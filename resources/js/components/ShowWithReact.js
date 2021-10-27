
import ReactDOM from 'react-dom';
import React, {useState, useEffect} from 'react';
import axios from 'axios';
import Example from './Example'
import './reactCss.css';


function ShowWithReact() {


    const [musicians, setMusicians] = useState([]);
    const [musiciansLaravel, setMusiciansLaravel] = useState([]);


    const musiciansFetched = async () => {
        try{
            const response = await fetch(' https://api.github.com/users');
            // const response = await fetch('http://127.0.0.1:8000/api/musicians'); //ova bese od Muzicari db ama nema path za picture i ne gi vlece sliite dobro
            const data = await  response.json();

            //ova dole so if bi se proveruvalo ako imame moment kade bi ni trebalo vo Example da preku input vo nekoja form
            //barame da ni gi povika fetchot ili pa preku buuton da pravime fetch. I tagas znaci ke sakame da proverime da ako nema
            //nisto vo DB da ne odnese na nekoja druga stranica (primer Error.js komponenta ako imame) i da ni ja pokaze taa.Za ova treba router
            //Ke vidis primer vo 15 react projects kaj COcktails vezbata.
            // so if proveruvame dali ke ima nesto vo data ili ke vrati prazen array na primer ako kucneme ne
            if(data){
                //ova dole so map e finta da ako ne ni se svigjaat iminjata dadei vo api-to da direkt pri fetch gi smenime vo nekoi pologicni za nas
                const changedData = data.map(item => {
                    const {login, avatar_url, type, url} = item; //ova se tie od api-to a so pri returnot im dodeluvame novi
                    return {
                        name: login,
                        image: avatar_url,
                        tip: type,
                        pateka: url,}
                });
                setMusicians(changedData);
            } else { //demek ako vrati null api-to(pazi ova ne e fetch error tuku samo prazen vraten array, sepak fetchot e uspesen)
                setMusicians([])
            }
        } catch (err)  {
            console.log(err)
        }
    };

    useEffect(() =>{
       musiciansFetched();
    },[]);

    if (musicians.length === 0) {
        console.log('dddd');
    }


    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/musicians')
            .then(response => {
                setMusiciansLaravel(response.data.instruments)

            })
            .catch(err => {
                console.log(err)
            })
    },[]);

   console.log(musiciansLaravel)

    return (
        <>
            <section className='container'>
                <div className='title'>
                    <h2>Активни музичари</h2>

                    <div className='underline'></div>
                </div>
                <Example musicians={musicians} />
                {
                    musiciansLaravel.map(musician => <li key={musician.id}> {musician.name} - {musician.id} </li>)
                }
            </section>

        </>
    );
}


//function ShowWithReact() {
//     const [musicians, setMusicians] = useState([]);
//
// useEffect(() => {
//     axios.get('http://127.0.0.1:8000/api/musicians')
//     .then(response => {
//        setMusicians(response.data)
//
//     })
//         .catch(err => {
//             console.log(err)
//         })
// });
//
//     return (
//
//         <ol>
//             <div><Example/></div>
//               {
//                 musicians.map(musician => <li  key={musician.id}> {musician.name} - {musician.id} </li>)
//               }
//         </ol>
//
//     );
//}

export default ShowWithReact;

if (document.getElementById('showWithReact')) {
    ReactDOM.render(<ShowWithReact />, document.getElementById('showWithReact'));
}
