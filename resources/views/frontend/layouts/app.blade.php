<!DOCTYPE html>
<html class="no-js css-menubar{{ !Request::is('games') && !Request::is('listings') ? ' overflow-smooth' : '' }}{{ Request::is('messages') ? ' messages' : '' }}" lang="{{config('settings.default_locale')}}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    {{-- Meta --}}
    @if(config('settings.facebook_client_id') != '')
    <meta property="fb:app_id" content="{{config('settings.facebook_client_id')}}" />
    @endif
    {{-- Add unread notification count in title --}}
    @if(Auth::check())
      @php $unreadMessagesCount = Auth::user()->unreadMessagesCount(); @endphp
    @endif
    {{-- Check if user is logged in and if user have unread notifications --}}
    @if(Auth::check() && (count(Auth::user()->unreadNotifications)>0 || $unreadMessagesCount>0))
      @php
      // Get current SEO title
      $title = SEO::getTitle();
      // Append unread notifications count to meta title
      SEOMeta::setTitle('(' . ((int)count(Auth::user()->unreadNotifications)  + (!Request::is('messages') ? (int)$unreadMessagesCount : 0)) . ') ' . $title);
      @endphp
    @endif
    {{-- Generate SEO tags --}}
    {!! SEO::generate() !!}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg') }}" color="#302f2f">
    {{-- Sitemap --}}
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('sitemap') }}" />
    {{-- OpenSearch --}}
    <link href="{{ url('opensearch.xml') }}" rel="search" title="{{ config('settings.page_name') }} {{ trans('general.nav.search') }}" type="application/opensearchdescription+xml">

    <meta name="theme-color" content="#302f2f">
    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/' . Theme::getCurrent() . '/assets/css/site.css') }}?version=1.4.1">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/notie/notie.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/assets/owl.theme.default.min.css') }}">

    {{-- Fonts --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    {{-- Additional css from settings --}}
    @if(config('settings.css'))
    <style>
      {!! config('settings.css') !!}
    </style>
    @endif
    {{-- Laravel csrfToken for Ajax form headers --}}
    @php
        echo "<script>window.Laravel = " . json_encode(['csrfToken' => csrf_token(),]) . "</script>";
    @endphp
  </head>

  <body class="site-navbar-small">
    {{-- Progress bar for ajax loading --}}
    <nav class="site-navbar navbar navbar-dark navbar-fixed-top navbar-inverse"
    role="navigation" style="{{ (Request::is('games/*') && !Request::is('games/add')) || Request::is('games') || Request::is('user/*') || Request::is('login') || Request::is('password/reset/*') || Request::is('offer/*') || Request::is('listings') || (Request::is('listings/*') && !Request::is('listings/add') && !Request::is('listings/*/add') && !Request::is('listings/*/edit') ) ? 'background: linear-gradient(0deg, rgba(34,33,33,0) 0%, rgba(34,33,33,0.8) 100%);' : 'background-color: rgba(34,33,33,1);' }} -webkit-transition: all .3s ease 0s; -o-transition: all .3s ease 0s; transition: all .3s ease 0s; z-index: 20;">

      {{-- Start header --}}
      <div class="navbar-header">

        {{-- Toggle offcanvas navigation (Mobile only) --}}
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided navbar-toggle offcanvas-toggle"
       data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" id="offcanvas-toggle">
          <span class="sr-only">{{ trans('general.nav.toggle_nav') }}</span>
          <span class="hamburger-bar"></span>
        </button>

        {{-- Toggle sub navigation (Mobile only) --}}
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
        data-toggle="collapse">
          <i class="icon fa fa-ellipsis-h" aria-hidden="true"></i>
        </button>
        {{-- Logo --}}
        <a class="navbar-brand navbar-brand-center" href="{{ url('') }}">
          <img src="{{ asset(config('settings.logo')) }}"
          title="Logo" class="hires">
        </a>

      </div>
      {{-- End header --}}

      {{-- Start Navigation --}}
      <div class="navigation">

        <div class="navbar-container navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas" style="margin-left: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px;">

          <ul class="site-menu" data-plugin="menu">
            {{-- Close button (only offcanvas menu) --}}
            <li class="site-menu-item hidden-md-up">
              <a href="javascript:void(0)" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" id="offcanvas-toggle" class="offcanvas-toggle">
                <i class="site-menu-icon fa fa-times" aria-hidden="true"></i>
                <span class="site-menu-title">{{ trans('general.close') }}</span>
              </a>
            </li>
            {{-- Start listings nav --}}
            <li class="site-menu-item has-sub {{ Request::is('listings/*') || ( URL::current() == url('listings') ) ? 'active': '' }}">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <span class="site-menu-title"><i class="site-menu-icon fa fa-tags" aria-hidden="true"></i> {{ trans('general.listings') }}</span><span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu  site-menu-games">
                <div class="row no-space site-menu-sub">
                  {{-- Start Current Generation Nav --}}
                  <div class="col-xs-12 col-md-4" style="border-right: 1px solid rgba(255,255,255,0.05);">
                    <div class="site-menu-games-title">{{ trans('general.nav.current_generation') }}</div>
                    <ul>
                      <li class="site-menu-item menu-item-game {{ ( URL::current() == url('listings') ) ? 'active' : null }}">
                        <a href="{{ url('listings')}}">
                          <span class="site-menu-title site-menu-fix">{{ trans('listings.general.all_listings') }}</span>
                        </a>
                      </li>
                      <li class="site-menu-item menu-item-game {{ ( URL::current() == url('listings/ps4') ) ? 'active' : null }}">
                        <a href="{{ url('listings/ps4')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation 4</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/xboxone') ) ? 'active' : null }}">
                        <a href="{{ url('listings/xboxone')}}">
                          <span class="site-menu-title site-menu-fix">Xbox One</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/pc') ) ? 'active' : null }}">
                        <a href="{{ url('listings/pc')}}">
                          <span class="site-menu-title site-menu-fix">PC</span>
                        </a>
                      </li>
                      <li class="site-menu-item menu-item-game {{ ( URL::current() == url('listings/switch') ) ? 'active' : null }}">
                        <a href="{{ url('listings/switch')}}">
                          <span class="site-menu-title site-menu-fix">Nintendo Switch</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/wii-u') ) ? 'active' : null }}">
                        <a href="{{ url('listings/wii-u')}}">
                          <span class="site-menu-title site-menu-fix">Wii U</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  {{-- End Current Generation Nav --}}
                  {{-- Start last generation nav --}}
                  <div class="col-xs-12 col-md-4" style="border-right: 1px solid rgba(255,255,255,0.05);">
                    <div class="site-menu-games-title">{{ trans('general.nav.last_generation') }}</div>
                    <ul style="padding: 0; list-style-type: none;">
                      <li class="site-menu-item {{ ( URL::current() == url('listings/ps3') ) ? 'active' : null }}">
                        <a href="{{ url('listings/ps3')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation 3</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/xbox360') ) ? 'active' : null }}">
                        <a href="{{ url('listings/xbox360')}}">
                          <span class="site-menu-title site-menu-fix">Xbox 360</span>
                        </a>
                      </li>
                    </ul>
                    {{-- End last generation nav --}}
                    {{-- Start handhelds nav --}}
                    <div class="site-menu-games-title">{{ trans('general.nav.handhelds') }}</div>
                    <ul>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/3ds') ) ? 'active' : null }}">
                        <a href="{{ url('listings/3ds')}}">
                          <span class="site-menu-title site-menu-fix">Nintendo 3DS</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/vita') ) ? 'active' : null }}">
                        <a href="{{ url('listings/vita')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation Vita</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/ds') ) ? 'active' : null }}">
                        <a href="{{ url('listings/ds')}}">
                          <span class="site-menu-title site-menu-fix">Nintendo DS</span>
                        </a>
                      </li>
                    </ul>
                    {{-- End handhelds nav --}}
                  </div>
                  {{-- Start retro nav --}}
                  <div class="col-xs-12 col-md-4">
                    <div class="site-menu-games-title">{{ trans('general.nav.retro') }}</div>
                    <ul>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/ps2') ) ? 'active' : null }}">
                        <a href="{{ url('listings/ps2')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation 2</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/xbox') ) ? 'active' : null }}">
                        <a href="{{ url('listings/xbox')}}">
                          <span class="site-menu-title site-menu-fix">Xbox</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/ps') ) ? 'active' : null }}">
                        <a href="{{ url('listings/ps')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/wii') ) ? 'active' : null }}">
                        <a href="{{ url('listings/wii')}}">
                          <span class="site-menu-title site-menu-fix">Wii</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/gamecube') ) ? 'active' : null }}">
                        <a href="{{ url('listings/gamecube')}}">
                          <span class="site-menu-title site-menu-fix">Gamecube</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/n64') ) ? 'active' : null }}">
                        <a href="{{ url('listings/n64')}}">
                          <span class="site-menu-title site-menu-fix">Nintendo 64</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/gba') ) ? 'active' : null }}">
                        <a href="{{ url('listings/gba')}}">
                          <span class="site-menu-title site-menu-fix">Game Boy Advance</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/psp') ) ? 'active' : null }}">
                        <a href="{{ url('listings/psp')}}">
                          <span class="site-menu-title site-menu-fix">PlayStation Portable</span>
                        </a>
                      </li>
                      <li class="site-menu-item {{ ( URL::current() == url('listings/dreamcast') ) ? 'active' : null }}">
                        <a href="{{ url('listings/dreamcast')}}">
                          <span class="site-menu-title site-menu-fix">Dreamcast</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  {{-- End retro nav --}}
                </div>
              </div>
            </li>
            {{-- End listings nav --}}
            {{-- Games navbar --}}
            <li class="site-menu-item {{ Request::is('games/*') || ( URL::current() == url('games') ) ? 'active': '' }}">
              <a href="{{ url('games')}}">
                <span class="site-menu-title"><i class="site-menu-icon fa fa-gamepad" aria-hidden="true"></i> {{ trans('general.games') }}</span>
              </a>
            </li>

            {{-- Search navbar --}}
            <li class="site-menu-item">
              <a href="javascript:void(0)" data-toggle="collapse" data-target="#site-navbar-search" role="button" id="navbar-search-open">
                <i class="site-menu-icon fa fa-search hidden-sm-down" aria-hidden="true"></i>
                <span class="site-menu-title hidden-md-down">{{ trans('general.nav.search') }}</span>
              </a>
            </li>
          </ul>
        </div>

        <div class="navbar-container container-fluid userbar">
          <!-- Navbar Collapse -->
          <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->

            {{-- Start Search toggle for mobile view --}}
            <button type="button" class="navbar-toggler collapsed float-left" data-target="#site-navbar-search"
            data-toggle="collapse">
              <span class="sr-only">{{ trans('general.nav.toggle_search') }}</span>
              <i class="icon fa fa-search" aria-hidden="true"></i>
            </button>
            {{-- End Search toggle for mobile view --}}

            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
              {{-- Start User nav --}}
              @if(Auth::check())
                <li class="nav-item dropdown">
                  <a class="nav-link" href="{{ url('messages') }}" title="Messages" role="button" >
                    <i class="fas @if(!Request::is('messages') && $unreadMessagesCount>0) fa-envelope-open @else fa-envelope @endif"></i>
                    {{-- Count unread notifications --}}
                    @if(!Request::is('messages') && $unreadMessagesCount>0)
                      <span id="unread-messages" class="badge badge-danger badge-sm up">{{$unreadMessagesCount}}</span>
                    @endif
                  </a>
                </li>


              <li class="nav-item dropdown" id="dropdown-notifications">
                <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications" role="button" >
                  <i class="icon fa fa-bell @if(count(Auth::user()->unreadNotifications)>0) faa-shake animated @endif" aria-hidden="true"></i>
                  {{-- Count unread notifications --}}
                  @if(count(Auth::user()->unreadNotifications)>0)
                    <span class="badge badge-danger badge-sm up">{{count(Auth::user()->unreadNotifications)}}</span>
                  @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-nofications">
                  <li class="dropdown-notifications-loading">
                    <i class="fa fa-refresh fa-spin fa-2x" aria-hidden="true"></i>
                  </li>
                  <li class="dropdown-notifications-content">
                  </li>
                  {{-- Subscribe to push notifications --}}
                  @if(config('settings.onesignal'))
                  <li class="dropdown-notifications-push-subscribe" id="subscribe-push" style="display:none;">
                    <a href="#" id="subscribe-push-link">
                      <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                  {{ trans('general.nav.user.notifications_push_subscribe') }}
                    </a>
                  </li>
                  @endif
                  {{-- Show all notifications --}}
                  <li class="dropdown-notifications-showall">
                    <a href="{{ url('dash/notifications')}}">
                      <i class="fa fa-bell"></i> {{ trans('general.nav.user.notifications_all') }}
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link navbar-avatar flex-center" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">

                  <span class="avatar avatar-online">
                    {{-- <img src="{{ access()->user()->picture }}"  border=0 width=75/> --}}
                    <img src="{{Auth::user()->avatar_square_tiny}}" alt="{{Auth::user()->name}}" border="0" width="75"><i></i>
                    <i></i>
                  </span>
                  <span class="m-l-5 m-r-10"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                </a>
                <div class="dropdown-menu" role="menu" style="">
                  @can('access_backend')
                  <a class="dropdown-item" href="{{url('admin')}}" role="menuitem"><i class="icon fa fa-id-badge" aria-hidden="true"></i> {{ trans('general.nav.user.admin') }}</a>
                  <div class="dropdown-divider" role="presentation" style="opacity:0.1;"></div>
                  @endcan
                  @if(config('settings.payment'))
                  <a class="dropdown-item" href="{{url('dash/balance')}}" role="menuitem"><i class="icon far fa-money-bill" aria-hidden="true"></i> <strong>{{ money(abs(filter_var(number_format( Auth::user()->balance,2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}</strong></a>
                  <div class="dropdown-divider" role="presentation" style="opacity:0.1;"></div>
                  @endif
                  <a class="dropdown-item" href="{{url('dash')}}" role="menuitem"><i class="icon fa fa-tachometer" aria-hidden="true"></i> {{ trans('general.nav.user.dashboard') }}</a>
                  <a class="dropdown-item" href="{{url('dash/listings')}}" role="menuitem"><i class="icon fa fa-tags" aria-hidden="true"></i> {{ trans('general.nav.user.listings') }}</a>
                  <a class="dropdown-item" href="{{url('dash/offers')}}" role="menuitem"><i class="icon fa fa-briefcase" aria-hidden="true"></i> {{ trans('general.nav.user.offers') }}</a>
                  <a class="dropdown-item" href="{{url('dash/wishlist')}}" role="menuitem"><i class="icon fa fa-heart" aria-hidden="true"></i> {{ trans('wishlist.wishlist') }}</a>
                  <div class="dropdown-divider" role="presentation" style="opacity:0.1;"></div>
                  <a class="dropdown-item" href="{{ url('dash/notifications') }}" role="menuitem"><i class="icon fa fa-bell" aria-hidden="true"></i> {{ trans('general.nav.user.notifications') }}</a>
                  <a class="dropdown-item" href="{{ url('dash/settings') }}" role="menuitem"><i class="icon fa fa-wrench" aria-hidden="true"></i> {{ trans('general.nav.user.settings') }}</a>
                  <a class="dropdown-item" href="{{Auth::user()->url}}" role="menuitem"><i class="icon fa fa-user" aria-hidden="true"></i> {{ trans('general.nav.user.profile') }}</a>
                  <div class="dropdown-divider" role="presentation" style="opacity:0.1;"></div>
                  <a class="dropdown-item" href="{{url('logout')}}" role="menuitem"><i class="icon fa fa-power-off" aria-hidden="true"></i> {{ trans('general.nav.user.logout') }}</a>
                </div>
              </li>

              @endif

              @if(Auth::check())
              {{-- Add Listing Button --}}
              <a href="{{url('listings/add')}}" aria-expanded="false" role="button" class="btn btn-orange btn-round navbar-btn navbar-right" style="font-weight: 500;">
                <i class="fa fa-plus"></i><span class="hidden-md-down"> {{ trans('general.nav.listing_add') }}</span>
              </a>
              @endif

              @if(!Auth::check())
              {{-- Sign Up Button --}}
              <a data-toggle="modal" data-target="#RegModal" href="javascript:void(0)" aria-expanded="false" role="button" class="btn btn-orange btn-round navbar-btn navbar-right" style="font-weight: 500; border-radius: 0px 50px 50px 0px;">
                <i class="fa fa-user-plus"></i>
              </a>
              {{-- Sign in Button --}}
              <a data-toggle="modal" data-target="#LoginModal" href="javascript:void(0)" aria-expanded="false" role="button" class="btn btn-success btn-round navbar-btn navbar-right" style="font-weight: 500; border-radius: 50px 0px 0px 50px">
                <i class="fa fa-sign-in"></i> {{ trans('auth.login') }}
              </a>
              @endif
              {{-- End User nav --}}
            </ul>
          </div>
          <!-- End Navbar Collapse -->
        </div>

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search" style="width: 100%;">
          <form role="search" id="search">
            <div class="form-group">
              <div class="input-search input-search-fix">
                <i class="input-search-icon fa fa-search" aria-hidden="true" id="loadingcomplete"></i>
                <i class="input-search-icon fa fa-sync fa-spin" aria-hidden="true" id="loadingsearch" style="display: none; margin-top: -8px !important;"></i>
                <input type="text" class="form-control" name="input" placeholder="{{ trans('general.nav.search') }}" id="navbar-search" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="button" class="input-search-close icon fa fa-times" data-target="#site-navbar-search"
                data-toggle="collapse" aria-label="Close" id="search-close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
      {{-- End Navigation --}}
    </nav>
    {{-- Start Page--}}
    {{-- Subheader --}}
    @yield('subheader')
    @yield('content-full-width')
    @hasSection('content')
    <div class="page {{ Request::is('listings/*') || Request::is('games/*') ? 'game-overview' : '' }}">
      <div class="page-content container-fluid" >
        {{-- Content --}}
        @yield('content')
      </div>
    </div>
    @endif
    {{-- Breadcrumbs --}}
    @yield('breadcrumbs')
    {{-- End Page --}}
    {{-- Footer --}}
    @if(!Request::is('login') && !Request::is('messages'))
      @include('frontend.layouts.inc.footer')
    @endif
    {{-- Start Login Modal --}}
    @if(!Auth::check())
    <div class="modal fade modal-fade-in-scale-up modal-success" id="LoginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog user-dialog" role="document">
        <div class="modal-content">

          <div class="user-background" style="background: url({{asset('img/game_pattern_white.png')}});"></div>

          <div class="modal-header" >
            <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}');"></div>
            <div class="title flex-center-space">
              {{-- Modal Title (Icon - Sign In) --}}
              <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-sign-in" aria-hidden="true"></i><strong> {{ trans('auth.login') }}</strong>
              </h4>
              {{-- Sign up button next to modal title (Icon - Create Account) --}}
              <div>
                <a data-dismiss="modal" data-toggle="modal" href="#RegModal" class="btn btn-warning btn-round m-r-5 f-w-500"><i class="fa fa-user-plus" aria-hidden="true"></i><span class="hidden-xs-down"> {{ trans('auth.create_account') }}</span></a>
                {{-- Modal close button --}}
                <a href="/#" data-dismiss="modal" class="btn btn-round btn-dark">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="modal-body user-body">
            <div class="row no-space">
              <div class="col-md-6 social">
                <div class="logo">
                  <img src="{{ asset(config('settings.logo')) }}" class="hires" />
                </div>
                <div class="buttons">
                  {{-- Sign in with twitch --}}
                  @if( config('settings.twitch_auth') )
                  <a href="{{ url('login/twitch') }}" class="btn btn-tagged btn-block social-twitch f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-twitch" aria-hidden="true"></i></span> {{ trans('auth.login_twitch') }}
                  </a>
                  @endif
                  {{-- Sign in with steam --}}
                  @if( config('settings.steam_auth') )
                  <a href="{{ url('login/steam') }}" class="btn btn-tagged btn-block social-steam f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-steam" aria-hidden="true"></i></span> {{ trans('auth.login_steam') }}
                  </a>
                  @endif
                  {{-- Sign in with facebook --}}
                  @if( config('settings.facebook_auth') )
                  <a href="{{ url('login/facebook') }}" class="btn btn-tagged btn-block social-facebook f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-facebook" aria-hidden="true"></i></span> {{ trans('auth.login_facebook') }}
                  </a>
                  @endif
                  {{-- Sign in with twitter --}}
                  @if( config('settings.twitter_auth') )
                  <a href="{{ url('login/twitter') }}" class="btn btn-tagged btn-block social-twitter f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-twitter" aria-hidden="true"></i></span> {{ trans('auth.login_twitter') }}
                  </a>
                  @endif
                  {{-- Sign in with gogle+ --}}
                  @if( config('settings.google_auth') )
                  <a href="{{ url('login/google') }}" class="btn btn btn-tagged btn-block social-google-plus f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-google-plus-g" aria-hidden="true"></i></span> {{ trans('auth.login_google') }}
                  </a>
                  @endif
                </div>
              </div>

              <div class="col-md-6 form" id="loginform">
                {{-- Login failed msg --}}
                <div class="bg-danger error" id="loginfailed">
                  <i class="fa fa-times" aria-hidden="true"></i> {{ trans('auth.failed') }}
                </div>

                <form id="loginForm" method="POST" novalidate="novalidate">
                  {{ csrf_field() }}
                  {{-- eMail Adress input --}}
                  <div class="input-group m-b-10">
                    <span class="input-group-addon login-form">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <input id="email" type="email" class="form-control input rounded" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                  </div>
                  {{-- Password input --}}
                  <div class="input-group">
                    <span class="input-group-addon login-form">
                      <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    </span>
                    <input id="password" type="password" class="form-control input" name="password" placeholder="{{ trans('auth.password') }}">
                  </div>
                  {{-- Remember me --}}
                  <div class="checkbox-custom checkbox-default">
                    <input name="remember" id="remember" type="checkbox" />
                    <label for="remember">{{ trans('auth.remember_me') }}</label>
                  </div>
                  {{-- Login button --}}
                  <button type="submit" class="btn btn-success btn-block btn-animate btn-animate-vertical" id="login">
                    <span><i class="icon fa fa-sign-in" aria-hidden="true"></i> {{ trans('auth.login') }}</span>
                  </button>
                  {{-- Forget password --}}
                  <a data-dismiss="modal" data-toggle="modal" href="#ForgetModal" class="btn btn-dark btn-block">{{ trans('auth.password_forgot') }}</a>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Login Modal --}}

    {{-- Start Forget Password Modal --}}
    <div class="modal fade modal-fade-in-scale-up modal-dark" id="ForgetModal" tabindex="-1" role="dialog">
      <div class="modal-dialog user-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-header" >
            <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}');"></div>
            <div class="title">
              {{-- Sign in button --}}
              <a data-dismiss="modal" data-toggle="modal" href="#LoginModal" class="btn btn-success btn-round f-w-500 float-right"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
              <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-unlock" aria-hidden="true"></i>
                <strong> {{ trans('auth.password_forgot') }}</strong>
              </h4>
            </div>
          </div>

          <div class="modal-body user-body">
            <div class="row no-space">
              <div class="col-md-12 form" id="loginform">
                <div class="bg-success error reg" id="forget-success">
                  <i class="fa fa-check"></i> {{ trans('auth.reset.sent') }}
                </div>
                <form id="forgetForm" method="POST" novalidate="novalidate">
                  {{ csrf_field() }}
                  <div class="bg-danger error reg" id="forget-errors-email">
                  </div>
                  {{-- eMail Adress input --}}
                  <div class="input-group m-b-10">
                    <span class="input-group-addon login-form">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <input id="forget-email" type="email" class="form-control input rounded" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                  </div>
                  {{-- Forget password submit button --}}
                  <button type="submit" class="btn btn-dark btn-block btn-animate btn-animate-vertical" id="forget">
                    <span><i class="icon fa fa-unlock" aria-hidden="true"></i> {{ trans('auth.reset.reset_button') }}</span>
                  </button>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Forget Password Modal --}}

    {{-- Start Register Modal --}}
    <div class="modal fade modal-fade-in-scale-up modal-orange" id="RegModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" style="overflow-y: initial !important;">
        <div class="modal-content">

          <div class="user-background" style="background: url({{asset('img/game_pattern_white.png')}});"></div>

          <div class="modal-header" >
            <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}');"></div>
            <div class="title flex-center-space">
              {{-- Title (Create Account) --}}
              <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <strong> {{ trans('auth.create_account') }}</strong>
              </h4>
              <div>
                {{-- Sign in button --}}
                <a data-dismiss="modal" data-toggle="modal" href="#LoginModal" class="btn btn-success btn-round m-r-5 f-w-500"><i class="fa fa-sign-in" aria-hidden="true"></i><span class="hidden-xs-down"> {{ trans('auth.login') }}</a></span>
                {{-- Modal close button --}}
                <a href="/#" data-dismiss="modal" class="btn btn-round btn-dark">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="modal-body user-body">
            <div class="row no-space">
              <div class="col-md-6 form" id="register">
              {{ Form::open(['url' => 'register', 'id' => 'registerForm']) }}
              {{ csrf_field() }}
                <div class="bg-danger error reg" id="register-errors-name">
                </div>
                {{-- Username input --}}
                <div class="input-group m-b-10" id="register-name">
                  <span class="input-group-addon login-form">
                    <i class="fa fa-user" aria-hidden="true"></i>
                  </span>
                  <input id="register-name" type="input" class="form-control input rounded" name="name" placeholder="{{ trans('auth.username') }}">
                </div>
                <div class="bg-danger error reg" id="register-errors-email">
                </div>
                {{-- eMail Adress input --}}
                <div class="input-group m-b-10" id="register-email">
                  <span class="input-group-addon login-form">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                  </span>
                  <input id="register-email" type="email" class="form-control input rounded" name="email" placeholder="{{ trans('auth.email') }}">
                </div>
                <div class="bg-danger error reg" id="register-errors-password">
                </div>
                {{-- Password input --}}
                <div class="input-group m-b-10" id="register-password">
                  <span class="input-group-addon login-form">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                  </span>
                  <input id="register-password" type="password" class="form-control input" name="password" placeholder="{{ trans('auth.password') }}">
                </div>
                {{-- Pasword confirmation input --}}
                <div class="input-group m-b-10" id="register-password-confirm">
                  <span class="input-group-addon login-form">
                    <i class="fa fa-repeat" aria-hidden="true"></i>
                  </span>
                  <input id="register-password-confirmation" type="password" class="form-control input" name="password_confirmation" placeholder="{{ trans('auth.password_confirmation') }}">
                </div>
                {{-- Check if reCAPTCHA is enabled --}}
                @if(config('settings.recaptcha_register'))
                  {{-- Register button (invisible reCaptcha) --}}
                  {!! app('captcha')->display($attributes = ['data-theme'=>'dark'], trans('auth.create_account')); !!}
                @else
                  {{-- Register button --}}
                  <button type="submit" id="register-submit" class="btn btn-orange btn-block btn-animate btn-animate-vertical">
                    <span><i class="icon fa fa-user-plus" aria-hidden="true"></i> {{ trans('auth.create_account') }}</span>
                  </button>
                @endif
              {{ Form::close() }}
              </div>

              <div class="col-md-6 social">
                <div class="logo">
                  <img src="{{ asset(config('settings.logo')) }}" class="hires" />
                </div>
                <div class="buttons">
                  {{-- Sign in with twitch --}}
                  @if( config('settings.twitch_auth') )
                  <a href="{{ url('login/twitch') }}" class="btn btn-tagged btn-block social-twitch f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-twitch" aria-hidden="true"></i></span> {{ trans('auth.login_twitch') }}
                  </a>
                  @endif
                  {{-- Sign in with steam --}}
                  @if( config('settings.steam_auth') )
                  <a href="{{ url('login/steam') }}" class="btn btn-tagged btn-block social-steam f-w-500">
                    <span class="btn-tag"><i class="icon fab fa-steam" aria-hidden="true"></i></span> {{ trans('auth.login_steam') }}
                  </a>
                  @endif
                  {{-- Sign in with facebook --}}
                  @if( config('settings.facebook_auth') )
                  <a href="{{ url('login/facebook') }}" class="btn btn-tagged btn-block social-facebook f-w-500" rel="nofollow">
                    <span class="btn-tag"><i class="icon fab fa-facebook-f" aria-hidden="true"></i></span> {{ trans('auth.login_facebook') }}
                  </a>
                  @endif
                  {{-- Sign in with twitter --}}
                  @if( config('settings.twitter_auth') )
                  <a href="{{ url('login/twitter') }}" class="btn btn-tagged btn-block social-twitter f-w-500" rel="nofollow">
                    <span class="btn-tag"><i class="icon fab fa-twitter" aria-hidden="true"></i></span> {{ trans('auth.login_twitter') }}
                  </a>
                  @endif
                  {{-- Sign in with gogle+ --}}
                  @if( config('settings.google_auth') )
                  <a href="{{ url('login/google') }}" class="btn btn btn-tagged btn-block social-google-plus f-w-500" rel="nofollow">
                    <span class="btn-tag"><i class="icon fab fa-google-plus-g" aria-hidden="true"></i></span> {{ trans('auth.login_google') }}
                  </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Register Modal --}}
    @endif
  </body>
  {{-- Google Searchbox --}}
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "WebSite",
    "name": "{{ config('settings.page_name') }}",
    "url": "{{ url('/') }}",
    "potentialAction": [{
      "@type": "SearchAction",
      "target": "{{ url('search/') }}/{search_term_string}",
      "query-input": "required name=search_term_string"
    }]
  }
  </script>
  {{-- Scripts --}}
  @yield('before-scripts')
  {{-- Vendor JS --}}
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/tether.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script async src="{{ asset('js/bootstrap.offcanvas.js') }}"></script>
  <script async src="{{ asset('js/velocity.min.js') }}"></script>
  <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.lazyload.min.js') }}"></script>
  {{-- Site JS --}}
  <script async src="{{ asset('js/site.js') }}"></script>
  <script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
  {{-- Additional JS from admin panel --}}
  {!! config('settings.js') !!}
  @yield('after-scripts')
  @stack('scripts')
  {{-- OneSignal Push Notifications --}}
  @if(Auth::check() && config('settings.onesignal'))
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
  <script>
    {{-- Init OneSignal --}}
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
      appId: '{{ config('services.onesignal.app_id') }}',
      {{-- Safari Web ID --}}
      @if(config('settings.onesignal_safari_web_id'))
      safari_web_id: '{{ config('settings.onesignal_safari_web_id') }}',
      @endif
      autoRegister: true,
      welcomeNotification: {
          "title": "{{ config('settings.page_name') }}",
          "message": "{{ trans('notifications.push.welcome') }}",
          // "url": ""
      },
      notifyButton: {
        enable: false
      }
    }]);

    {{-- Subscribe function --}}
    function subscribe() {
      OneSignal.push(["registerForPushNotifications"]);
      event.preventDefault();
    }

    OneSignal.push(function() {
      {{-- Check if browser support push notifications --}}
      if (!OneSignal.isPushNotificationsSupported()) {
         return;
      }

      {{-- Show subscribe link, check if user is already subscribed--}}
      OneSignal.isPushNotificationsEnabled(function(isEnabled) {
        if (!isEnabled) {
          document.getElementById("subscribe-push-link").addEventListener('click', subscribe);
          document.getElementById("subscribe-push").style.display = '';
        }
      });

      {{-- Get player id from user --}}
      OneSignal.getUserId(function(playerId) {
          OneSignal.on('subscriptionChange', function (isSubscribed) {
            {{-- User subscribed - save player id to database --}}
            if (isSubscribed) {
                {{-- Get new player id after subscribe --}}
                $("#subscribe-push").hide();
                OneSignal.getUserId(function(playerId) {
                    $.ajax({
                        type:'POST',
                        url:'{{ url('user/push/add') }}',
                        headers: { 'X-CSRF-TOKEN': Laravel.csrfToken },
                        data: {
                            'player_id': playerId
                        }
                    });
                });
            {{-- User unsubscribed - remove player id from database --}}
            } else {
                $.ajax({
                    type:'POST',
                    url:'{{ url('user/push/remove') }}',
                    headers: { 'X-CSRF-TOKEN': Laravel.csrfToken },
                    data: {
                        'player_id': playerId
                    }
                });
            }
          });
      });



    });
  </script>
  @endif

  <script src="{{ asset('js/notie.min.js') }}"></script>
  {{-- Bootstrap Notifications using notie Alerts --}}
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('.col-xs-6').matchHeight();

      @foreach (Alert::getMessages() as $type => $messages)
          @foreach ($messages as $message)
            notie.alert('{{ $type }}', '{!! $message !!}',5)
          @endforeach
      @endforeach
    });
  </script>

  @if(!Auth::check())

  {{-- Start Register Form --}}
  <script>
    var registerForm = $("#registerForm");
    var registerSubmit = $("#register-submit");

    @if(config('settings.recaptcha_register'))
    {{-- execute google recaptcha --}}
    function reCaptcha(token) {
      grecaptcha.execute();
    }
    @endif

    function registerFormSubmit(token) {
      registerForm.submit();
    }

    registerForm.submit(function(e){
      e.preventDefault();
      var formData = registerForm.serialize();
      $( '#register-errors-name' ).html( "" );
      $( '#register-errors-email' ).html( "" );
      $( '#register-errors-password' ).html( "" );
      $( '#register-errors-name' ).slideUp('fast');
      $( '#register-errors-email' ).slideUp('fast');
      $( '#register-errors-password' ).slideUp('fast');
      $('#register-name').removeClass('has-error');
      $('#register-email').removeClass('has-error');
      $('#register-password').removeClass('has-error');
      $('#register-password-confirm').removeClass('has-error');

      $.ajax({
          url:'{{url('register')}}',
          type:'POST',
          data:formData,
          beforeSend: function(){
              registerSubmit.prop( "disabled", true ).html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
          },
          success:function(data){
              $('#registerModal').modal( 'hide' );
              window.location.href=data;
          },
          error: function (data) {
             $('#register').shake({
               speed: 80
             });
             {{-- Reset google recaptcha --}}
             @if(config('settings.recaptcha_register'))
              grecaptcha.reset();
             @endif
             registerSubmit.prop( "disabled", false ).html('{{ trans('auth.create_account') }}');
             var obj = jQuery.parseJSON( data.responseText );
             if(obj.errors.name){
                $('#register-name').addClass('has-error');
                $('#register-errors-name').slideDown('fast');
                $('#register-errors-name').html( obj.errors.name );
              }
              if(obj.errors.email){
                $('#register-email').addClass('has-error');
                $('#register-errors-email').slideDown('fast');
                $('#register-errors-email').html( obj.errors.email );
              }
              if(obj.errors.password){
                $('#register-password').addClass('has-error');
                $('#register-password-confirm').addClass('has-error');
                $('#register-errors-password').slideDown('fast');
                $('#register-errors-password').html( obj.errors.password );
              }
          }
      });
    });
  </script>
  {{-- End Register Form --}}

  <script>

  @if(config('settings.locate_position'))
  {{-- Save geolocation --}}
  function saveLocation(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      $.ajax({
          type:'POST',
          url:'{{ url('geolocation/save') }}',
          headers: { 'X-CSRF-TOKEN': Laravel.csrfToken },
          data: {
              'latitude': latitude,
              'longitude': longitude
          }
      });
  }
  @endif

  $(document).ready(function(){

    @if(config('settings.locate_position') && !session()->has('latitude') && !session()->has('longitude'))
    {{-- Get current position --}}
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(saveLocation);
    }
    @endif

    {{-- Login Form --}}
    var loginForm = $("#loginForm");
    var loginSubmit = $("#login");
    loginForm.submit(function(e){
        e.preventDefault();
        var formData = loginForm.serialize();

        $.ajax({
            url:'{{ url("login") }}',
            type:'POST',
            data:formData,
            beforeSend: function(){
                $("#loginfailed").slideUp();
                loginSubmit.prop( "disabled", true ).html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
            },
            success:function(data){
                $("#loginform").shake({
                  direction: "up",
                  speed: 80
                });
                window.location.href=data;
            },
            error: function (data) {
                $("#loginform").shake({
                  speed: 80
                });
                $("#loginfailed").slideDown();
                loginSubmit.prop( "disabled", false ).html('{{ trans('auth.login') }}');
            }
        });
    });
    {{-- Forget Password Form --}}
    var forgetForm = $("#forgetForm");
    forgetForm.submit(function(e){
        e.preventDefault();
        var formData = forgetForm.serialize();
        $('#forget-errors-email').html('');
        $('#forget-errors-email').slideUp('fast');
        $('#forget-email').removeClass('has-error');
        $.ajax({
            url:'{{url('password/email')}}',
            type:'POST',
            data:formData,
            success:function(data){
              $('#forgetForm').slideUp('fast');
              $('#forget-success').slideDown('fast');
            },
            error: function (data) {
              console.log(data.responseText);
              var obj = jQuery.parseJSON( data.responseText );
              if(obj.email){
                $('#forget-email').addClass('has-error');
                $('#forget-errors-email').slideDown('fast');
                $('#forget-errors-email').html( obj.email );
              }
            }
        });
    });
  });
  </script>
  @endif

  {{-- Start navbar typeahead search --}}
  <script type="text/javascript">
  $(document).ready(function(){
    @if(Auth::check())
    {{-- Load notifications on dropdown click --}}
    $('#dropdown-notifications').on('show.bs.dropdown', function () {
      if($('.dropdown-notifications-content' ).children().length == 0){
        $.ajax({
            url:'{{ url("dash/notifications/api") }}',
            type:'GET',
            success:function(data){
              $('.dropdown-notifications-loading').fadeOut('fast', function() {
                $('.dropdown-notifications-content' ).hide().html(data).fadeIn('fast');
              });
            },
            error: function (data) {
              alert('Oops, an error occurred!')
            }
        });
      }
    })
    @endif

    @if((Request::is('games/*') && !Request::is('games/add') ) || Request::is('games') || Request::is('user/*') || Request::is('login') || Request::is('password/reset/*') || Request::is('offer/*') || Request::is('listings') || (Request::is('listings/*') && !Request::is('listings/add') && !Request::is('listings/*/add') && !Request::is('listings/*/edit') ))
    {{-- Scroll function for navbar --}}
    var scroll = function () {
      if(lastScrollTop >= 30){
        $('.site-navbar').css('background-color','rgba(34,33,33,1)');
        $(".sticky-header").removeClass('slide-up')
        $(".sticky-header").addClass('slide-down')
      }else{
        $('.site-navbar').css('background','linear-gradient(0deg, rgba(34,33,33,0) 0%, rgba(34,33,33,0.8) 100%)');
      }
    };
    var raf = window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        window.oRequestAnimationFrame;
    var $window = $(window);
    var lastScrollTop = $window.scrollTop();

    if (raf) {
        loop();
    }

    function loop() {
        var scrollTop = $window.scrollTop();
        if (lastScrollTop === scrollTop) {
            raf(loop);
            return;
        } else {
            lastScrollTop = scrollTop;

            // fire scroll function if scrolls vertically
            scroll();
            raf(loop);
        }
    }
    @endif

    {{-- Focus search input on collapse --}}
    $(document).on('click', '[data-toggle="collapse"]', function(e) {
      $('#navbar-search').focus();
    });
    {{-- Redirect to search results when user click enter button --}}
    $('#navbar-search').keypress(function(e) {
      if(e.which == 13){
        e.preventDefault();
        if($('#navbar-search').val() != "")
          window.location.href = {!! '"' . url('/search/') . '/"'!!} + $('#navbar-search').val();
      }
    });
    {{-- Bloodhound engine with remote search data in json format --}}
    var gameSearch = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      sorter: false,
      remote: {
        url: '{{ url("games/search/json/%QUERY") }}',
        wildcard: '%QUERY'
      }
    });
    {{-- Typeahead with data from bloodhound engine --}}
    $('#navbar-search').typeahead(null, {
      name: 'navbar-search',
      display: 'name',
      source: gameSearch,
      highlight: true,
      limit:6,
      templates: {
        empty: [
          '<div class="nosearchresult bg-danger" >',
            '<span><i class="fa fa-ban"></i> {{ trans('general.nav.search_empty') }}<span>',
          '</div>'
        ].join('\n'),
        suggestion: function (data) {
            var price;
            if(data.cheapest_listing != '0') {
              cheapest_listing = '<span class="price"> {{ trans('general.nav.starting_from')}} <strong>' + data.cheapest_listing + '</strong></span>';
            }else{
              cheapest_listing = '';
            }

            if(data.listings != '0') {
              listings = '<span class="listings-label"><i class="fa fa-tags"></i> ' + data.listings + '</span>';
            }else{
              listings = '';
            }
            return '<div class="searchresult navbar"><a href="' + data.url + '"><div class="inline-block m-r-10"><span class="avatar"><img src="' + data.pic + '" class="img-circle"></span></div><div class="inline-block"><strong class="title">' + data.name + '</strong><span class="release-year m-l-5">' + data.release_year +'</span><br><small class="text-uc text-xs"><span class="platform-label" style="background-color: ' + data.platform_color + ';">' + data.platform_name + '</span> ' + listings + ''+ cheapest_listing +'</small></div></a></div>';
        }
      }
    })
    .on('typeahead:asyncrequest', function() {
        $('.input-search').removeClass('input-search-fix');
        $('#loadingcomplete').hide();
        $('#loadingsearch').show();
    })
    .on('typeahead:asynccancel typeahead:asyncreceive', function() {
        $('#loadingsearch').hide();
        $('#loadingcomplete').show();
    });
    {{-- Reset input and add search-fix class on closing --}}
    $( "#search-close" ).click(function() {
        $('.input-search').addClass('input-search-fix');
        $('#navbar-search').typeahead('val', '');
    });
  })
  </script>
  {{-- End navbar typeahead search --}}

  @if(!Auth::check())
  <script type="text/javascript">
  (function($) {
    $.fn.shake = function(o) {
      if (typeof o === 'function')
        o = {callback: o};
      // Set options
      var o = $.extend({
        direction: "left",
        distance: 20,
        times: 3,
        speed: 140,
        easing: "swing"
      }, o);

      return this.each(function() {

        // Create element
        var el = $(this), props = {
          position: el.css("position"),
          top: el.css("top"),
          bottom: el.css("bottom"),
          left: el.css("left"),
          right: el.css("right")
        };

        el.css("position", "relative");

        // Adjust
        var ref = (o.direction == "up" || o.direction == "down") ? "top" : "left";
        var motion = (o.direction == "up" || o.direction == "left") ? "pos" : "neg";

        // Animation
        var animation = {}, animation1 = {}, animation2 = {};
        animation[ref] = (motion == "pos" ? "-=" : "+=")  + o.distance;
        animation1[ref] = (motion == "pos" ? "+=" : "-=")  + o.distance * 2;
        animation2[ref] = (motion == "pos" ? "-=" : "+=")  + o.distance * 2;

        // Animate
        el.animate(animation, o.speed, o.easing);
        for (var i = 1; i < o.times; i++) { // Shakes
          el.animate(animation1, o.speed, o.easing).animate(animation2, o.speed, o.easing);
        };
        el.animate(animation1, o.speed, o.easing).
        animate(animation, o.speed / 2, o.easing, function(){ // Last shake
          el.css(props); // Restore
          if(o.callback) o.callback.apply(this, arguments); // Callback
        });
      });
    };
  })(jQuery);
  </script>
  @endif
</html>
