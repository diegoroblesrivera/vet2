
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(dsAsset('css/custom/dashboard/dashboard.css')); ?>" rel="stylesheet" />

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold"><?php echo e(translate('Appointment Booking Dashboard')); ?></h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="booking-calendar" class="btn btn-secondary btn-round"><?php echo e(translate('Add New Booking')); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
   

   

    <div class="row">
        <div class="col-md-12   ">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title"><?php echo e(translate('Para exploracion')); ?></div>

                        <div class="card-tools">

                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <select id="booking-info-service-status" class="form-control input-sm mt-1">
                                        <option value="">All Except Done</option>
                                        <option value="5">Exploracion</option>
                                        <option value="4">Done</option>
                                        <option value="3">Cancel</option>
                                        <option value="2">Approved</option>
                                        <option value="1">Processing</option>
                                        <option value="0">Pending</option>
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

        

    </div>



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
              <button class="nav-link " id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sala de Espera</button>
            </li>
            <li class="nav-item active" role="presentation">
              <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"> Examen Fisico</button>
            </li>
            
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab"><h3>Sala de espera</h3>
                
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
                            <input type="text" id="peso" name="peso" class="form-control input-full"  />
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
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                            <label><?php echo e(translate('Tiempo de llenado capilar')); ?></label>
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
            
          

            
                                    

            <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="historial-tab">     
                <h3> Historial</h3>

                <div class="row">
                        <div class="col-md-12">
                            <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/exploracion/exploracion.blade.php ENDPATH**/ ?>