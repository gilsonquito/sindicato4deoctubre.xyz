<!DOCTYPE html>
<html lang="en">
<h2>Lista de docentes</h2>
<div class="table-responsive-lg p-3">
<table class="table table-hover table-responsive" id="dtBasicExample">
    <thead class="table-success">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">cedula</th>
            <th scope="col">nombre</th>
            <th scope="col">apellido</th>
            <th scope="col">lugarNacimiento_doc </th>
            <th scope="col">fechaNacimiento_doc</th>
            <th scope="col">direccion_doc </th>
            <th scope="col">celular_doc </th>
            <th scope="col">correo_doc </th>
            <th scope="col">etnia_doc </th>
            <th scope="col">sexo_doc </th>
            <th scope="col">instruccion </th>
            <th scope="col">imagen </th>
            <th scope="col">Acciones </th>
          </tr>
      </thead>
  <tbody>     
  @foreach ($docentes as $docente)
    <tr>
        <td>{{$docente->id}}</td>
        <td>{{$docente->cedula}}</td>
        <td>{{$docente->name}}</td>
        <td>{{$docente->apellido}}</td>
        <td>{{$docente->lugarNacimiento}}</td>
        <td>{{$docente->fechaNacimiento}}</td>
        <td>{{$docente->direccion}}</td>
        <td>{{$docente->celular}}</td>
        <td>{{$docente->email}}</td>
        <td>{{$docente->etnia}}</td>
        <td>{{$docente->sexo}}</td>
        <td>{{$docente->instruccion}}</td>
        <td>
            <img src="{{asset('storage').'/'.$docente->imagen}}" alt="imagen-usuario"  id="fotoUsuario">
        </td>     
        <td>
         <form action="{{ route('docentes.destroy',$docente->id) }}" method="POST">
            <div class="form-inline">
                <a href="/docentes/{{$docente->id}}/edit" class="btn btn-info" title="Editar">Editar</a>         
                  @csrf
                  @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Borrar</button>
            </div>
         </form>          
        </td>     
    </tr>
    @endforeach
  </tbody>
  <tfooter>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
  </tfooter>
</table>
</div>
<script type='text/javascript' >
    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });

                
</script>
</body>

</html>

