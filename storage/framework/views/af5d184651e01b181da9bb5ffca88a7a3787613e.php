<div class="col-xs-12">
	<div class="simulators">
		<h1>Simulateurs</h1>
		<a class="simulator" href="#frais-kilometriques">Frais kilométriques</a>
		<?php echo $__env->make('simulators.frais-kilometriques', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<a class="simulator" href="#conges-payes">Congés payés</a>
		<?php echo $__env->make('simulators.conges-payes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>