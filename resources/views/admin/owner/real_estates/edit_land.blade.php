@extends('layouts.backend-master')
@section('bread')
    <h1>Edit  Land</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('real-estate.get','land')}}"><i class="fa fa-building-o"></i>Lands</a></li>
        <li class="active">Edit Land</li>
    </ol>
@endsection
@section('css_before')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{adminAssets('css/select2.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{adminAssets('css/bootstrap3-wysihtml5.min.css')}}">
    <!-- bootstrap file input -->

    <link rel="stylesheet" href="{{adminAssets('file_input/css/fileinput.css')}}">
    <link rel="stylesheet" href="{{adminAssets('file_input/themes/explorer-fas/theme.css')}}">
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{adminAssets('js/select2.full.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{adminAssets('js/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- bootstrap file input -->



    <script src="{{adminAssets('file_input/js/plugins/piexif.js')}}"></script>
    <script src="{{adminAssets('file_input/js/plugins/sortable.js')}}"></script>
    <script src="{{adminAssets('file_input/js/fileinput.js')}}"></script>
    {{--    <script src="{{adminAssets('file_input/js/locales/fr.js')}}"></script>--}}
    {{--    <script src="{{adminAssets('file_input/js/locales/es.js')}}"></script>--}}
    {{--    <script src="{{adminAssets('file_input/themes/fas/theme.js')}}"  type="text/javascript"></script>--}}
    <script src="{{adminAssets('file_input/themes/fa/theme.js')}}"  type="text/javascript"></script>
    {{--    <script src="{{adminAssets('file_input/themes/explorer-fas/theme.js')}}"  type="text/javascript"></script>--}}






    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5({toolbar: {
                    "font-styles": true, // Font styling, e.g. h1, h2, etc.
                    "emphasis": true, // Italics, bold, etc.
                    "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
                    "html": false, // Button which allows you to edit the generated HTML.
                    "link": false, // Button to insert a link.
                    "image": false, // Button to insert an image.
                    "color": false, // Button to change color of font
                    "blockquote": true, // Blockquote
                }});
        });
        $(document).ready(function (){
            $('#_country').on('change',function (){
                let id=$(this).val();
                $.ajax({
                    url:"{{route('country.state')}}",
                    type: 'GET',  // http method
                    dataType: 'json', // type of response data,
                    data: { id:id  },  // data to submit
                    success: function (data, status, xhr) {
                        let options=$('#put-states-here');
                        options.html('');
                        console.log(data)
                        // options.append(defaultOption);
                        for (item of data) {
                            let option=document.createElement('option');
                            option.innerText=item.name;
                            option.value=item.id;
                            options.append(option)
                        }

                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        // $('p').append('Error' + errorMessage);
                        // console.log(textStatus+errorMessage)
                    }
                });

            });
        });
        $("#images").fileinput({
            theme: 'fas',
            showUpload: false,
            showCaption: false,
            showRemove: true,
            showCancelButton: true,
            showCancel:true,
            browseClass: "btn btn-warning btn-sm",
            removeClass: "btn btn-danger btn-sm",
            allowedFileTypes: ['image'],
            overwriteInitial: false,
            initialPreviewAsData: true,



        });
    </script>
@endsection

@section('content')
    <section >
        <div class="row">

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Land</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('real-estate.update_land',$realEstate->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input  type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder=" Enter The Title" value="{{$realEstate->title}}" >
                                                @error('title')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" class="form-control custom-select"  required>
                                                    <option value="buy"  selected >Buy</option>

                                                </select>
                                                @error('category')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select name="type" class="form-control custom-select"  required>
                                                    <option disabled selected>__SELECT__</option>
                                                    <option value="land"  selected>Land</option>

                                                </select>
                                                @error('type')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input  type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder=" Enter The Address" value="{{$realEstate->address}}" >
                                                @error('address')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select name="country" class="form-control custom-select" id="_country" required>
                                                    <option disabled selected>__select the country__</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}" {{($realEstate->state->country->id == $country->id)?'selected':''}}>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('country')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select name="state" class="form-control custom-select"  id="put-states-here" required>
                                                    @foreach($realEstate->state->country->states as $state)
                                                        <option value="{{$country->id}}" {{($realEstate->state_id== $state->id)?'selected':''}}>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('state')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" min="0"  class="form-control   @error('price') is-invalid @enderror " name="price" placeholder=" Enter The unit Price" value="{{$realEstate->price}}">
                                                @error('price')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="area">Area</label>
                                                <input type="number" min="0" step="1" class="form-control   @error('area') is-invalid @enderror " name="area" placeholder=" Enter The Area" value="{{$realEstate->area}}">
                                                @error('area')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <label>Description</label>
                                    @error('description')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <textarea class="textarea" name="description" placeholder="Place some text here"
                                              style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                              {!! $realEstate->description !!}
                                            </textarea>

                                </div>
                                <div class="col-sm-12">
                                    <label>Images</label>
                                    @error('images')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="form-group">
                                        <div class="file-loading">
                                            <input type="file" style="height: 100px" name="images[]" multiple  id="images"  class="file" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Save</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (Form) -->
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Real Estate Types</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{route('real-estate.create_building')}}"><i class="fa fa-building"></i>Create Building</a></li>
                            {{--                            <li><a href="{{route('real-estate.create_apartment')}}"><i class="fa fa-home"></i>Create Building</a></li>--}}
                            <li><a href="{{route('real-estate.create_land')}}"><i class="fa fa-square-o"></i>Create Land</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>   <!-- /.row -->
    </section>
@endsection
