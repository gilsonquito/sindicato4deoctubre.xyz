   
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/subirarchivo.css')}}" rel="stylesheet">
        <title>Cursos</title>
    </head>
    <body>
        <div class="container-fluid p-2"><!--digeneral-->    
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                            <a class="navbar-brand text-success" href="#">Subir sílabo</a>
            </nav>
            <form id="avatarForm2" action="{{url('silabodoc/guardarSilabo')}}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                <div class="row  justify-content-center p-3">
                        <div class="col-md-6 px-2 justify-content-center  text-left">
                            <label for=""><b>Archivo: </b></label><br>
                            <input type="file" name="file"  class="form-control" tabindex="1" required>
                        </div>  
                        <div class="col-md-6 px-2 justify-content-center  text-left">
                            <label for="" class="form-label ml-2">Responsable</label>
                            <input id="responsable" name="responsable" type="text" class="form-control" tabindex="2" maxlength="50" required  readonly value="{{auth()->user()->email}}">
                        </div>
                </div>  
                <div class="row  justify-content-center p-3">
                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                        <label for="select">Periodo Académico</label>
                        <select class="form-control" id="selPeriodo" name="selPeriodo" tabindex="4" required>
                                <option selected="true" disabled="disabled" value="">Elija un período acádemico</option>
                                @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}">Desde {{ $periodo->fechaini }}&nbsp;Hasta {{ $periodo->fechafin}}&nbsp;Licencia tipo {{$periodo->nombre_tipolicencia }}</option>
                                @endforeach
                        </select>
                    </div>                                                    
                    <div class="col-md-6 px-2 justify-content-center  text-left">
                            <label for="" class="form-label ml-2">Seleccione módulo</label>
                            <select class="form-control" id="selModulo" name="selModulo" tabindex="2" tile="Seleccione modulo" required>
                                <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                            </select>
                    </div>  
                </div>
                <button type="submit" class="btn btn-success btn-lg" tile="Subir archivo"><i class="fa fa-upload mr-2" aria-hidden="true"></i>Subir Archivo</button>
                 <!-- <input class="btn btn-success" type="submit" value="Subir Archivo" >-->
            </form>
        </div>
        <script>//subir archivo
                $(document).ready(function(){
                    
                    var $avatarInput,$avatarForm,$avatarUrl;
                    $(function(){
                        $avatarInput=$('#file');
                        $avatarForm=$('#avatarForm2');

                    
                        $avatarUrl=$avatarForm.attr('action');
                        $('#avatarForm2').submit(function(e){

                            e.preventDefault();
                           
                          var paqueteDeDatos = new FormData(document.getElementById("avatarForm2"));
					       
                           $.ajax({
                               url:$avatarUrl+'?'+$avatarForm.serialize(),
                               method:'POST',
                               data:paqueteDeDatos,
                               cache:false,
                               processData:false,
                               contentType:false
                               
                           })
                           
                           .done(function(data){
                               if(data.success)
                               {
                                toastr.success('El sílabo fue cargado con exito','¡EXITOSO!',{timeOut:3000});
                                document.getElementById("avatarForm2").reset();
                                
                                }
                           })
                           .fail(function(){
                                
                                toastr.error('Verificar: El archivo subido no es .pdf/.doc o Ya existe SÍlabo del modulo','¡FALLIDA!',{timeOut:4000});  
                           });

                        });
                    });
                    

                });
            </script>
             <script>
                $(document).ready(function(){    
                    $('#selPeriodo').on('change', function(e){//cargar  cursos 
                       
                        var periodoacad = e.target.value;
                        $.get('/silabodoc/selectModulosSilabos/'+periodoacad,function(data) {
                            $('#selModulo').empty();
                            $('#selModulo').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#selModulo').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +" / "+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });   
                    });
                });
            </script>
    <body>
</html>