@extends(Theme::getLayout())

@section('subheader')

  <div class="subheader tabs">

    <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}') !important;"></div>
    <div class="background-color"></div>

    {{-- Subheader title (Listings) --}}
    <div class="content">
      {{-- Balance details --}}
      <div class="flex-center-space balance-wrapper">
        {{-- Show available balance --}}
        <div>
          {{-- Available balance --}}
          <span class="balance-count block">{{ money(abs(filter_var(number_format(Auth::user()->balance ,2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}</span>
          {{-- Balance text --}}
          <span class="balance-text">{{ trans('payment.available_balance') }}</span>
        </div>
        {{-- Show sales --}}
        <div class="text-right">
          {{-- Sale count --}}
          <span class="balance-count block">{{ $transactions->where('type','sale')->count() }}</span>
          {{-- Sale text --}}
          <span class="balance-text">{{ trans('payment.sales') }}</span>
        </div>
      </div>
    </div>

    <div class="tabs">
      {{-- Transactions tab --}}
      <a class="tab {{  Request::is('dash/balance') ? 'active' : ''}}"  href="{{url('dash/balance')}}">
        {{ trans('payment.transactions') }}
      </a>

      @if(Auth::user()->balance > 0)
      {{-- Balance tab --}}
      <a class="tab {{  Request::is('dash/balance/withdrawal') || Request::is('dash/balance/withdrawal/bank') ? 'active' : ''}}"  href="{{url('dash/balance/withdrawal')}}">
        {{ trans('payment.withdrawal.withdrawal') }}
      </a>
      @endif

    </div>

  </div>

@stop


@section('content')

  <div class="withdrawal">
    {{-- Payment methods --}}
    <div class="m-b-20">
      <div class="contentselector">
        <div class="selectors">
          @if(config('settings.paypal'))
          {{-- PayPal Method --}}
          <span class="payment-method bg-dark b-r inline-block" id="method-paypal" style="margin-right: 30px">
            <a href="{{url('dash/balance/withdrawal')}}" class="selector {{  Request::is('dash/balance/withdrawal') ? 'active' : ''}}"><i class="fab fa-paypal f-w-500"></i> PayPal</a>
          </span>
          @endif
          <span class="payment-method bg-dark b-r inline-block" id="method-bankaccount">
            <a href="{{url('dash/balance/withdrawal/bank')}}"  class="selector {{  Request::is('dash/balance/withdrawal/bank') ? 'active' : ''}}"><i class="fas fa-money-check"></i> Bank Transfer</a>
          </span>
        </div>
      </div>
    </div>

    @if($tab=='paypal')
    {!! Form::open(array('url'=>'dash/balance/withdrawal', 'id'=>'form-withdrawal' )) !!}
    @elseif($tab=='bank')
    {!! Form::open(array('url'=>'dash/balance/withdrawal/bank', 'id'=>'form-withdrawal' )) !!}
    @endif

    {{-- Start Details Panel --}}
    <section class="panel">
      {{-- Panel Title (Details) --}}
      <div class="panel-heading">
        <h3 class="panel-title">{{ trans('payment.withdrawal.withdrawal_details') }}</h3>
      </div>

      <div class="panel-body">
        @if($tab=='paypal')
        <div class="form-group" id="payment-paypal">
          {{-- PayPal email address label --}}
          <label>
            {{ trans('payment.withdrawal.paypal_email') }} <strong><span class="text-danger">*</span></strong>
          </label>
          @if($errors->has('paypal_email'))
            {{-- Email error msg --}}
            <div class="bg-danger m-b-10 b-r p-10" id="loginfailedFull">
              <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('paypal_email') }}
            </div>
          @endif
          {{-- Input group for paypal address --}}
          <div class="input-group input-group-lg {{$errors->has('paypal_email') ? 'has-error' : '' }}">
            <span class="input-group-addon">
              <span><i class="fab fa-paypal"></i></span>
            </span>
            {{-- PayPal address Input --}}
            {{ Form::input('paypal_email', 'paypal_email', null, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => trans('payment.withdrawal.paypal_email')]) }}
          </div>
        </div>
        @endif
        @if($tab=='bank')
        <div class="form-group" id="payment-bankaccount">
          <div class="input-wrapper">
            {{-- Bank Account First Name label --}}
            <label>
              {{ trans('users.dash.settings.firstname') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('firstname'))
              {{-- First Name error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('firstname') }}
              </div>
            @endif
            {{-- Input group for Bank Account First Name --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-user"></i></span>
              </span>
              {{-- Bank Account First Name Input --}}
              {{ Form::input('text', 'firstname', Auth::user()->bank_firstname, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '']) }}
            </div>
          </div>
          <div class="input-wrapper">
            {{-- Bank Account Last Name label --}}
            <label>
              {{ trans('users.dash.settings.lastname') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('lastname'))
              {{-- Last Name error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('lastname') }}
              </div>
            @endif
            {{-- Input group for Bank Account Last Name --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-user"></i></span>
              </span>
              {{-- Bank Account Last Name Input --}}
              {{ Form::input('text', 'lastname', Auth::user()->bank_lastname, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '', ]) }}
            </div>
          </div>
          <div class="input-wrapper">
            {{-- Bank Account IBAN label --}}
            <label>
              {{ trans('users.dash.settings.iban') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('iban'))
              {{-- IBAN error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('iban') }}
              </div>
            @endif
            {{-- Input group for Bank Account IBAN --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-tags"></i></span>
              </span>
              {{-- Bank Account Last Name Input --}}
              {{ Form::input('text', 'iban', Auth::user()->bank_iban, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '', ]) }}
            </div>
          </div>
          <div class="input-wrapper">
            {{-- Bank Account Swift Code label --}}
            <label>
              {{ trans('users.dash.settings.swiftcode') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('swiftcode'))
              {{-- Swift Code error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('swiftcode') }}
              </div>
            @endif
            {{-- Input group for Bank Account Swift Code --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-barcode"></i></span>
              </span>
              {{-- Bank Account Swift Code Input --}}
              {{ Form::input('text', 'swiftcode', Auth::user()->bank_swiftcode, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '', ]) }}
            </div>
          </div>
          <div class="input-wrapper">
            {{-- Bank Name label --}}
            <label>
              {{ trans('users.dash.settings.bankname') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('bankname'))
              {{-- Bank Name error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('bankname') }}
              </div>
            @endif
            {{-- Input group for Bank Name --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-credit-card"></i></span>
              </span>
              {{-- Bank Account Swift Code Input --}}
              {{ Form::input('text', 'bankname', Auth::user()->bank_name, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '', ]) }}
            </div>
          </div>
          <div class="input-wrapper">
            {{-- Bank Address label --}}
            <label>
              {{ trans('users.dash.settings.bankaddress') }} <strong><span class="text-danger">*</span></strong>
            </label>
            @if($errors->has('bankname'))
              {{-- Bank Address error msg --}}
              <div class="bg-danger m-b-10 b-r p-10">
                <i class="fa fa-times" aria-hidden="true"></i> {{ $errors->first('bankaddress') }}
              </div>
            @endif
            {{-- Input group for Bank Address --}}
            <div class="input-group input-group">
              <span class="input-group-addon">
                <span><i class="fa fa-address-book"></i></span>
              </span>
              {{-- Bank Account Swift Code Input --}}
              {{ Form::textarea('bankaddress', Auth::user()->bank_address, ['class' => 'form-control rounded input-lg inline input', 'placeholder' => '', 'readonly' => '', 'rows' => 3]) }}
            </div>
          </div>
        </div>
        @endif
        <div class="form-group">
          {{-- Amount label --}}
          <label>
            {{ trans('payment.withdrawal.amount') }}
          </label>
          {{-- Withdrawal amount --}}
          <div class="withdrawal-amount">
            {{ money(abs(filter_var(number_format(Auth::user()->balance ,2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}
          </div>
        </div>
      </div>

    </section>
    {{-- Submit button --}}
    <div class="float-right">
      <button class="btn btn-lg btn-success" type="submit" id="submit-button"><i class="fa fa-save"></i> {{ trans('payment.withdrawal.submit_request') }}</button>
    </div>
    {!! Form::close() !!}
  </div>

@section('after-scripts')
<script type="text/javascript">
$(document).ready(function(){
  {{-- Delete submit --}}
  $("#submit-button").click( function(){
    $('#submit-button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
    $('#submit-button').addClass('loading');
    $('#form-withdrawal').submit();
  });
});
</script>

@endsection

@stop
