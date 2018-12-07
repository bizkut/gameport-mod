<!-- select -->

<div @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label> <br/>

    Available APIs
    <ul class="mailbox-attachments clearfix">
        <li>
          <div class="mailbox-attachment-info">
            <a href="https://zippopotam.us/" target="_blank" class="mailbox-attachment-name">Zippopotam</a>
                <span class="mailbox-attachment-size">
                  @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/zippopotam.blade.php'))
                    <span class="label label-success"><i class="fa fa-check"></i> Installed</span>
                      @if($field['value'] == 'zippopotam')
                        <a href="javascript:void(0)" target="_blank" class="btn btn-default btn-xs pull-right"> <i class="fa fa-cog" aria-hidden="true"></i> Active</a>
                      @endif
                  @else
                    <span class="label label-danger"><i class="fa fa-times"></i> Not Installed</span>
                    <a href="https://www.wiledia.com/gameport/downloads" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                  @endif
                </span>
          </div>
        </li>
        <li>
          <div class="mailbox-attachment-info">
            <a href="https://www.google.com/maps" target="_blank" class="mailbox-attachment-name">Google Maps</a>
                <span class="mailbox-attachment-size">
                  @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/googlemaps.blade.php'))
                    <span class="label label-success"><i class="fa fa-check"></i> Installed</span>
                    @if($field['value'] == 'googlemaps')
                      <a href="javascript:void(0)" target="_blank" class="btn btn-default btn-xs pull-right"> <i class="fa fa-cog" aria-hidden="true"></i> Active</a>
                    @endif
                  @else
                    <span class="label label-danger"><i class="fa fa-times"></i> Not Installed</span>
                    <a href="https://www.wiledia.com/gameport/downloads" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                  @endif
                </span>
          </div>
        </li>
        <li>
          <div class="mailbox-attachment-info">
            <a href="https://www.openstreetmap.org" target="_blank" class="mailbox-attachment-name">OpenStreetMap</a>
                <span class="mailbox-attachment-size">
                  @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/openstreetmap.blade.php'))
                    <span class="label label-success"><i class="fa fa-check"></i> Installed</span>
                    @if($field['value'] == 'openstreetmap')
                      <a href="javascript:void(0)" target="_blank" class="btn btn-default btn-xs pull-right"> <i class="fa fa-cog" aria-hidden="true"></i> Active</a>
                    @endif
                  @else
                    <span class="label label-danger"><i class="fa fa-times"></i> Not Installed</span>
                    <a href="https://www.wiledia.com/gameport/downloads" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                  @endif
                </span>
          </div>
        </li>
    </ul>

    <select
    	name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' =>  'form-control select2'])
    	>
        @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/zippopotam.blade.php'))
          <option value="zippopotam" @if ( ( old($field['name']) && old($field['name']) == 'zippopotam' ) || (isset($field['value']) &&  $field['value'] == 'zippopotam' ) ) selected @endif >
            Zippopotam (Selected countries)
          </option>
        @endif

        @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/googlemaps.blade.php'))
          <option value="googlemaps" @if ( ( old($field['name']) && old($field['name']) == 'googlemaps' ) || (isset($field['value']) &&  $field['value'] == 'googlemaps' ) ) selected @endif >
            Google Maps (Worldwide)
          </option>
        @endif

        @if(file_exists(public_path('themes') . '/default/views/frontend/user/location/openstreetmap.blade.php'))
          <option value="openstreetmap" @if ( ( old($field['name']) && old($field['name']) == 'openstreetmap' ) || (isset($field['value']) &&  $field['value'] == 'openstreetmap' ) ) selected @endif >
            OpenStreetMap (Worldwide)
          </option>
        @endif


	</select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

</div>
