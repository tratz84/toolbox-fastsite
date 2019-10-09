

<div class="page-header">
	
	<div class="toolbox">
		<a href="<?= appUrl('/?m=fastsite&c=redirect&a=edit') ?>" class="fa fa-plus"></a>
	</div>

	<h1>Overzicht redirects</h1>
</div>



<div id="redirect-table-container"></div>




<script>

var t = new IndexTable('#redirect-table-container');

t.setRowClick(function(row, evt) {
	window.location = appUrl('/?m=fastsite&c=redirect&a=edit&id=' + $(row).data('record').redirect_id);
});

t.setConnectorUrl( '/?m=fastsite&c=redirect&a=search' );


t.addColumn({
	fieldName: 'redirect_id',
	width: 40,
	fieldDescription: 'Id',
	fieldType: 'text',
	searchable: false
});
t.addColumn({
	fieldName: 'match_type',
	fieldDescription: 'Match-type',
	fieldType: 'text',
	searchable: false
});
t.addColumn({
	fieldName: 'pattern',
	fieldDescription: 'Patroon',
	fieldType: 'text',
	searchable: false
});
t.addColumn({
	fieldName: 'redirect_url',
	fieldDescription: 'Bestemmings url',
	fieldType: 'text',
	searchable: false
});
t.addColumn({
	fieldName: 'active',
	fieldDescription: 'Actief',
	fieldType: 'boolean',
	searchable: false
});

t.addColumn({
	fieldName: '',
	fieldDescription: '',
	fieldType: 'actions',
	render: function( record ) {
		var redirect_id = record['redirect_id'];
		
		var anchEdit = $('<a class="fa fa-pencil" />');
		anchEdit.attr('href', appUrl('/?m=fastsite&c=redirect&a=edit&id=' + redirect_id));
		
		var anchDel  = $('<a class="fa fa-trash" />');
		anchDel.attr('href', appUrl('/?m=fastsite&c=redirect&a=delete&id=' + redirect_id));
		anchDel.click( handle_deleteConfirmation_event );
		anchDel.data('description', record.company_name);

		
		var container = $('<div />');
		container.append(anchEdit);
		container.append(anchDel);
		
		return container;
	}
});

t.setSortUpdate(function(evt) {
	var ids = new Array();
	$(this.container).find('tbody tr').each(function(index, node) {
		var r = $(node).data('record');
		ids.push( r.redirect_id );
	});
	
	$.ajax({
		type: 'POST',
		url: appUrl('/?m=fastsite&c=redirect&a=sort'),
		data: {
			ids: ids.join(',')
		}
	});
});

t.load();




</script>