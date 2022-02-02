<!DOCTYPE html>
<html lang="en">      
<link href="css/docente.css" rel="stylesheet">
<body>
<div class="py-3">
<h2>Editar datos de docente</h2>
<br>
@foreach ($docentes as $docente)
<form action="/docentes/{{$docente->id}}" method="POST" enctype="multipart/form-data">
    @csrf
{{ method_field('PATCH') }}
    <div class="row  justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 h5">Cédula</label>
          <input id="cedula" name="cedula" type="text" class="form-control" tabindex="1" maxlength="10" required value="{{$docente->cedula}}">    
        </div>
        <div class="col-md-6 px-2 justify-content-center  text-left">
          <label for="" class="form-label ml-2 h5">Nombre</label>
          <input id="name" name="name" type="text" class="form-control" tabindex="2" maxlength="50" required value="{{$docente->name}}">
        </div>
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 h5">Apellido</label>
          <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" maxlength="80" required value="{{$docente->apellido}}">
        </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 h5">Lugar de nacimiento</label>
          <input id="lugarNacimiento" name="lugarNacimiento" type="text" class="form-control" tabindex="4" maxlength="100" required value="{{$docente->lugarNacimiento}}">
        </div>
    </div>
    <div class="row justify-content-center p-2">
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h6">Fecha de nacimiento</label>
            <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" tabindex="5" format="y/m/d" value="2017-06-01"required value="{{$docente->fechaNacimiento}}">
          </div>
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h5">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="form-control" tabindex="6" maxlength="80" required value="{{$docente->direccion}}">
          </div>
         
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h5">Celular</label>
            <input id="celular" name="celular" type="text" class="form-control" tabindex="7" maxlength="15"required value="{{$docente->celular}}">
          </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 h5">Correo</label>
          <input id="email" name="email" type="email" class="form-control" tabindex="8" maxlength="80" required value="{{$docente->email}}">
        </div>
    </div>
    <div class="row justify-content-center p-2">
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h5 ">Etnia</label>
            <input id="etnia" name="etnia" type="text" class="form-control" tabindex="9" maxlength="80" required value="{{$docente->etnia}}">
          </div>
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h5">Sexo</label>
            <input id="sexo" name="sexo" type="text" class="form-control" tabindex="10" maxlength="10" required value="{{$docente->sexo}}">
          </div>
    </div>
    <div class="row justify-content-center p-2">
        
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 h5 ">Instrucción</label>
          <input id="instruccion" name="instruccion" type="text" class="form-control" tabindex="11" maxlength="100" required value="{{$docente->instruccion}}">
        </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 h5"><strong>Imagen</strong></label>
             <img src="{{asset('storage').'/'.$docente->imagen}}" alt="imagen-usuario" width="150" tabindex="12">
            <input id="imagen" name="imagen" type="file" class="form-control" tabindex="13" value="{{$docente->imagen}}">
        </div>
    </div>
    <div class="row justify-content-start p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
        <button type="submit" class="btn btn-light font-weight-bold col-md-4" tabindex="14" id="password" name="password" href="" >Cambiar contraseña</button>
        </div>
    </div>
    <br>
  <button type="submit" class="btn btn-success font-weight-bold col-md-4" tabindex="14" id="actualizar" href="/docentes/{{auth()->user()->email}}/edit" >GUARDAR CAMBIOS</button>
  @endforeach
</form>
</div>
    
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type='text/javascript' >
    $(document).ready(function(){
        alert($docente)
            $("#cedula").bind('keypress', function(event) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
            });
            $("#celular").bind('keypress', function(event) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
            });
        
            
            $('#enviar').click(function(){
                var message2 = document.getElementById("fechanacimiento").value;
                alert(message2);
            });
            $('#actualizar').click(function(){
                $.ajax({
                    url:'/docentes/{{$docente->id}}',
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
            /*$('#sub-menu-editarperfil').click(function(){
                $.ajax({
                    url:'/docentes/{{auth()->user()->email}}/edit',
                    success : function(data){
                     alert("datos Modificados");
                    
                    }
                });
            });*/
        });
</script>


</body>

</html>
