
    <head>
        <link href="{{asset('css/tablaEscenarios.css')}}" rel="stylesheet">
        <title>Escenarios</title>
    </head>
    <body>
        <div id="contenidoEscenarios"> 
            <p class="text-left font-weight-bold text-muted" href="#">Listado de Escenarios</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtIdSilaboEsc" name="txtIdSilaboEsc" value="{{session('idSilabo')}}">
            <div class="row col-md-12 ">
                    <div class="col-md-6">
                        <table id="tablaEscenarios" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Escenario</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6 align-self-center">
                    </div>
            </div>         
            </div>     
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                           
                            var recursos=$('#tablaEscenarios').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/escenario2",
                            },
                            columns:[
                                {data:'descripcion_escenario'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

        </script>   
       
    <body>
