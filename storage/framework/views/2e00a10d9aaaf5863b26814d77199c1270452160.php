
<?php $__env->startSection('content-site-dashboard'); ?>
<link href="<?php echo e(dsAsset('site/css/custom/client/client-pending-booking.css')); ?>" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="card card-box-shadow">
            <div class="card-header">
                <div class="fs-18 color-black"><?php echo e(translate('User Info')); ?></div>
            </div>
            <form class="form-horizontal p-5 pt-3 mt-1" id="inputForm" novalidate="novalidate" enctype="multipart/form-data">

                <div class="mb-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-12">
                            <div class="float-start">
                                <img id="user_photo_view" name="user_photo_view" src="" width="100" height="100" />
                            </div>
                            <div class="float-start ms-2">
                                <input class=" mt-4" name="user_photo" id="user_photo" type="file" />
                        </div>
                    </div>
                </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black w-100"><?php echo e(translate('Your Name')); ?> *</span>
                <input name="name" id="name" type="text" required class="form-control w-100" />
            </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('User Name')); ?> *</span>
                <input readonly name="username" id="username" type="text" required class="form-control" />
            </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('Email')); ?> *</span>
                <input readonly name="email" id="email" required type="text" class="form-control" />
            </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('Phone No')); ?> *</span>
                <input id="phone_no" type="text" class="form-control" />
            </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('Date of Birth')); ?></span>
                <input name="dob" id="dob" type="text" class="form-control datePicker" />
            </div>
        </div>

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('Direccion    ')); ?> </span>
                <input name="street_address" id="street_address" type="text" class="form-control" />
            </div>
        </div>

        

        <div class="mb-3">
            <div class="col-md-12">
                <span class="color-black"><?php echo e(translate('City')); ?></span>
                <input name="city" id="city" required type="text" class="form-control" />
            </div>
        </div>

        

        

        <div class="mb-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success float-end"><?php echo e(translate('Save Change')); ?></button>
            </div>
        </div>


        </form>
    </div>
</div>
</div>

<script src="<?php echo e(dsAsset('site/js/custom/client/client-profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.site-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/site/client/client-profile.blade.php ENDPATH**/ ?>