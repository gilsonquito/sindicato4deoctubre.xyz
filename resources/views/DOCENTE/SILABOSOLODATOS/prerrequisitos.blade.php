    <head>
        <link href="{{asset('css/prerrequisito.css')}}" rel="stylesheet">
    <title>Prerrequisitos</title>
    </head>
    <body>  
        <div id="datosPrerrequisitos" class="px-3">    
                <input type="hidden" id="txtIdSilaboP" name="txtIdSilaboP" value="{{session('idSilabo')}}">
                <p class="text-left font-weight-bold text-muted" href="#">Listado de prerrequisitos</p>
                <hr color="" class="border border-muted w-100 p-0">
              
                <div class="row col-md-12 ">
                    <div class="col-md-6">
                        <table id="tabla_prerrequisitos" class="table-bordered  ">
                                <thead class="font-weight-bold text-center text-dark" >
                                    <td class="col-md-2 py-2">Prerrequisito</td>
                                    <td class="col-md-1 py-2">Acciones</td>
                                </thead>    
                        </table>   
                    </div>                                        
                </div>      
        </div> 
        <script> //cargar tabla en el index
          
                    $(document).ready(function(){
                            prerrequisito=$('#tabla_prerrequisitos').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:false,  
                            //:false,
                            ajax:{
                                url:"/prerrequisitos2",
                            },
                            columns:[
                                {data:'descripcion_prerrequisito'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
            </script> 
       
        <body>
</html>