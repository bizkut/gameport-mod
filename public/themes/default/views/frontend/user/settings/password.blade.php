@extends(Theme::getLayout())

{{-- Add Settings Subheader --}}
@include('frontend.user.settings.subheader')

@section('content')
    {{-- Start Quick Links --}}
    <div class="flex-center wrap m-b-20">
      {{-- Dashboard listings quick action --}}
      <a href="{{ url('listings/add') }}" class="quick-action quick-action-orange">
        <div class="quick-icon">
          <i class="fa fa-tag"></i>
        </div>
        <div class="quick-text">
          {{ trans('users.dash.quick_listing') }}
        </div>
      </a>
      {{-- Dashboard listing quick action --}}
      <a href="{{ url('dash/listings') }}" class="quick-action">
        {{-- Icon with count --}}
        <div class="quick-icon">
          <i class="fa fa-tags"></i>@if((count($user->listings->where('status',0))+count($user->listings->where('status',1))) > 0)<span class="badge badge-dark badge-sm up">{{(count($user->listings->where('status',0))+count($user->listings->where('status',1)))}}</span>@endif
        </div>
        <div class="quick-text">
          {{ trans('general.listings') }}
        </div>
      </a>
      {{-- Dashboard offers quick action --}}
      <a href="{{ url('dash/offers') }}" class="quick-action">
        {{-- Icon with count --}}
        <div class="quick-icon">
          <i class="fa fa-briefcase"></i>@if((count($user->offers->where('status',0)->where('declined',0)) + count($user->offers->where('status',1)->where('declined',0))) > 0)<span class="badge badge-dark badge-sm up">{{count($user->offers->where('status',0)->where('declined',0)) + count($user->offers->where('status',1)->where('declined',0))}}</span>@endif
        </div>
        <div class="quick-text">
          {{ trans('general.offers') }}
        </div>
      </a>
      {{-- Dashboard wishlist quick action --}}
      <a href="{{ url('dash/wishlist') }}" class="quick-action">
        {{-- Icon --}}
        <div class="quick-icon">
          <i class="fa fa-heart"></i>
        </div>
        <div class="quick-text">
          {{ trans('wishlist.wishlist') }}
        </div>
      </a>
      {{-- Dashboard messenger quick action --}}
      <a href="{{ url('messages') }}" class="quick-action">
        {{-- Icon with count --}}
        <div class="quick-icon">
          <i class="fas {{ Auth::user()->unreadMessagesCount()>0 ? 'fa-envelope-open' : 'fa-envelope'}}"></i>@if(Auth::user()->unreadMessagesCount()>0)<span class="badge badge-danger badge-sm up">{{Auth::user()->unreadMessagesCount()}}</span> @endif
        </div>
        <div class="quick-text">
          {{ trans('messenger.messenger') }}
        </div>
      </a>
      {{-- Dashboard notifications quick action --}}
      <a href="{{ url('dash/notifications') }}" class="quick-action">
        {{-- Icon with count --}}
        <div class="quick-icon">
          <i class="fa fa-bell @if(count(Auth::user()->unreadNotifications)>0) faa-shake animated @endif"></i>@if(count(Auth::user()->unreadNotifications)>0)<span class="badge badge-danger badge-sm up">{{count(Auth::user()->unreadNotifications)}}</span> @endif
        </div>
        <div class="quick-text">
          {{ trans('notifications.title') }}
        </div>
      </a>
      {{-- Dashboard Settings quick action --}}
      <a href="{{ url('dash/settings') }}" class="quick-action">
        <div class="quick-icon">
          <i class="fa fa-wrench"></i>
        </div>
        <div class="quick-text">
          {{ trans('users.dash.settings.settings') }}
        </div>
      </a>
    </div>
    {{-- End Quick Links --}}

    {{-- Start Content Tab --}}
    <div class="contenttab">
      <div class="tabs">
        {{-- Profile tab --}}
        <a class="tab {{  Request::is('dash/settings') ? 'active' : ''}}" href="{{url('dash/settings')}}">
          {{ trans('users.dash.settings.profile') }}
        </a>
        {{-- Password tab --}}
        <a class="tab {{  Request::is('dash/settings/password') ? 'active' : ''}}" href="{{url('dash/settings/password')}}">
          {{ trans('users.dash.settings.password') }}
        </a>
      </div>
    </div>
    {{-- End Content Tab --}}
  
    <section class="panel">
      {{-- Panel heading (Change password) --}}
      <div class="panel-heading">
        <h3 class="panel-title">{{ trans('users.dash.settings.password_heading') }}</h3>
      </div>
      {{-- Open Form for password --}}
      {!! Form::open(array('url'=>'dash/settings/password','id'=>'form-password')) !!}
      <div class="panel-body">
        <div class="input-wrapper">
          {{-- Old password label --}}
          <label>{{ trans('users.dash.settings.password_old') }}</label>
          {{-- Error messages for old input --}}
          @if($errors->has('old_password'))
          <div class="bg-danger input-error">
            @foreach($errors->get('old_password') as $message)
            {{$message}}
            @endforeach
          </div>
          @endif
          {{-- Input for old password --}}
          <div class="input-group {{$errors->has('old_password') ? 'has-error' : '' }}">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-key" aria-hidden="true"></i>
            </span>
            <input id="password" type="password" class="form-control input" name="old_password" placeholder="{{ trans('users.dash.settings.password_old') }}" value="{{ old('old_password') }}">
          </div>
        </div>
        <div class="input-wrapper">
          {{-- New password label --}}
          <label>{{ trans('users.dash.settings.password_new') }}</label>
          {{-- Error messages for new input --}}
          @if($errors->has('password'))
          <div class="bg-danger input-error">
            @foreach($errors->get('password') as $message)
            {{$message}}
            @endforeach
          </div>
          @endif
          {{-- Input for new password --}}
          <div class="m-b-10 input-group {{$errors->has('password') ? 'has-error' : '' }}">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            </span>
            <input id="password" type="password" class="form-control input" name="password" placeholder="{{ trans('users.dash.settings.password_new') }}" value="{{ old('password') }}">
          </div>
          {{-- Input for new paddword confirmation --}}
          <div class="input-group {{$errors->has('password') ? 'has-error' : '' }}">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-repeat" aria-hidden="true"></i>
            </span>
            <input id="password" type="password" class="form-control input" name="password_confirmation" placeholder="{{ trans('users.dash.settings.password_new_confirm') }}" value="{{ old('password_confirmation') }}">
          </div>
        </div>
      </div>

      <div class="panel-footer">
        <div>
        </div>
        <div>
          {{-- Save button --}}
          <a href="javascript:void(0)" class="button" id="password-submit">
            <i class="fa fa-save" aria-hidden="true"></i> {{ trans('general.save') }}
          </a>
        </div>
      </div>
      {!! Form::close() !!}
      {{-- Close Form for password --}}

    </section>

@stop


@section('after-scripts')
<script type="text/javascript">
$(document).ready(function(){

  {{-- password submit --}}
  $("#password-submit").click( function(){
    $('#password-submit').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
    $('#password-submit').addClass('loading');
    $('#form-password').submit();
  });

})
</script>
@stop
