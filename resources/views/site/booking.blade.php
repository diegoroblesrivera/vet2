@extends('site.layouts.site')
@section('content')
<link href="{{ dsAsset('site/css/custom/website-booking.css') }}" rel="stylesheet" />
<script src="{{ dsAsset('site/js/custom/website-booking2.js') }}"></script>
<script src="{{ dsAsset('site/js/custom/jquery.rut.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<style>

.image-container {
    border: 3px solid #ccc; /* Define el estilo del borde */
    padding: 5px; /* Agrega un espacio alrededor de la imagen */
}
    .grid-images {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .grid-images img {
        flex: 1 1 calc(33.33% - 10px); /* Tres imágenes por fila */
        max-width: 100%;
        height: auto;
        object-fit: cover; /* Mantiene las proporciones de las imágenes */
        /* Elimina o ajusta esta línea según tus necesidades */
        /* max-height: 100px; */ /* Ajusta esto según el tamaño deseado */
    }

    .grid-images .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 3px;
    }

    .grid-images .image-container img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .image-name {
        margin-top: 5px;
        font-size: 12px; /* Ajusta el tamaño según tus necesidades */
        color: #c20707; /* Ajusta el color según tus necesidades */
    }

    .image-selected {
        border: 2px solid blue;
    }
</style>


<meta name="csrf-token" content="{{ csrf_token() }}">


<!--start banner section -->
{{-- <section class="banner-area position-relative" style="background:url({{$appearance ?? ''->background_image}}) no-repeat;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative text-center">
                    <h1 class="text-capitalize mb-3 text-white">{{translate('Appointment Booking')}}</h1>
                    <a class="text-white" href="{{route('site.home')}}">{{translate('Home')}} </a>
                    <i class="icofont-long-arrow-right text-white"></i>
                    <a class="text-white" href="{{route('site.appoinment.booking')}}"> {{translate('Appointment Booking')}}</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- end banner section -->

<!-- Start booking Area -->
<section class="appoinment-booking-area mb-5"> 
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-4 order-sm-first ">
                <div class="single-booking-area single-booking-support mb-3">
                    <div class="mt-3">

                        {{-- <span class="h3">{{translate('Call for any Emergency Support!')}}</span>
                        <h2 class="text-color mt-3">{{$appearance ?? ''->contact_phone}}</h2> --}}
                                    <!-- Cuadrícula de Imágenes -->
                                       <!-- Cuadrícula de Imágenes -->
                                       {{-- <h6>Bienvenido a nuestro sistema de agenda online
                                       </h6>
                                       <ul>
                                        <li>1.- Selecciona al veterinario</li> 
                                        <li>2.- Selecciona la Hora</li> 
                                        <li>3.- Datos de tu mascota</li> 
                                        <li>4.- Datos Personales</li> 
                                        <li>5.- Revisa y confirma</li> 
                                        </li>    
                                       </ul>
                            <hr>

                            <p style="background: #007bff; color: white;">1.- Selecciona al veterinario</p>
                            <div class="grid-images">
                                <div class="image-container">
                                    <a href="javascript:void(0)"><img src="{{ asset('uploadfiles/5nd2PaPKB6FtOlFoA1JMuiEXXWesu9wngnh7DjO8.png') }}" alt="Imagen 1" data-employee-id="1">
                                    <span class="image-name">Dorctor Remedios</span></a>
                                </div>
                                <div class="image-container">
                                    <a href="javascript:void(0)"><img src="{{ asset('uploadfiles/5nd2PaPKB6FtOlFoA1JMuiEXXWesu9wngnh7DjO8.png') }}" alt="Imagen 2" data-employee-id="2">
                                    <span class="image-name">Dortor Medicina</span></a>
                                </div>
                                <div class="image-container">
                                    <a href="javascript:void(0)"><img src="{{ asset('uploadfiles/5nd2PaPKB6FtOlFoA1JMuiEXXWesu9wngnh7DjO8.png') }}" alt="Imagen 3" data-employee-id="3">
                                    <span class="image-name">Doctor No </span></a>
                                </div>
                                <!-- Más imágenes si es necesario -->
                                <p>Elige al profesional que cuidará de tu mascota
                                    con solo unos clics.
                                </p>
                            </div>
                            
                    </div>
                </div>
            </div> --}} 
            <div class="col-lg-12 mb-3">
                <div class="single-booking-area"> 
                    <br> <br> <br>
                    <form class="form-wrap" id="formServiceBooking">
                        <div id="serviceStep">
                            <h3>1.- <i class="fas fa-user-md"></i></h3>

                            <section>
                                <div class="grid-images">
                                    @foreach ($employees ?? ''['data'] as $employee)
                                        <div class="image-container">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset($employee['image_url']) }}" alt="Imagen de {{ $employee['full_name'] }}" 
                                                data-employee-id="{{ $employee['id'] }}" >
                                                <span class="image-name">{{ $employee['full_name'] }}</span>
                                            </a>
                                        </div>
                                    @endforeach
                             
                                    <div class="col-md-0">
                                        {{-- <label for="cmn_branch_id" class="float-start">{{translate('Branch')}}</label> --}}
                                        <select id="cmn_branch_id" name="cmn_branch_id" class="serviceInput form-control" hidden>
                    
                                        </select>
                                    </div>
                                    <div class="col-md-0">
                                        {{-- <label for="sch_service_category_id" class="float-start">{{translate('Category')}}</label> --}}
                                        
                                        <select id="sch_service_category_id" name="sch_service_category_id" class="serviceInput form-control" hidden>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-0">
                                        {{-- <label for="sch_service_id" class="float-start">{{translate('Service')}}</label> --}}
                                        <select id="sch_service_id" name="sch_service_id" class="serviceInput form-control" hidden >
                    
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <label for="sch_employee_id" class="float-start">{{translate('Staff')}}</label> --}}
                                        <select id="sch_employee_id" name="sch_employee_id" class="serviceInput form-control"  >
                                        </select>
                                    </div>
                                </div>
                            </section>
                        
                     
                          <!-- <button type="button" class="action-button previous previous_button">Volver</button> -->
                          <button type="button" class="next action-button" id="primero" hidden>Continuar</button>  
                            <h3>2.- <i class="fas fa-calendar-day"></i></h3>
                            <section>

                                Visualiza y selecciona fácilmente la hora que mejor se ajuste a tu agenda. Un proceso rápido y sencillo para ahorrarte tiempo.
                                    <div class="row">
                                        <div class="col-md-auto col-lg-auto col-sm-auto" id="divServiceCalendar">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="serviceDate" class="float-start">{{translate('Service Date')}}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input id="serviceDate" name="service_date" class="form-control input-sm" type="text" readonly />
                                                    <div id="divServiceDate" style="float: left;"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div id="divTopDays">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="float-start" id="divDaysName"></div>
                                                        <div class="float-end" id="divPreNext">
                                                            <i id="iPrvDate" title="Previous day" class="iChangeDate fa fa-chevron-left float-start"></i>
                                                            <i id="iNextDate" title="Next day" class="iChangeDate fa fa-chevron-right float-end"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row divServiceAvaiable">
                                                    <div class="col-md-12" id="divServiceAvaiableTime">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col divSelectedService">
                                        <i class="fa fa-calendar float-start pl-2 mt-1 mr-1" aria-hidden="true"></i>
                                        <i id="iSelectedServiceText" class=""></i>
                                    </div>
                                    {{-- <div class="col-md-auto col-lg-auto col-sm-auto float-end">
                                        <button type="button" class="btn btn-success float-end" id="add-service-btn"><i class="fas fa-plus-circle"></i> {{translate('Add more service')}}</button>
                                    </div> --}}
                                    <div class="col-md-12 mt-3">
                                        <table id="tbl-service-cart" class="table table-responsive table-bordered fs-13 text-start d-none">
                                            <thead>
                                                <tr>
                                                    <th>{{translate('SL')}}</th>
                                                    <th>{{translate('Service')}}</th>
                                                    <th>{{translate('Staff')}}</th>
                                                    <th>{{translate('Date')}}</th>
                                                    <th>{{translate('Time')}}</th>
                                                    {{-- <th>{{translate('Fee')}}</th> --}}
                                                    {{-- <th class="text-center">{{translate('Opt')}}</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="text-start" id="iSelectedServiceList"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <h3>3.- <i class="fas fa-dog"></i></h3>
                            <section>
                                <div class="row p-1">
                                    <p>Completa información clave sobre tu mascota. Esta información personalizada nos permite brindarle la mejor atención. 
Un proceso breve y significativo para asegurar que tu mascota reciba la mejor atención.
                                    </p>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="pet_name" class="float-start">{{translate('Pet Name')}} *</label>
                                                <input type="text" id="pet_name" name="pet_name" class="form-control" value="Firulais"/>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="specie" class="float-start">{{translate('Specie')}} *</label>
                                                {{-- <input type="text" id="specie" name="specie" class="form-control" /> --}}
                                                <select class="form-select" id="specie" name="specie" >
                                                    
                                                    <option value="Canino" selected>Canino</option>
                                                    <option value="Felino">Felino</option>
                                                    <option value="Otro">Otro</option>
                                                  </select>
                                            </div>
                                            <div class="col-md-4" id="otro_espe">
                                                <label for="otro_esp" class="float-start">{{translate('Especifique Especie')}} </label>
                                                <input type="text" id="otro_esp" name="otro_esp" class="form-control" />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="sex" class="float-start">{{translate('Sexo')}} </label>
                                                {{-- <input type="text   " id="sex" name="sex" class="form-control" /> --}}
                                                <select class="form-select"  id="sex" name="sex" >
                                                    
                                                    <option value="Macho" selected>Macho</option>
                                                    <option value="Hembra">Hembra</option>
                                                  </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="race" class="float-start">{{translate('Raza')}} </label>
                                                <input type="text" id="race" name="race" class="form-control" />
                                            </div>
                                            <div class="col-md-4">
                                                <label for="color" class="float-start">{{translate('Size')}} </label>
                                                {{-- <input type="text" id="color" name="color" class="form-control" /> --}}
                                                <select class="form-select"  id="color" name="color" >
                                                    
                                                    <option value="Pequeño" selected>Pequeño</option>
                                                    <option value="Mediano">Mediano</option>
                                                    <option value="Grande">Grande</option>
                                                  </select>
                                            </div>

                                            
                                           
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="state" class="float-start">{{translate('Est. Reproductivo')}} *</label>
                                                <select class="form-select"  id="state" name="state" >
                                                    
                                                    <option value="Fertil" selected>Fertil</option>
                                                    <option value="Castrado/Esterilizado">Castrado/Esterilizado</option>
                                                    <option value="No lo sé">No lo sé</option>
                                                  </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nac" class="float-start">{{translate('Nac Estimado')}} (01-12-2020) </label>
                                                <input type="text" id="nac" name="nac" class="form-control" oninput="formatearFecha(this)" placeholder="dd-mm-AAAA" />
                                            </div>

                                            
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="state" class="float-start">Motivo Consulta</label>
                                                <input type="text" id="motivo" name="motivo" class="form-control" />
                                            </div>
                                           

                                            
                                          
                                        </div>
                                    </div>

                                </div>
                            </section>
                            <h3>4.- <i class="fas fa-user"></i></h3>
                            <section>
                                <p>Completa tu información personal. Solo pedimos lo necesario para mantenernos en contacto y enviar recordatorios.
                                </p>
                                <div class="row p-1">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="full_name" class="float-start">{{translate('Full Name')}} *</label>
                                                <input type="text" id="full_name" name="full_name" class="form-control" value="Name" />
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email" class="float-start">{{translate('Email')}} *</label>
                                                <input type="email" id="email" name="email" class="form-control" value="usuario1@gmail.com"/>
                                                <span id="emailFeedback"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="phone_no" class="float-start">{{translate('Phone')}} *</label>
                                                <input type="number" id="phone_no" name="phone_no" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="rut" class="float-start">{{translate('RUN')}} *</label>
                                                <input type="text" id="rut" name="rut" class="form-control claseRut" value="162342345" oninput="formatearRUT(this)" placeholder="XX.XXX.XXX-X"/>
                                            </div>
                                            <div class="col-md-7">
                                                <label for="direccion" class="float-start">{{translate('Address')}} *</label>
                                                <input type="text" id="direccion" name="direccion" class="form-control" value="Las Camelias "/>
                                            </div>
                                           
                                        </div>
                                    </div>

                                </div>
                            </section>

                            
                            <h3>5.- <i class="fas fa-check"></i></h3> 
                            <section>
                                <div class="color-success p-5">Revisa y confirma en un instante. Si es necesario, vuelve y edita lo que sea necesario. Una vez confirmada, recibirás
                                    un correo electrónico, y tu cita quedará agendada y reservada para ti.</div>
                                    <div id="summary">
                                        <h6>Resumen de la Cita</h6>
                                        Fecha de la cita: <span id="summaryDate"></span><br>
                                        Hora de la cita: <span id="summaryTime"></span><br>
                                        Veterinario: <span id="vet"></span>
                                        <!-- Agrega más elementos de resumen según sea necesario -->
                                    </div>
                                  
                            </section>
                            


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End booking Area -->
<script>


        function formatearRUT(input) {
            var rut = input.value;

            // Eliminar cualquier caracter que no sea un número o k
            rut = rut.replace(/[^0-9kK]/g, '');

            // Si el largo del RUT es mayor a 1, formatear
            if (rut.length > 1) {
                // Extraer el dígito verificador
                var dv = rut.substring(rut.length - 1, rut.length);
                // Extraer el resto del RUT
                var numeros = rut.substring(0, rut.length - 1);

                // Formatear con puntos
                numeros = numeros.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Reunir el RUT con el dígito verificador
                rut = numeros + '-' + dv;
            }

            // Actualizar el valor del input
            input.value = rut.toUpperCase();
        }

        function formatearFecha(input) {
            var fecha = input.value;
            
            // Eliminar cualquier caracter que no sea un número o guión
            fecha = fecha.replace(/[^0-9\-]/g, '');

            // Insertar guiones en las posiciones correctas para formato DD-MM-YYYY
            if (fecha.length === 2 || fecha.length === 5) {
                fecha += '-';
            }

            // Limitar la longitud para evitar entradas incorrectas
            if (fecha.length > 10) {
                fecha = fecha.substring(0, 10);
            }

            // Validar la fecha y comprobar que no sea futura solo si la fecha está completa
            if (fecha.length === 10) {
                if (esFechaValidaYNoFutura(fecha)) {
                    input.value = fecha;
                } else {
                    alert("Por favor ingrese una fecha válida y que no sea futura.");
                    input.value = ''; // Limpiar el input
                }
            } else {
                input.value = fecha; // Actualizar el valor con la entrada parcial
            }
        }


function esFechaValidaYNoFutura(fecha) {
    var partes = fecha.split('-');
    if (partes.length === 3) {
        var day = parseInt(partes[0], 10);
        var month = parseInt(partes[1], 10) - 1; // Los meses en JavaScript van de 0 a 11
        var year = parseInt(partes[2], 10);
        var fechaObj = new Date(year, month, day);
        var ahora = new Date();

        // Comprobar validez de la fecha y que no sea futura
        if (!isNaN(fechaObj.getTime()) && fechaObj <= ahora && fechaObj.getDate() === day) {
            return true;
        }
    }
    return false;
}


</script>

<style>
    #otro_espe {
        display: none;
    }
    .number {
        display: none;
    }

    .grid-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.grid-images img {
    flex: 1 1 calc(33.33% - 10px); /* Tres imágenes por fila */
    max-width: 100%;
    height: auto;
    object-fit: cover; /* Mantiene las proporciones de las imágenes */
    max-height: 100px; /* Ajusta esto según el tamaño deseado */
}
.grid-images .image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 3px;
}

.grid-images .image-container img {
    max-width: 100%;
    height: auto;
    display: block;
}

.image-name {
    margin-top: 5px;
    font-size: 12px; /* Ajusta el tamaño según tus necesidades */
    color: #333; /* Ajusta el color según tus necesidades */
}
.image-selected {
    border: 2px solid blue;
}
.steps ul {
    display: flex;
    justify-content: space-between;
}

.steps ul li {
    flex: 1; /* Distribuye el espacio igualmente entre los li */
    text-align: center; /* Centra el contenido de cada tab */
    /* Añade cualquier otro estilo necesario aquí */
}

</style>
<script>
    $(document).ready(function() {
        $('#specie').change(function() {
            if ($(this).val() === 'Otro') {
                $('#otro_espe').show();
            } else {
                $('#otro_espe').hide();
            }
        });
    });

    $(document).ready(function() {
    $('.grid-images img').on('click', function() {
        // Quitar la clase 'image-selected' de todas las imágenes
        $('.grid-images img').removeClass('image-selected');

        // Agregar la clase 'image-selected' a la imagen clickeada
        $(this).addClass('image-selected');

        // Actualizar el valor del select si es necesario
        var employeeId = $(this).data('employee-id');
        $('#sch_employee_id').val(employeeId);
    });
});

$(document).ready(function() {
    var $select = $('#sch_service_id');
    if ($select.children('option').length > 1) { // Asegúrate de que haya suficientes opciones
        $select.val($select.children('option').eq(1).val()); // Establece la segunda opción como seleccionada
    }
});

$(document).ready(function(){
                        $('#email').on('blur', function(){
                            var email = $(this).val();
                            if(email.length > 0){ // Asegúrate de que el campo no esté vacío
                                $.ajax({
                                    url: '/check-email',
                                    type: 'POST',
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content'),
                                        'email': email
                                    },
                                    success: function(response){
                                        if(response.emailExists){
                                            Swal.fire({
                                                title: '¡Atención!',
                                                text: 'Este correo electrónico ya está registrado.',
                                                icon: 'warning',
                                                confirmButtonText: 'Ok'
                                            });
                                            isEmailValid = false;
                                        } else {
                                           
                                            isEmailValid = true;
                                        }
                                    }

                                    
                                });
                            }
                        });
                    });




</script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" rel="stylesheet"/>


@endsection