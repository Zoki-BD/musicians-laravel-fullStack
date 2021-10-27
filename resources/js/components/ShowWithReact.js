
import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Example from './Example'
import './reactCss.css';


function ShowWithReact() {


   const [musicians, setMusicians] = useState([]);
   const [musiciansLaravel, setMusiciansLaravel] = useState([]);


   const musiciansFetched = async () => {
      try {
         const response = await fetch(' https://api.github.com/users');

         const data = await response.json();


         if (data) {

            const changedData = data.map(item => {
               const { login, avatar_url, type, url } = item;
               return {
                  name: login,
                  image: avatar_url,
                  tip: type,
                  pateka: url,
               }
            });
            setMusicians(changedData);
         } else {
            setMusicians([])
         }
      } catch (err) {
         console.log(err)
      }
   };

   useEffect(() => {
      musiciansFetched();
   }, []);

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
   }, []);

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


export default ShowWithReact;

if (document.getElementById('showWithReact')) {
   ReactDOM.render(<ShowWithReact />, document.getElementById('showWithReact'));
}
