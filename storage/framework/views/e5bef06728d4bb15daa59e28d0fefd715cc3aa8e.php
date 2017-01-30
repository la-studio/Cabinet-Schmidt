<div id="conges-payes" class="hidden">
	<form method="get" action="/simulateurs/conges-payes">
		<?php echo e(csrf_field()); ?>

		<input class="required" type="text" name="param1" value=""/>
		<span class="error1"></span>
		<input class="required" type="text" name="param2" value=""/>
		<span class="error2"></span>
		<input class="required" type="text" name="param3" value=""/>
		<span class="error3"></span>
		<input class="required" type="text" name="param4" value=""/>
		<span class="error4"></span>
		<input type="submit" value="Calculer"/>
	</form>
	<div class="result">
	</div>
	<div class="error">
	</div>
</div>