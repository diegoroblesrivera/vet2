@extends('site.layouts.site')
@section('content')
<link href="{{ dsAsset('site/css/custom/website-booking.css') }}" rel="stylesheet" />
<script src="{{ dsAsset('site/js/custom/website-booking.js') }}"></script>
<script src="{{ dsAsset('site/js/custom/jquery.rut.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- Normalize CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!-- Bootstrap 4 CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
      <!-- Telephone Input CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
      <!-- Icons CSS -->
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
      <!-- Nice Select CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
     <!-- Style CSS -->
    <link href="{{ dsAsset('site/css/style.css') }}"  rel="stylesheet" > 
	<!-- Demo CSS -->
    <link href="{{ dsAsset('site/css/demo.css') }}"  rel="stylesheet" > 

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
      .image-container {
    border: 3px solid #ccc; /* Define el estilo del borde */
    padding: 5px; /* Agrega un espacio alrededor de la imagen */
}

.image-container img {
    max-width: 100%; /* Asegura que la imagen no se desborde del contenedor */
    height: auto; /* Permite que la imagen mantenga su proporción de aspecto */
}

  </style>



<meta name="csrf-token" content="{{ csrf_token() }}">


<!--start banner section --
<section class="banner-area position-relative" style="background:url({{$appearance ?? ''->background_image}}) no-repeat;">
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
</section>
<!-- end banner section -->

<!-- Start booking Area -->
<section class="appoinment-booking-area mb-5 multi_step_form"> 
    <form id="msform"  action="{{ route('save.the.booking') }}" method="POST" > 
        @csrf
        <!-- Tittle -->
        <div class="tittle">
          <h2>Agendar una cita</h2>
        </div>
        <!-- progressbar -->
        <ul id="progressbar">
          <li class="active">Veteninario</li>  
          <li>Fecha</li> 
          <li>Mascota</li>
          <li>Cliente</li> 
          <li>Final</li>
        </ul>
        <!-- fieldsets -->
     
       <fieldset>
          <h3>Selecciona a tu veterinario pinchando la foto</h3>

            <div class="grid-images">
                @foreach ($employees ?? ''['data'] as $employee)
                    <div class="image-container">
                        <a href="javascript:void(0)">
                            <img src="{{ asset($employee['image_url']) }}" alt="Imagen de {{ $employee['full_name'] }}" data-employee-id="{{ $employee['id'] }}">
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
                    <label for="sch_employee_id" class="float-start">{{translate('Staff')}}</label>
                    <select id="sch_employee_id" name="sch_employee_id" class="serviceInput form-control" >
                    </select>
                </div>
            </div>
        
     
          <!-- <button type="button" class="action-button previous previous_button">Volver</button> -->
          <button type="button" class="next action-button" id="primero" hidden>Continuar</button>  
        </fieldset>
        <fieldset>
          <h3>Fecha   </h3>
          {{-- <input type="text" id="serviceDate" placeholder="Selecciona una fecha" name="service_time">
          <!-- Aquí irá la cuadrícula de horarios -->
          <br>
          <hr>
      

            <!-- Más botones para diferentes horarios -->
          </div> --}}

          <div class="col-md-auto col-lg-auto col-sm-auto" id="divServiceCalendar">
            <div class="row">
                <div class="col-md-12">
                    <label for="serviceDate" class="float-start">{{translate('Service Date')}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input id="serviceDate" name="service_date" class="form-controle input-sm" type="text" readonly />
                    <div id="divServiceDate" style="float: left;"></div>
                </div>
            </div>

        </div>
        <div class="col">
            <div id="divTopDays">

                <div class="row divServiceAvaiable">
                    <div class="col-md-12" id="divServiceAvaiableTime">
                    </div>
                </div>
            </div>
        </div>
          <br>
          <button type="button" class="action-button previous previous_button">Volver</button>
          <button type="button" class="next action-button" id="segundo">Continuar</button>  
        </fieldset>
        <fieldset> 
          <h3>Datos Mascota</h3>
    
          <!-- <div class="form-group fg_3"> 
            <input type="text" class="form-controle" placeholder="Anwser here:">
          </div>  -->
          <div class="row p-1">
            <!-- <p>Completa información clave sobre tu mascota. Esta información personalizada nos permite brindarle la mejor atención. 
                    Un proceso breve y significativo para asegurar que tu mascota reciba la mejor atención.
            </p> -->
            <div class="col-md-12">
                <div class="row">

                    <!--<div class="input-group">-->
                    <!--    <span class="input-group-addon"><i class="fa fa-paw"></i></span>-->
                    <!--    <input id="email" type="email" class="form-control" name="email" placeholder="Email">-->
                    <!--  </div>-->

                    <div class="col-md-4 input-icon">
                        <label for="pet_name" class="float-start">{{translate('Pet Name')}} *</label>
                        <div class="icon-container">
                            <input type="text" id="pet_name" name="pet_name" class="form-controle icon-input" value="Firulais" required/>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                      <label for="specie" class="float-start">{{translate('Specie')}} *</label><br>
                      <select class="product_select form-select" id="specie" name="specie">
                        
                        <option value="Canino" selected>Canino</option>
                        <option value="Felino">Felino</option>
                        <option value="Otro">Otro</option> 
                      </select>
    
                    </div>
                    <div class="col-md-4" id="otro_espe">
                        <label for="otro_esp" class="float-start">{{translate('Especifique Especie')}} </label>
                        <input type="text" id="otro_esp" name="otro_esp" class="form-controle" />
                    </div>
                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <label for="sex" class="float-start">{{translate('Sexo')}} </label>
                        {{-- <input type="text   " id="sex" name="sex" class="form-controle" /> --}}
                        <select class="form-select product_select"  id="sex" name="sex" >
                            
                            <option value="Macho" selected>Macho</option>
                            <option value="Hembra">Hembra</option>
                          </select>
                    </div>
                    <div class="col-md-4">
                        <label for="race" class="float-start">{{translate('Raza')}} </label>
                        <input type="text" id="race" name="race" class="form-controle" />
                    </div>
                    <div class="col-md-4">
                        <label for="color" class="float-start">{{translate('Size')}} </label>
                        {{-- <input type="text" id="color" name="color" class="form-controle" /> --}}
                        <select class="form-select product_select"  id="color" name="color" >
                            
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
                        <select class="form-select product_select"  id="state" name="state" >
                            
                            <option value="Fertil" selected>Fertil</option>
                            <option value="Castrado/Esterilizado">Castrado/Esterilizado</option>
                            <option value="No lo sé">No lo sé</option>
                          </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nac" class="float-start">{{translate('Nac Estimado')}} (01-12-2020) </label>
                        <input type="text" id="nac" name="nac" class="form-controle" oninput="formatearFecha(this)" placeholder="dd-mm-AAAA" />
                    </div>
    
                    
                  
                </div>
            </div>
    
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label for="state" class="float-start">Motivo Consulta</label>
                        <input type="text" id="motivo" name="motivo" class="form-controle" />
                    </div>
                   
    
                    
                  
                </div>
            </div>
    
          </div>
    
          <button type="button" class="action-button previous previous_button">Volver</button>
          <button type="button" class="next action-button" id="tercero">Continuar</button>  
        </fieldset>
        <fieldset>
          <h3>Datos Cliente</h3>
          <div class="row p-1">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <label for="full_name" class="float-start">{{translate('Full Name')}} *</label>
                        <input type="text" id="full_name" name="full_name" class="form-controle" value="Name" />
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="float-start">{{translate('Email')}} *</label>
                        <input type="email" id="email" name="email" class="form-controle" value="usuario1@gmail.com"/>
                        <span id="emailFeedback"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="phone_no" class="float-start">{{translate('Phone')}} *</label>
                        <input type="number" id="phone_no" name="phone_no" class="form-controle" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="rut" class="float-start">{{translate('RUN')}} *</label>
                        <input type="text" id="rut" name="rut" class="form-controle claseRut" value="162342345" oninput="formatearRUT(this)" placeholder="XX.XXX.XXX-X"/>
                    </div>
                    <div class="col-md-7">
                        <label for="direccion" class="float-start">{{translate('Address')}} *</label>
                        <input type="text" id="direccion" name="direccion" class="form-controle" value="Las Camelias "/>
                    </div>
                   
                </div>
            </div>
    
        </div>
          <button type="button" class="action-button previous previous_button">Volver</button>
          <button type="button" class="next action-button" id="cuarto">Continuar</button>  
        </fieldset>
        <fieldset>
          <h3>Confirma tu cita</h3>
          <div class="color-success p-12">Revisa y confirma en un instante. Si es necesario, vuelve y edita lo que sea necesario. Una vez confirmada, recibirás
            un correo electrónico, y tu cita quedará agendada y reservada para ti.</div>
            <div id="summary">
                <h6>Resumen de la Cita</h6>
                Fecha de la cita: <span id="summaryDate"></span><br>
                Hora de la cita: <span id="summaryTime"></span><br>
                Veterinario: <span id="vet"></span>
                <!-- Agrega más elementos de resumen según sea necesario -->
            </div>
          
    
          <button type="button" class="action-button previous previous_button">Volver</button> 
          
          <button type="submit" class="next action-button" id="tercero">Finalizar</button> 
          {{-- <a href="#" class="action-button" id="final"  type="" >Finalizar</a>  --}}
        </fieldset>  
      </form> 
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
            
            // Eliminar cualquier caracter que no sea un número
            fecha = fecha.replace(/[^0-9]/g, '');

            // Insertar guiones en las posiciones correctas para formato DDMMYYYY
            if (fecha.length === 2 || fecha.length === 4) {
                fecha = fecha.substring(0, 2) + '-' + fecha.substring(2, 4);
            }
            if (fecha.length > 6) {
                fecha = fecha.substring(0, 2) + '-' + fecha.substring(2, 4) + '-' + fecha.substring(4, 8);
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
  

    .grid-images {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: calc(33.33% - 10px); /* Ajusta esto para controlar cuántas imágenes se muestran por fila */
}

.image-container img {
    width: 100%; /* Ajusta las imágenes para que ocupen todo el ancho del contenedor */
    height: auto; /* Mantiene la proporción de las imágenes */
    object-fit: cover; /* Asegura que la imagen cubra el área sin distorsionarse, puede recortarse un poco */
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
        $('#primero').click(); 
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ dsAsset('site/js/script.js') }}"></script>

<script>
     var SiteManager = {
        GetCouponAmount: function () {
            var jsonParam = {
                couponCode: $("#coupon_code").val(),
                orderAmount: subtotal
            };
            var serviceUrl = "get-coupon-amount";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);
            function onSuccess(jsonData) {
                if (jsonData.status == 1) {
                    $("#summary-discount").text(currency + '' + jsonData.data);
                    $("#summary-total").text(currency + '' + parseFloat(parseFloat(subtotal)-parseFloat(jsonData.data)).toFixed(2));
                }
            }
            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
     
        ServiceDatePicker: function (startDate) {
            $('#divServiceDate').datetimepicker({
                format: 'Y-m-d',
                inline: true,
                timepicker: false,
                minDate: new Date(),
                startDate: startDate._d,
                onChangeDateTime: function (dp, $input) {
                    $("#serviceDate").val($input.val());
                    SiteManager.SetServiceProperty($input.val());
                    SiteManager.LoadServiceTimeSlot($("#sch_service_id").val(), $("#sch_employee_id").val())
                }
            });
            SiteManager.SetServiceProperty(startDate);
        },


        SetServiceProperty: function (startDate, time) {
           
            // Configurar moment en español
            let longDate = moment(startDate).locale('es').format('dddd, DD, MMMM, yyyy');
            // $("#serviceDate").val(JsManager.DateFormatDefault(startDate));
            $("#divDaysName").text(longDate);
            if (time) {
                $("#iSelectedServiceText").text("Has Seleccionado " + time + " el " + longDate);
            } else {
                $("#iSelectedServiceText").text("Has Seleccionado " + longDate);
            }
        },
        
        LoadServiceCategoryDropDown: function () {
            var jsonParam = '';
            var serviceUrl = "get-site-service-category";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                JsManager.PopulateCombo("#sch_service_category_id", jsonData.data, "Seleccione", '');
                $("#sch_service_category_id").val('2').change();
                
                //document.ready = document.getElementById("sch_service_category_id").value = '2';
            }

            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        LoadServiceDropDown: function (categoryId=2) {
            var jsonParam = { sch_service_category_id: categoryId };
            var serviceUrl = "get-site-service";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                JsManager.PopulateCombo("#sch_service_id", jsonData.data, "Seleccione", '');
                $("#sch_service_id").val('2').change();
                
            }
            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        LoadBranchDropDown: function () {
            var jsonParam = '';
            var serviceUrl = "get-site-branch";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                JsManager.PopulateCombo("#cmn_branch_id", jsonData.data);
            }
            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        LoadEmployeeDropDown: function (serviceId) {
            var jsonParam = { sch_service_id: serviceId, cmn_branch_id: $("#cmn_branch_id").val() };
            var serviceUrl = "get-site-employee-service";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                currentEmpList = jsonData.data;
                JsManager.PopulateCombo("#sch_employee_id", jsonData.data, "Seleccione", '');
            }
            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        LoadServiceTimeSlot: function (serviceId, employeeId,dateText) {
            if (2 > 0 ) {
                JsManager.StartProcessBar();
                var jsonParam = {
                    sch_service_id: 1,
                    sch_employee_id: 2,
                    date: dateText,
                    cmn_branch_id: 2
                };
                var serviceUrl = "get-site-service-time-slot";
                JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);
                function onSuccess(jsonData) {
                    if (jsonData.status == 1) {
                        $("#divServiceAvaiableTime").empty();
                        
                        var ahora = new Date();
                        var fechaActual = ahora.toISOString().split('T')[0]; // Obtiene la fecha actual en formato 'YYYY-MM-DD'
                        var horaActual = ahora.getHours();
                        var minutoActual = ahora.getMinutes();
                        var fechaSeleccionada = $("#serviceDate").val(); // Obtiene la fecha seleccionada del input
            
            
                        $.each(jsonData.data, function (i, v) {
                            let startTimeParts = v.start_time.split(":");
                            let startTimeHour = parseInt(startTimeParts[0]);
                            let startTimeMinute = parseInt(startTimeParts[1]);
                            let disabledClass = "";
                            let disabledServiceText = "";

                                            // Si la fecha seleccionada es igual a la actual, aplicar el filtro de tiempo
                if (fechaSeleccionada === fechaActual) {
                    if (startTimeHour > horaActual || (startTimeHour === horaActual && startTimeMinute >= minutoActual)) {
                        // ... (código para agregar el divTimeSlot)
                        if (startTimeHour > horaActual || (startTimeHour === horaActual && startTimeMinute >= minutoActual)) {
                            if (v.is_avaiable == 0) {
                                disabledClass = "disabled-service";
                                disabledServiceText = "disabled-service-text";
                            }
                            let serviceTime = v.start_time + '-' + v.end_time;
                            $("#divServiceAvaiableTime").append(
                                '<div class="divTimeSlot ' + disabledClass + '" title="' + serviceTime + '">' +
                                '<div class="float-start w-100">' +
                                '<div class="float-start">' +
                                '<input type="radio" class="serviceTime d-none" name="service_time" value="' + serviceTime + '"/>' +
                                '</div>' +
                                '<div class="float-start cp divStartTime text-center w-100 time-slop' + disabledServiceText + '" style="direction: ltr;">' + moment('01-01-1990 ' + v.start_time).format('hh:mm A') + '</div>' +
                                '</div>' +
                                '</div>');
                            }
                    }
                } else {
                    // Para fechas futuras, mostrar todas las horas disponibles
                    // ... (código para agregar el divTimeSlot)
                   
                        if (v.is_avaiable == 0) {
                            disabledClass = "disabled-service";
                            disabledServiceText = "disabled-service-text";
                        }
                        let serviceTime = v.start_time + '-' + v.end_time;
                        $("#divServiceAvaiableTime").append(
                            '<div class="divTimeSlot ' + disabledClass + '" title="' + serviceTime + '">' +
                            '<div class="float-start w-100">' +
                            '<div class="float-start">' +
                            '<input type="radio" class="serviceTime d-none" name="service_time" value="' + serviceTime + '"/>' +
                            '</div>' +
                            '<div class="float-start cp divStartTime text-center w-100 time-slop' + disabledServiceText + '" style="direction: ltr;">' + moment('01-01-1990 ' + v.start_time).format('hh:mm A') + '</div>' +
                            '</div>' +
                            '</div>');
                        }
                

                        });
                    }
                    JsManager.EndProcessBar();
                }
                function onFailed(xhr, status, err) {
                    if (xhr.responseJSON.status == 5) {
                        $("#divServiceAvaiableTime").empty();
                        $("#divServiceAvaiableTime").append('<div class="mt-3">' + xhr.responseJSON.data + '</div>');
                    } else if (xhr.responseJSON.status == 2) {
                        //service is not available today
                    } else {
                        Message.Exception(xhr);
                    }
                    JsManager.EndProcessBar();
                }
            } else {
                $("#divServiceAvaiableTime").empty();
            }
        },

      
        SaveBooking: function () {
            return new Promise(function (resolve, reject) {
                JsManager.StartProcessBar();
                let bookingData = {
                    full_name: $("#full_name").val(),
                    email: $("#email").val(),
                    phone_no: initTelephone.getNumber(),
                    run: $("#rut").val(),
                    direccion: $("#direccion").val(),
                    sex: $("#sex").val(),
                    pet_name: $("#pet_name").val(),
                    specie: $("#specie").val(),
                    race: $("#race").val(),
                    color: $("#color").val(),
                    micro: $("#micro").val(),
                    state: $("#state").val(),
                    nac: $("#nac").val(),
                    motivo: $("#motivo").val(),
                    items: []
                };
                $.each(bookingList, function (i, v) {
                    let obj = {
                        cmn_branch_id: v.branchId,
                        sch_service_category_id: v.categoryId,
                        sch_service_id: v.serviceId,
                        service_name: v.service_name,
                        sch_employee_id: v.employeeId,
                        service_date: v.serviceDate,
                        service_time: v.serviceTime
                    };
                    bookingData.items.push(obj);
                });
        
                var jsonParam = { bookingData: bookingData };
                var serviceUrl = "save-site-service-booking";
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);
        
                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("save");
                        // Aquí se procesa la respuesta de éxito como sea necesario
                        // La lógica depende de cómo tu aplicación deba manejar el éxito.
                       // serviceStepar.steps("next");
                       
                        JsManager.EndProcessBar();
                        resolve(jsonData); // Resolver la promesa con los datos de respuesta
                      
                         window.location.href = JsManager.BaseUrl() + "/booking-complete"; //'booking-complete' ;//jsonData.data.returnUrl.data.links[1].href;
                    } else {
                        Message.Error("save");
                        JsManager.EndProcessBar();
                        reject(jsonData); // Rechazar la promesa con los datos de respuesta
                    }
                }
        
                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    if (typeof Message !== 'undefined' && typeof Message.Exception === 'function') {
                        Message.Exception(xhr);
                    } else {
                        console.error('An error occurred:', xhr, status, err);
                    }
                    reject(err); // Rechazar la promesa con el error
                }
                isBookingSuccess = false;
            });
        }
        
        ,

        CancelBooking: function (bookingId) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = { serviceBookingId: bookingId };
                var serviceUrl = "site-cancel-booking";
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("Cancel Successfully");
                    } else {
                        Message.Error("save");
                    }
                    JsManager.EndProcessBar();
                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                    return false;
                }
            }
        },

        GetCustomerLoginInfo: function () {
            JsManager.StartProcessBar();
            var jsonParam = '';
            var serviceUrl = "get-site-login-customer-info";
            JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                if (jsonData.status == "1") {
                    let data = jsonData.data;
                    if (data.full_name)
                        $("#full_name").val(data.full_name).attr('readonly', true);
                    if (data.email)
                        $("#email").val(data.email).attr('readonly', true);
                    initTelephone.setNumber(data.phone_no);
                    if (data.state)
                        $("#state").val(data.state).attr('readonly', true);
                    if (data.city)
                        $("#city").val(data.city).attr('readonly', true);
                    if (data.postal_code)
                        $("#postal_code").val(data.postal_code).attr('readonly', true);
                    if (data.street_address)
                        $("#street_address").val(data.street_address).attr('readonly', true);
                    if (data.street_address)
                        $("#street_address").val(data.street_address).attr('readonly', true);
                }
                JsManager.EndProcessBar();
            }

            function onFailed(xhr, status, err) {
                JsManager.EndProcessBar();
                Message.Exception(xhr);
            }

        },
        AddBookingSchedule: function () {
            if (bookingList.length > 0) {
                const chkVal = bookingList.filter(function (item, ind) {
                    console.log(item.branchId);
                    if (item.branchId != $("#cmn_branch_id").val()) {
                        Message.Warning("You can't add different branches service in the same order");
                        return true;
                    }
                    return item.branchId == $("#cmn_branch_id").val() &&
                        item.categoryId == $("#sch_service_category_id").val() &&
                        item.serviceId == $("#sch_service_id").val() &&
                        item.employeeId == $("#sch_employee_id").val() &&
                        item.serviceTime == $("input[name='service_time']:checked").val() &&
                        item.serviceDate == $("#serviceDate").val();
                });

                if (chkVal.length > 0) {
                    Message.Warning("This is already exists in your cart");
                    return false;
                }
            }
            var currentEmp = currentEmpList.filter(function (emp) { return emp.id == $("#sch_employee_id").val() })[0];
            bookingList.push({
                branchId: $("#cmn_branch_id").val(),
                categoryId: $("#sch_service_category_id").val(),
                serviceId: $("#sch_service_id").val(),
                service_name: $("#sch_service_id option:selected").text(),
                employeeId: $("#sch_employee_id").val(),
                employee_name: currentEmp.name,
                employee_rate: parseFloat(currentEmp.fees),
                serviceTime: $("input[name='service_time']:checked").val(),
                serviceDate: $("#serviceDate").val(),
                currency: currentEmp.currency,
            });
            SiteManager.DrawServiceTable();
            $("#tbl-service-cart").removeClass('d-none');
            return bookingList;
        },
        RemoveBookingSchedule: function (ind) {
            if (bookingList[ind] != undefined) {
                bookingList = bookingList.filter(function (item, index) {
                    return index != ind;
                });
            }

            SiteManager.DrawServiceTable();
            return bookingList;

        },
        DrawServiceTable: function () {
            $('#iSelectedServiceList').empty();
            $.each(bookingList, function (ind, item) {
                var $delItem = $('<i class="fa fa-trash text-danger cursor-pointer"></i>');
                $delItem.on("click", function () {
                    SiteManager.RemoveBookingSchedule(ind);
                });
                var $wrap = $('<tr>' +
                    '<td class="text-center">' + (ind + 1) + '</td>' +
                    '<td>' + item.service_name + '</td>' +
                    '<td>' + item.employee_name + '</td>' +
                    '<td>' + item.serviceDate + '</td>' +
                    '<td>' + item.serviceTime + '</td>' +
                    // '<td>' + item.currency + " " + item.employee_rate + '</td>' +
                    '<td class="text-center"></td>' +
                    '</tr>');
                $wrap.find('td:last-child').append($delItem);
                $('#iSelectedServiceList').append($wrap);
            })
        },
        DrawServiceTable2: function () {
            $('#iSelectedServiceList2').empty();
            $.each(bookingList, function (ind, item) {
                var $delItem = $('<i class="fa fa-trash text-danger cursor-pointer"></i>');
                $delItem.on("click", function () {
                    SiteManager.RemoveBookingSchedule(ind);
                });
                var $wrap = $('<tr>' +
                    '<td class="text-center">' + (ind + 1) + '</td>' +
                    '<td>' + item.service_name + '</td>' +
                    '<td>' + item.employee_name + '</td>' +
                    '<td>' + item.serviceDate + '</td>' +
                    '<td>' + item.serviceTime + '</td>' +
                    // '<td>' + item.currency + " " + item.employee_rate + '</td>' +
                    '<td class="text-center"></td>' +
                    '</tr>');
                $wrap.find('td:last-child').append($delItem);
                $('#iSelectedServiceList2').append($wrap);
            })
        },
        CalculateServiceSummary: function () {
            $("#divServiceSection").empty();
            subtotal=0;
            $.each(bookingList, function (i, v) {
                subtotal = parseFloat(parseFloat(subtotal) + parseFloat(v.employee_rate), 0);
                currency = v.currency;
                let servicehtml = '<div class="service-item">'
                    + '<div class="w-70 float-start">'
                    + '<div class="w-100 text-start">' + v.service_name + '</div>'
                    + '<div class="w-100 text-start" style="font-size:11px">Date:' + v.serviceDate + ' Time:' + v.serviceTime + '</div>'
                    + '</div>'
                    + '<div class="float-end">' + v.currency + v.employee_rate.toFixed(2) + '</div>'
                    + '</div>';
                $("#divServiceSection").append(servicehtml);
            });
            $("#divServiceSection").append('<div class="service-border-button"></div>');
            $("#summary-subtotal").text(currency + subtotal.toFixed(2));
            $("#summary-total").text(currency + subtotal.toFixed(2));
        }
    };
    $(document).ready(function() {
    var veterinarioSeleccionado, fechaCita;

    // Inicializar DatePicker
    $("#serviceDate").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        firstDay: 1,
        dayNamesMin: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        onSelect: function(dateText) {
            fechaCita = dateText;
            $('#summaryDate').text(fechaCita);
            SiteManager.LoadServiceTimeSlot(2, 2, dateText);
        }
    });

    // Evento para seleccionar veterinario
    $('.image-container').on('click', function() {
        veterinarioSeleccionado = $(this).find('.image-name').text();
        $('#vet').text(veterinarioSeleccionado);
    });

    // Actualizar los slots de hora cuando estén disponibles
    $(document).ajaxComplete(function() {
        $('.time-slop').on('click', function() {
            var horaCita = $(this).text();
            $('#summaryTime').text(horaCita);
        });
    });
});






</script>


@endsection