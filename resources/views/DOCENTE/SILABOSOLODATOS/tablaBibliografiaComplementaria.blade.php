<head>   
    <link href="{{asset('css/tablaBobliografiaComplementaria.css')}}" rel="stylesheet">
    <title>BibliografiaComplementarias</title>
</head>
    <body>
        <div id="contenidoBibliCom"> 
            <input type="hidden" id="txtIdSilaboBibCom" name="txtIdSilaboBibCom" value="{{session('idSilabo')}}">
            <div class="w-100">
                   
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBibliografiaComplementarias" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-9">Blibliografia Complementaria</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>     
            </div>            
        </div> 
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var recursos=$('#tablaBibliografiaComplementarias').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/bcomplementaria2",
                            },
                            columns:[
                                {data:'descripcion_bibliografia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>  
    <body>