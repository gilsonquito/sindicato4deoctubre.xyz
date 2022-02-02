
    <link href="{{asset('css/tablaBibliografia.css')}}" rel="stylesheet">
    <body>
        <div id="contenidoBibliografias"> 
            <p class="text-left font-weight-bold text-muted" href="#">Listado de bibliografias</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtIdSilaboBib" name="txtIdSilaboBib" value="{{session('idSilabo')}}">
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBibliografias" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Tipo de Bibliografía</td>
                                <td class="col-md-4">Título</td>
                                <td class="col-md-4">Autor</td>
                                <td class="col-md-4">Tipo de documento</td>
                                <td class="col-md-4">Editorial</td>
                                <td class="col-md-4">Fecha de Publicaión</td>
                                <td class="col-md-4">Número Página</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>        
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var recursos=$('#tablaBibliografias').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/bibliografia2",
                            },
                            columns:[
                                {data:'tipo_bibliografia'},
                                {data:'titulo_bibliografia'},
                                {data:'autor_bibliografia'},
                                {data:'tipo_documento_bibliografia'},
                                {data:'editorial_bibliografia'},
                                {data:'fecha_publicacion_bibliografia'},
                                {data:'numero_pagina_bibliografia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>   
       
    <body>