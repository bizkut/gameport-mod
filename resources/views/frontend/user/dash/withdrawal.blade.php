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
      <a class="tab {{  Request::is('dash/balance/withdrawal') ? 'active' : ''}}"  href="{{url('dash/balance/withdrawal')}}">
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
      {{-- PayPal Method --}}
      <span class="payment-method bg-dark b-r inline-block">
        <i class="fab fa-paypal f-w-500"></i> PayPal
      </span>
    </div>

    {{-- Payment methods --}}
    <div class="m-b-20">
      {{-- PayPal Method --}}
      <span class="payment-method bg-dark b-r inline-block">
        <i class="fas fa-money-check"></i> Bank Transfer
      </span>
    </div>

    {!! Form::open(array('url'=>'dash/balance/withdrawal', 'id'=>'form-withdrawal' )) !!}
    {{-- Start Details Panel --}}
    <section class="panel">

      {{-- Panel Title (Details) --}}
      <div class="panel-heading">
        <h3 class="panel-title">{{ trans('payment.withdrawal.withdrawal_details') }}</h3>
      </div>

      <div class="panel-body">
        <div class="form-group">
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
