let mostrador = document.getElementById("mostrador");
let seleccion = document.getElementById("seleccion");
let imgselec = document.getElementById("img");
let modelselec = document.getElementById("modelo");
let descripcionselec = document.getElementById("descripcion");
let precioselec = document.getElementById("precio");


function cargar(item){
    quitarbordes();
    mostrador.style.width="60%";
    seleccion.style.width="40%";
    seleccion.style.opacity="1";
    item.style.border="2px solid red";

if(item){
    item.style.marginTop = "50px";
}

imgselec.src=item.getElementsByTagName("img")[0].src;
modelselec.innerHTML=item.getElementsByTagName("p")[0].innerHTML;
descripcionselec.innerHTML=item.getElementsByTagName("p")[1].innerHTML;
precioselec.innerHTML=item.getElementsByTagName("span")[0].innerHTML;
    
}

function quitarbordes(){

    var items =document.getElementsByClassName("item");
    
    for(i=0; i<items.length; i++){
        items[i].style.border="none";
    }

}

function cerrar(){
    mostrador.style.width="100%";
    seleccion.style.width="0%";
    seleccion.style.opacity="0%";
    quitarbordes();
}