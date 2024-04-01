    
    <?php $__env->startSection('content'); ?>
    <link href="<?php echo e(dsAsset('css/custom/dashboard/dashboard.css')); ?>" rel="stylesheet" />
    <div class="home"></div>
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div >
                    <h2 class="text-white pb-2 fw-bold"><?php echo e(translate('Appointment Booking Dashboard')); ?></h2>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="booking-calendar" class="btn btn-secondary btn-round"><?php echo e(translate('Add New Booking')); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2 div-top-card">

            <div class="col-md-3">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="fs-11rem"><?php echo e(translate('Total Done')); ?></div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-2">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <h1 class="fw-bold mb-0 mt-2" id="divDoneBookingText">0</h1>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divDoneBooking"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="fs-11rem"><?php echo e(translate('Total Cancel')); ?></div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-2">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <h1 class="fw-bold mb-0 mt-2" id="divCancelBookingText">0</h1>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divCancelBooking"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="fs-11rem"><?php echo e(translate('Total Approved')); ?></div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-2">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <h1 class="fw-bold mb-0 mt-2" id="divApprovedBookingText">0</h1>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divApprovedBooking"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="fs-11rem"><?php echo e(translate('Processing & Pending')); ?></div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-2">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <h1 class="fw-bold mb-0 mt-2" id="divProcessingAndPendingBookingText">0</h1>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divProcessingAndPendingBooking"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt--2 div-today-service-card">
            <div class="col-md-7">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title"><?php echo e(translate("Today's Service statistics")); ?></div>
                        <div class="card-category"><?php echo e(translate('Show all service statistics based on user branch permission.')); ?></div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divTotalBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Total')); ?></h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divDoneBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Done')); ?></h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divCancelBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Cancel')); ?></h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divApprovedBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Approved')); ?></h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divProcessingBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Processing')); ?></h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="divPendingBookingToday"></div>
                                <h6 class="fw-bold mt-3 mb-0"><?php echo e(translate('Pending')); ?> </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title"><?php echo e(translate("Today's Income & Other Statistics")); ?></div>
                        <div class="row py-3">
                            <div class="col-md-6 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8"><?php echo e(translate('Total Income')); ?></h6>
                                    <h3 id="totalIncome" class="fw-bold">0</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-danger op-8"><?php echo e(translate('Total Due')); ?></h6>
                                    <h3 id="totalDue" class="fw-bold">0</h3>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8"><?php echo e(translate('Total Cash Payment')); ?></h6>
                                    <h3 id="totalCash" class="fw-bold">0</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-primary op-8"><?php echo e(translate('Total Online Payment')); ?></h6>
                                    <h3 id="totalOnlinePayment" class="fw-bold">0</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title"><?php echo e(translate('Booking Info')); ?></div>


                            <div class="card-tools">

                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <select id="booking-info-service-status" class="form-control input-sm mt-1">
                                            <option value="">Todos</option>
                                            <option value="5">Exploracion</option>
                                            <option value="4">Terminados</option>
                                            <option value="3">Cancelados</option>
                                            <option value="2">Approved</option>
                                            <option value="1">R</option>
                                            <option value="0">Agendado</option>
                                        </select>
                                    </li>
                                    <li class="nav-item">
                                        <a class="booking-info-duration nav-link active" id="booking-info-duration-pill-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true"><?php echo e(translate('Today')); ?></a>
                                        <input type="radio" id="booking-info-duration-radio-today" checked name="booking-info-duration-radio" value="1" />
                                    </li>
                                    <li class="nav-item">
                                        <a class="booking-info-duration nav-link" id="booking-info-duration-pill-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false"><?php echo e(translate('Month')); ?></a>
                                        <input type="radio" id="booking-info-duration-radio-monthly" name="booking-info-duration-radio" value="2" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body scrollbar-outer" id="div-body-booking-info">
                        
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?php echo e(translate('Top Booking Service')); ?></div>
                    </div>
                    <div class="card-body pb-0" id="div-body-top-booking-service">


                    </div>
                </div>
            </div>

        </div>

                    <!-- Modal para Inmunización -->
            <div class="modal fade bd-example-modal-lg" id="inmuModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <h1>Inmunizacion</h1>
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Inmunizacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="inmuForm" action="<?php echo e(route('customer.inmuStore')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                        <!-- Campo oculto para el ID del servicio -->
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" id="serviceIdinmu" name="serviceIdinmu" value="">
                        <input type="hidden" id="cmn_pet_idinmu" name="cmn_pet_idinmu" value="">
                        <input type="hidden" id="idinmu" name="idinmu" value="">
                        <input type="hidden" id="tieneinmu" name="tieneinmu" value="">
                        <input type="hidden" name="_tokeninmu" value="<?php echo e(csrf_token()); ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group control-group form-inline controls">
                                    <label><?php echo e(translate('Nombre Vacuna')); ?></label>
                                    <input type="text" id="nombre_vacuna" name="nombre_vacuna" class="form-control input-full" required />
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group control-group form-inline controls">
                                    <label><?php echo e(translate('N° Serie')); ?></label>
                                    <input type="text" id="n_serie" name="n_serie" class="form-control input-full" />
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                        <h3>Periodo de protección</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group control-group form-inline controls">
                                    <label><?php echo e(translate('Cantidad')); ?></label>
                                    <input type="number" id="inmu_cant" name="inmu_cant" class="form-control input-full" required />
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inmu_unidad"><?php echo e(translate('Unidad')); ?></label>
                                    <select id="inmu_unidad" name="inmu_unidad" class="form-control mt-0">
                                        <option value="Semana">Semanas</option>
                                        <option value="Meses">Meses</option>
                                        <option value="Anos">Años</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="anam">Notas:</label>
                                    <textarea class="form-control" id="notas_inmu" name="notas_inmu" rows="8"></textarea>
                                </div> 
                            </div>

                        </div>


                    </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Cerrar')); ?></button>
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Guardar')); ?></button>
                    </div>
                    <!-- Agrega aquí más campos si es necesario -->
                </form>
                </div>
                </div>
            </div>
            
            <!-- Final Modal para Inmunización... -->

            
                    <!-- Modal para Desparazitacion -->
                    <div class="modal fade bd-example-modal-lg" id="despaModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <h1>Desparacitaciones</h1>
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="despaForm" action="<?php echo e(route('customer.despastore')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                <!-- Campo oculto para el ID del servicio -->
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" id="serviceIddespa" name="serviceIddespa" value="">
                                <input type="hidden" id="cmn_pet_iddespa" name="cmn_pet_iddespa" value="">
                                <input type="hidden" id="iddespa" name="iddespa" value="">
                                <input type="hidden" id="tienedespa" name="tienedespa" value="">
                                <input type="hidden" name="_tokendespa" value="<?php echo e(csrf_token()); ?>">
        
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group control-group form-inline controls">
                                            <label><?php echo e(translate('Nombre del desparasitante')); ?></label>
                                            <input type="text" id="nombre_despa" name="nombre_despa" class="form-control input-full" required />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group control-group form-inline controls">
                                            <label><?php echo e(translate('Dosis')); ?></label>
                                            <input type="text" id="dosis" name="dosis" class="form-control input-full" required />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group control-group form-inline controls">
                                            <label><?php echo e(translate('Presentacion')); ?></label>
                                            <input type="text" id="presentacion" name="presentacion" class="form-control input-full" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
        
                                </div>
                                <h3>Periodo de protección</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group control-group form-inline controls">
                                            <label><?php echo e(translate('Cantidad')); ?></label>
                                            <input type="number" id="despa_cant" name="despa_cant" class="form-control input-full" required />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="despa_unidad"><?php echo e(translate('Unidad')); ?></label>
                                            <select id="despa_unidad" name="despa_unidad" class="form-control mt-0">
                                                <option value="Semana">Semanas</option>
                                                <option value="Meses">Meses</option>
                                                <option value="Anos">Años</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
        
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anam">Notas:</label>
                                            <textarea class="form-control" id="notas_despa" name="notas_despa" rows="8"></textarea>
                                        </div> 
                                    </div>
        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="anti_in" name="anti_in" value="1" >
                                                <label class="custom-control-label" for="anti_in">Antiparasitario interno</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="anti_ex" name="anti_ex" value="1">
                                                <label class="custom-control-label" for="anti_ex">Antiparasitario externo</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="anti_recorda" name="anti_recorda"value="1">
                                                <label class="custom-control-label" for="anti_recorda">Establecer un recordatorio para cuando se deba aplicar nuevamente la desparasitación</label>
                                            </div>
                                        </div> 
                                    </div>

                                </div>
        
        
                            </div>
                                <div class="modal-footer">
        
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Cerrar')); ?></button>
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Guardar')); ?></button>
                            </div>
                            <!-- Agrega aquí más campos si es necesario -->
                        </form>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Final Modal para Despa... -->

                    <!-- Modal para Cirugia -->
                    <div class="modal fade bd-example-modal-lg" id="cirugiaModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <h1>Cirugia</h1>
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="cirugiaForm" action="<?php echo e(route('customer.cirugiaStore')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                <!-- Campo oculto para el ID del servicio -->
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" id="serviceIdcirugia" name="serviceIdcirugia" value="">
                                <input type="hidden" id="cmn_pet_idcirugia" name="cmn_pet_idcirugia" value="">
                                <input type="hidden" id="idcirugia" name="idcirugia" value="">
                                <input type="hidden" id="tienecirugia" name="tienecirugia" value="">
                                <input type="hidden" name="_tokencirugia" value="<?php echo e(csrf_token()); ?>">
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group control-group controls">
                                            <label><?php echo e(translate('Nombre del Cirugia')); ?></label>
                                            
                                            <span class="help-block"></span>
                                            <select name="nombre_cirugia" id="nombre_cirugia" class="form-control">
                                                <option value="">Seleccione una cirugia</option>
                                                <?php $__currentLoopData = $examenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($categoria->nombre_examen_list); ?>"><?php echo e($categoria->nombre_examen_list); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            
                                        </div>
                                    </div>

        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anam">Evaluacion Anestésica</label>
                                            <textarea class="form-control" id="eval_anestesica" name="eval_anestesica" rows="4"></textarea>
                                        </div> 
                                    </div>
        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anam">Evaluacion ASA</label>
                                            <textarea class="form-control" id="eval_asa" name="eval_asa" rows="2"></textarea>
                                        </div> 
                                    </div>
        
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anam">Notas:</label>
                                            <textarea class="form-control" id="notas_cirugia" name="notas_cirugia" rows="4"></textarea>
                                        </div> 
                                    </div>
        
                                </div>

        
        
                            </div>
                                <div class="modal-footer">
        
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Cerrar')); ?></button>
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Guardar')); ?></button>
                            </div>
                            <!-- Agrega aquí más campos si es necesario -->
                        </form>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Final Modal para Cirugia... -->


                    
                    <!-- Modal para Peluqueria -->
                    <div class="modal fade bd-example-modal-lg" id="peluModal" tabindex="-1" role="dialog" aria-labelledby="modalInmunizacionLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <h1> Peluqueria</h1>
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="peluForm" action="<?php echo e(route('customer.peluStore')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                <!-- Campo oculto para el ID del servicio -->
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" id="serviceIdpelu" name="serviceIdpelu" value="">
                                <input type="hidden" id="cmn_pet_idpelu" name="cmn_pet_idpelu" value="">
                                <input type="hidden" id="idpelu" name="idpelu" value="">
                                <input type="hidden" id="tienepelu" name="tienepelu" value="">
                                <input type="hidden" name="_tokenpelu" value="<?php echo e(csrf_token()); ?>">
        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group control-group controls">
                                            <label><?php echo e(translate('Nombre del Cirugia')); ?></label>
                                            <select name="tipo_corte" id="tipo_corte" class="form-control">
                                                <option value="">Seleccione una cirugia</option>
                                                
                                                    <option value="Corte de Raza">Corte de Raza</option>
                                                    <option value="Corte de Cachorro">Corte de Cachorro</option>
                                                    <option value="Rebaje">Rebaje</option>

                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group control-group controls">
                                            <label><?php echo e(translate('Tipo de baño')); ?></label>
                                            <select name="tipo_bano" id="tipo_bano" class="form-control">
                                                <option value="">Seleccione una cirugia</option>
                                                
                                                    <option value="Baño medicado">Baño medicado</option>
                                                    <option value="Baño belleza">Baño belleza</option>

                                            </select>
                                            
                                        </div>
                                    </div>


        
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notas_pelu">Notas:</label>
                                            <textarea class="form-control" id="notas_pelu" name="notas_pelu" rows="4"></textarea>
                                        </div> 
                                    </div>
        
                                </div>

        
        
                            </div>
                                <div class="modal-footer">
        
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Cerrar')); ?></button>
                                <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Guardar')); ?></button>
                            </div>
                            <!-- Agrega aquí más campos si es necesario -->
                        </form>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Final Modal para Peluqueria... -->
            
            


            <!-- Modal -->
    <div class="modal fade bd-example-modal-lg"  id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Registrar Consulta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sala de Espera</button>
                </li>
                                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Examen Fisico</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="consulta-tab" data-toggle="tab" data-target="#consulta" type="button" role="tab" aria-controls="consulta" aria-selected="false">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#prediag" type="button" role="tab" aria-controls="prediag" aria-selected="false">Pre Diagnostico</button>
                </li>
                
                </li>


                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Examenes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#diag" type="button" role="tab" aria-controls="diag" aria-selected="false">Diagnostico</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#trata" type="button" role="tab" aria-controls="trata" aria-selected="false">Tratamientos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#historial" type="button" role="tab" aria-controls="historial" aria-selected="false">Historial</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab"><h3>Sala de espera</h3>
                    
                        <form class="form-horizontal" id="cancelForm" action="<?php echo e(route('customer.citaStore')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                    <!-- Campo oculto para el ID del servicio -->
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" id="serviceId" name="serviceId" value="">
                    <input type="hidden" id="cmn_pet_id" name="cmn_pet_id" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="tiene" name="tiene" value="">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Peso')); ?></label>
                                <input type="text" id="peso" name="peso" class="form-control input-full" required />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('¿Vive con otros animales?')); ?></label>
                                <input type="text" id="vive_otros" name="vive_otros" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Si es si ¿cuántos y de qué tipo?')); ?></label>
                                <input type="text" id="vive_otrosn" name="vive_otrosn" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('¿qué tipo de alimentación tiene?')); ?></label>
                                
                                <select class="form-control" id="tipo_alim" name="tipo_alim">
                                    <option value="Pellet (croquetas)">Pellet (croquetas)</option>
                                    <option value="Alimento húmedo (sobres, latas)">Alimento húmedo (sobres, latas)</option>
                                    <option value="Comida casera">Comida casera</option>
                                    <option value="Dieta BARF">Dieta BARF</option>
                                    <option value="Pellet + comida casera">Pellet + comida casera</option>
                                    <option value="Pellet + alimento húmedo">Pellet + alimento húmedo</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('¿de qué marca es el alimento?')); ?></label>
                                <input type="text" id="tipo_alim_marca" name="tipo_alim_marca" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Deposisiones ')); ?></label> <a  type="text"
                                data-toggle="modal" data-target="#exampleModal">
                                Ver ejemplo
                            </a>
                                
                                <select class="form-control" id="depo" name="depo">
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                    <option value="Tipo 3">Tipo 3</option>
                                    <option value="Tipo 4">Tipo 4</option>
                                    <option value="Tipo 5">Tipo 5</option>
                                    <option value="Tipo 6">Tipo 6</option>
                                    <option value="Tipo 7">Tipo 7</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
                    <h3> Consulta</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Razón</label>
                                <input type="text" id="razon" name="razon" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Anamnesis</label>
                                <input type="text" id="anamnesis" name="anamnesis" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group control-group form-inline controls">
                                <label>Notas</label>
                                <input type="text" id="notas_anam" name="notas_anam" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3> Examen Fisico</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Peso')); ?></label>
                                <input type="text" id="peso_2" name="peso_2" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Temperatura')); ?></label>
                                <input type="text" id="temperatura" name="temperatura" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Mucosa')); ?></label>
                                <input type="text" id="mucosa" name="mucosa" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Timepo de llenado capilar')); ?></label>
                                <input type="text" id="tiempo_cap" name="ganglios_p" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Frecuencia Respiratoria')); ?></label>
                                <input type="text" id="frecuencia_resp" name="frecuencia_resp" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Frecuencia Cardiaca')); ?></label>
                                <input type="text" id="frecuencia_car" name="frecuencia_car" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Presion')); ?></label>
                                <input type="text" id="presion" name="presion" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Condicion corporal')); ?></label>
                                <input type="text" id="condicion_corp" name="condicion_corp" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Hidratacion')); ?></label>
                                <input type="text" id="desidra" name="desidra" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Nivel DesHidratacion')); ?></label>
                                <input type="text" id="ndesidra" name="ndesidra" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
                        </div>
  
                    </div>
                </div>
                <div class="tab-pane fade show active"  id="contact" role="tabpanel" aria-labelledby="contact-tab">     
                        <h3> Anamnesis</h3>
                        <div class="row">
                            <div class="col-4">
                                <ul class="list-unstyled">
                                <li class="text-muted">Peso: <span style="color:#e99d05;" ><label id="pesoLabel"></label></span></li>
                                <li class="text-muted">Temperatura:<label id="temperatural"></label></li>
                                <li class="text-muted">Edad: <label id="pet_birth_date"></label></li>
                                <li class="text-muted">Ganglios R: <label id="ganglios_rl"></label></li>
                                
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                <li class="text-muted">Ganglios P: <label id="ganglios_pl"></label></li>
                            
                                <li class="text-muted">Fonendo :<label id="fonendol"></label></li>

                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted">Palpitacion Abdominal:<label id="palpitacion_abdl"></label></li>
                                    <li class="text-muted">Piel y Anejos :<label id="piell"></label></li>
                                <li class="text-muted">Obeso :<label id="obesol"></label></li>
                                </ul>
                            </div>
    

                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="anam">Observaciones:</label>
                                    <textarea class="form-control" id="anam" name="anam" rows="8"></textarea>
                                </div> 
                            </div>
                            
                        </div>
                </div>
                <div class="tab-pane fade" id="prediag" role="tabpanel" aria-labelledby="prediag-tab"> 
                    <h3> Pre-Diagnostico</h3>    
                            <div class="form-group">
                                <label for="notas_prediag">Observaciones:</label>

        
                                <textarea class="form-control" id="notas_prediag" name="notas_prediag" rows="8"></textarea>
                            </div> 
                </div>
                <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">     
                    <h3> Examenes</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="examen" name="examen">

                                    <option value="Examen 1">Examen 1</option>
                                    <option value="Examen 2">Examen 2</option>
                                    <option value="Examen 3">Examen 3</option>
                                    <option value="Examen 4">Examen 4</option>
                                    <option value="Examen 5">Examen 5</option>
                                    <option value="Examen 6">Examen 6</option>
                                    <option value="Examen 7">Examen 7</option>
                                </select>
                                <span class="help-block"></span>
                            </div> 
                        </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notas_examen">Observaciones:</label>
                                    <textarea class="form-control" id="notas_examen" name="notas_examen" rows="8"></textarea>
                                </div> 
                            </div>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="diag" role="tabpanel" aria-labelledby="diag-tab">     
                    <h3> Diagnostico</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="obs">Observaciones:</label>
                                    <textarea class="form-control" id="obs" name="obs" rows="8"></textarea>
                                </div> 
                            </div>
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">     
                    <h3> Examenes</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="examenes">Examenes:</label>
                                    <textarea class="form-control" id="examenes" name="examenes" rows="8"></textarea>
                                </div> 
                            </div>
                        
                    </div>
                </div>


                <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="historial-tab">     
                    <h3> Historial</h3>

                    <div class="row">
                            <div class="col-md-12">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Servicio</th>
                                        <th scope="col">Doctor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>2023-01-03</td>
                                        <td>Consulta</td>
                                        <td>Doctor Medicina</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>2023-01-03</td>
                                        <td>Rayos</td>
                                        <td>Doctor Medicina</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>2023-01-03</td>
                                        <td>Peluqueria</td>
                                        <td>Doctor Medicina</td>
                                    </tr>
                                    </tbody>
                                </table>  
                            </div>
                        
                    </div>
                </div>




            </div>



                
                
                <div class="modal-footer">

                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Save Change')); ?></button>
            </div>
                <!-- Agrega aquí más campos si es necesario -->
            </form>
            </div>

        </div>
        </div>
    </div>
    

    </div>



    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!--Bootstrap modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tipo de depociciones
                </h5>
                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <!-- Modal body with image -->
            <div class="modal-body">
                
                <img src="<?php echo e(asset('img/bristol.jpg')); ?>"  width="450" height="540" alt="Tipo de deposiciones">
            </div>
        </div>
    </div>
    </div>


    <!-- Chart JS -->
    <script src="<?php echo e(dsAsset('js/lib/assets/js/plugin/chart.js/chart.min.js')); ?>"></script>

    <!-- jQuery Sparkline -->
    <script src="<?php echo e(dsAsset('js/lib/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')); ?>"></script>

    <!-- Chart Circle -->
    <script src="<?php echo e(dsAsset('js/lib/assets/js/plugin/chart-circle/circles.min.js')); ?>"></script>
    <!-- jQuery Vector Maps -->
    <script src="<?php echo e(dsAsset('js/lib/assets/js/plugin/jqvmap/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(dsAsset('js/lib/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')); ?>"></script>

    <!-- dashboard JS -->

    <script src="<?php echo e(dsAsset('js/custom/dashboard/main-dashboard.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            if (window.location.pathname === '/home') {
                $('body').addClass('home');
            }
        });
    </script>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>