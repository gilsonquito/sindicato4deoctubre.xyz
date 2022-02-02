
        <link href="{{asset('css/metodosAvanceAcademico.css')}}" rel="stylesheet">
        <div class="container-fluid border border-warning rounded text-justify" id="metodosVisibles">
                    @foreach ($metodos as $metodo)
                        <div class="form-check form-check-inline  p-2">
                            <input class="form-check-input" type="checkbox" id="checkMetodos" value="{{$metodo->descripcion_metodo}}" name="nameMetodo">
                            <label class="form-check-label" for="{{$metodo->id_metodo}}">{{$metodo->descripcion_metodo}}</label>
                        </div>
                    @endforeach
                    <div class="w-100 p-2 text-right">  
                        <div onclick="esconderDivMetodos()" class="btn btn-secondary" ><i class="fa fa-times-circle mr-2"></i>Cerrar</div>  
                    </div>
            
        </div>
        <script>
            function esconderDivMetodos() 
            {
                var div = document.getElementById('metodosVisibles');
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
                $('input[name=nameMetodo]').on('change', function() {
                    let valoresCheck = [];
                    if ($(this).is(':checked') ) {
                        $("input[name=nameMetodo]:checked").each(function(){
                            //cada elemento seleccionado
                            
                            valoresCheck.push(" "+this.value);

                        });
                        $('#txtMetodologiaAvance').val(valoresCheck);
                    } else {
                        $("input[name=nameMetodo]:checked").each(function(){
                            //cada elemento seleccionado
                            valoresCheck.push(" "+this.value);
                        });
                        $('#txtMetodologiaAvance').val(valoresCheck);
                        
                    }
                });
               
        </script>

