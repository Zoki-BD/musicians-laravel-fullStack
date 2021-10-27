import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { Table, Button } from 'reactstrap';
import people from './data'
import { FaChevronLeft, FaChevronRight, FaQuoteRight } from 'react-icons/fa';
import axios from 'axios';

function Example({ musicians }) {

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


   const randomPerson = () => {

      let randomNumber = Math.floor(Math.random() * musicians.length);

      if (randomNumber === index) {
         randomNumber = index + 1;
      }

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
   });

   console.log(musicians[index])



   if (musicians.length === 0) {
      return '';
   }
   const { name, image, tip, pateka } = musicians[index];


   return (


      <article className='review'>

         <div className='img-container'>


            <img src={image} alt={name} className='person-img' />
            <span className='quote-icon'>
               <FaQuoteRight />
            </span>
         </div>
         <h4 className='author'>{name}</h4>
         <p className='job'>{tip}</p>
         <p className='info'>{pateka}</p>

      </article>
   );
}
export default Example;

// if (document.getElementById('example')) {
//     ReactDOM.render(<Example />, document.getElementById('example'));
// }
