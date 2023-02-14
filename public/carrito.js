productos = [
    {
        id:1,
        nombre:"Dogui alimento para perros",
        descripcion: "Cachorros 1 a 3 años -Bolsa 10kg",
        precio:4500,
        img:'https://ardiaprod.vtexassets.com/arquivos/ids/230974/Alimento-para-Perros-Dog-Chow-Cachorros-15-Kg-_1.jpg?v=638026465703870000'
    },
    {
        id:2,
        nombre:"Gati alimentos para gatos ",
        descripcion: "Cachorros 3 a 12 meses -Bolsa 10kg",
        precio:5500,
        img:'https://http2.mlstatic.com/D_NQ_NP_857035-MLA41668326991_052020-O.jpg'
    },
    {
        id:3,
        nombre:"Dogui alimento para perros",
        descripcion: "Cachorros 1 a 3 años -Bolsa 10kg",
        precio:4500,
        img:'https://ardiaprod.vtexassets.com/arquivos/ids/230974/Alimento-para-Perros-Dog-Chow-Cachorros-15-Kg-_1.jpg?v=638026465703870000'
    },
    {
        id:4,
        nombre:"Gati alimentos para gatos ",
        descripcion: "Cachorros 3 a 12 meses -Bolsa 10kg",
        precio:5500,
        img:'https://http2.mlstatic.com/D_NQ_NP_857035-MLA41668326991_052020-O.jpg'
    },
    {
        id:5,
        nombre:"Dogui alimento para perros",
        descripcion: "Cachorros 1 a 3 años -Bolsa 10kg",
        precio:4500,
        img:'https://ardiaprod.vtexassets.com/arquivos/ids/230974/Alimento-para-Perros-Dog-Chow-Cachorros-15-Kg-_1.jpg?v=638026465703870000'
    },

]; 


/*creamos el lugar donde se van a ver los productos*/

const listaProductos = document.querySelector('#listaProductos');

const fragmento = document.createDocumentFragment(); 

const carro2 = [];
productos.forEach(productos => {
    /*recorremos el arreglo, luego sera el que venga de la base de datos*/

    /*creeate elemente crea la la etiqueta de forma dinamica*/ 
    
const card = document.createElement('div');
card.className ="card "
card.id=productos.id
const titulo = document.createElement('div');
titulo.className = "card-titulo"
titulo.textContent = productos.nombre
const cuerpo = document.createElement('div');
cuerpo.className = "card-cuerpo"
cuerpo.textContent = productos.descripcion 
const imagen = document.createElement('img');
imagen.className = "card-imagen";
imagen.src=`${productos.img}`
const precio = document.createElement('p')
precio.innerHTML = `precio: <strong>$${productos.precio} </strong>`
const agregar = document.createElement('button');
agregar.innerHTML = `+ Agregar <i class="fa-solid fa-cart-shopping"></i>`
agregar.className = "card-agregar"
agregar.title=`Agregar ${productos.nombre} al carrito`

/*cada elemento tiene que tener un padre*/ 
card.appendChild(titulo);
card.appendChild(cuerpo);

card.appendChild(imagen);
card.appendChild(precio);
card.appendChild(agregar);
fragmento.appendChild(card);
const carro = document.querySelector('.carrito');
const alertaCarrito = document.querySelector('.alertaCarrito');
agregar.addEventListener('click',function(){
  
carro.innerHTML="";
carro2.push(productos); 
let tamanio = carro2.length;
 carro2.forEach(elementos => {
carro.innerHTML += `<div class="card"><p>id:${elementos.id} <br>${elementos.nombre} <br> <div class="text-danger">$${elementos.precio} </div><br> </p></div>`;

}); 
console.log(carro2)
alertaCarrito.innerHTML = ` ${tamanio}`
          
}); 

});
/*manda el listado del fragmento a la etiqueta listaProductos*/ 
listaProductos.appendChild(fragmento);
