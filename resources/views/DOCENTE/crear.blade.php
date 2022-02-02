<!DOCTYPE html>
<html lang="en">
<body>  
<div class="py-3">
<h2>CREAR DOCENTE</h2>
<form action="{{url('/docentes')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row  justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Cédula</label>
          <input id="cedula" name="cedula" type="text" class="form-control" tabindex="1" maxlength="10" required>    
        </div>
        <div class="col-md-6 px-2 justify-content-center  text-left">
          <label for="" class="form-label ml-2">Nombre</label>
          <input id="name" name="name" type="text" class="form-control" tabindex="2" maxlength="50" required>
        </div>
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Apellido</label>
          <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" maxlength="80" required>
        </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Lugar de nacimiento</label>
          <input id="lugarNacimiento" name="lugarNacimiento" type="text" class="form-control" tabindex="4" maxlength="100" required>
        </div>
    </div>
    <div class="row justify-content-center p-2">
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Fecha de nacimiento</label>
            <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" tabindex="5" format="y/m/d" value="2017-06-01"required>
          </div>
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="form-control" tabindex="6" maxlength="80" required>
          </div>
         
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Celular</label>
            <input id="celular" name="celular" type="text" class="form-control" tabindex="7" maxlength="15"required>
          </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Correo</label>
          <input id="email" name="email" type="email" class="form-control text-lowercase" tabindex="8" maxlength="80" required>
        </div>
       
    </div>
    <div class="row justify-content-center p-2">
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Etnia</label>
            <input id="etnia" name="etnia" type="text" class="form-control" tabindex="9" maxlength="80" required>
          </div>
          <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Sexo</label>
            <input id="sexo" name="sexo" type="text" class="form-control" tabindex="10" maxlength="10" required>
          </div>
          
    </div>
    <div class="row justify-content-center p-2">
        
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Instrucción</label>
          <input id="instruccion" name="instruccion" type="text" class="form-control" tabindex="11" maxlength="100" required>
        </div>
        <div class="col-md-6 px-2  justify-content-center text-left">
            <label for="" class="form-label ml-2 ">Imagen</label>
            <input id="imagen" name="imagen" type="file" class="form-control" tabindex="12">
        </div>
    </div>
    <div class="row justify-content-center p-2">
        
        <div class="col-md-6 px-2  justify-content-center text-left">
          <label for="" class="form-label ml-2 ">Contraseña</label>
          <input id="password" name="password" type="password" class="form-control" tabindex="13" maxlength="100" required>
        </div>
    </div>

  <button type="submit" class="btn btn-success font-weight-bold" tabindex="4" >Guardar</button>
</form>
</div>
<script type='text/javascript' >
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
</script>
</body>

</html>
