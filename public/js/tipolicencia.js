
                    $(document).ready(function(){
                        
                        var tipolice=$('#tabla-tipoLicencia').DataTable({
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                            processing:true,
                            serverSide:true,
                            order: [[1, "asc"]],
                            language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                            ajax:{
                                url:"{{route('tipolicencia.index')}}",
                            },
                            columns:[
                                {data:'id_tlic'},
                                {data:'nombre_tlic'},
                                {data:'action',orderable:false}
                            ]

                        });
                    });
                    function mayusculas(e) {
                        e.value = e.value.toUpperCase();
                    }
                    
                    $('#ingreso-tipoLicencia').submit(function(e){ 
                        e.preventDefault();
                        
                            var nombre_tlic=$('#tipol').val();
                         
                            
                            var _token=$("input[name=_token]").val();
                                     $.ajax({
                                            url:"{{route('tipolicencia.ingresar')}}",
                                            type:"POST",
                                            async: true,
                                            data:{
                                                nombre_tlic:nombre_tlic,
                                                _token:_token
                                            },
                                            success:function(response)
                                            {   
                                                if(response)
                                                {
                                                    $('#ingreso-tipoLicencia')[0].reset();
                                                    toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                    $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                                }
                                            },
                                            error : function(response){
                                                toastr.error('No se realizo el registro','Error',{timeOut:3000});
                                            }
                                        });
                        });
                        var _id;
                        $(document).on('click','.delete',function(){
                        _id=$(this).attr('id'); 
                        $('#confirmModal').modal('show');
                        });
                        $('#btnEliminar').click(function(){
                        $.ajax({
                            url:"tipolicencia/eliminar/"+_id,
                            beforeSend:function(){
                                $('#btnEliminar').text('Eliminando..'); 
                                $('#girar').show(); 
                            },
                            success:function(data){
                                setTimeout(function(){
                                    $('#confirmModal').modal('hide');
                                    toastr.success('El tipo de licencia fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                    $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                    $('#btnEliminar').text('Eliminar'); 
                                    $('#girar').hide(); 
                                },2000);
                            },
                            error : function(response){
                                    toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:3000});
                                    $('#confirmModal').modal('hide');
                                    $('#btnEliminar').text('Eliminar'); 
                                    $('#girar').hide(); 
                            }
                        });
                        });
                        function editarTipoLicencia(id){
                            $.get('tipolicencia/editar/'+id, function(tipolicencia)
                            {
                                //asignar datos recuperados
                                $('#txtId2').val(tipolicencia[0].id_tlic);
                                $('#tipol2').val(tipolicencia[0].nombre_tlic);
                                $("input[name=_token]").val();
                                $('#tipolicencia_edit_modal').modal('toggle');
        
                            });
                            }
                            $('#tipolicencia_edit_form').submit(function(e){
                                e.preventDefault();
                                var id2=$('#txtId2').val();
                                var nombre_tlic2=$('#tipol2').val();
                                var _token2=$("input[name=_token]").val();
                                        $.ajax({
                                            url:"{{route('tipolicencia.actualizar')}}",
                                            type:"POST",
                                            data:{
                                                id_tlic:id2, 
                                                nombre_tlic:nombre_tlic2,
                                                _token:_token2
                                            },
                                            beforeSend:function(){
                                                $('#btnActualizar').text('Actualizando..'); 
                                                $('#girar2').show(); 
                                            },
                                            success:function(response)
                                            {
                                                if(response)
                                                {
                                                    $('#tipolicencia_edit_modal').modal('hide');
                                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                                    $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                                    $('#btnActualizar').text('Guardar cambios'); 
                                                    $('#girar2').hide(); 
                                                }
                                            },
                                            error:function(response)
                                            {
                                                $('#tipolicencia_edit_modal').modal('hide');
                                                toastr.error('No se actualizaron correctamente los datos','ACTUALIZACIÓN FALLIDA',{timeOut:3000});
                                                $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                                    $('#btnActualizar').text('Guardar cambios'); 
                                                    $('#girar2').hide(); 
                                            }
                                            
                                        });
                                })