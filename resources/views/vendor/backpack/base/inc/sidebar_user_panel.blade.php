<div class="user-panel">
  <span class="pull-left image">
    <img src="{{ backpack_avatar_url(backpack_auth()->user()) }}" class="img-circle" alt="User Image">
  </span>
  <div class="pull-left info">
    <p>{{ backpack_auth()->user()->name }}</p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>
