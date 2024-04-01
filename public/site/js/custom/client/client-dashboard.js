
var ClientDashboard;
function cancelBooking(bookingId) {
    ClientDashboard.CancelBooking(bookingId);
}
function ConfirmarBooking(bookingId) {
    ClientDashboard.ConfirmarBooking(bookingId);
}

function payDueBookingAmount(bookingId) {
    window.location = 'choose-payment-method?bookingId=' + bookingId;
}

(function ($) {
    "use strict";
    var dTable;
    $(document).ready(function () {
        ClientDashboard.GetDataList(0);
    });

    ClientDashboard = {

        CancelBooking: function (bookingId) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = { bookingId: bookingId };
                var serviceUrl = 'client-dashboard-available-cancel-booking';
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("cancel");
                        ClientDashboard.GetDataList(1);
                    } else {
                        Message.Error("cancel");
                    }
                    JsManager.EndProcessBar();

                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                }
            }
        },
        ConfirmarBooking: function (bookingId) {
            if (Message.Prompt()) {
                JsManager.StartProcessBar();
                var jsonParam = { bookingId: bookingId };
                var serviceUrl = 'client-dashboard-available-confirmar-booking';
                JsManager.SendJson("POST", serviceUrl, jsonParam, onSuccess, onFailed);

                function onSuccess(jsonData) {
                    if (jsonData.status == "1") {
                        Message.Success("confimada");
                        ClientDashboard.GetDataList(1);
                    } else {
                        Message.Error("confirmada");
                    }
                    JsManager.EndProcessBar();

                }

                function onFailed(xhr, status, err) {
                    JsManager.EndProcessBar();
                    Message.Exception(xhr);
                }
            }
        },
        GetDataList: function (refresh) {
            var jsonParam = '';
            var serviceUrl = "client-dashboard-last-10-booking";
            JsManager.SendJsonAsyncON('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {
                ClientDashboard.LoadDataTable(jsonData.data, refresh);
            }

            function onFailed(xhr, status, err) {
                Message.Exception(xhr);
            }
        },
        LoadDataTable: function (data, refresh) {
            if (refresh == "0") {
                dTable = $('#tableElement').DataTable({
                    dom: "<'row'<'col-md-12'tr>>" + "<'row'<'col-md-5'i><'col-md-7 mt-7'p>>",
                    buttons: [],
                    scrollY: true,
                    scrollCollapse: true,
                    lengthMenu: [[5, 100, 500, -1], [5, 100, 500, "All"]],
                    columnDefs: [
                        { visible: false, targets: [] },
                        { "className": "dt-center", "targets": [] }
                    ],
                    order: [[2, 'desc']],
                    columns: [

                        {
                            data: 'service',
                            name: 'service',
                            title: 'Detalle servicio',
                            width: 500,
                            render: function (data, type, row) {
                                return '<div class="flex-1 ml-3 pt-1">' +
                                    '<h6 class="fw-bold mb-1">' +
                                    "No# " + row['id'] + " | " + row['service'] +
                                    '<span class="' + ClientDashboard.ServiceFontColorClass(row['status']) + ' pl-3"> ' + ClientDashboard.ServiceStatus(row['status']) + '</span>' +
                                    '</h6>' +
                                    '<span class="text-muted">' +
                                    row['branch'] + " | " + row['employee'] + " | <span class='text-primary'>" + moment(row['date'] + ' ' + row['start_time']).format('LT') + " to " + moment(row['date'] + ' ' + row['end_time']).format('LT') + "</span><br/>" +
                                    "Costo# <span class='text-danger'>" + parseFloat(row['due']).toFixed(2) + "</span> | " + (row['remarks'] == null ? "No remarks found!" : row['remarks'])
                                    + '</span>' +
                                    '</div>';
                            }
                        },

                        {
                            data: 'date',
                            name: 'date',
                            title: 'Fecha',
                            width: 100,
                            render: function (data, type, row) {
                                return moment(data).format('ll');
                            }
                        },

                        {
                            data: 'id',
                            name: 'id',
                            title: 'Opcion',
                            width: 60,
                            render: function (data, type, row) {
                                let disabled = '';
                                if (row['status'] == '4' || row['status'] == '3') {
                                    disabled = 'disabled';
                                }
                                let btn = "<button " + disabled + " onclick='cancelBooking(" + row['id'] + ")' class='btn btn-danger btn-sm cancel-padding fs-11 float-end'><i class='fa fa-times-circle' aria-hidden='true'></i> Cancelar cita</button>";
                                if (row['status'] == '2')
                                    disabled = 'disabled';
                                btn = btn + "<br/><button " + disabled + " onclick='ConfirmarBooking(" + row['id'] + ")' class='btn btn-primary btn-sm cancel-padding fs-11 mt-1 float-end'>Confirmar Cita</button>";
                                return btn;
                            }
                        }

                    ],
                    fixedColumns: false,
                    data: data
                });
            } else {
                dTable.clear().rows.add(data).draw();
            }
        },
        ServiceStatus: function (status) {
            var serviceStatus = ['Agendado', 'Recordatorio Enviado',
             'Confirmado', 'Hora Cancelada', 'En sala de espera', 'En Box'
            , 'Atendido', 'Hospitalizacion', 'En Cirugia'];
            return serviceStatus[status];
        },

        ServiceStatusColor: function (status) {
            var serviceStatus = ['bg_agendado', 'bg_recordatorio_enviado', 'bg_confirmado',
             'bg_cancel', 'bg_ensala','bg_enbox',
            'bg_atendido', 'bg_hospitalizado', 'bg_encirugia'];
            return serviceStatus[status];
        },
        ServiceFontColorClass: function (status) {
            var serviceColor = ['fc_agendado', 'fc_recordatorio_enviado',
            'fc_confirmado', 'fc_cancel', 'fc_ensala','fc_enbox'
           , 'fc_atendido', 'fc_hospitalizado', 'fc_encirugia'];
            return serviceColor[status];
        },
    };
})(jQuery);