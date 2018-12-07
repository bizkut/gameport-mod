@if ($crud->hasAccess('create'))
	<a href="{{ url('listings/add') }}" class="btn btn-primary ladda-button" data-style="zoom-in" target="_blank"><span class="ladda-label"><i class="fa fa-plus"></i> Add Listing</span></a>
@endif
