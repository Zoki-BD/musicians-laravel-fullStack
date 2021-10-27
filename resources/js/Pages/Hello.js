
import ReactDOM from 'react-dom';
import React, { useState } from 'react';
// import Icofont from 'react-icofont';
import Jumbotron from 'react-bootstrap/Jumbotron';
import Toast from 'react-bootstrap/Toast';
import Container from 'react-bootstrap/Container';
import Button from 'react-bootstrap/Button';

const ExampleToast = ({ children, name, showHandle, show }) => {

   // const [show, toggleShow] = useState(false);

   return (
      <>
         <Button onClick={showHandle}>Show Toast</Button>
         <p>ffff</p>
         <article>
            <h2>
               {name}
            </h2>
         </article>
      </>
   );
};

function Hello(props) {

   // const {musicians} = props.musiciansTest
   console.log(props.musiciansTest)

   const [show, toggleShow] = useState(false);
   return (

      <Container className="p-3">
         <Jumbotron>
            <h1 className="header">Welcome To React-Bootstrap</h1>

            We now have Musicians
            <span role="img" aria-label="tada"></span>

            <div>
               {props.musiciansTest.map((item) => {
                  return <ExampleToast key={item.id} {...item} showHandle={() => toggleShow(true)} show={show} />
               })}
            </div>



         </Jumbotron>
      </Container>

   )
}


export default Hello;


//Ova dole ne ni treba so inertia ova e potrebno ako odime po regularen pat na mix react so laravelpreku api
// i na ovoj nacin vikame deka tamu kade vo nekoj blade e <div id='hello'></div> tamu ke se pojavi ova.
//Ne zaboravaj deka togas mora i  vo resources vo app.js da napravis  require('./Pages/Hello');

if (document.getElementById('hello')) {
   ReactDOM.render(<Hello />, document.getElementById('hello'))
}
