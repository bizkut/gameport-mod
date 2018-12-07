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
      @foreach($themes as $theme)
        <div class="col-md-6 col-lg-4">

            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title flex-center-space">
                      {{-- Thene Name --}}
                      <strong>{{ $theme['name'] or 'Unknown Name' }}</strong>
                      {{-- Theme version --}}
                      <div>{{ $theme['version'] or 'Unknown Version' }}</div>
                    </div>
                    <small>{{ $theme['slug'] or 'Unknown Slug' }}</small>
                </div>

                <div class="box-body">
                  <object data="{{ asset('themes/' . $theme['slug'] . '/screenshot.jpg') }}" type="image/jpg" class="theme-screenshot screenshot-object">
                      <img src="{{ asset('themes/default_screenshot.jpg') }}" class="m-b-10 theme-screenshot" style="" />
                  </object>
                  @if($theme['gameport_version'] && (config('settings.script_version') >=  $theme['gameport_version']))
                    <div class="callout callout-success" style="margin-top: -13px;">
                      <p><i class="fa fa-check-circle" aria-hidden="true"></i> Compatible with this GamePort script version.</p>
                    </div>
                  @elseif($theme['gameport_version'] && (config('settings.script_version') <  $theme['gameport_version']))
                    <div class="callout callout-danger" style="margin-top: -13px;">
                      <p><i class="fa fa-times-circle" aria-hidden="true"></i>
 Not compatible with this GamePort script version. You need at least version <strong>{{ $theme['gameport_version'] }}</strong>.</p>
                    </div>
                  @elseif(!$theme['gameport_version'])
                    <div class="callout callout-warning" style="margin-top: -13px;">
                      <p><i class="fa fa-info-circle" aria-hidden="true"></i>
 Unknown GamePort script version.</p>
                    </div>
                  @endif
                  <strong>Author: </strong>{{ $theme['author'] or 'Unknown Author' }}<br>
                  <strong>Description: </strong>{{ $theme['description'] or 'No Description' }}
                </div>
                <div class="box-footer">
                  <div class="flex-center-space">
                    <div>
                      @if($theme['gameport_version'] && (config('settings.script_version') >=  $theme['gameport_version']))
                        @if(config('settings.default_theme') == $theme['slug'])
                			    <a type="submit" class="btn btn-success ladda-button" data-style="zoom-in">
                            <span class="ladda-label"><i class="fa fa-check"></i> Default Theme</span>
                          </a>
                        @else
                          @if($theme['public'])
                            <a type="submit" class="btn btn-default ladda-button" data-style="zoom-in" href="{{ url('admin/settings/theme/default' , $theme['slug']) }}">
                              <span class="ladda-label"><i class="fa fa-check"></i> Set as Default</span>
                            </a>
                          @else
                            <a type="submit" class="btn btn-danger ladda-button" data-style="zoom-in">
                              <span class="ladda-label"><i class="fa fa-times"></i> Not Public</span>
                            </a>
                          @endif
                        @endif
                      @else
                        <a type="submit" class="btn btn-danger ladda-button" data-style="zoom-in">
                          <span class="ladda-label"><i class="fa fa-times"></i> Not Compatible</span>
                        </a>
                      @endif
                    </div>
                    <div>
                      @if($theme['public'])
                        <i class="fa fa-check"></i> Public
                      @else
                        <i class="fa fa-times"></i> Not Public
                      @endif
                    </div>
                  </div>
        		    </div><!-- /.box-footer-->
            </div>
        </div>
      @endforeach
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
	<script>
        jQuery('document').ready(function($){

          $('.col-md-6').matchHeight();

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
