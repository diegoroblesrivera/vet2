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

function openPet(id_pelu = null) {
    // Limpiar los campos del formulario antes de recibir nuevos datos
   
    $('#nombre').val('');
    $('#especie').val('');
    //$('#id_pet').val('');
    $('#tienepet').val(0);// Asume que no hay cirugía por defecto

    // Si id_pelu es null, podría ser una indicación para crear una nueva entrada en lugar de actualizar una existente
    if(id_pelu) {
        // Hacer una solicitud AJAX para obtener datos existentes
        $.ajax({
            url: '/obtener-pelupet/' + id_pelu,
            type: 'GET',
            success: function(data) {
                if (data && data.id) {
                // Rellenar el formulario con los datos existentes
                $('#id_dueno').val(data.id_dueno);
				$('#nombre').val(data.nombre);
				$('#especie').val(data.especie);
				//$('#id_pet').val(data.notas_pelu);
				$('#id_pet').val(data.id); 
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
    $('#petModal').modal('show');
}