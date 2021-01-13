// console.log('Hello World');
import React from "react";
import ReactDOM from "react-dom";

function Person(props){
    return (
        <div className="person">
            <h1>{props.name}</h1>
            <p>Age: {props.age}</p>
        </div>
    );
}

const app = (
    <>
        <Person name="Matt" age="22" />
        <Person name="John Doe" age="20" />
    </>
)

ReactDOM.render(
    app,
    document.querySelector('#people')
);