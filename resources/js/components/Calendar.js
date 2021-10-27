import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react'
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";




function Calendar() {

   const [musicians, setMusicians] = useState([]);

   const [startDate, setStartDate] = useState(null);
   const [id, setId] = useState('')




   useEffect(() => {
      axios.get(`http://127.0.0.1:8000/api/musicians/${id}`)
         .then(response => {
            setMusicians(response.data.id)

         })
         .catch(err => {
            console.log(err)
         })
   }, [id]);


   console.log(musicians)


   return (
      <div>

         <DatePicker
            selected={startDate}
            onChange={(date) => setStartDate(date)}
            dateFormat='dd/MM/yyyy'
            // minDate={new Date()}
            showYearDropdown
            scrollableMonthYearDropdown

         />
         {/* <div id="calendar">
            <input type="text" id="date_birth" name="date_birth" className="form-control" onChange={e =>}
               value={id}
               readOnly />
         </div> */}

      </div>
   )
}


export default Calendar;

if (document.getElementById('calendar')) {
   ReactDOM.render(<Calendar />, document.getElementById('calendar'));
}
