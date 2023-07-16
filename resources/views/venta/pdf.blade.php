
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comprobante de venta {{date('d-m-Y H:i:s', strtotime($venta->fecha))}}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  
        <style>
            .contenedor{
                width: 100% !important;
            }

            .cabeceraComprobante{
                border: 3px solid rgba(100, 83, 153, 1);
                width: 100% !important;
                height: 150px !important;
                align-items: center;
            }

            .width-20{
                width: 20% !important;
                float: left;
            }

            .width-30{
                width: 30% !important;
                float: right !important;
                margin-top: 15px;
            }

            .width-50{
                width: 50% !important;
                text-align: center !important;
                align-items: center !important;
                position: absolute;
                top: 25;
                left: 130;
            }

            .imagen{
                width: 100% !important;
                margin-left: 5%;
                margin-top: 2%;
            }

            .displayInline{
                display: inline-block !important;
            }

            .contenedorX{
                border: 2px solid black;
                border-radius: 2px;
                width: 50px;
                height: 50px;
            }

            .textoVioleta{
                color: rgba(100, 83, 153, 1);
            }

            h6{
                font-size: 15px;
            }

            .col-4{
                width: 40% !important;
            }

            th{
                font-size: 12px;
                font-weight: bold;
            }

            td{
                font-size: 12px;
            }

            .table{
                border: 3px solid rgba(100, 83, 153, 1);
            }

            thead{
                background-color: rgba(100, 83, 153, 1);
                color: white;
            }

        </style>


        <div class="contenedor">
            <div class="cabeceraComprobante">
                <div class="width-20 displayInline">
                    <img class="imagen" src="{{public_path(). '/iconos/logo_factura.jpg'}}" alt="logo_principal">
                </div>
                <div class="width-30 displayInline">
                    <h6>Clínica veterinaria San Agustín</h6>
                    <h6>Domicilio: Selva de Montiel 681, Paraná, Entre Ríos</h6>
                    <h6>Teléfono: 0343-4077466</h6>
                    <h6>Fecha de emisión: {{date('d-m-Y', strtotime($venta->fecha))}}</h6>
                </div>
            </div>
            <div class="width-50 displayInline">
                <div class="contenedorX" style="margin-left: 40%;">
                    <p style="font-size: 25px; font-weight: 900;">x</p>
                </div>
                <h6>Documento no válido como factura</h6>
            </div>

            <table id="example" class="table mt-5" style="width:100%">
                <thead>
                <tr>
                    <th scope="col" style="width: 25%;">Descripción</th>
                    <th scope="col" style="width: 15%;">Precio x ud.</th>
                    <th scope="col" style="width: 10%;">Cantidad</th>
                    <th scope="col" style="width: 20%;">Descuento x ud.</th>
                    <th scope="col" style="width: 20%;">Descuento total</th>
                    <th scope="col" style="width: 10%;">Subtotal</th>
                </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach($detalles as $unDetalle)
                    <tr class="text-center">
                        <td scope="col" style="width: 25%;">{{$unDetalle->descripcion}}</td>
                        <td scope="col" style="width: 15%;">${{$unDetalle->subtotal/$unDetalle->cantidad}}</td>
                        <td scope="col" style="width: 10%;">{{$unDetalle->cantidad}}</td>
                        <td scope="col" style="width: 20%;">-${{$unDetalle->descuento}}</td>
                        <td scope="col" style="width: 20%;">-${{$unDetalle->descuento * $unDetalle->cantidad}}</td>
                        <td scope="col" style="width: 10%;">${{$unDetalle->subtotal}}</td>
                    </tr>
                    @endforeach

                    @php
                        $vuelto = ($venta->montoPagado-$venta->total);
                    @endphp
                    <tr class="text-center bg-white">
                        <td scope="col" style="width: 25%;"></td>
                        <td scope="col" style="width: 15%;"></td>
                        <td scope="col" style="width: 10%;"></td>
                        <td scope="col" style="width: 20%;"></td>
                        <td scope="col" style="width: 20%; text-align:end;"><h6>Total:</h6></td>
                        <td scope="col" style="width: 10%;"><h6><strong>${{$venta->total}}</strong></h6></td>
                    </tr>
                    <tr class="text-center">
                        <td scope="col" style="width: 25%;"><h6 id="pago">Abonado:</h6></td>
                        <td scope="col" style="width: 15%;"><h6>${{$venta->montoPagado}}</h6></td>
                        <td scope="col" style="width: 10%;"><h6>Vuelto:</h6></td>
                        <td scope="col" style="width: 20%;"><h6>${{$vuelto}}</h6></td>
                        <td scope="col" style="width: 20%;"></td>
                        <td scope="col" style="width: 10%;"></td>
                    </tr>
            </tbody>

            </table>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>