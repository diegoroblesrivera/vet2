(function ($) {
    "use strict";
    var dTable = null;
    var _id = null;
    var initTelephone;



    $(document).ready(function () {

        //load datatable
        Manager.GetDataList(0);
        Manager.LoadUserDropdown();
 
        //generate datatabe serial no
        dTableManager.dTableSerialNumber(dTable);

        //add  modal
        $("#btnAdd").on("click", function () {
            _id = null;
            Manager.ResetForm();
            $("#frmModal").modal('show');
        });

        //save or update
        JsManager.JqBootstrapValidation('#inputForm', (form, event) => {
            event.preventDefault();
            if (_id == null) {
                Manager.Save(form);
            } else {
                Manager.Update(form, _id);
            }
        });

        initTelephone = window.intlTelInput(document.querySelector("#phone_no"), {
            allowDropdown: true,
            autoHideDialCode: false,
            dropdownContainer: document.body,
            excludeCountries: [],
            formatOnDisplay: false,
            geoIpLookup: function (callback) {
                var jsonParam = '';
                var serviceUrl = "get-requested-country-code";
                JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == 1) {
                        callback(jsonData.data);
                    } else {
                        callback("CL");
                    }
                }
                function onFailed(xhr, status, err) {
                }
            },
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            separateDialCode: true,
            utilsScript: "js/lib/tel-input/js/utils.js",
        });

    });

    //show edit info modal
    $(document).on('click', '.dTableEdit', function () {
        var rowData = dTable.row($(this).parent()).data();
        _id = rowData.id;
        $('#nombre').val(rowData.nombre);
        $('#user_id').val(rowData.user_id);
        $('#country_code').val(rowData.country_code);
        initTelephone.setNumber('+' + rowData.phone_no)
        $('#email').val(rowData.email);
        $('#dob').val(rowData.dob);
        $('#country').val(rowData.country);
        $('#state').val(rowData.state);
        $('#postal_code').val(rowData.postal_code);
        $('#city').val(rowData.city);
        $('#street_number').val(rowData.street_number);
        $('#street_address').val(rowData.street_address);
        $('#remarks').val(rowData.remarks);

        $("#frmModal").modal('show');
    });

        //show customer pets
        $(document).on('click', '.petTableEdit', function () {
            var rowData = dTable.row($(this).parent()).data();
            _id = rowData.id;
            $('#nombre').val(rowData.nombre);
            // $('#user_id').val(rowData.user_id);
            // $('#country_code').val(rowData.country_code);
            // initTelephone.setNumber('+' + rowData.phone_no)
            // $('#email').val(rowData.email);
            // $('#dob').val(rowData.dob);
            // $('#country').val(rowData.country);
            // $('#state').val(rowData.state);
            // $('#postal_code').val(rowData.postal_code);
            // $('#city').val(rowData.city);
            // $('#street_number').val(rowData.street_number);
            // $('#street_address').val(rowData.street_address);
            // $('#remarks').val(rowData.remarks);
    
            $("#petModal").modal('show');
        });

       

    //delete
    $(document).on('click', '.dTableDelete', function () {
        var rowData = dTable.row($(this).parent()).data();
        Manager.Delete(rowData.id);
    });

    // var urly = window.location.href; // Obtiene la URL actualfq2 1
    // var segments = urly.split('/');  // Divide la URL en segmentos
    // var idPet = segments[segments.length - 1]; // Obtiene el último segmento, que es el ID
    var Manager = {

        GetDataList: function ( refresh) {
            var jsonParam = '';
            var serviceUrl = "get-pets/";
            JsManager.SendJsonAsyncON('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                Manager.LoadDataTable(jsonData.data, refresh);
            }

            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        

        ResetForm: function () {
            $("#inputForm").trigger('reset');
        },

        Save: function (form) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = form.serialize() + "&phone_no=" + initTelephone.getNumber();
                var serviceUrl = "customer-create";
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("save");
                        Manager.ResetForm();
                        Manager.GetDataList(1); //reload datatable
                    } else {
                        Message.Error("save");
                    }
                    JsManager.EndProcessBar();
                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                }
            }
        },
        Update: function (form, id) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = form.serialize() + "&id=" + id + "&phone_no=" + initTelephone.getNumber();
                var serviceUrl = "customer-update";
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("update");
                        _id = null;
                        Manager.ResetForm();
                        Manager.GetDataList(1); //reload datatable
                    } else {
                        Message.Error("update");
                    }
                    JsManager.EndProcessBar();

                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                }
            }
        },
        Delete: function (id) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = { id: id };
                var serviceUrl = "customer-delete";
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("delete");
                        Manager.GetDataList(1); //reload datatable
                    } else {
                        Message.Error("delete");
                    }
                    JsManager.EndProcessBar();

                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                }
            }
        },



        LoadUserDropdown: function () {
            var jsonParam = '';
            var serviceUrl = "get-customer-user";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                var cbmOptions = '<option value="">Unknown User</option>';
                cbmOptions += '<option value="0">Create System User(Pass:12345678)</option>';
                $.each(jsonData.data, function () {
                    cbmOptions += '<option value=\"' + this.id + '\">' + this.name + '</option>';
                });
                $("#user_id").html(cbmOptions);
            }

            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        
        




        LoadDataTable: function (data, refresh) {
            if (refresh == "0") {
                dTable = $('#tableElement').DataTable({
                    dom: "<'row'<'col-md-6'B><'col-md-3'l><'col-md-3'f>>" + "<'row'<'col-md-12'tr>>" + "<'row'<'col-md-5'i><'col-md-7 mt-7'p>>",
                    initComplete: function () {
                        dTableManager.Border(this, 350);
                    },
                    buttons: [
                        {
                            text: '<i class="fa fa-file-pdf"></i> PDF',
                            className: 'btn btn-sm',
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [2, 3, 4, 5]
                            },
                            title: 'Customer List'
                        },
                        {
                            text: '<i class="fa fa-print"></i> Imprimir',
                            className: 'btn btn-sm',
                            extend: 'print',
                            exportOptions: {
                                columns: [2, 3, 4, 5]
                            },
                            title: 'Customer List'
                        },
                        {
                            text: '<i class="fa fa-file-excel"></i> Excel',
                            className: 'btn btn-sm',
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [2, 3, 4, 5]
                            },
                            title: 'Customer List'
                        }
                    ],

                    scrollY: "350px",
                    scrollX: true,
                    scrollCollapse: true,
                    lengthMenu: [[50, 100, 500, -1], [50, 100, 500, "All"]],
                    columnDefs: [
                        { visible: false, targets: [] },
                        { "className": "dt-center", "targets": [3] }
                    ],
                    columns: [
                        {
                            data: null,
                            name: '',
                            'orderable': false,
                            'searchable': false,
                            title: '#SL',
                            width: 8,
                            render: function () {
                                return '';
                            }
                        },
                        {
                            name: 'Option',
                            title: 'Option',
                            width: 100,
                            render: function (data, type, row) {
                                return EventManager.DataTableCommonButtonPet();
                            }
                        },
                        {
                            data: 'nombre',
                            name: 'nombre',
                            title: 'Nombre Mascota',
                            render: function(data, type, row) {
                                // Aquí construyes la URL hacia donde quieres que el enlace dirija
                                // Suponiendo que tienes una ruta nombrada 'pet.detail' y que esperas un ID de mascota como parámetro
                                var url = `petdeta/${row.id}`; // Asegúrate de tener el ID de la mascota disponible en tu objeto de datos
                                return `<a href="${url}">${data}</a>`; // Crea el enlace con la URL y el nombre de la mascota
                            }
                        },
                        {
                            data: 'especie',
                            name: 'especie',
                            title: 'Especie'
                        },
                        {
                            data: 'sexo',
                            name: 'sexo',
                            title: 'Sexo'
                        },
                        {
                            data: 'color',
                            name: 'color',
                            title: 'Color'
                        }
                        // ,
                        // {
                        //     data: 'country',
                        //     name: 'country',
                        //     title: 'Country'
                        // }
                    ],
                    fixedColumns: false,
                    data: data
                });
            } else {
                dTable.clear().rows.add(data).draw();
            }
        }
    };
})(jQuery);

function openInmu(id_inmu = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
                // Aquí rellenas el formulario con los datos existentes
                $('#inmu_cant').val('');
				$('#inmu_unidad').val('');
				$('#nombre_vacuna').val('');
				$('#n_serie').val('');
				$('#notas_inmu').val('');
				$('#idinmu').val('');
    $('#tieneinmu').val(0);// Asume que no hay cirugía por defecto

    // Si id_inmu es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_inmu) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-inmupet/' + id_inmu,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                // Aquí rellenas el formulario con los datos existentes
                $('#inmu_cant').val(data.cantidad);
				$('#inmu_unidad').val(data.unidad);
				$('#nombre_vacuna').val(data.nombre_vacuna);
				$('#n_serie').val(data.n_serie);
				$('#notas_inmu').val(data.notas_inmu);
				$('#idinmu').val(data.id);
                $('#tieneinmu').val(1);// Indica que hay cirugía existente// Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.nombre_despa);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#inmuModal').modal('show');
}


function openDespa(id_despa = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
    $('#despa_cant').val('');
    $('#despa_unidad').val('');
    $('#nombre_despa').val('');
    $('#dosis').val('');
    $('#presentacion').val('');
    $('#notas_despa').val('');
    $('#iddespa').val('');
    $('#tienedespa').val(0);// Asume que no hay cirugía por defecto

    // Si id_despa es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_despa) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-despapet/' + id_despa,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                $('#despa_cant').val(data.cantidad);
				$('#despa_unidad').val(data.unidad);
				$('#nombre_despa').val(data.nombre_despa);
				$('#dosis').val(data.dosis);
				$('#presentacion').val(data.presentacion );
				$('#notas_despa').val(data.notas_despa );
				$('#iddespa').val(data.id);
                // Aquí se establece el estado checked de los checkboxes
                $('#anti_in').prop('checked', data.anti_in == 1);
                $('#anti_ex').prop('checked', data.anti_ex == 1);
                $('#anti_recorda').prop('checked', data.anti_recorda == 1);
                $('#tienedespa').val(1);// Indica que hay cirugía existente// Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.nombre_despa);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#despaModal').modal('show');
}

function openPeluqueria(id_pelu = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
    $('#id_clienteciru').val('');
    $('#tipo_corte').val('');
    $('#tipo_bano').val('');
    $('#notas_pelu').val('');
    $('#idpelu').val('');
    $('#tienepelu').val(0);// Asume que no hay cirugía por defecto

    // Si id_pelu es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_pelu) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-pelupet/' + id_pelu,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                $('#id_clientepelu').val(data.id_cliente);
				$('#tipo_corte').val(data.tipo_corte);
				$('#tipo_bano').val(data.tipo_bano);
				$('#notas_pelu').val(data.notas_pelu);
				$('#idpelu').val(data.id); 
                $('#tienepelu').val(1); // Indica que hay cirugía existente// Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.tipo_corte);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#peluModal').modal('show');
}

function openCirugia(id_ciru = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
    $('#nombre_cirugia').val('');
    $('#eval_anestesica').val('');
    $('#eval_asa').val('');
    $('#notas_cirugia').val('');
    $('#idcirugia').val('');
    $('#tienecirugia').val(0); // Asume que no hay cirugía por defecto

    // Si id_ciru es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_ciru) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-cirugiapet/' + id_ciru,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                    // Rellenar el formulario con los datos existentes
                    $('#nombre_cirugia').val(data.nombre_cirugia);
                    $('#eval_anestesica').val(data.eval_anestesica);
                    $('#eval_asa').val(data.eval_asa);
                    $('#notas_cirugia').val(data.notas_cirugia);
                    $('#idcirugia').val(data.id);
                    $('#tienecirugia').val(1); // Indica que hay cirugía existente
                    console.log("Tiene registros, debe actualizar:", data.nombre_cirugia);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#id_ciru').val(id_ciru);
    $('#cirugiaModal').modal('show');
}

function openCancelModal(id_consu = null) {


	console.log("serviceId6www6:");
        // Si id_ciru es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
        if(id_consu) {
            console.log("se supone que hay datos:");

    // Hacer una solicitud AJAX para obtener datos existentes
    $.ajax({
        url: '/obtener-consu/' + id_consu,  // Asegúrate de tener esta ruta en tus rutas de Laravel
        type: 'GET',
        success: function(data) {
            if (data && data.id) {
                console.log("se supone que hay datos dentro de los cargados:");
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

				//conaulta
				$('#razon').val(data.razon);
				$('#anamnesis').val(data.anamnesis);
				$('#notas_anam').val(data.notas_anam);
				//prediag
				$('#notas_prediag').val(data.notas_anam);
				//examen fisico
				$('#mucosa').val(data.mucosa);
				$('#timpo_cap').val(data.timpo_cap);
				$('#frecuencia_resp').val(data.frecuencia_resp);
				$('#frecuencia_car').val(data.frecuencia_car);
				$('#presion').val(data.presion);
				$('#condicion_corp').val(data.condicion_corp);
				$('#desidra').val(data.desidra);
				$('#ndesidra').val(data.ndesidra);
				//examenes
				$('#examen').val(data.examen);
				$('#notas_examen').val(data.notas_exam);
				//tratamientos
				$('#notas_trata').val(data.notas_trata);


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
                $('#tieneconsu').val(1); // Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.nombre_cirugia);
            } else {
                // No se encontraron datos
                console.log("No tiene registros, debe crear.");
                // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
            }
        },
        error: function(error) {
            console.log("Error en la solicitud AJAX:", error);
            // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
            // Por ejemplo, mostrar un mensaje al usuario
        }
    });
} else {
    // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
    console.log("Preparando formulario para crear una nueva cirugía.");
}

// Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
$('#id_consu').val(id_consu);
$('#cancelModal').modal('show');
}

//modal para actualizar cliente

function opencli(id_cli = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
                // Aquí rellenas el formulario con los datos existentes
                // $('#nombre').val('');
				// $('#run').val('');
				// $('#nombre_vacuna').val('');
				// $('#n_serie').val('');
				// $('#notas_cli').val('');
				// $('#idcli').val('');
                $('#tienecli').val(0);// Asume que no hay cirugía por defecto

    // Si id_cli es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_cli) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-pet/' + id_cli,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                // Aquí rellenas el formulario con los datos existentes
                $('#nombrecli').val(data.full_name);
				$('#runcli').val(data.run);
                $('#razacli').val(data.raza);
                $('#colorcli').val(data.color);
				$('#id_dueno').val(data.id_dueno);
				$('#nombrepet').val(data.nombre);
				$('#notas_cli').val(data.notas_cli);
				$('#especiecli').val(data.especie);
                $('#sexocli').val(data.sexo);
				$('#pet_birth_datecli').val(data.pet_birth_date);
                $('#estado_reprocli').val(data.estado_repro);
                $('#microcli').val(data.micro_num);
                $('#direccioncli').val(data.direccion);
                $('#phone_nocli').val(data.phone_no);
                $('#tienecli').val(1);// Indica que hay cirugía existente// Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.full_name);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#cliModal').modal('show');
}

//modal para actualizar antecedentes

function openante(id_ante = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
                // Aquí rellenas el formulario con los datos existentes
                // $('#nombre').val('');
				// $('#run').val('');
				// $('#nombre_vacuna').val('');
				// $('#n_serie').val('');
				// $('#notas_ante').val('');
				// $('#idante').val('');
                $('#tieneante').val(0);// Asume que no hay cirugía por defecto

    // Si id_ante es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_ante) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-antepet/' + id_ante,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                // Aquí rellenas el formulario con los datos existentes
                $('#origenante').val(data.origen);
				$('#habitatante').val(data.habitat);
                $('#comportamientoante').val(data.comportamiento);
                $('#enfermedadesante').val(data.enfermedades);
				$('#id_petante').val(data.id );
				$('#alergiasante').val(data.alergias);
				$('#esterilante').val(data.esteril);
				$('#desparaante').val(data.despara);
;
                $('#tieneante').val(1);// Indica que hay cirugía existente// Indica que hay cirugía existente
                console.log("Tiene registros, debe actualizar:", data.origen);
                } else {
                    // No se encontraron datos
                    console.log("No tiene registros, debe crear.");
                    // Aquí puedes dejar los campos limpios o establecer valores por defecto si es necesario
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
                // Aquí puedes manejar cómo quieres que tu aplicación responda en caso de error
                // Por ejemplo, mostrar un mensaje al usuario
            }
        });
    } else {
        // Lógica para manejar la creación de una nueva cirugía, si eso es parte de tu aplicación
        console.log("Preparando formulario para crear una nueva cirugía.");
    }

    // Preparar el ID de la cirugía para el formulario, independientemente de si se encontraron datos o no
    $('#anteModal').modal('show');
}

// Guarda los check en vivo
$(document).ready(function() {
    $('#esterilCheckbox, #desparaCheckbox').change(function() {
        var field = $(this).attr('id') == 'esterilCheckbox' ? 'esteril' : 'despara';
        var value = $(this).is(':checked') ? 'Si' : 'No';
        var idPet = $(this).data('id-pet');

        $.ajax({
            url: '/actualizar-antecedente',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Asegúrate de que el token CSRF esté disponible
                id_pet: idPet,
                field: field,
                value: value
            },
            success: function(response) {
                // Puedes mostrar un mensaje de éxito o actualizar la interfaz de usuario según sea necesario.
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Manejo de errores
                console.log(xhr.responseText);
            }
        });
    });
});
// Fin Guarda los check en vivo
