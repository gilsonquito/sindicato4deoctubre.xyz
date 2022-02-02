    <head>
        <link href="{{asset('css/tablaMetodos.css')}}" rel="stylesheet">
        <title>Metodos</title>
    </head>
    <body>
        <div id="contenidoMetodos">
            <p class="text-left font-weight-bold text-muted" href="#">MÉTODOS</p>
                <hr color="" class="border border-muted w-100 p-0">
            <input type="hidden" id="txtSilaboM" name="txtSilaboM" value="{{session('idSilabo')}}">
            <div class="row w-100">
                    <div class="col col-md-6">
                        <div>
                            <table id="tablaMetodos"  class="table table-striped table-bordered table-responsive-lg w-100">
                                <thead  class="font-weight-bold text-dark ">
                                    <td scope="col-md-4">Metodos</td>
                                    <td scope="col-md-3">Acciones</td>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col col-md-6 align-self-center"> 
                    </div>  
            </div>     
        </div>        
            <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var metodos=$('#tablaMetodos').DataTable({
                            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                            ajax:{
                                url:"/metodos2",
                            },
                            columns:[
                                {data:'descripcion_metodo'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

            </script>    
        
    <body>
