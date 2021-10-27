
import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Example from './Example'
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

import './reactCss.css';



function ReactSearch() {

   const [musicians, setMusicians] = useState([]);
   const [bands, setBands] = useState([])
   const [selectedTerm, setSelectedTerm] = useState('')


   const [startDate, setStartDate] = useState(new Date());


   useEffect(() => {
      axios.get('http://127.0.0.1:8000/api/musicians')
         .then(response => {
            setMusicians(response.data.musiciansTest)

         })
         .catch(err => {
            console.log(err)
         })
   }, []);

   useEffect(() => {
      axios.get('http://127.0.0.1:8000/api/musicians')
         .then(response => {
            setBands(response.data.bands)

         })
         .catch(err => {
            console.log(err)
         })
   }, []);

   // console.log(musicians)
   // console.log(bands)


   const handleOnChange = e => {
      setSelectedTerm(e.target.value)
      console.log(e.target.value)
   }





   return (

      <>
         <div >

            <DatePicker selected={startDate} onChange={(date) => setStartDate(date)} />


            <label className="control-label">REACT Име </label>
            <input type="text" id="search2" name="search2" className="form-control form-control-sm col-auto " placeholder="Ime od react" onChange={handleOnChange} />



            {/* za bendovi e ova dole */}
            <label className="control-label">Bendovi React</label>
            <select className="select2 form-control form-control-sm col-auto"
               id="search5" name="search5"  >
               <option value=''>&nbsp;</option>
               {
                  bands.map(band => {
                     return (
                        <option

                           value={band.id}
                           // selected={band.id ==   ? true : false}
                           key={band.id} > {band.name}</option>
                     )
                  })
               }
            </select>




            {/* za pol e ova dole */}
            <label className="control-label">Pol React</label>
            <select className="select2 select2-lime form-control-sm col-auto"
               id="search4" name="search4">

               <option value="">&nbsp;</option>
               <option value="F"  >Zenski</option>
               <option value="M" >Maski</option>

            </select>




         </div >

      </>
   );

}

export default ReactSearch;

if (document.getElementById('reactSearch')) {
   ReactDOM.render(<ReactSearch />, document.getElementById('reactSearch'));
}



