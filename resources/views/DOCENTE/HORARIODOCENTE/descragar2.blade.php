<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href=" css/horariodocentepdf.css" rel="stylesheet">
        <title>Horario Docente</title>
        <style>
            
            table,td, th { border: 0px solid black; }

            table { border-collapse: collapse; margin: auto;text-align: center; }

            td, th { width: max-content; height: 35px; }
            #encabezado{font-weight: normal;color:green;}
            table.show {border-collapse:separate;
            empty-cells: hide;
            }
            body{width: 100%}
            #titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                padding: 1px;
                text-align: center;
            }
            #caja-logo
            {
                align-self: center;
            }
            #logo
            {
                width: 70px;
                height: 70px;
                text-align: center;
                
            }
            @page {
            margin: 0cm 0cm;
            font-family: Arial;
            }
            body {
                margin: 3cm 2cm 2cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #DAA520;
                color: white;
                text-align: center;
                line-height: 30px;
            }
            #titulosistemaacademico{
                color:black;
            }
            #TITULO
            {
                font-family: Arial, Helvetica, Sans-serif;
                color:green;
                text-align: center;
                font-weight: normal;
            }
            tbody tr > td{
                    border-top:3px solid rgb(220,220,220);
                    height: 100px;
                    padding-left: 3px;
                    color:rgb(0,0,0);
                   opacity: 0.8;
                }
                #g-table{
                    padding-left: 40px;
                    margin-top: 20px;

                }
                .espacio{
					height:10px;
				}
        </style>
    </head>
    <body>
       <header>
            <!--<img src="{{ public_path('image/logo_empresa.png') }}" width="100%" height="100%"/>-->
            <h3 id="tituloslogan">SINDICATO DE CHOFERES PROFESIONALES 4 DE OCTUBRE-CANTON PENIPE</h3>
        </header>
        <div id="TITULO">
            <h2>Horario de docente</h2>
        </div>
            <div class="container-fluid p-4 "><!--digeneral-->  
            <h1></br></h1>
                    <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <!--<div id="pa">
                            <img src="{{asset('/image/logo_empresa.png')}}" alt="logo del sindicato de choferes de penipe" class="img-fluid " id="logo" >
                        </div>-->
                    </div>
                    <div class="container-fuid"> 
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">  
                                    <table id="tabla-horario" class="table-responsive table-bordered w-100 table-hover">
                                       
                                            <thead id="encabezado" class="font-weight-bold text-center" >
                                                <td class="col-md-2">Hora</td>
                                                <td class="col-md-1">Lunes</td>
                                                <td class="col-md-1">Martes</td>
                                                <td class="col-md-1">Miércoles</td>
                                                <td class="col-md-1">Jueves</td>
                                                <td class="col-md-1">Viernes</td>
                                                <td class="col-md-2">Sábado</td>
                                                <td class="col-md-2">Domingo</td>
                                            </thead>
                                        <tbody>    
                                            <tr></tr>
                                            @foreach ($HorarioClases as $horario)
                                                <tr>
                                                    <td>{{$horario[0]}}</td>
                                                    <td>{{$horario[1]}}</td>
                                                    <td>{{$horario[2]}}</td>
                                                    <td>{{$horario[3]}}</td>
                                                    <td>{{$horario[4]}}</td>
                                                    <td>{{$horario[5]}}</td>
                                                    <td>{{$horario[6]}}</td>
                                                    <td>{{$horario[7]}}</td>          
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                    </table>

                                </div>                
                            </div>                                  
                    </div><!--finc container--> 
            </div><!--digeneral-->  
    <body>
</html>

