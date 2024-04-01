
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(dsAsset('site/css/custom/website-booking.css')); ?>" rel="stylesheet" />
<script src="<?php echo e(dsAsset('site/js/custom/website-booking.js')); ?>"></script>

<!--start banner section -->
<section class="banner-area position-relative" style="background:url(<?php echo e($appearance->background_image); ?>) no-repeat;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative text-center">
                    <h1 class="text-capitalize mb-3 text-white">Su cita fue agendada con éxito. <br> Un mail fue enviado como respaldo.</h1>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end banner section -->

<!-- Start booking Area -->

<!-- End booking Area -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/site/finishbooking.blade.php ENDPATH**/ ?>