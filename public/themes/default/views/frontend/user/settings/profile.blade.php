@extends(Theme::getLayout())

{{-- Add Game Subheader --}}
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
      {{-- BankAccount tab --}}
      <a class="tab {{  Request::is('dash/settings/bankaccount') ? 'active' : ''}}" href="{{url('dash/settings/bankaccount')}}">
        {{ trans('users.dash.settings.bankaccount') }}
      </a>
      {{-- Password tab --}}
      <a class="tab {{  Request::is('dash/settings/password') ? 'active' : ''}}" href="{{url('dash/settings/password')}}">
        {{ trans('users.dash.settings.password') }}
      </a>
    </div>
  </div>
  {{-- End Content Tab --}}

  <section class="panel">

    {{-- Panel heading (Profile) --}}
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('users.dash.settings.profile') }}</h3>
    </div>

    {!! Form::open(array('url'=>'dash/settings','id'=>'form-settings','files' => true)) !!}
    <div class="panel-body">
      <div class="input-wrapper">
        {{-- Username label --}}
        <label>{{ trans('users.dash.settings.username') }}</label>
        {{-- Username input --}}
        <div class="input-group">
          <span class="input-group-addon fixed-width">
            <i class="fa fa-user" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control rounded inline input" name="name" id="name" autocomplete="off" value="{{$user->name}}" placeholder="{{ trans('users.dash.settings.username') }} " readonly/>
        </div>
        {{-- Profile link --}}
        <span style="opacity:0.5;"><i class="fa fa-link" aria-hidden="true"></i> {{ trans('users.dash.settings.profile_link') }} {{ $user->url }}</span>
      </div>
      <div class="input-wrapper">
        {{-- eMail Address label --}}
        <label>{{ trans('users.dash.settings.email') }}</label>
        {{-- Error messages for eMail Address --}}
        @if($errors->has('email'))
        <div class="bg-danger input-error">
          @foreach($errors->get('email') as $message)
          {{$message}}
          @endforeach
        </div>
        @endif
        {{-- eMail Address input --}}
        <div class="input-group {{$errors->has('email') ? 'has-error' : '' }}">
          <span class="input-group-addon fixed-width">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control rounded inline input" data-validation="number,required" name="email" id="email" autocomplete="off" value="{{$user->email}}" placeholder="{{ trans('users.dash.settings.email') }}"/>
        </div>
      </div>
      <div class="input-wrapper">
        {{-- Change profile image label --}}
        <label>{{ trans('users.dash.settings.change_avatar') }}</label>
        {{-- Error messages for image --}}
        @if($errors->has('avatar'))
        <div class="bg-danger input-error">
          @foreach($errors->get('avatar') as $message)
          {{$message}}
          @endforeach
        </div>
        @endif
        <div class="flex-center">
          <div class="m-r-10">
            <span class="avatar">
              <img src="{{$user->avatar_square_tiny}}" alt="">
            </span>
          </div>
          <div>
            {{-- File browser --}}
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn {{ $errors->has('avatar') ? 'bg-danger' : 'bg-success' }}">
                  <i class="fa fa-file-image" aria-hidden="true"></i> {{ trans('users.dash.settings.browse') }}&hellip; <input type="file" name="avatar" style="display: none;" multiple>
                </span>
              </label>
              <input type="text" class="form-control input" readonly>
            </div>
          </div>
        </div>
      </div>
      <div class="input-wrapper">
        {{-- Change or set location label --}}
        <label>{{ $location ? trans('users.dash.settings.location_change') : trans('users.dash.settings.location_set')}}</label>
        <div class="flex-center">
          {{-- Show current location --}}
          @if($location)
          <div class="current-location m-r-10">
            <img src="{{ asset('img/flags/' .   $location->country_abbreviation . '.svg') }}" height="14"/> {{$location->country_abbreviation}}, {{$location->place}} <span class="postal-code">{{$location->postal_code}}</span>
          </div>
          {{-- Show if no location is saved --}}
          @else
          <div class="current-location m-r-10">
            <i class="fa fa-times text-danger"></i> {{ trans('users.dash.settings.location_no') }}
          </div>
          @endif
          {{-- Button to open modal for location change --}}
          <a data-toggle="modal" data-target="#modal_user_location" href="javascript:void(0)" role="button" class="btn btn-success">
            <i class="fa fa-map-marker"></i>
            {{ $location ? trans('users.dash.settings.location_change') : trans('users.dash.settings.location_set')}}
          </a>
        </div>
      </div>

    </div>

    <div class="panel-footer">
      <div>
      </div>
      {{-- Save button --}}
      <div>
        <a href="javascript:void(0)" class="button" id="save-submit">
          <i class="fa fa-save" aria-hidden="true"></i> {{ trans('general.save') }}
        </a>
      </div>
    </div>
    {!! Form::close() !!}
  </section>

@stop


@section('after-scripts')

@include('frontend.user.location.' . config('settings.location_api') )

<script type="text/javascript">

$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });

});

$(document).ready(function(){


  {{-- password submit --}}
  $("#save-submit").click( function(){
    $('#save-submit').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
    $('#save-submit').addClass('loading');
    $('#form-settings').submit();
  });

})
</script>
@stop
