
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Silabos</title>
    </head>
    <body>
        <div class="p-1">
                <table id="tabla-silaboEstudiante" class="table table-responsive-lg table-hover w-100">
                        <thead class="font-weight-bold text-center" >
                            <td class="col-md-3 text-left">Módulo</td>
                            <td class="col-md-3">Visualizar sílabo</td>               
                        </thead>
                        <tbody >      
                            @foreach ($silabosEstudiantes as $silabo)
                                <tr>
                                    <td class="text-left">{{$silabo->nombre_mod}}</td>
                                    <td><div class="p-1 text-center "><a type="button" name="descargar" href="/estudiantes/descargarSilaboEstudiante/{{$silabo->id_sil}}" target="_blank" class="descargar btn btn-outline-secondary  btn-sm "  title="Visualizar silabo"><i class="fa fa-eye px-2" aria-hidden="true"></i></a></div></td> 
                                </tr>
                            @endforeach   
                        </tbody>
                </table>
        </div> 
    <body>
</html>