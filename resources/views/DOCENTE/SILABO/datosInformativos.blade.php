    <head>
        <title>Datos informativos</title>
    </head>
    <body>
        <div id="datosInformativos" class="p-2">          
            @foreach ($datos as $dato)
                <div class="row  justify-content-center p-2">
                    <div class="col-md-7 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Institución</label>
                        <input readonly="readonly" id="escuela" name="escuela" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required value="{{$dato->escuela}}">    
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Area académica</label>
                        <input readonly="readonly" id="" name="" type="text" class="form-control font-italic" tabindex="2" maxlength="100" required value="EDUCACIÓN">
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Nombre de la asignatura</label>
                        <input readonly="readonly"  type="text" class="form-control font-italic" tabindex="3" value="{{$dato->nombre_mod}}" required >
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Tipo licencia</label>
                        <input readonly="readonly"  type="text" class="form-control font-italic" tabindex="4" value="{{$dato->nombre_tlic}}" >
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Periodo académico</label>
                        <input  readonly="readonly" type="text" class="form-control font-italic" tabindex="5" value="Desde {{$dato->fechaini}} Hasta {{$dato->fechafin}}" >
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Fecha creacion</label>
                        <input readonly="readonly" type="text" class="form-control font-italic" tabindex="6"  value="{{$dato->fecha_creacion}}">
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Número de horas</label>
                        <input readonly="readonly" type="text" class="form-control font-italic" tabindex="7"  value="{{$dato->duracion_horas}}">
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Paralelo</label>
                        <input readonly="readonly" type="text" class="form-control font-italic" tabindex="8"  value="{{$dato->nombre_paralelo}}" required>
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Tipo de asignatura</label>
                        <input readonly="readonly" type="text" class="form-control font-italic" tabindex="8"  value="Obligatoria" required>
                    </div>
                </div>
            @endforeach                                        
        </div> 
    <body>
