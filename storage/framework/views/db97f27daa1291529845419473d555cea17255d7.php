
<?php $__env->startSection('content'); ?>
<!-- datatable css -->
<link href="<?php echo e(dsAsset('js/lib/DataTables/datatables.min.css')); ?>" rel="stylesheet" />

<link href="<?php echo e(dsAsset('site/css/custom/client/site-dashboard.css')); ?>" rel="stylesheet" />


	<div class="container mt-5">
		<div class="section-top-border">	
			<!-- Botón del menú visible en dispositivos móviles -->
<button type="button" class="btn btn-primary d-md-none" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
	<i class="fas fa-bars"></i> <!-- Icono de Bootstrap 5 -->
  </button>
  
			<div class="row mt-5">
			
				<div class="col-md-3">
				
					
					  
					<div class="collapse  d-md-block" id="sidebarMenu">
					<div class="sidebar-menu">
						<div class="leftside-menu">
							<div class="card card-box-shadow py-4 mb-3">
								<span class="lm-shape"></span> <span class="lm-shape2"></span>
								<div class="card-header bg-transparent">
									<div class="div-profile-image justify-content-center d-flex">
										<?php if($userInfo['photo']==null || $userInfo['photo']==''): ?>
										<img class="profile-image" src="<?php echo e(dsAsset('js/lib/assets/img/avater-man.png')); ?>" alt="" class="avatar-img rounded" />
										<?php else: ?>
										<img class="profile-image" src="<?php echo e(dsAsset($userInfo['photo'])); ?>" alt="" class="avatar-img rounded" />
										<?php endif; ?>
									</div>
									<h4 class="mb-0 mt-1 text-center fw400"><?php echo e($userInfo['name']); ?></h4>
									<div class="text-center fs-13 user-balance">
									<span>Balance: <?php echo e(auth()->user()->balance()); ?></span>	
									</div>
								</div>
								<ul class="nav flex-column pt-3 mb-0 mb-md-3">
									<li class="nav-item pl-3"><a href="<?php echo e(route('site.client.profile')); ?>" class="nav-link"><i class="fa fa-user client-menu-icon"></i> <?php echo e(translate('Perfil')); ?></a></li>
									<li class="nav-item pl-3"><a href="<?php echo e(route('client.dashboard')); ?>" aria-current="page" class="nav-link"><i class="fa fa-home client-menu-icon"></i> <?php echo e(translate('Panel Principal')); ?></a></li>
									<li class="nav-item pl-3"><a href="<?php echo e(route('site.client.pets.listing')); ?>" class="nav-link"><i class="fas fa-cat client-menu-icon"></i></i> <?php echo e(translate('Pets')); ?></a></li>
									
									<br><br><br>
									<li class="nav-item pl-3 align-text-bottom"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"><i class="fas fa-sign-out-alt client-menu-icon"></i> <?php echo e(translate('Sign Out')); ?></a></li>
									<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
										<?php echo csrf_field(); ?>
									</form>
								</ul>	
							</div>
						</div>
					</div>
				</div></div>

				<div class="col-md-9">
					<?php echo $__env->yieldContent('content-site-dashboard'); ?>
				</div>
			</div>

		</div>


	</div>



<script src="<?php echo e(dsAsset('site/js/custom/client/site-dashboard.js')); ?>"></script>

<!-- Datatables -->
<script src="<?php echo e(dsAsset('js/lib/DataTables/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/link/lp/vet/resources/views/site/layouts/site-dashboard.blade.php ENDPATH**/ ?>