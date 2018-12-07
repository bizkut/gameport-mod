<!-- select -->

<div @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label>

    <select
    	name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' =>  'form-control select2'])
    	>

      @php $languages = \App\Models\Language::all(); @endphp
        @foreach($languages as $language)

            <option value="{{$language->abbr}}"
            @if ( ( old($field['name']) && old($field['name']) == $language->abbr ) || (isset($field['value']) && $language->abbr==$field['value']))
               selected
            @endif
            >{{$language->name}} ({{$language->native}})</option>
        @endforeach


	</select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
  {{-- FIELD CSS - will be loaded in the after_styles section --}}
  @push('crud_fields_styles')
      <!-- include select2 css-->
      <link href="{{ asset('vendor/backpack/select2/select2.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('vendor/backpack/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />
  @endpush

  {{-- FIELD JS - will be loaded in the after_scripts section --}}
  @push('crud_fields_scripts')
      <!-- include select2 js-->
      <script src="{{ asset('vendor/backpack/select2/select2.js') }}"></script>
      <script>
          jQuery(document).ready(function($) {
              // trigger select2 for each untriggered select2 box
              $('.select2').each(function (i, obj) {
                  if (!$(obj).data("select2"))
                  {
                      $(obj).select2();
                  }
              });
          });
      </script>
  @endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
