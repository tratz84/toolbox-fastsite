
<div class="page-header">

	<div class="toolbox">
		<a href="<?= appUrl('/?m=fastsite&c=redirect') ?>" class="fa fa-chevron-circle-left"></a>
		<a href="javascript:void(0);" class="fa fa-save submit-form"></a>
	</div>

	<?php if ($isNew) : ?>
		<h1>Redirect aanmaken</h1>
	<?php else : ?>
		<h1>Redirect bewerken</h1>
	<?php endif; ?>
</div>


<?= $form->render() ?>

