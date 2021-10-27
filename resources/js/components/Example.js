import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import {Table, Button} from 'reactstrap';
import people from './data'
import { FaChevronLeft, FaChevronRight, FaQuoteRight } from 'react-icons/fa';
import axios from 'axios';

function Example({musicians}) {

    const [index, setIndex] = useState(0);



    const checkNumber = (number) => {

        if (number > musicians.length - 1) {
            return 0;
        }
        if (number < 0) {
            return musicians.length - 1;
        }
        return number;
    };

    //
    // const nextPerson = () => {
    //     setIndex((index) => {
    //         // let newIndex = index + 1;
    //         return checkNumber(index + 1);
    //     });
    // };
    //
    // //Metod za next. Ovde odime cisto za deka moze i vaka, preku let varijabla. same shit
    // const prevPerson = () => {
    //     setIndex((index) => {
    //         let newIndex = index - 1;
    //         return checkNumber(newIndex);
    //     });
    // };

    //metod za Suprise Me kopceto.Mora i so If za da ne dojde edno po drugo isto prikazuvanje
    const randomPerson = () => {
        //Math.random dava pomegu 0 i 1 po default. zatoa nie mnozime so length i ke se dvizi megju 0 i 3.99
        //povikuvame floor metod za da vratime na dolna decimala (ajo e 3.97 ke e 3) i so ova imame 0,1,2 i 3 opcii
        let randomNumber = Math.floor(Math.random() * musicians.length);
        //do ovde ke si raboti se, samo moze da ima edno po drugo dve random objekti
        if (randomNumber === index) {
            randomNumber = index + 1;
        }
        //mora i random da go povikame kroz checkNumber za da ne otide preku gorna i dolna granica
        setIndex(checkNumber(randomNumber));
    };

    const tick = () => {
        setIndex(prevIndex => prevIndex + 1)
    };

    useEffect(() => {
        const interval = setInterval(randomPerson, 2500)
        return () => {
            clearInterval(interval)
        }
    } );

console.log(musicians[index])


    //da prvo proveri dali vratilo fetchot posle renderiranjeto. Prviot pat na render ke bide default prazen array koj ke dava errori na undefined
     if (musicians.length === 0){
        return '';
    }
    const {name, image, tip, pateka} = musicians[index];


    return (


        <article className='review'>

            <div className='img-container'>

                {/*ne znam kkao da povlecam image od DB od muzicari so url zatoa dava error i ne pokazuva slika na muzicarot*/}
                {/*<img src={`public/upload/musicians/2/${pictures}`}  alt={name} className='person-img' />*/}
               <img src={image} alt={name} className='person-img'/>
                <span className='quote-icon'>
                    <FaQuoteRight />
                </span>
            </div>
            <h4 className='author'>{name}</h4>
            <p className='job'>{tip}</p>
            <p className='info'>{pateka}</p>
            {/*<div className='button-container'>*/}
                {/*<button className='prev-btn' onClick={prevPerson}>*/}
                    {/*<FaChevronLeft />*/}
                {/*</button>*/}
                {/*<button className='next-btn' onClick={nextPerson}>*/}
                    {/*<FaChevronRight />*/}
                {/*</button>*/}
            {/*</div>*/}
            {/*<button className='random-btn' onClick={randomPerson}>*/}
                {/*surprise me*/}
            {/*</button>*/}
        </article>
    );
}
export default Example;

// if (document.getElementById('example')) {
//     ReactDOM.render(<Example />, document.getElementById('example'));
// }
