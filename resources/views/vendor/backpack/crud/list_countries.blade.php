@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
	    <small>{{ trans('backpack::crud.all') }} <span>{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">
        @if ( $crud->buttons->where('stack', 'top')->count() ||  $crud->exportButtons())
        <div class="box-header hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">
          <button data-toggle="modal" data-target="#myModal" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Add country</span></button>
          @include('crud::inc.button_stack', ['stack' => 'top'])

          <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
        </div>
        @endif

        <div class="box-body overflow-hidden">

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif

        <table id="crudTable" class="table table-striped table-hover display responsive nowrap" cellspacing="0">
            <thead>
              <tr>
                {{-- Table columns --}}
                @php $hidden_columns = ''; @endphp
                @foreach ($crud->columns as $column)
                  @php
                    if(isset($column['type']) && $column['type'] == 'hidden') {
                      $index = $crud->details_row ? $loop->index + 1 : $loop->index;
                      $hidden_columns .= $hidden_columns === '' ? $index : ', ' . $index;
                    }
                  @endphp
                  <th
                    data-orderable="{{ var_export($column['orderable'], true) }}"
                    data-priority="{{ $column['priority'] }}"
                    data-visible-in-modal="{{ (isset($column['visibleInModal']) && $column['visibleInModal'] == false) ? 'false' : 'true' }}"
                    >
                    {!! $column['label'] !!}
                  </th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}">{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th style="{{ isset($column['type']) && $column['type'] === 'hidden' ? 'border: none !important; width: 0 !important; max-width: 0 !important; font-size:0 !important; padding:0 !important;' : '' }}">{!! $column['label'] !!}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

        </div><!-- /.box-body -->


        @if ( $crud->buttons->where('stack', 'bottom')->count() )
        <div class="box-footer hidden-print">
          @include('crud::inc.button_stack', ['stack' => 'bottom'])
        </div>
        @endif
      </div><!-- /.box -->
    </div>

  </div>
  {{-- Add Country modal --}}
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add country</h4>
	      </div>
				<form method="POST" action="{{ url($crud->route) }}" accept-charset="UTF-8" id="add_country_form">
					{!! csrf_field() !!}
		      <div class="modal-body">
						<p>Please select the country you want to add.</p>
						<select name="country_selection" id="country_selection" class="form-control select2">
							<option></option>
							<option value="AD">Andorra</option>
							<option value="AR">Argentina</option>
							<option value="AS">American Samoa</option>
							<option value="AT">Austria</option>
							<option value="AU">Australia</option>
							<option value="BD">Bangladesh</option>
							<option value="BE">Belgium</option>
							<option value="BG">Bulgaria</option>
							<option value="BR">Brazil</option>
							<option value="CA">Canada</option>
							<option value="CH">Switzerland</option>
							<option value="CZ">Czech Republic</option>
							<option value="DE">Germany</option>
							<option value="DK">Denmark</option>
							<option value="DO">Dominican Republic</option>
							<option value="ES">Spain</option>
							<option value="FI">Finland</option>
							<option value="FO">Faroe Islands</option>
							<option value="FR">France</option>
							<option value="GB">Great Britain</option>
							<option value="GF">French Guyana</option>
							<option value="GG">Guernsey</option>
							<option value="GL">Greenland</option>
							<option value="GP">Guadeloupe</option>
							<option value="GT">Guatemala</option>
							<option value="GU">Guam</option>
							<option value="GY">Guyana</option>
							<option value="HR">Croatia</option>
							<option value="HU">Hungary</option>
							<option value="IM">Isle of Man</option>
							<option value="IN">India</option>
							<option value="IS">Iceland</option>
							<option value="IT">Italy</option>
							<option value="JE">Jersey</option>
							<option value="JP">Japan</option>
							<option value="LI">Liechtenstein</option>
							<option value="LK">Sri Lanka</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MC">Monaco</option>
							<option value="MD">Moldavia</option>
							<option value="MH">Marshall Islands</option>
							<option value="MK">Macedonia</option>
							<option value="MP">Northern Mariana Islands</option>
							<option value="MQ">Martinique</option>
							<option value="MX">Mexico</option>
							<option value="MY">Malaysia</option>
							<option value="NL">Holland</option>
							<option value="NO">Norway</option>
							<option value="NZ">New Zealand</option>
							<option value="PH">Phillippines</option>
							<option value="PK">Pakistan</option>
							<option value="PL">Poland</option>
							<option value="PM">Saint Pierre and Miquelon</option>
							<option value="PR">Puerto Rico</option>
							<option value="PT">Portugal</option>
							<option value="RE">French Reunion</option>
							<option value="RU">Russia</option>
							<option value="SE">Sweden</option>
							<option value="SI">Slovenia</option>
							<option value="SJ">Svalbard & Jan Mayen Islands</option>
							<option value="SK">Slovak Republic</option>
							<option value="SM">San Marino</option>
							<option value="TH">Thailand</option>
							<option value="TR">Turkey</option>
							<option value="US">United States</option>
							<option value="VA">Vatican</option>
							<option value="VI">Virgin Islands</option>
							<option value="YT">Mayotte</option>
							<option value="ZA">South Africa</option>
						</select>
						<input type="hidden" name="name" id="name" value="">
						<input type="hidden" name="code" id="code" value="">
						<input type="hidden" name="redirect_after_save" value="{{ $crud->route }}">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Add country</button>
		      </div>
				</form>
	    </div>
	  </div>
	</div>

@endsection

@section('after_styles')


  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
  {{-- Country selection --}}
	<!-- include select2 css-->
	<link href="{{ asset('vendor/backpack/select2/select2.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('vendor/backpack/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />

	<!-- include select2 js-->
	<script src="{{ asset('vendor/backpack/select2/select2.js') }}"></script>
	<script>
			jQuery(document).ready(function($) {
					// trigger select2 for each untriggered select2 box
					$('.select2').each(function (i, obj) {
							if (!$(obj).data("select2"))
							{
									$(obj).select2({placeholder: "Select a country"});
							}
					});
					{{-- Set hidden inputs for country form --}}
					$("#country_selection").change(function() {
					    var $value = $(this).val();
					    var $title = $(this).children('option[value='+$value+']').html();
					    $('#name').val($title);
							$('#code').val($value);
					});

			    $("#add_country_form").submit(function(e){
			        if($('#code').val().length < 1 && $('#name').val().length < 1){
								alert('Please select a country!')
								return false;
							}
			    });
			});
	</script>

	@include('crud::inc.datatables_logic')

  <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
