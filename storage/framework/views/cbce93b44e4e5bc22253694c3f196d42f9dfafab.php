
<?php $__env->startSection('content'); ?>

<div class="page-inner">
    <!--Modal add menu--->
   

    <!--Modal pet menu-->
        <div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="inputForm" novalidate="novalidate" enctype="multipart/form-data">
    
                        
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold">
                                    Mascotas asociadas
                                </span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
    
    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('Nombre')); ?> *</label>
                                        <input type="text" id="nombre" name="nombre" placeholder="<?php echo e(translate('Nombre')); ?>" required data-validation-required-message="El nombre de la mascota es requerida" class="form-control input-full" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('System User')); ?></label>
                                        <select name="user_id" id="user_id" class="form-control input-full">
                                            <option value="">a</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group control-group form-inline controls">
                                <label>Customer Email *</label>
                                <input type="email" id="email" name="email" placeholder="email@example.com" required data-validation-required-message="Email address is required" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
    
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group control-group form-inline controls">
    
                                        <label class="col-md-12 p-0"><?php echo e(translate('Customer Phone')); ?> *</label>
                                        <input type="tel" id="phone_no" maxlength="20" name="phone_no" placeholder="<?php echo e(translate('Phone Number')); ?>" required data-validation-required-message="Phone number is required" class="form-control input-full w-100" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('Date of Birth')); ?> </label>
                                        <input type="text" id="dob" name="dob" class="form-control input-full datePicker" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group control-group form-inline ">
                                <label><?php echo e(translate('Street Address')); ?> *</label>
                                <textarea type="text" id="street_address" name="street_address" required data-validation-required-message="Street address is required" class="form-control input-full"></textarea>
                                <span class="help-block"></span>
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('Country')); ?></label>
                                        <input type="text" id="country" name="country" class="form-control input-full" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('City')); ?></label>
                                        <input type="text" id="city" name="city" class="form-control input-full" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('State Name')); ?></label>
                                        <input type="text" id="state" name="state" class="form-control input-full" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group control-group form-inline controls">
                                        <label><?php echo e(translate('Postal Code')); ?></label>
                                        <input type="number" id="postal_code" name="postal_code" class="form-control input-full" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group control-group form-inline controls">
                                <label><?php echo e(translate('Remarks')); ?></label>
                                <input type="text" id="remarks" name="remarks" class="form-control input-full" />
                                <span class="help-block"></span>
                            </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(translate('Save Change')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--category datatable -->
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">
                            <?php echo e(translate('Listado de mascotas')); ?>

                        </h4>
                        <button id="btnAdd" class="btn btn-primary btn-sm btn-round ml-auto">
                            <i class="fa fa-plus"></i> <?php echo e(translate('Add New Customer')); ?>

                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableElement" class="table table-bordered w100"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(dsAsset('js/custom/pet/pets.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/pet/pets.blade.php ENDPATH**/ ?>