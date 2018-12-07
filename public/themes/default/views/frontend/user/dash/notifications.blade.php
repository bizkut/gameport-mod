@extends(Theme::getLayout())


@section('subheader')
  {{-- Start subheader --}}
  <div class="subheader">

    <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}') !important;"></div>
    <div class="background-color"></div>
    {{-- Subheader title (Notifications) --}}
    <div class="content">
      <span class="title"><i class="fa fa-bell"></i> {{ trans('notifications.title') }}</span>
    </div>

    @if($user->unreadNotifications()->count() > 0)
      <div class="tabs">
        {{-- Mark all as  read --}}
        <a class="tab" href="{{url('dash/notifications/read/all')}}">
          <i class="fa fa-check"></i> {{ trans('notifications.mark_all_read') }}
        </a>
      </div>
    @endif

  </div>
  {{-- End subheader --}}
@stop


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
  <div class="contenttab {{ $user->unreadNotifications()->count() > 0 ? '' : 'hidden' }}">
    @if($user->unreadNotifications()->count() > 0)
      <div class="tabs">
        {{-- Mark all as  read --}}
        <a class="tab" href="{{url('dash/notifications/read/all')}}">
          <i class="fa fa-check"></i> {{ trans('notifications.mark_all_read') }}
        </a>
      </div>
    @endif
  </div>
  {{-- End Content Tab --}}
  
  {{-- Load data for notifications --}}
  @php
  $listings = \App\Models\Listing::whereIn('id', array_column($user->notifications->pluck('data')->toArray(),'listing_id'))->withTrashed()->get();
  $listings->load('game','game.platform','game.giantbomb');
  $offers = \App\Models\Offer::whereIn('id', array_column($user->notifications->pluck('data')->toArray(),'offer_id'))->withTrashed()->get();
  $offers->load('game','user');
  $users = \App\Models\User::whereIn('id', array_column($user->notifications->pluck('data')->toArray(),'user_id'))->withTrashed()->get();
  @endphp
  {{-- Pagination links on top --}}
  {{$user->notifications()->paginate(20)->links()}}
  {{-- Show all notifications --}}
  @forelse($user->notifications()->paginate(20) as $notification)
    @include('default::frontend.notifications.' . snake_case(class_basename($notification->type)))
  @empty
    {{-- Start empty list message --}}
    <div class="empty-list">
      {{-- Icon --}}
      <div class="icon">
        <i class="far fa-frown" aria-hidden="true"></i>
      </div>
      {{-- Text --}}
      <div class="text">
        {{ trans('notifications.no_notifications') }}
      </div>
    </div>
    {{-- End empty list message --}}
  @endforelse
  {{-- Pagination links on bottom --}}
  {{$user->notifications()->paginate(20)->links()}}

@stop


@section('after-scripts')
<script type="text/javascript">
$(document).ready(function(){

  $('a[data-notif-id]').click(function () {
    {{-- Get notification id --}}
    var notif_id   = $(this).data('notifId');
    {{-- Get target after click --}}
    var targetHref = $(this).attr('href');

    $.ajax({
        url:'{{ url('dash/notifications/read') }}',
        type:'POST',
        data:{'notif_id': notif_id},
        {{-- Send CSRF Token over ajax --}}
        headers: { 'X-CSRF-TOKEN': Laravel.csrfToken },
        success:function(data){
          window.location.href = targetHref;
        },
        error: function (data) {
          alert('Error');
        }
    });

    return false;
  });

})
</script>
@stop
