let button= document.querySelector(".testeTudo button"), ul = document.querySelector(".testeTudo ul");
button.addEventListener("click", function(){
    let li = document.createElement("li");
    li.innerText = "Sou nova aqui!"
    ul.prepend(li);
})

let button1= document.querySelector(".testeTudo1 button"), p = document.querySelector("p"), arrayy = ["1","2","3","4","5","54"], comprimento = arrayy.length, msg = "";

button1.addEventListener("click", function(){
    for(let i = 0; i < comprimento; i++){
        let = soma = (i+1);
        msg +=`${soma}°: contagem: ${arrayy[i]}</br>`
        p.innerHTML = msg;
    }
});

let testeTudo = document.querySelectorAll(".testeTudo").children;
let testeTudo1 = document.querySelector(".testeTudo1").offsetHeight;


let valor1;
let valor2;
let buttonV = document.querySelector(".pegarValor button")
buttonV.addEventListener("click", function(){
    valor1 = parseInt(document.querySelector("#valor1").value);
    valor2 = parseInt(document.querySelector("#valor2").value);
    let p = document.querySelector(".pegarValor p")
    p.innerHTML = `a soma de ${valor1}+${valor2} = ${valor1+valor2}`
    let soma = valor1 + valor2;
});

// ocultar 
const container = document.getElementById("container"),
buttonLimpa = document.getElementById("buttonLimpa"),
uum = document.getElementById("uum");
let teste2 = [container.children[0].offsetHeight, buttonLimpa];

if(buttonLimpa){
    buttonLimpa.addEventListener('click', function(){
        container.classList.add('show-limpa');
        buttonLimpa.style.display="none"
        uum.style.display="block";
    });
};
if(uum){
    uum.addEventListener('click', function(){
        container.classList.remove('show-limpa');
        buttonLimpa.style.display="block";
        location.reload();  
    });
};
console.log(teste2);