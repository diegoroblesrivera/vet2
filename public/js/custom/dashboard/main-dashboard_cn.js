var Dashboard;
function doneService(id, status) {
	Dashboard.ChangeBookingStatus(id, status);
}

function cancelService(id, status) {
	Dashboard.ChangeBookingStatus(id, status);
}

function makeService(id) {
	Dashboard.SaveCita(id);
}


function openCancelModal(id_cliente, cmn_pet_id) {
    // console.log("serviceId:", serviceId); // Esto te mostrará el valor en la consola

    // document.getElementById('serviceId').value = serviceId;
    // $('#cancelModal').modal('show');

	console.log("serviceId66:", id_cliente);

    // Hacer una solicitud AJAX para obtener datos existentes
    $.ajax({
        url: 'obtener-cita/' + id_cliente,  // Asegúrate de tener esta ruta en tus rutas de Laravel
        type: 'GET',
        success: function(data) {
            if(data) {
                // Aquí rellenas el formulario con los datos existentes
                $('#peso').val(data.peso);
				$('#pesoLabel').text(data.peso);
				// Convertir la fecha de nacimiento a un objeto Date de JavaScript
				var birthDate = new Date(data.pet_birth_date);
				var currentDate = new Date();

				// Calcular la edad en años
				var ageYears = currentDate.getFullYear() - birthDate.getFullYear();

				// Ajustar los años si aún no hemos pasado el mes de cumpleaños este año
				if (currentDate.getMonth() < birthDate.getMonth() || 
					(currentDate.getMonth() === birthDate.getMonth() && currentDate.getDate() < birthDate.getDate())) {
					ageYears--;
				}

				// Calcular los meses adicionales
				var ageMonths = currentDate.getMonth() - birthDate.getMonth();
				if (ageMonths < 0 || (ageMonths === 0 && currentDate.getDate() < birthDate.getDate())) {
					ageMonths += 12;
				}

				// Mostrar la edad en años y meses
				var edadTexto = ageYears + ' años ' + ageMonths + ' meses';
				$('#pet_birth_date').text(edadTexto);
				$('#ganglios_rl').text(data.ganglios_r);
				$('#ganglios_pl').text(data.ganglios_p);
				$('#pet_id').text(data.pet_id);
				$('#temperatural').text(data.temperatura);
				$('#fonendol').text(data.fonendo);
				$('#palpitacion_abdl').text(data.palpitacion_abd);
				$('#piell').text(data.piel);
				$('#obesol').text(data.obeso);

				$('#depo').val(data.depo);
				$('#vive_otros').val(data.vive_otros);
				$('#vive_otrosn').val(data.vive_otrosn);
				$('#tipo_alim').val(data.tipo_alim);
				$('#tipo_alim_marca').val(data.tipo_alim_marca);
				$('#obs').val(data.obs);
				$('#id').val(data.id);
				$('#temperatura').val(data.temperatura);
				$('#ganglios_r').val(data.ganglios_r);
				$('#ganglios_p').val(data.ganglios_p);
				$('#fonendo').val(data.fonendo);
				$('#palpitacion_abd').val(data.palpitacion_abd);
				$('#piel').val(data.piel);
				$('#peso_2').val(data.peso_2);
				$('#obeso').val(data.obeso);
				$('#anam').val(data.anam);
				$('#imagenes').val(data.imagenes);
				if(data.id>0){
					$('#tiene').val(1);
				}
				else{
					$('#tiene').val(0);
				}
				console.log("el servicio ha llegado:", data.peso);

            } else {
                // Si no hay datos, deja los campos del formulario vacíos
                // Resetea los campos como necesites
				$('#cancelForm label').text('');


            }
        },
        error: function(error) {
            console.log(error);
        }
    });

	

    document.getElementById('serviceId').value = id_cliente;
	document.getElementById('cmn_pet_id').value = cmn_pet_id;
	$('#cancelModal').modal('show');
}





(function ($) {
    "use strict";	

	$(document).ready(function () {
		$("input[name='booking-info-duration-radio']").hide()
		Dashboard.Common();
		Dashboard.BookingInfo('', 1);

		$("#booking-info-duration-pill-today").on("click",function () {
			$("#booking-info-duration-radio-today").prop("checked", true);
			Dashboard.BookingInfo($("#booking-info-service-status").val(), 1);
		});
		$("#booking-info-duration-pill-month").on("click",function () {
			$("#booking-info-duration-radio-monthly").prop("checked", true);
			Dashboard.BookingInfo($("#booking-info-service-status").val(), 2);
		});
		$("#booking-info-service-status").change(function () {
			Dashboard.BookingInfo($(this).val(), $("input[name='booking-info-duration-radio']:checked").val());
		});
	});

	Dashboard = {
		Common: function () {
			var jsonParam = '';
			var serviceUrl = "get-dashboard-common-data";
			JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);
			function onSuccess(jsonData) {
				if (jsonData.status == 1) {

					//Total Income And Other Statistics
					Dashboard.TotalIncomeAndOtherStatistics(jsonData.data.incomAndOtherStatistics);

					// top services
					Dashboard.TopBookingService(jsonData.data.topService);

					//total service
					var dataTotalBooking = jsonData.data.bookingStatus.totalBooking;
					let totalBooking = dataTotalBooking.reduce((n, { serviceCount }) => n +parseInt(serviceCount), 0);

					//total done booking
					let totalDone = dataTotalBooking.find(f => f.status == 4)?.serviceCount ?? 0;
					let donePer = parseInt((totalDone / totalBooking) * 100);
					Circles.create({
						id: 'divDoneBooking',
						radius: 30,
						value: donePer,
						maxValue: 100,
						width: 7,
						text: donePer??0 + " %",
						colors: ['#f1f1f1', '#28a745'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});
					$("#divDoneBookingText").text(totalDone);

					//total cancel booking
					let totalCancel = dataTotalBooking.find(f => f.status == 3)?.serviceCount ?? 0;
					let cancelPer = parseInt((totalCancel / totalBooking) * 100);
					Circles.create({
						id: 'divCancelBooking',
						radius: 30,
						value: cancelPer,
						maxValue: 100,
						width: 7,
						text: cancelPer??0 + " %",
						colors: ['#f1f1f1', '#fe3145'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});
					$("#divCancelBookingText").text(totalDone);

					//total approved booking
					let totalApproved = dataTotalBooking.find(f => f.status == 2)?.serviceCount ?? 0;
					let approvedPer = parseInt((totalApproved / totalBooking) * 100);
					Circles.create({
						id: 'divApprovedBooking',
						radius: 30,
						value: approvedPer,
						maxValue: 100,
						width: 7,
						text: approvedPer??0 + " %",
						colors: ['#f1f1f1', '#2674da'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});
					$("#divApprovedBookingText").text(totalApproved);

					//total processing * pending booking
					let totalProcessing = dataTotalBooking.find(f => f.status == 1)?.serviceCount ?? 0;
					let totalPending = dataTotalBooking.find(f => f.status == 0)?.serviceCount??0;
					let processingPendingPer = parseInt(((parseInt(totalProcessing) + parseInt(totalPending)) / parseInt(totalBooking)) * 100);
					Circles.create({
						id: 'divProcessingAndPendingBooking',
						radius: 30,
						value: processingPendingPer,
						maxValue: 100,
						width: 7,
						text: processingPendingPer??0 + " %",
						colors: ['#f1f1f1', '#ffad46'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});
					$("#divProcessingAndPendingBookingText").text(parseInt(totalProcessing) + parseInt(totalPending));





					//todays service
					var dataTodayBooking = jsonData.data.bookingStatus.todayBooking;
					let totalBookingToday = dataTodayBooking.reduce((n, { serviceCount }) => n + parseInt(serviceCount), 0);

					Circles.create({
						id: 'divTotalBookingToday',
						radius: 35,
						value: totalBookingToday,
						maxValue: totalBookingToday,
						width: 7,
						text: totalBookingToday,
						colors: ['#f1f1f1', '#000'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});

					Circles.create({
						id: 'divDoneBookingToday',
						radius: 35,
						value: dataTodayBooking.find(f => f.status == 4)?.serviceCount,
						maxValue: totalBookingToday,
						width: 7,
						text: dataTodayBooking.find(f => f.status == 4)?.serviceCount,
						colors: ['#f1f1f1', '#28a745'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});

					Circles.create({
						id: 'divCancelBookingToday',
						radius: 35,
						value: dataTodayBooking.find(f => f.status == 3)?.serviceCount,
						maxValue: totalBookingToday,
						width: 7,
						text: dataTodayBooking.find(f => f.status == 3)?.serviceCount,
						colors: ['#f1f1f1', '#fe3145'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});

					Circles.create({
						id: 'divApprovedBookingToday',
						radius: 35,
						value: dataTodayBooking.find(f => f.status == 2)?.serviceCount,
						maxValue: totalBookingToday,
						width: 7,
						text: dataTodayBooking.find(f => f.status == 2)?.serviceCount,
						colors: ['#f1f1f1', '#2674da'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});

					Circles.create({
						id: 'divProcessingBookingToday',
						radius: 35,
						value: dataTodayBooking.find(f => f.status == 1)?.serviceCount,
						maxValue: totalBookingToday,
						width: 7,
						text: dataTodayBooking.find(f => f.status == 1)?.serviceCount,
						colors: ['#f1f1f1', '#17a2b8'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});

					Circles.create({
						id: 'divPendingBookingToday',
						radius: 35,
						value: dataTodayBooking.find(f => f.status == 0)?.serviceCount,
						maxValue: totalBookingToday,
						width: 7,
						text: dataTodayBooking.find(f => f.status == 0)?.serviceCount,
						colors: ['#f1f1f1', '#ffad46'],
						duration: 400,
						wrpClass: 'circles-wrp',
						textClass: 'circles-text',
						styleWrapper: true,
						styleText: true
					});


				}
			}

			function onFailed(xhr, status, err) {
				Message.Exception(xhr);
			}
		},

		TopBookingService: function (data) {
			$.each(data, function (i, v) {
				var html = '<div class="d-flex">' +
					'<div class="avatar avatar-online">' +
					'<span class="avatar-title rounded-circle border border-white bg-primary text-uppercase">' + v.title.slice(0, 1) + '</span>'
					+
					'</div>' +
					'<div class="flex-1 pt-1 ml-2">' +
					'<h6 class="fw-bold mb-1">' + v.title + '</h6>' +
					'<small class="text-muted">Our top services</small>' +
					'</div>' +
					'<div class="d-flex ml-auto align-items-center">' +
					'<h3 class="text-info fw-bold">' + v.service_count + '</h3>' +
					'</div>' +
					'</div>' +
					'<div class="separator-dashed"></div>';
				$("#div-body-top-booking-service").append(html);
			});
		},
		BookingInfo: function (serviceStatus, duration) {
			JsManager.StartProcessBar()
			var jsonParam = { serviceStatus: serviceStatus, duration: duration };
			var serviceUrl = "get-dashboard-booking-info";
			JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);
			function onSuccess(jsonData) {
				$("#div-body-booking-info").empty();
				if (jsonData.status == 1) {
					var data = jsonData.data;


					$.each(data, function (i, v) {
						var btnClass = "";
						var buttonText = "";
						var onClickFunction = "";
						switch (v.status) {
						
							case 2:
								btnClass = "btn btn-sm btn-info float-right";
								buttonText = "Enviar Recordatorio";
								onClickFunction = "Dashboard.ChangeBookingStatus(" + v.id + ", 1)";
								break;
							case 0	:
								btnClass = "btn btn-sm btn-success float-right";
								buttonText = "Confirmar Cita";
								onClickFunction = "Dashboard.ChangeBookingStatus(" + v.id + ", 2)";
								break;
							default:
								btnClass = "btn btn-sm btn-danger float-right";
								buttonText = "Sin Texto																";
								onClickFunction = "";
								break;
	
						}
						var html = '<div class="row">' +
							'<div class="col-md-8">' +
							'<div class="d-flex">' +
							'<div class="float-left avatar avatar-online">' +
							'<span class="avatar-title rounded-circle border border-white bg-info text-uppercase">' + v.customer.slice(0, 1) + '</span>' +
							'</div>' +
							'<div class="float-left ml-3 pt-1">' +
							'<h6 class="text-uppercase fw-bold mb-1">' +
							v.service + " | "  + v.nombre + " | " + 
							'<span class="' + Dashboard.ServiceFontColorClass(v.status) + ' pl-3">' + Dashboard.ServiceStatus(v.status) + '</span>' +
							'</h6>' +
							'<span class="text-muted">' +
							"No# " + v.id + " | Nombre " + v.nombre + " | " + v.branch + " | " + v.employee + " | " + "Due# <span class='text-danger'>" + parseFloat(v.due).toFixed(2) + "</span><br/>" +
							v.customer + " | " + v.customer_phone_no + " | " + (v.remarks == null ? "No remarks found!" : v.remarks)
							+ '</span>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'<div class="col-md-4">' +
							'<div class="float-right pt-1">' +
							'<small class="text-muted">' + moment(v.date + ' ' + v.start_time).format('LLL') + '</small>' +
							'<div class="">'+
							// '<button ' + (v.status == 4 ? "disabled" : "") + ' onclick="doneService(' + v.id + ',4)" type="button" class="btn btn-sm  btn-success ml-1 float-right"><i class="fas fa-check-circle"></i> Done</button>' +
							// '<button ' + ' onclick="startService(' + v.id + ',' + ')" type="button" class="btn btn-sm btn-success float-right"><i class="fas fa-check-circle"></i>Confirmar Cita</button>'+
							
							'<button onclick="' + onClickFunction + '" type="button" class=" ' + btnClass + ' float-right">' +
							buttonText + '</button>' +
						
                            '</div>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'<div class="separator-dashed"></div>';
						$("#div-body-booking-info").append(html);
					});

				}
				JsManager.EndProcessBar()
			}

			function onFailed(xhr, status, err) {
				JsManager.EndProcessBar()
				Message.Exception(xhr);
			}
		},

		

		
		ServiceStatus: function (status) {
			var serviceStatus = ['Agendado', 'Recordatorio Enviado',
			'Confirmado', 'Hora Cancelada', 'En sala de espera', 'En Box'
		   , 'Atendido', 'Hospitalizacion', 'En Cirugia'];
			return serviceStatus[status];
		},
		ServiceFontColorClass: function (status) {
			var serviceColor = ['fc_agendado', 'fc_recordatorio_enviado',
			'fc_confirmado', 'fc_cancel', 'fc_ensala','fc_enbox'
		   , 'fc_atendido', 'fc_hospitalizado', 'fc_encirugia'];
			return serviceColor[status];
		},
		TotalIncomeAndOtherStatistics: function (data) {
			$("#totalIncome").text(parseFloat(data.todayPaidAndDue.reduce((n, { service_amount }) => n + parseFloat(service_amount), 0)).toFixed(2))
			let partialDue = data.todayPaidAndDue.find(f => f.payment_status == 3);
			partialDue = (parseFloat(partialDue?.service_amount ?? 0) - parseFloat(partialDue?.paid_amount ?? 0));
			$("#totalDue").text(parseFloat(data.todayPaidAndDue.find(f => f.payment_status == 2)?.service_amount ?? 0 + partialDue).toFixed(2))

			$("#totalCash").text(parseFloat(data.todayPaidBy.find(f => f.type == 1)?.paid_amount ?? 0).toFixed(2))
			$("#totalOnlinePayment").text(parseFloat(data.todayPaidBy.find(f => f.type == 2)?.paid_amount ?? 0).toFixed(2))

		},

		ChangeBookingStatus: function (id, status) {
			if (Message.Prompt()) {
				JsManager.StartProcessBar();
				var jsonParam = { id: id, status: status };
				var serviceUrl = "dashboard.change.booking.status";
				JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

				function onSuccess(jsonData) {
					if (jsonData.status == "1") {
						Message.Success("save");
						Dashboard.BookingInfo($("#booking-info-service-status").val(), $("input[name='booking-info-duration-radio']:checked").val());

					} else {
						Message.Error("sace");
					}
					JsManager.EndProcessBar();
				}

				function onFailed(xhr, status, err) {
					JsManager.EndProcessBar();
					Message.Exception(xhr);
				}
			}
		},

		SaveCita: function (id) {

				JsManager.StartProcessBar();
				var jsonParam = { id: id };
				var serviceUrl = "cita-create";
				JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

				function onSuccess(jsonData) {
					if (jsonData.status == "1") {
						Message.Success("save");
						//Dashboard.BookingInfo($("#booking-info-service-status").val(), $("input[name='booking-info-duration-radio']:checked").val());

					} else {
						Message.Error("sace");
					}
					JsManager.EndProcessBar();
				}

				function onFailed(xhr, err) {
					JsManager.EndProcessBar();
					Message.Exception(xhr);
				}
			
		},

	};


	


	
})(jQuery);