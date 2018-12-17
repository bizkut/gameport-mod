<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="header">{{ trans('backpack::base.administration') }}</li>
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<!-- Settings -->
@can('edit_settings')
<li class="treeview">
  <a href="#"><i class="fa fa-cogs"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/general') }}"><i class="fa fa-cog"></i> <span>General</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/design') }}"><i class="fa fa-diamond"></i> <span>Design</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/theme') }}"><i class="fa fa-paint-brush"></i> <span>Theme</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/localization') }}"><i class="fa fa-globe"></i> <span>Localization</span></a></li>
    @if(config('settings.location_api') == 'zippopotam')
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/country') }}"><i class="fa fa-street-view"></i> <span>Countries</span></a></li>
    @endif
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/listing') }}"><i class="fa fa-tag"></i> <span>Listing</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/game') }}"><i class="fa fa-gamepad"></i> <span>Game</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/auth') }}"><i class="fa fa-key"></i> <span>Authentication</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/ads') }}"><i class="fa fa-bullhorn"></i> <span>Ads</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/payment') }}"><i class="fa fa-money"></i> <span>Payment</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/comment') }}"><i class="fa fa-comments"></i> <span>Comment</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/notification') }}"><i class="fa fa-bell"></i> <span>Notifications</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/article') }}"><i class="fa fa-newspaper-o"></i> <span>News</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/messenger') }}"><i class="fa fa-envelope"></i> <span>Messenger</span></a></li>
  </ul>
</li>
@endcan
<!-- Language -->
@can('edit_translations')
<li class="treeview">
  <a href="#"><i class="fa fa-globe"></i> <span>Translations</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language') }}"><i class="fa fa-flag-checkered"></i> Languages</a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language/texts') }}"><i class="fa fa-language"></i> Site texts</a></li>
  </ul>
</li>
@endif
<!-- ======================================= -->
<li class="header">Content</li>
<!-- Users, Roles Permissions -->
@can('edit_users')
<li class="treeview">
  <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
  </ul>
</li>
@endcan
<!-- Games, Consoles Genres -->
@can('edit_games')
<li class="treeview">
  <a href="#"><i class="fa fa-gamepad"></i> <span>Games</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/game') }}"><i class="fa fa-gamepad"></i> <span>Games</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/genre') }}"><i class="fa fa-folder-open" aria-hidden="true"></i> <span>Genres</span></a></li>
  </ul>
</li>
@endcan
<!-- Platforms, Digital distributors -->
@can('edit_platforms')
<li class="treeview">
  <a href="#"><i class="fa fa-gamepad"></i> <span>Platforms</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/platform') }}"><i class="fa fa-cube"></i> <span>Platforms</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/digital') }}"><i class="fa fa-download"></i> <span>Digital distributors</span></a></li>
  </ul>
</li>
@endcan
<!-- Product, Product Categories -->
@can('edit_products')
<li class="treeview">
  <a href="#"><i class="fa fa-product-hunt"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Products</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/procategory') }}"><i class="fa fa-th-list"></i> <span>Categories</span></a></li>
  </ul>
</li>
@endcan
@can('edit_listings')
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/listing') }}"><i class="fa fa-tags"></i> <span>Listings</span></a></li>
@endcan
@can('edit_offers')
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/offer') }}"><i class="fa fa-briefcase"></i> <span>Offers</span></a></li>
@php $open_reports = \App\Models\Report::where('status','0')->count(); @endphp
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/report') }}"><i class="fa fa-life-ring"></i> <span>Reports</span>@if($open_reports > 0) <span class="pull-right-container"> <span class="label label-danger pull-right">{{$open_reports}}</span> </span>@endif</a></li>
@endcan
<!-- Payments, Transactions, Withdrawals -->
@can('edit_payments')
@php $pending_withdrawals = \App\Models\Withdrawal::where('status','1')->count(); @endphp
<li class="treeview">
  <a href="#"><i class="fa fa-money"></i> <span>Payments</span> <i class="fa fa-angle-left pull-right"></i>@if($pending_withdrawals > 0) <span class="pull-right-container"> <span class="label label-warning pull-right">{{$pending_withdrawals}}</span> </span>@endif</a>
  <ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/payment') }}"><i class="fa fa-money"></i> <span>Payments</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/transaction') }}"><i class="fa fa-th-list" aria-hidden="true"></i> <span>Transactions</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/withdrawal') }}"><i class="fa fa-repeat"></i> <span>Withdrawals</span>@if($pending_withdrawals > 0) <span class="pull-right-container"> <span class="label label-warning pull-right">{{$pending_withdrawals}}</span> </span>@endif</a></li>
  </ul>
</li>
@endcan
@can('edit_ratings')
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/rating') }}"><i class="fa fa-thumbs-up"></i> <span>Ratings</span></a></li>
@endcan
@can('edit_articles')
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>News</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ url('admin/article') }}"><i class="fa fa-newspaper-o"></i> <span>Articles</span></a></li>
      <li><a href="{{ url('admin/category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
      <li><a href="{{ url('admin/tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>
@endcan
@can('edit_comments')
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/comment') }}"><i class="fa fa-comments"></i> <span>Comments</span></a></li>
@endcan
@can('edit_pages')
<li><a href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/menu-item') }}"><i class="fa fa-list"></i> <span>Menu (Footer)</span></a></li>
@endcan
@can('edit_emotical')
<li><a href="{{ url(config('backpack.base.route_prefix').'/emotical') }}"><i class="fa fa-meh-o"></i> <span>Emoticals</span></a></li>
@endcan
<!-- ======================================= -->
<li class="header">{{ trans('backpack::base.user') }}</li>
<li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
