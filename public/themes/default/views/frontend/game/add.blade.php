@extends(Theme::getLayout())

@section('subheader')

{{-- Start Subheader --}}
<div class="subheader">
    <div class="background-pattern" style="background-image: url('{{ asset('/img/game_pattern.png') }}');"></div>
    <div class="background-color"></div>
    <div class="content">
        <span class="title"><i class="fa fa-plus"></i> {{ trans('games.add.add_product', ['CategoryName' => $category_name]) }}</span>
    </div>
</div>
{{-- End Subheader --}}

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
    </a> {{-- Dashboard offers quick action --}}
    <a href="{{ url('dash/offers') }}" class="quick-action">
      {{-- Icon with count --}}
      <div class="quick-icon">
        <i class="fa fa-briefcase"></i>@if((count($user->offers->where('status',0)->where('declined',0)) + count($user->offers->where('status',1)->where('declined',0))) > 0)<span class="badge badge-dark badge-sm up">{{count($user->offers->where('status',0)->where('declined',0)) + count($user->offers->where('status',1)->where('declined',0))}}</span>@endif
      </div>
      <div class="quick-text">
        {{ trans('general.offers') }}
      </div>
    </a> {{-- Dashboard wishlist quick action --}}
    <a href="{{ url('dash/wishlist') }}" class="quick-action">
      {{-- Icon --}}
      <div class="quick-icon">
        <i class="fa fa-heart"></i>
      </div>
      <div class="quick-text">
        {{ trans('wishlist.wishlist') }}
      </div>
    </a> {{-- Dashboard messenger quick action --}}
    <a href="{{ url('messages') }}" class="quick-action">
      {{-- Icon with count --}}
      <div class="quick-icon">
        <i class="fas {{ Auth::user()->unreadMessagesCount()>0 ? 'fa-envelope-open' : 'fa-envelope'}}"></i>@if(Auth::user()->unreadMessagesCount()>0)<span class="badge badge-danger badge-sm up">{{Auth::user()->unreadMessagesCount()}}</span> @endif
      </div>
      <div class="quick-text">
        {{ trans('messenger.messenger') }}
      </div>
    </a> {{-- Dashboard notifications quick action --}}
    <a href="{{ url('dash/notifications') }}" class="quick-action">
      {{-- Icon with count --}}
      <div class="quick-icon">
        <i class="fa fa-bell @if(count(Auth::user()->unreadNotifications)>0) faa-shake animated @endif"></i>@if(count(Auth::user()->unreadNotifications)>0)<span class="badge badge-danger badge-sm up">{{count(Auth::user()->unreadNotifications)}}</span> @endif
      </div>
      <div class="quick-text">
        {{ trans('notifications.title') }}
      </div>
    </a> {{-- Dashboard Settings quick action --}}
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

{{-- Open form for product edit --}}
@if(isset($product))
    {!! Form::open(array('url'=>'products/edit', 'id'=>'form-product', 'role'=>'form', 'files' => true )) !!}
    <input name="product_id" type="hidden" value="{{ encrypt($product->id) }}" />
    <input name="redirect" type="hidden" value"{{ url()->previous() }}" />
{{-- Open form for new product  --}}
@else
    {!! Form::open(array('url'=>'products/add', 'id'=>'form-product', 'role'=>'form', 'files' => true )) !!}
@endif

{{-- Start Form --}}
<div class="product-form">
    {{-- Start Details Panel --}}
    <section class="panel">
        {{-- Panel Title (Details) --}}
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-tag m-r-5"></i>{{ trans('listings.form.details_title') }}</h3>
        </div>
        <div class="panel-body">
            <div class="row no-space">
                {{-- Name --}}
                <div class="input-group">
                    <label>
                        {{ trans('games.form.name') }} <strong><span class="text-danger">*</span></strong>
                    </label>
                    <input type="text" class="form-control rounded input-lg inline input" id="name" name="name" placeholder="{{ trans('games.form.placeholder.name', ['CategoryName' => $category_name]) }}" required="required" />
                </div>
                {{-- Description (Summernote) --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.description') }}
                    </label>
                    {!! Form::textarea('description', null, array('class'=>'form-control input', 'placeholder'=>trans('games.form.placeholder.description', ['CategoryName' => $category_name]), 'id' => 'description' )) !!}
                </div>

                {{-- Enable cover generator --}}
                <div class="input-group">
                    <div class="checkbox-custom checkbox-default checkbox-lg">
                        <input type="checkbox" id="cover_generator" name="cover_generator" />
                        <label for="digital">
                            {{ trans('games.form.cover_generator') }}
                        </label>
                    </div>
                </div>
                
                {{-- Start Images Panel --}}
                <section class="panel">
                    {{-- Panel Title (Images) --}}
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-images m-r-5"></i>{{ trans('games.form.image_upload.images') }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="dropzone hidden">
                            <div class="images-empty-messages-holder dz-default dz-message">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <br>{{ trans('games.form.image_upload.empty_message') }}
                            </div>
                            <div class="add-image dz-clickable">
                                <div>
                                    <span class="fa fa-plus"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- End Images Panel --}}
                
                {{-- Release Date --}}
                <div class="input-group">
                    <label>
                        {{ trans('games.form.rlsdate') }} <strong><span class="text-danger">*</span></strong>
                    </label>
                </div>
                <div class="input-group m-t-10">
                    <input type="text" class="form-control rounded input-lg inline input" id="rlsdate" name="rlsdate" required="required">
                    <span class="input-group-addon">
                        <span>
                            <i class="fa fa-calendar-alt"></i>
                        </span>
                    </span>
                </div>
                
                {{-- Publisher --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.publisher') }}
                    </label>
                    <input type="text" class="form-control rounded input-lg inline input" id="publisher" name="publisher" placeholder="{{ trans('games.form.placeholder.publisher', ['CategoryName' => $category_name]) }}" />
                </div>
                
                {{-- Developer --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.developer') }}
                    </label>
                    <input type="text" class="form-control rounded input-lg inline input" id="developer" name="developer" placeholder="{{ trans('games.form.placeholder.developer', ['CategoryName' => $category_name]) }}" />
                </div>
                
                {{-- Pegi --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.pegi') }}
                    </label>
                    <select class="form-control select" id="pegi" name="pegi">
                        <option value>-</option>
                        @foreach($pegis as $pegi_key => $pegi_value)
                        <option value="{{ $pegi_key }}">{{$pegi_value}}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Category --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.category') }}
                    </label>
                    @if (count($categories))
                    <select class="form-control select" id="category_id" name="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @else
                    <select class="form-control select" id="category_id" name="category_id">
                        <option value="{{$category_id}}">None</option>
                    </select>
                    @endif
                </div>
                
                {{-- Genre --}}
                <div class="input-group m-t-10">
                    <label>
                        {{ trans('games.form.genre') }}
                    </label>
                    <select class="form-control select" id="genre_id" name="genre_id">
                        <option value>-</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group m-t-10">
                    <div class="listing-buttons" id="submit_button">
                        <button class="btn btn-lg btn-success" type="submit" id="submit-button"><i class="fa fa-plus"></i>{{ trans('games.add.add_product', ['CategoryName' => $category_name ]) }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Details Panel --}}
</div>
</section>
{{-- End Form --}}

@stop

@section('after-scripts')

<link href="{{ asset('vendor/backpack/summernote/summernote_frontend.css') }}" rel="stylesheet" type="text/css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js"></script>
<script src="{{ asset('js/autoNumeric.min.js') }}"></script>
<script src="{{asset('vendor/backpack/summernote/summernote.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<link href="{{  asset('vendor/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('vendor/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

{{-- Load DropZone JS and CSS files --}}
<script src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>
<link href="{{ asset('vendor/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('vendor/dropzone/Sortable.min.js') }}"></script>
<script src="{{ asset('vendor/dropzone/jquery.binding.js') }}"></script>

<script type="text/javascript">
    Dropzone.autoDiscover = false;
    
    $(document).ready(function() {
        @if(config('settings.picture_upload') || (isset($product) && !is_null($product->picture)))
            {{--Image queue--}}
            var images_queue = [];
            {{--Image queue--}}
            var current_queue = [];
            {{--Dropzone container--}}
            var imageDrop = $(".dropzone");
            {{--Add more images container--}}
            var addMoreImages = $(".add-image");
            
            {{--DropZone Options--}}
            imageDrop.dropzone({
                url: '{{ url(isset($product) ? 'products/' .  $product->id . '/images/upload' : 'products/images/upload')}}',
                clickable: '.add-image, .dropzone',
                maxFiles: 1,
                parallelUploads: 1,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                maxFilesize: 10,
                uploadMultiple: false,
                dictRemoveFile: '<i class="fa fa-trash"></i>',
                dictMaxFilesExceeded: '{{ trans('products.form.image_upload.max_files_exceeded') }}',
                dictInvalidFileType: '{{ trans('products.form.image_upload.invalid_type') }}',
                autoProcessQueue: false,
                sending: function(file, xhr, formData) {
                  formData.append("_token", Laravel.csrfToken);
                },
                complete: function(file, response) {
                    if (file._removeLink) {
                        file._removeLink.innerHTML = this.options.dictRemoveFile;
                    }
                    if (file.previewElement) {
                        return file.previewElement.classList.add("dz-complete");
                    }
                },
                success: function(file, resp) {
                    {{--if (file.upload) {
                        this.removeFile(file);
                        var file = {
                            name: resp.filename,
                            size: '0',
                            status: 'added',
                            accepted: true,
                            order: resp.order
                        };
                        this.emit('addedfile', file);
                        this.emit('success', file,);
                        this.emit('thumbnail', file, resp.thumbnail);
                        this.emit('complete', file, true);
                        this.files.push(file);
                    }--}}
                },
                init: function() {
                    imageDrop.removeClass("hidden")
                    this.on("addedfile", function(file) {
                        imageDrop.children().insertBefore(addMoreImages);
                        
                        if (this.files.length >= this.options.maxFiles) {
                            addMoreImages.addClass("hidden");
                        }
                    });
                    this.on("removedfile", function(file) {
                        if (this.files.length < this.options.maxFiles) {
                            addMoreImages.removeClass("hidden");
                        }
                    });
                    @if(isset($product))
                    $.getJSON('{{ url('products/' . $product->id . '/images') }}', function (data) {
                        $.each(data, function (key, value) {
                            add_image_dz(value);
                        });
                    });
                    @endif
                }
            });
            
            {{-- Dropzone var --}}
            var myDropzone = Dropzone.forElement(".dropzone");
            
            @if(isset($product))
            var add_image_dz = function (resp) {
                // var file = {
                //     name: resp.filename,
                //     size: '0',
                //     status: 'added',
                //     accepted: true,
                //     order: resp.order
                // };
                // myDropzone.emit('addedfile', file);
                // myDropzone.emit('success', file,);
                // myDropzone.emit('thumbnail', file, resp.thumbnail);
                // myDropzone.emit('complete', file, true);
                // myDropzone.files.push(file);
            };
            @endif
            
            {{--Form validator--}}
            $.validate({
                form: '#form-product',
                borderColorOnError: '#00',
                addValidClassOnAll: true,
                validateOnBlur: true,
                scrollToTopOnError: false,
                validateOnEvent: true,
                onSuccess: function($form) {
                    $('#submit-button').attr('disabled', 'disabled');
                    $('#submit-button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                    $(".loading-backdrop").removeClass('hidden');
                    $('#zustand').removeAttr('disabled');
                },
                onError: function($form) {
                    $('#submit-button').shake({
                        speed: 80
                    });
                }
            });
            
            @if(isset($product))
            var add_image_dz = function (resp) {
                // var file = {
                //     name: resp.filename,
                //     size: '0',
                //     status: 'added',
                //     accepted: true,
                //     order: resp.order
                // };
                // myDropzone.emit('addedfile', file);
                // myDropzone.emit('success', file,);
                // myDropzone.emit('thumbnail', file, resp.thumbnail);
                // myDropzone.emit('complete', file, true);
                // myDropzone.files.push(file);
            };
            @endif
            
            @if(!isset($product))
            // Initialize Submit Button
            var submitButton = $('#submit-button');
            var uploading_files = false;
            var product_url;
            var product_id;
            
            // Submit Button Event on click
            $('#form-product').on('submit', function(e) {
                e.preventDefault();
                {{-- Check if form is valid --}}
                if ($(this).isValid()) {
                    var loadingBackdrop = $(".loading-backdrop");
                    // Serialize Form
                    // var form = $('#form-product').serializeArray();
                    // var html = $('#description').code();
                    // form.push({name:'description', value:html});
                    var formData = new FormData();
                    formData.append('name', $('#name').val());
                    formData.append('description', $('#description').code());
                    formData.append('cover_generator', $('#cover_generator').val());
                    formData.append('rlsdate', $('#rlsdate').val());
                    formData.append('publisher', $('#publisher').val());
                    formData.append('developer', $('#developer').val());
                    formData.append('category_id', $('#category_id').val());
                    formData.append('pegi', $('#pegi').val());
                    formData.append('genre_id', $('#genre_id').val());
                    formData.append("_token", Laravel.csrfToken);
                    if (images_queue.length > 0) {
                        for (var i = 0; i < images_queue.length; i++) {
                            let image = images_queue[i];
                            formData.append('image', image);
                            break;
                        }
                    }
                    $.ajax({
                        type: 'POST',
                        url: $('#form-product').attr('action'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            loadingBackdrop.removeClass("hidden");
                        },
                        success: function(data) {
                            console.log(data);
                            product_url = data.url_slug;
                            product_id = data.id;
                            window.location={{ isset($product) ? '"' . $product->url_slug . '"' : 'product_url' }};
                        },
                        error: function(data) {
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            $.each(data.responseJSON.errors, function(key, value ) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + '-error').html(value);
                            });
                            loadingBackdrop.addClass("hidden");
                        }
                    });
                }
            });
            @else
            var uploading_files = false;
            var product_id = {{$product->id}};
            @endif
            
            myDropzone.on('addedfile', function (file, start) {
                if ($.inArray(file.name, current_queue) !== -1) {
                    current_queue.push(file.name);
                    notie.alert('error', '{{ trans('products.form.image_upload.already_exists') }}',5);
                    //errors.html('');
                    myDropzone.removeFile(file);
                } else {
                    // order is already added for existing images onload
                    if (!start) {
                        // add order as last by default
                        file.order = current_queue.length;
                    }
                    current_queue.push(file.name);
                }
                images_queue.push(file);
            });
            
            myDropzone.on('removedfile', function (file) {
                current_queue.splice($.inArray(file.name, current_queue), 1);
                images_queue.splice($.inArray(file, images_queue), 1);
                {{--@if(isset($product))
                sort();
                $.ajax({
                    url: '{{ url('products/' .  $product->id . '/images/remove')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: Laravel.csrfToken,
                        filename: file.name,
                        order: file.order
                    },
                    success: function (data) {
                    }
                });
                @endif--}}
            });
            
            // on sending via dropzone append token and form values (using serializeObject jquery Plugin)
            myDropzone.on("sending", function(file, xhr, formData) {
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('product_id', product_id);
                formData.append('order', file.order);
            });
            
            myDropzone.on("success", function(file) {
                @if(isset($product))
                    sort();
                @endif
                //myDropzone.options.autoProcessQueue = true;
                @if(!isset($product))
                if (myDropzone.getQueuedFiles().length == 0) {
                    window.location=product_url;
                }
                @endif
            });
            
            myDropzone.on("queuecomplete", function(){
                if (uploading_files) {
                    @if(isset($product))
                        window.location="{{ $product->url_slug }}";
                    @else
                        window.location=product_url;
                    @endif
                }
            });
            
            // on error show errors
            myDropzone.on("error", function(file, errorMessage, xhr){
                notie.alert('error', errorMessage, 5);
            });
            
        @endif
        
        {{--Turn description textarea to summernote--}}
        $('#description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol']]
            ],
            height: '150',
            disableDragAndDrop: true
        });
        {{--Turn release date input to datepicker--}}
        $(function() {
            $("#rlsdate").datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
				todayHighlight: true
			});
        });
    });
</script>

@stop