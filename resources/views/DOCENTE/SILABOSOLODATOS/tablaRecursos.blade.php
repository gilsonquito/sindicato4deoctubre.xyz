    <head>
        <link href="{{asset('css/tablaRecursos.css')}}" rel="stylesheet">
        <title>Recursos</title>
    </head>
    <body>
        <div id="contenidoRecursos"> 
            <p class="text-left font-weight-bold text-muted" href="#">RECURSOS</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtSilaboR" name="txtSilaboR" value="{{session('idSilabo')}}">
            <div class="row col-md-12">
                    <div class="col-md-6">
                        <table id="tablaRecursos" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Recurso</td>
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
                            var recursos=$('#tablaRecursos').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/recurso2",
                            },
                            columns:[
                                {data:'descripcion_recurso'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

        </script>   
       
    <body>
