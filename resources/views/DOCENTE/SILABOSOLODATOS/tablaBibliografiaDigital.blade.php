<head>   
    <link href="{{asset('css/tablaBdigital.css')}}" rel="stylesheet">
    <title>Webgrafías</title>
</head>
    <body>
        <div id="contenidoBibliCom"> 
            <input type="hidden" id="txtIdSilaboBdigital" name="txtIdSilaboBdigital" value="{{session('idSilabo')}}">
            <div class="w-100">
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBdigitals" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-9">Bibliografía Digital</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>     
            </div>        
            </div> 
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var bdigital=$('#tablaBdigitals').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/bdigital2",
                            },
                            columns:[
                                {data:'descripcion_bdigital'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>  
       
    <body>