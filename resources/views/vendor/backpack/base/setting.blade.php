@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ $title }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li><li><a href="{{ Request::url() }}">{{ $title }}</a></li>
        <li class="active">{{ $subtitle }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
		      {!! Form::open(array('url' => url('admin/setting/save/' . $category), 'method' => 'post')) !!}
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">
                      {{ $subtitle }}
                    </div>
                </div>

                <div class="box-body">
                  @foreach($settings as $setting)
                  @php

                  $field = json_decode($setting->field, true);
                  $field['value'] = $setting->value;
                  $field['name'] = $setting->key;
                  $field['label'] = $setting->name;
                  @endphp
                    @if(view()->exists('vendor.backpack.crud.fields.'.$field['type']))
                  		@include('vendor.backpack.crud.fields.'.$field['type'], array('field' => $field))
                  	@else
                  		@include('crud::fields.'.$field['type'], array('field' => $field))
                  	@endif
                  @endforeach
                </div>
                <div class="box-footer">
        			    <button type="submit" class="btn btn-success ladda-button" data-style="zoom-in">
                    <span class="ladda-label"><i class="fa fa-save"></i> {{ trans('backpack::crud.save') }}</span>
                  </button>
        		    </div><!-- /.box-footer-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

{{-- Define blade stacks so css and js can be pushed from the fields to these sections. --}}

@section('after_styles')
	<!-- CRUD FORM CONTENT - crud_fields_styles stack -->
	@stack('crud_fields_styles')
@endsection

@section('after_scripts')
	<!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
	@stack('crud_fields_scripts')

	<script>
        jQuery('document').ready(function($){

      		// Ctrl+S and Cmd+S trigger Save button click
      		$(document).keydown(function(e) {
      		    if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
      		    {
      		        e.preventDefault();
      		        // alert("Ctrl-s pressed");
      		        $("button[type=submit]").trigger('click');
      		        return false;
      		    }
      		    return true;
      		});

        });
	</script>
@endsection
