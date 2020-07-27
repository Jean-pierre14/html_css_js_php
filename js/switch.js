// switch (new Date().getDay()) {
//     case 0:
//         day = "Sunday";
//         break;
//     case 1:
//         day = "Monday";
//         break;
//     case 2:
//         day = "Tuesday";
//         break;
//     case 3:
//         day = "Wednesday";
//         break;
// }
// document.getElementById('demo').innerHTML = "Today is: " + day;



// for loop
var kids = ["Grace", "germain", "Adolpher", "Daniel", "Espoire"];
// let text = "";
// let i;
for (i = 0; i <= kids.length; i++ ){
    text += kids[i] +"<br>";
}
// document.getElementById('demo').innerHTML = text;

let person = {fname: "grace ", sname: "Bisimwa ", age: 23}
let x
let txt = ''
for(x in person){
    txt += person[x]
}
document.getElementById('for').innerHTML = txt

// While loop

let b = 1,a = 10

let t = ''
while(b <= a){
    t += "N: >"+b+++"<br>"
}
document.getElementById('t').innerHTML = t

// Do While
var text = ""
var i = 0;

do {
    text += "<br>The number is " + i;
    i++;
}
while (i < 10);  

document.getElementById("demo").innerHTML = text;