/**
 * ES6 ECMAScript 6
 * @see http://es6-features.org/
 * @see https://www.w3schools.com/js/js_es6.asp
 */

/* Modules */
import { name, age } from "./mod.js";
import message from "./message.js";


const message = { id: 'Hello world' }; // Try edit me
message.id = 'Alpha';
var x = function (y, z = 'default value') {return y + 1}
function sum(...args) {} // variadic

const z = (y) => y + 5
const q1 = ["Jan", "Feb", "Mar"];

for (let a of q1) {
    console.log(a)
}

const pro = new Promise(function(res, rej) {
    rej('ok')
    setTimeout(function() {res('ok')}, 100)
}).then(
    function(v) {console.log(v)},
    function(err) {console.log('blob')}
)

document.querySelector('#header').innerHTML = 
  message.id
  + ' '
  + [...q1, 'Avr'].join('.')
  + "<br/>"
  + [...q1, 'Mai'].map((a) => a)

/** String */
text.includes("world").startsWith("w").endsWith('a')

/** Arrays */
Array.from("ABCDEFG")   
const numbers = [4, 9, 16, 25, 29];
numbers
    .find(function (value, index, array) { return value > 18; })
    .findIndex(myFunction)

// Number
Number.isInteger(10); // return true
Number.isSafeInteger(12345678901234567890);  // returns false
isNaN("Hello"); // return true

/** SYMBOLS */
// Symbol is a primitive data type. represents a unique "hidden" identifier that no other code can accidentally access
const person = { name: 'J' }; let id = Symbol('id'); person[id] = 1523
console.log(person) // {name: "J"}
Symbol("id") == Symbol("id"); // false (always unique)