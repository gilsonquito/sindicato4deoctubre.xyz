<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Evaluación Docente</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Evaluación docente</a>
                    </nav>
                    <div class="container-fuid"> 
                            <div class="tab-content" id="myTabContent">
                                <div class="row justify-content-center p-2">
                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 text-nowrap">Periodo acádemico</label>
                                        <select class="form-control" id="selPeridoAcademicos" name="selPeridoAcademicos" tabindex="3" required>
                                            <option selected="true" disabled="disabled" value="">Elija un período acádemico</option>
                                            @foreach ($periodosacademicos as $periodosaca)
                                            <option value="{{$periodosaca->id}}">Desde {{$periodosaca->fechaini}}&nbsp;Hasta {{$periodosaca->fechafin}}&nbsp;/ Licencia tipo&nbsp;{{$periodosaca->nombre_tipolicencia}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>               
                            </div>                             
                    </div><!--finc container--> 
                    <div class="p-2" id="tablacontenido">     
                    </div> 
            </div><!--digeneral-->        
                <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
            <script>
                 $(document).ready(function(){
                    $('#selPeridoAcademicos').on('change', function(e){//cargar tabla
                        var idperiodo = e.target.value;
                        
                        $.ajax({
                                url:'/evaluacionDocentes/tablaEvaluacion/'+idperiodo,               
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tablacontenido').empty().append($(data));
                                    }
                                    );
                                }
                        });
                    }); 
                    
                });
            </script>
    <body>
</html>

