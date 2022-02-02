<head>
        <link href="{{asset('css/tablaUnidades.css')}}" rel="stylesheet">
        <title>Unidades</title>
</head>
<body>
        <div id="contenidoUnidades" class="p-2 w-100">
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Unidades</p>
                <table id="tabla-sil" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-secondary" >
                            <td class="col-md-1 align-middle">Seleccionar</td>
                            <td class="col-md-2 align-middle">Título de unidad</td>
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($unidades as $unidad)
                              <tr>    
                                  <td class="py-1 align-middle">
                                        <div class="row justify-content-center p-2">
                                              <a  href="javascript:void(0)" onclick="listarTemas({{$unidad->id_unidad}})" class="btn btn-info" title="Listar temas">
                                                Temas</a>
                                        </div>                                      
                                  </td>  
                                  <td class="py-1 align-middle">{{$unidad->titulo_unidad}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                 
                @foreach ($silabosU as $silabo)
                    <input type="hidden" id="txtSilaboU" name="txtSilaboU" value="{{$silabo->id_sil}}">
                @endforeach     
        </div>  
        
         <script>//CARGAER temas
                function listarTemas(id){                  
                    $.ajax({
                        url:'/temas/mostrarTemas3/'+id,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoUnidades').empty().append($(data));
                                }
                                );
                            }
                    });
                }
        </script> 
    <body>