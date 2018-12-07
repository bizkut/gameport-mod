@if ($crud->hasAccess('create'))
	<a href="{{ url('games/add') }}" class="btn btn-warning ladda-button" data-style="zoom-in" target="_blank"><span class="ladda-label"><i class="fa fa-plus"></i> Add Game through API</span></a>
@endif
