let txt = document.getElementById('username');

const input = document.getElementById('username');

let error = document.getElementById('error');
error = '';

check();
function check(){
    if(txt != ''){
        this.style.bordercolor = 'red';
    }else{
        
    }
}

error.text = txt.value();

alert('Hello');
