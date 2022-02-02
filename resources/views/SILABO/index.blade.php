<!DOCTYPE html>
<html lang="en">
<h2>Listaaaaaaaaaaa de Silabos</h2>
<div class="table-responsive-lg table-hover w-100 p-3">
<table class="table table-hover table-responsive" id="dtBasicExample">
    <thead class="table-success">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Descripción</th>
            <th scope="col">Archivo</th>
            <th scope="col">Docente</th>
            <th scope="col">Acciones </th>
          </tr>
      </thead>
  <tbody>    
  @foreach ($silabos as $silabo)
    <tr>
        <td>{{$silabo->id}}</td>
        <td>{{$silabo->descripcion}}</td>
        <td>{{$silabo->file}}</td>
        <td>{{$silabo->docente_id}}</td>      
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
                <button type="submit" class="btn btn-success" onclick="return confirm('Borrar?');">Descargar</button>
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

