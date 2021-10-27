
import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';
import axios from 'axios';
//import Example from './Example'
import './reactCss.css';


function ModalReact() {


   const [musicians, setMusicians] = useState([]);


   useEffect(() => {
      axios.get('http://127.0.0.1:8000/api/musicians')
         .then(response => {
            setMusicians(response.data)

         })
         .catch(err => {
            console.log(err)
         })
   }, []);

   console.log(musicians.bands);


   return (
      <>
         <section className='container'>
            <div className='title'>
               <h2>Активни музичари</h2>

               <div className='underline'></div>
            </div>
            {
               musicians.bands.map(item => {
                  return (
                     <li key={item.id}>{item.name}</li>
                  )
               })
            }


            {/* {
               musicians.bands.map(item => {
                  const { name, id } = item;
                  console.log(name)
                  return (
                     <ul>
                        <li key={id}>{name}</li>
                     </ul>
                  )
               })
            } */}

         </section>

      </>
   );
}


export default ModalReact;

if (document.getElementById('modalReact')) {
   ReactDOM.render(<ModalReact />, document.getElementById('modalReact'));
}

