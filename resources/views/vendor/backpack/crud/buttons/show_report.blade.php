@if ($crud->hasAccess('update'))
	<a href="{{ url('offer/admin/report/'.$entry->getKey().'') }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-briefcase"></i> Show Offer</a>
@endif
