@if ($crud->hasAccess('update'))
	<a href="{{ url('listings/show-listing-'.$entry->getKey().'') }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i> Show</a>
@endif
