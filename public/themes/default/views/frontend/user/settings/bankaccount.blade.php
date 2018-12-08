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
      {{-- Panel heading (Bank Account) --}}
      <div class="panel-heading">
        <h3 class="panel-title">{{ trans('users.dash.settings.bankaccount') }}</h3>
      </div>
      {{-- Open Form for BankAccount --}}
      {!! Form::open(array('url'=>'dash/settings/bankaccount','id'=>'form-bankaccount')) !!}
      <div class="panel-body">
        <div class="input-wrapper">
          {{-- First Name label --}}
          <label>{{ trans('users.dash.settings.firstname') }}</label>
          {{-- First Name input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control rounded inline input" name="firstname" id="firstname" autocomplete="off" value="{{$user->bank_firstname}}" placeholder="{{ trans('users.dash.settings.firstname') }} "/>
          </div>
        </div>
        <div class="input-wrapper">
          {{-- Last Name label --}}
          <label>{{ trans('users.dash.settings.lastname') }}</label>
          {{-- Last Name input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control rounded inline input" name="lastname" id="lastname" autocomplete="off" value="{{$user->bank_lastname}}" placeholder="{{ trans('users.dash.settings.lastname') }} "/>
          </div>
        </div>
        <div class="input-wrapper">
          {{-- IBAN label --}}
          <label>{{ trans('users.dash.settings.iban') }}</label>
          {{-- IBAN input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-tags" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control rounded inline input" name="iban" id="iban" autocomplete="off" value="{{$user->bank_iban}}" placeholder="{{ trans('users.dash.settings.iban') }} "/>
          </div>
        </div>
        <div class="input-wrapper">
          {{-- Swift Code label --}}
          <label>{{ trans('users.dash.settings.swiftcode') }}</label>
          {{-- Swift Code input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-barcode" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control rounded inline input" name="swiftcode" id="swiftcode" autocomplete="off" value="{{$user->bank_swiftcode}}" placeholder="{{ trans('users.dash.settings.swiftcode') }} "/>
          </div>
        </div>
        <div class="input-wrapper">
          {{-- Bank Name label --}}
          <label>{{ trans('users.dash.settings.bankname') }}</label>
          {{-- Bank Name input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-credit-card" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control rounded inline input" name="bankname" id="bankname" autocomplete="off" value="{{$user->bank_name}}" placeholder="{{ trans('users.dash.settings.bankname') }} "/>
          </div>
        </div>
        <div class="input-wrapper">
          {{-- Bank Address label --}}
          <label>{{ trans('users.dash.settings.bankaddress') }}</label>
          {{-- Bank Address input --}}
          <div class="input-group">
            <span class="input-group-addon fixed-width">
              <i class="fa fa-address-book" aria-hidden="true"></i>
            </span>
            <textarea class="form-control rounded inline input" name="bankaddress" id="bankaddress" rows="3" autocomplete="off" placeholder="{{ trans('users.dash.settings.bankaddress') }} ">{{$user->bank_address}}</textarea>
          </div>
        </div>
      </div>

      <div class="panel-footer">
        <div>
        </div>
        <div>
          {{-- Save button --}}
          <a href="javascript:void(0)" class="button" id="bankaccount-submit">
            <i class="fa fa-save" aria-hidden="true"></i> {{ trans('general.save') }}
          </a>
        </div>
      </div>
      {!! Form::close() !!}
      {{-- Close Form for bankaccount --}}

    </section>

@stop


@section('after-scripts')
<script type="text/javascript">
$(document).ready(function(){

  {{-- password submit --}}
  $("#bankaccount-submit").click( function(){
    $('#bankaccount-submit').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
    $('#bankaccount-submit').addClass('loading');
    $('#form-bankaccount').submit();
  });

})
</script>
@stop
