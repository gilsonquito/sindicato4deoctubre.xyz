<head>
        <title>RecursosAvance</title>
        <link href="{{asset('css/recursosAvanceAcademico.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid border border-warning rounded text-justify" id="recursosVisibles">
                    @foreach ($recursos as $recurso)
                        <div class="form-check form-check-inline  p-2">
                            <input class="form-check-input" type="checkbox" id="checkRecursos" value="{{$recurso->descripcion_recurso}}" name="nameRecurso">
                            <label class="form-check-label" for="{{$recurso->id_recurso}}">{{$recurso->descripcion_recurso}}</label>
                        </div>
                    @endforeach
                    <div class="w-100 p-2 text-right">  
                        <button onclick="esconderDivR()" type="button" class="btn btn-secondary" ><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>  
                    </div>
        </div>
        <script>
            function esconderDivR() 
            {
                var div = document.getElementById('recursosVisibles');
                if (div.style.display !== 'none') {
                    div.style.display = 'none';
                }
                else {
                    div.style.display = 'block';
                }
            }
            
        </script>   
          <script>
           
              // Comprobar cuando cambia un checkbox
                $('input[type=checkbox]').on('change', function() {
                    let valoresCheck2 = [];
                    if ($(this).is(':checked') ) {
                        $("input[name=nameRecurso]:checked").each(function(){
                            //cada elemento seleccionado
                            
                            valoresCheck2.push(" "+this.value);

                        });
                        $('#txtRecursosAvance').val(valoresCheck2);
                    } else {
                        $("input[name=nameRecurso]:checked").each(function(){
                            //cada elemento seleccionado
                            valoresCheck2.push(" "+this.value);
                        });
                        $('#txtRecursosAvance').val(valoresCheck2);
                        
                    }
                });
               
        </script>
</body>

