@section('subheader')

  <div class="subheader">

    <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}') !important;"></div>
    <div class="background-color"></div>
    {{-- Settings title --}}
    <div class="content">
      <span class="title"><i class="fa fa-wrench"></i> {{ trans('users.dash.settings.settings') }}</span>
    </div>

  </div>

@stop
