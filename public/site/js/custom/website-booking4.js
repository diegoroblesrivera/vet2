
(function ($) {
    "use strict";
    var initTelephone;
    var serviceStepar;
    var isBookingSuccess = false;
    var currentEmpList = [];
    let currency = '';
    let subtotal = 0;
    var bookingList = [];
    var isEmailValid = false;

    moment.locale('es_CL');

    $(document).ready(function () {
        serviceStepar = $("#serviceStep").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            onInit: function (event, currentIndex) {

            },
            onStepChanging: function (event, currentIndex, newIndex) {
                if (currentIndex > newIndex)
                    return true;
                var branch = $("#cmn_branch_id");
                var categoryId = $("#sch_service_category_id");
                var serviceId = $("#sch_service_id");
                var employeeId = $("#sch_employee_id");
                var serviceTime = $("input[name='service_time']");

                if (currentIndex == 0) {
                    
                    console.log('primer pasp0')
                    
                    return true;

                } else if (currentIndex == 1) {
                    console.log('acá pasa algo en el segundo paso?')
                    if (!branch.val()) {
                        branch.addClass('border-red');
                    }
                    else if (!categoryId.val()) {
                        categoryId.addClass('border-red');
                    }
                    else if (!serviceId.val()) {
                        serviceId.addClass('border-red');
                    }
                    else if (!employeeId.val()) {
                        employeeId.addClass('border-red');
                    }
                     else if (serviceTime.length < 1 || typeof $("input[name='service_time']:checked").val() == 'undefined') {
                        // Message.Warning("Select service time.");
                        Message.Warning("Una hora debe ser seleccionada.");
                        $(".divTimeSlot").addClass('border-red');
                    } 
                    else {
                        SiteManager.GetCustomerLoginInfo();
                        if (bookingList.length < 1)
                            SiteManager.AddBookingSchedule();
                            console.log('acá pasa algo en el segundo paso?')
                        return true;
                    }
                }

            else if (currentIndex == 2) {
                var brancho = $("#pet_id");
                if (!brancho.val()) {
                    brancho.addClass('border-red');
                }else {

                console.log('primer de la mascota sepone'+ currentIndex)

                $("#tbl-service-cart").removeClass('d-none');
                // Captura los valores de los campos del paso 1
                var selectedDate = $('#serviceDate').val();
                var selectedTime = getSelectedServiceTime();
                var currentEmp = currentEmpList.filter(function (emp) { return emp.id == $("#sch_employee_id").val() })[0];
                var vet = currentEmp.name.slice(0, -9);
        
                // Actualizar el resumen en el paso 5
                $('#summaryDate').text(selectedDate);
                $('#summaryTime').text(selectedTime);
                $('#vet').text(vet);

                    return true;
                
                }
            }
                
             else if (currentIndex == 3) {
                console.log('paso 3');
            
            
                    // ... Resto de tu validación ...
                    return true;
                  
            }


            },
            onFinished: function (event, currentIndex) {
                SiteManager.SaveBooking();
                //window.location = JsManager.BaseUrl() + "/client-dashboard";
            }
            ,
            labels: {
                loading: "Cargando ..."
            }
        });

        $(".form-control").on("click", function () {
            $(this).removeClass('border-red');
        });


        SiteManager.LoadBranchDropDown();
        SiteManager.LoadServiceCategoryDropDown();
       // SiteManager.PaymentType();

        $("#sch_service_category_id").on("change", function () {
            SiteManager.LoadServiceDropDown($(this).val());
        });

        $("#sch_service_id").on("change", function () {
            SiteManager.LoadEmployeeDropDown($(this).val());
        });

        $("#iNextDate").on("click", function () {
            $('#divServiceDate').datetimepicker('destroy');
            var nextDate = moment($('#serviceDate').val(), 'Y-M-D').add(1, 'days');
            SiteManager.ServiceDatePicker(nextDate);
        });
        $("#iPrvDate").on("click", function () {

            var nextDate = moment($('#serviceDate').val(), 'Y-M-D').subtract(1, 'days');
            if (nextDate >= moment(moment(new Date()).format('Y-M-D'), 'Y-M-D')) {
                $('#divServiceDate').datetimepicker('destroy');
                SiteManager.ServiceDatePicker(nextDate);
            }
        });

        $(".serviceInput").on("change", function () {
            let selectedPropId = $(this).attr('id');
            if (selectedPropId == "cmn_branch_id") {
                $("#sch_employee_id").val('');
                $("#sch_service_category_id").val('');
                $("#sch_service_id").val('');
            }
            else if (selectedPropId == "sch_service_category_id") {
                $("#sch_employee_id").val('');
                $("#sch_service_id").val('');
            } else if (selectedPropId == "sch_service_id") {
                $("#sch_employee_id").val('');
                SiteManager.LoadServiceTimeSlot($(this).val(), $("#sch_employee_id").val());
            } else if (selectedPropId == "sch_employee_id") {
                SiteManager.LoadServiceTimeSlot($("#sch_service_id").val(), $(this).val());
            }
        });

        $(".iChangeDate").on("click", function () {
            SiteManager.LoadServiceTimeSlot($("#sch_service_id").val(), $("#sch_employee_id").val());
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
            hiddenInput: "full_number",
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            separateDialCode: true,
            utilsScript: "js/lib/tel-input/js/utils.js",
        });
        var date = new Date();
        SiteManager.ServiceDatePicker(date);
    });


    $(document).on('click', ".payment-chose-div", function () {
        $(this).find('input').prop('checked', true);
        $(".payment-chose-div").removeClass('payment-chose');
        $(this).addClass('payment-chose');
    });

    $(document).on("click", ".divTimeSlot", function () {
        $(".divTimeSlot").removeClass('border-red');
    });

    $(document).on("click", "#add-service-btn", function () {
        var branch = $("#cmn_branch_id");
        var categoryId = $("#sch_service_category_id");
        var serviceId = $("#sch_service_id");
        var employeeId = $("#sch_employee_id");
        var serviceTime = $("input[name='service_time']");

        if (!branch.val()) {
            branch.addClass('border-red');
        }
        else if (!categoryId.val()) {
            categoryId.addClass('border-red');
        }
        else if (!serviceId.val()) {
            serviceId.addClass('border-red');
        }
        else if (!employeeId.val()) {
            employeeId.addClass('border-red');
        } 
        else if (serviceTime.length < 1 || typeof $("input[name='service_time']:checked").val() == 'undefined') {
            Message.Warning("Debes seleccionar una hora.");
            $(".divTimeSlot").addClass('border-red');
        } 
        else {
            SiteManager.AddBookingSchedule();
            return true;
        }
    });

    $(document).on("click", ".divTimeSlot", function () {
        $(this).find('input').prop('checked', true);
        $('.divTimeSlot').removeClass('divTimeSlotActive');
        $(this).addClass('divTimeSlotActive');
        SiteManager.SetServiceProperty($("#serviceDate").val(), $(this).find('.divStartTime').text());
    });

    $(document).on("click", "#btn-apply-coupon", function () {
        SiteManager.GetCouponAmount();
    });


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
        PaymentType: function () {
            var jsonParam = '';
            var serviceUrl = "get-site-payment-type";
            JsManager.SendJson('GET', serviceUrl, jsonParam, onSuccess, onFailed);

            function onSuccess(jsonData) {

                if (jsonData.status == 1) {
                    $.each(jsonData.data, function (i, v) {
                        let typeIcon = '<img src="img/payment-cash.svg" />';
                        let checkStatus = "";
                        let activePayment = '';
                        if (v.type == 2) {
                            typeIcon = '<img src="img/payment-paypal.svg" />';
                            checkStatus = 'checked';
                            activePayment = 'payment-chose';
                        } else if (v.type == 3) {
                            typeIcon = '<img src="img/payment-stripe.svg" />';
                        }
                        else if (v.type == 4) {
                            typeIcon = '<img src="img/payment-user-balance.svg" />';
                        }

                        $("#divPaymentMethod").append('<div class="payment-chose-div float-start ' + activePayment + '">' +
                            '<input  '+ checkStatus + ' type="radio" name="payment_type" id="payment_type" value="' + v.id + '" class="float-start payment-radio d-none" />' +
                            '<div class="float-start color-black p-2">' + typeIcon + '</div>' +
                            '</div>');

                    });
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
        // SetServiceProperty: function (startDate, time) {
        //     let longDate = moment(startDate).format('dddd, MMMM, DD, yyyy');
        //     $("#serviceDate").val(JsManager.DateFormatDefault(startDate));
        //     $("#divDaysName").text(longDate);
        //     if (time) {
        //         $("#iSelectedServiceText").text("Has Seleccionado" + time + " On " + longDate);
        //     } else {
        //         $("#iSelectedServiceText").text("Has Seleccionado " + longDate);
        //     }
        // },

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
        LoadServiceTimeSlot: function (serviceId, employeeId) {
            if (employeeId > 0 && serviceId > 0 && $("#serviceDate").val() && $("#cmn_branch_id").val() > 0) {
                JsManager.StartProcessBar();
                var jsonParam = {
                    sch_service_id: serviceId,
                    sch_employee_id: employeeId,
                    date: $("#serviceDate").val(),
                    cmn_branch_id: $("#cmn_branch_id").val()
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
                                '<div class="float-start cp divStartTime text-center w-100 ' + disabledServiceText + '" style="direction: ltr;">' + moment('1990-01-01 ' + v.start_time).format('hh:mm A') + '</div>' +
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
                            '<div class="float-start cp divStartTime text-center w-100 ' + disabledServiceText + '" style="direction: ltr;">' + moment('1990-01-01 ' + v.start_time).format('hh:mm A') + '</div>' +
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
                    pet_id: $("#pet_id").val(), // Obtener el valor seleccionado del select
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
                var serviceUrl = "save-site-service-booking1";
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

    function getSelectedServiceTime() {
        var serviceTimeRadios = document.getElementsByName('service_time');
        for (var i = 0; i < serviceTimeRadios.length; i++) {
            if (serviceTimeRadios[i].checked) {
                return serviceTimeRadios[i].value;
            }
        }
        return null; // o algún valor predeterminado si no se encuentra ninguno seleccionado
    }
})(jQuery);