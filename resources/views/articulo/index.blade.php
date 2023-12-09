@extends('layouts.plantillaBase2') 
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
@section('contenido')
<style>
.acciones{
padding-right: 0px;
padding-left: 0px;
}
.lote{
    color: rgb(21, 96, 236);
}
.eliminar{
    color:red;
}
table.dataTable td {
  text-align: center;
}
table.dataTable tr {
  text-align: center;
}
table.dataTable th {
  text-align: center;
}
.modal-header{
    background-color: rgb(255, 87, 51 ) !important;
    color: white;
}
.btn-close{
    background-color: white;
}
.contendorCategoria{
    display: inline-block;
    background-color : #cccd!important;
    padding: 5px;
    border-radius: 10px;
    
}

</style>

<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-3 fs-1 fw-bold text-dark" > Listado de los Artículos </h2>
    </div>
    <a href="/articulos/create" type="button" class="btn btn-primary rounded-pill ">+ Artículo <i class="fa-solid fa-store"></i></a>
    <div class="contendorCategoria">
        <select  id='categoria' class="btn btn-primary rounded-pill" name="categoria" style="width:150px">
            <option  id ="0" value = "0" class="seleccion" title="todas las categorías" >Categorías <span><i class="fa-solid fa-list-ul"></i> </span><i class="fa-solid fa-store"></option>
            @foreach($categoria as $unaCategoria)
                @if($unaCategoria->id == $idCategoria)
                <option  id ="{{$unaCategoria->id}}" value = "{{$unaCategoria->id}}" class="seleccion" selected>{{$unaCategoria->id}}-{{$unaCategoria->descripcion}}</option>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                @else
                <option  id ="{{$unaCategoria->id}}" value = "{{$unaCategoria->id}}" class="seleccion">{{$unaCategoria->id}}-{{$unaCategoria->descripcion}}</option>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                @endif
            @endforeach
        </select>
        <button type="button" class="btn btn-primary rounded-pill" title="Agregar una nueva categoría de artículo" data-bs-toggle="modal" data-bs-target="#exampleModalCategoria"  id ='agregarCategoria'><i class="fa-solid fa-plus"></i> </button>
    </div>
</div>  
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col"class="text-center"                 >Codigo     </th>
                <th scope="col"class="text-center text-break col-3">Descripción</th>
                <th scope="col"class="text-center"                 >Precio     </th>
                <th scope="col"class="text-center"                 >Categoría  </th>
                <th scope="col"class="text-center"                 >Acciones   </th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $unArticulo)
                <tr>
                    <td class='text-break col-3' title="código de categoria -código de artículo" >{{$unArticulo->codigo}}</td>
                    <td class='text-break col-3'>{{$unArticulo->descripcion}}</td>
                    <td>${{$unArticulo->precioVenta}}</td>

                    @if (empty($unArticulo->categoria->descripcion))
                        <td></td>
                    @else
                    <td>{{$unArticulo->categoria->descripcion}}</td>
                    @endif

                    <td class="acciones w-25">    
                        <a href="/Lotes/{{$unArticulo->id}}/lote" name="lotes" class="btn lote" title="lotes"><i class="fa fa-archive"></i></a>
                        <a href="/articulos/{{$unArticulo->id}}/edit " name="Editar" class="btn " title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button class="btn btn eliminar" title="Eliminar" id="{{$unArticulo->id}}" value= '{{$unArticulo->id}}'><i class="fa-solid fa-trash-can"></i></button>       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal Categorias-->
<div class="modal fade" id="exampleModalCategoria" tabindex="-1" aria-labelledby="exampleModalLabelCategoria" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong id= 'tituloModal'><strong> Nueva categoria</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/categorias" method ="POST" id="formulario" name="formulario">
        @csrf
        <div class="modal-body cuerpo_modal">
        
        <!--Grupo Categoria -->
        <div class="mb-3">
            <div class="formulario__grupo" id="grupo__descripcion">
                <label for="descripcion" class="formulario__label text-dark" title="Caracteristicas del producto.Breve descripción del mismo" >Descripción *</label>
            <div class="formulario__grupo-input">
                <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" placeholder=" " maxlength="100" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
        <br>
        <p class="formulario__input-error">La categoría puede contener letras y número hasta 100 caracteres</p>
        </div>
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrar">Cerrar</button>
              <button type="submit"  class="btn btn-primary" id ="botonGuardar">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{asset('validarCategoria.js')}}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
            $('#example').DataTable({
                "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
                "order": [], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
                responsive:true, 
                language: {
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
            }); 
     /*------------------------------------------------ */
        let id       = 0;
        let botones  = document.getElementsByClassName("eliminar");
        let boton    = [];
        let cantidad = botones.length;

            for(let i = 0; i < cantidad; i++){
                
                id      = botones[i].id;
                boton[i]= document.getElementById(`${id}`);
                
                boton[i].addEventListener('click', function(){
                    
                        var cod       = boton[i].value;
                        let articulos = @json($articulos);
                        let longArt   = articulos.length;

                        for(let l=0 ;l<longArt; l++ ){

                            if(articulos[l].id == cod){
                                
                                Swal.fire({
                                    
                                    title: 'Esta Seguro que desea Borrar el articulo '+articulos[l].descripcion+'?',
                                    text: "confirme la decisión!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, eliminar'

                                }).then((result) => {

                                    if (result.isConfirmed) {
                        
                                        location.href = '/articulos/'+cod+'/delete'; 
                                    }
                                });
                            }
                        }
                    })
                }
</script>
<script>
    let clasificacion = document.getElementById('categoria');

    clasificacion.addEventListener('change', function(){
        location.href ='/Articulo/Por/Categoria/'+clasificacion.value;
    })
    
</script>
<script>
    let agregarCategoria = document.getElementById('agregarCategoria');
        agregarCategoria.addEventListener('click', function(){
        document.getElementById('descripcion').value = '';
    })
</script>
@endsection        

