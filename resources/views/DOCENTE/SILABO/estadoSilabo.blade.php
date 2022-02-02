<head>
        <title>EstadoSilabo</title>
    </head>
    <body>
        <div id="estadoSilabo" class="p-2">          
            @foreach ($sils as $dato)
                <div class="justify-content-center p-2">
                    <input type="hidden" id="txtEstadoSilabo" name="txtEstadoSilabo">
                    @if($dato->estado=="APROBADO")
                        <h1 id="" name=""  class="font-italic text-success" >{{$dato->estado}}</h1> 
                       
                    @else
                        <h1  id="" name=""  class="font-italic text-warning" > {{$dato->estado}}</h1>   
                    @endIf              
                </div>
            @endforeach                                 
        </div> 
    <body>
