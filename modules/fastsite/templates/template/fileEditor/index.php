

<div class="page-header">
	<div class="toolbox list-toolbox">
		<a href="<?= appUrl('/?m=fastsite&c=template/template&a=edit&n='.urlencode($templateName)) ?>" class="fa fa-pencil"></a>
		<a href="<?= appUrl('/?m=fastsite&c=template/template') ?>" class="fa fa-chevron-circle-left"></a>
	</div>
	
    <h1><?= t('Editing template ') ?> </h1>
</div>

<div>
	Templatename: <?= esc_html($templateName) ?>
</div>

<br/>

<table class="list-response-table">

	<thead>
		<tr>
			<th><?= t('File') ?></th>
			<th><?= t('Active') ?></th>
			<th class="actions"></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($files as $f) : ?>
		<tr>
			<td>
				<?php if ($controller->extensionSupported($f)) : ?>
				<a href="<?= appUrl('/?m=fastsite&c=template/fileEditor&a=editfile&n='.urlencode($templateName).'&f='.urlencode($f)) ?>"><?= esc_html( $f ) ?></a>
				<?php else : ?>
				<?= esc_html( $f ) ?>
				<?php endif; ?>
			</td>
			<td>
			</td>
			<td class="actions">
				<?php if ($controller->extensionSupported($f)) : ?>
					<a href="<?= appUrl('/?m=fastsite&c=template/fileEditor&a=editfile&n='.urlencode($templateName).'&f='.urlencode($f)) ?>" class="fa fa-edit"></a>
    				<?php if (in_array(file_extension($f), ['htm', 'html'])) : ?>
    				<a href="<?= appUrl('/?m=fastsite&c=template/templateFile&n='.urlencode($templateName).'&f='.urlencode($f)) ?>" class="fa fa-file-text"></a>
    				<?php endif; ?>
				<?php endif; ?>
				
				<a href="<?= appUrl('/?m=fastsite&c=template/fileEditor&a=delete&n='.urlencode($templateName).'&f='.urlencode($f)) ?>" class="fa fa-remove delete"></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>



<script>

$(document).ready(function() {
	handle_deleteConfirmation();
});

</script>


