
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

   // Najverojatno mora so dva useeffecti kao bi rabotele so dvata state-ta posebno 
   //Mi pravi problem musicians od saso posto vlece i current page i ako bi mi  trebalo da napravm map nema ke dade undefined 
   // error iako ke gi vlece podatocite vo console.log
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


            {/* VIP - preku name atributot laravel go cita value-to na toj html element, bez razlika dali e vo blade ili ovde, i vsusnost kaj dropdown-ot opciite koga ke se kliknat valueto nivno stanuva value na select tagot, a posto select ima name nekojsi search5 ili 4 ili 3, toa value ke vleze kaj select i preku name-ot ke otide da se proveruva ako e isset vo repositorito a potoa vo controllerot. VALUE-TO kaj option e id na bendot zapazi toa */}

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



{/* <div >
   <label className="control-label">{{ trans('properties.musicians.index.search5') }}</label>
   <select class="select2"
      id="search5" name="search5" onchange="this.form.submit()" style="width: 100%">
                                            @if(count($bands)>0)
      <option value="">&nbsp;</option>
      <option value="0"  {{ ((app('request') -> input('search5')) == '0') ? 'selected' : ''}}>{{ trans('properties.musicians.index.table_band_international') }}</option>
   @foreach($bands as $band)
   <option
      value="{{$band->id}}" {{ ((app('request') -> input('search5')) == $band -> id) ? 'selected' : ''}}>{{ $band-> name}}</option>
@endforeach
@endif
      </select >
                                    </div >
   {{ --@endif--}
} */}