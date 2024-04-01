@extends('site.layouts.site-dashboard')
@section('content-site-dashboard')
<link href="{{ dsAsset('site/css/custom/client/client-pending-booking.css') }}" rel="stylesheet" />
<style>

.dropdown-menu {
    z-index: 1000; /* O cualquier valor alto que asegure que el menú se superponga a otros elementos */
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card card-box-shadow card-pending-booking p-4">
			<div class="w-100 pb-3">
				<div class="d-flex align-items-center justify-content-between">
					<h5 class="mb-0">{{ translate('Listado de Mascotas') }} </h5>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="openPet()">
						Nueva mascota 
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="main-card card">

						<div class="card-body">
						
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr> 
											<th>Nombre</th>
											<th>Especie</th>
											<th>Sexo</th>
											<th>Detalles</th>
											<th>Dar de Baja</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($pets ?? '' as $mascota)
											<tr>
												<td><a href="{{ route('petdeta', ['id' => $mascota->id]) }}">{{ $mascota->nombre }}</a></td>
												<td>{{ $mascota->especie }}</td>
												<td>{{ $mascota->sexo }}</td>
												<td><a href="{{ route('petdeta', ['id' => $mascota->id]) }}" class="btn btn-info">Ver Detalles</a></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_{{ $mascota->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															{{ html_entity_decode($mascota->estado_pet)}}
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $mascota->id }}">
															{{-- <a class="dropdown-item" href="#" onclick="cambiarEstado('{{ $mascota->id }}', 'Nuevo Dueño')">Nuevo Dueño</a> --}}
															<a class="dropdown-item" href="#" onclick="cambiarEstado('{{ $mascota->id }}', 'Extraviado')">Extraviado</a>
															<a class="dropdown-item" href="#" onclick="cambiarEstado('{{ $mascota->id }}', 'Recuperado')">Recuperado</a>
															<a class="dropdown-item" href="#" onclick="cambiarEstado('{{ $mascota->id }}', 'Defuncion')">Defunción</a>
														</div>
													</div>

													
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
function cambiarEstado(idMascota, nuevoEstado) {
	    // Genera el ID único del botón de dropdown correspondiente
		var botonDropdownId = '#dropdownMenuButton_' + idMascota;
    // Realiza una solicitud AJAX al controlador para actualizar el estado
    $.ajax({
        url: '/actualizar-estado', // Reemplaza esto con la ruta adecuada
        type: 'POST',
        data: {
            id: idMascota,
            nuevo_estado: nuevoEstado
        },
        success: function(response) {
            // Actualiza la fila en la tabla con el nuevo estado (si es necesario)
            // Por ejemplo, podrías cambiar el texto en una columna específica o aplicar una clase CSS
            // Aquí se asume que la respuesta del controlador contiene el nuevo estado actualizado
            $(this).closest('tr').find('.estado-columna').text(response.nuevo_estado);

			            // Actualiza el texto del botón con el nuevo estado
						$(botonDropdownId).text(response.nuevo_estado);
        },
        error: function(xhr, status, error) {
            // Maneja los errores de la solicitud AJAX
            console.error(error);
        }
    });
}
    // Cerrar el dropdown después de hacer clic en una de las opciones
    $(document).ready(function() {
        // Agrega un evento click a cada elemento de menú desplegable
        $('.dropdown-menu a.dropdown-item').on('click', function() {
            // Obtiene el Popper.js instance asociado al botón de dropdown
            var dropdownMenu = $(this).closest('.dropdown').find('.dropdown-toggle');
            var popperInstance = bootstrap.Popover.getInstance(dropdownMenu[0]);
            
            // Cierra el menú desplegable asociado al botón de dropdown
            if (popperInstance) {
                popperInstance.hide();
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ dsAsset('site/js/custom/client/client-listingpets.js') }}"></script>

    <!-- Modal para Nueva Mascota -->
    <div class="modal fade bd-example-modal-lg" id="petModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nueva Mascota</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
            <div class="modal-body">
                <form class="form-horizontal" id="peluForm" action="{{ route('pet.petStore') }}" method="post">
                    @csrf
                <!-- Campo oculto para el ID del servicio -->
                {{ csrf_field() }} 
      
                <input type="hidden" id="id_dueno" name="id_dueno"  value="{{$cliente}}" >
                <input type="hidden" id="id_pet" name="id_pet" value="">
                <input type="hidden" id="tienepet" name="tienepet" value="">
                <input type="hidden" name="_tokenpelu" value="{{ csrf_token() }}">

				
				<div class="row">
					<div class="col-md-6">
						<label for="nombre" class="float-start">Nombre </label>
						<input type="text" id="nombre" name="nombre"  class="form-control" placeholder="Nombre" >
					</div>
					<div class="col-md-6">
						<label for="sex" class="float-start">Sexo </label>
						<select class="form-select"  id="sex" name="sex" >
                                                    
							<option value="Macho" selected>Macho</option>
							<option value="Hembra">Hembra</option>
						  </select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="specie" class="float-start">Especie *</label>
                                                
						<select class="form-select" id="specie" name="specie" >
							
							<option value="Canino" selected>Canino</option>
							<option value="Felino">Felino</option>
							<option value="Otro">Otro</option>
						  </select>
					</div>
					<div class="col-md-6" id="otro_espe">
						<label for="otro_esp" class="float-start">Especifique Especie </label>
						<input type="text" id="otro_esp" name="otro_esp" class="form-control" />
					</div>
				</div>
				
				<div class="row">

					<div class="col-md-6">
						<label for="race" class="float-start">Raza </label>
                        <input type="text" id="race" name="race" class="form-control" />
					</div>

					<div class="col-md-6">
						<label for="color" class="float-start">Tamaño </label>
                                                
						<select class="form-select"  id="color" name="color" >
							
							<option value="Pequeño" selected>Pequeño</option>
							<option value="Mediano">Mediano</option>
							<option value="Grande">Grande</option>
						  </select>
					</div>
				</div>

				<div class="row">
  
					<div class="col-md-6">
						<label for="state" class="float-start">Est. Reproductivo *</label>
						<select class="form-select"  id="state" name="state" >
							
							<option value="Fertil" selected>Fertil</option>
							<option value="Castrado/Esterilizado">Castrado/Esterilizado</option>
							<option value="No lo sé">No lo sé</option>
						  </select>
					</div>
				</div>




            </div>
                <div class="modal-footer">

                <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">{{translate('Cerrar')}}</button>
                <button type="submit" class="btn btn-success btn-sm">{{translate('Guardar')}}</button>
            </div>
            <!-- Agrega aquí más campos si es necesario -->
        </form>
        </div>
        </div>
    </div>



@endsection