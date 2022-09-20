@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Item {{ $item->id }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.item.index') }}">Back</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Item Details</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.item.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2 {!! $errors->first('category_id', 'is-invalid') !!}" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (old('category_id') == $category->id or $item->category_id == $category->id) selected @endif>
                                                    {{ $category['name_' . app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputRole">Hide In</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select a Branch" style="width: 100%;" name="branches[]">
                                        @foreach ($sizes as $userBranch)
                                        @if (in_array($userBranch->id, $itemBranches))
                                        <option value="{{ $userBranch->id }}" selected>{{ $userBranch->name_ar }}</option>
                                        @else
                                        <option value="{{ $userBranch->id }}">{{ $userBranch->name_ar }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item Arabic Name</label>
                                        <input type="text" class="form-control {!! $errors->first('name_ar', 'is-invalid') !!}"
                                            placeholder="Enter Item Arabic Name" name="name_ar"
                                            value="{{ old('name_ar') ?? $item->name_ar }}">
                                        {!! $errors->first('name_ar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item English Name</label>
                                        <input type="text" class="form-control {!! $errors->first('name_en', 'is-invalid') !!}"
                                            placeholder="Enter Item English Name" name="name_en"
                                            value="{{ old('name_en') ?? $item->name_en }}">
                                        {!! $errors->first('name_en', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Arabic Description</label>
                                        <textarea class="form-control {!! $errors->first('description_ar', 'is-invalid') !!}" placeholder="Enter Item Arabic Description"
                                            name="description_ar">{{ old('description_ar') ?? $item->description_ar }}</textarea>
                                        {!! $errors->first('description_ar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item English Description</label>
                                        <textarea class="form-control {!! $errors->first('description_en', 'is-invalid') !!}" placeholder="Enter Item English Description"
                                            name="description_en">{{ old('description_en') ?? $item->description_en }}</textarea>
                                        {!! $errors->first('description_en', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Item Price</label>
                                        <input type="number" step="any" class="form-control {!! $errors->first('price', 'is-invalid') !!}"
                                            placeholder="Enter Item Price" name="price"
                                            value="{{ old('price') ?? $item->price }}">
                                        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Calories</label>
                                    <input type="number" class="form-control {!! $errors->first('calories', 'is-invalid') !!}" placeholder="Enter Item Calories" name="calories" value="{{ old('calories') ?? $item->calories }}">
                                    {!! $errors->first('calories', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mobile Image</label>
                                        <div class="help-block text-info">
                                            .
                                        </div>
                                        <img src="{{ $item->image }}" class="img-thumbnail" style="width: 150px;" />
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input {!! $errors->first('image', 'is-invalid') !!}"
                                                    name="image" value="{{ old('image') }}">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website Image</label>
                                        <div class="help-block text-info">
                                            <b>Note</b> Image Dimensions Must Be: 300 * 300
                                        </div>
                                        <img src="{{ asset($item->image) }}" class="img-thumbnail" style="width: 150px;" />

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input {!! $errors->first('website_image', 'is-invalid') !!}"
                                                    name="website_image" value="{{ old('website_image') }}">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                        {!! $errors->first('website_image', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputRole">Item Sizes</label>
                                        <select class="select2" multiple="multiple" data-placeholder="Select a Size"
                                            style="width: 100%;" name="sizes[]">
                                            @foreach ($sizes as $size)
                                                @if (in_array($size->id, $itemSizes))
                                                    <option value="{{ $size->id }}" selected>
                                                        {{ $size['name_' . app()->getLocale()] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $size->id }}">
                                                        {{ $size['name_' . app()->getLocale()] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="colors">Item Colors</label>
                                        <select class="select2" id="colors" multiple="multiple"
                                            data-placeholder="Select a Color" style="width: 100%;" name="colors[]">
                                            @foreach ($colors as $color)
                                                @if (in_array($color->id, $itemColors))
                                                    <option value="{{ $color->id }}" selected>
                                                        {{ $color['name_' . app()->getLocale()] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $color->id }}">
                                                        {{ $color['name_' . app()->getLocale()] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="images">
                                        @foreach ($itemColorsAll as $col)
                                        <div class="row color-image color-name-{{$col->name_en}}" data-color-id="` + color.id + `">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{$col['name_' . app()->getLocale()]}} color Image</label>
                
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="color_images[]" value="{{$col->image}}">
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
                </form>
            </div>
    </div>
    </section>
    </div>
@endsection

@push('js')
    <script>
        window.onbeforeunload = function() {
            return 'Are you sure? Your work will be lost. ';
        };
        $('.custom-file-input').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

        $(document).ready(function() {
            var colors = JSON.parse('{!! json_encode($colors->toArray()) !!}');
            $(document).on('change', '#colors', function() {
                var ids = $(this).val();
                for (var i = 0; i < ids.length; i++) {
                    var color = colors.find(x => x.id == ids[i]);

                    if ($('.color-name-' + color.name_en).length > 0) {
                        continue;
                    }

                    $('#images').append(`
                        <div class="row color-image color-name-` + color.name_en + `" data-color-id="` + color.id + `">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>` + color['name_{{ app()->getLocale() }}'] + ` color Image</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                name="color_images[]" value="">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }

                // remove elements not existed in list
                $('.color-image').each(function(inx, el) {
                    if (ids.indexOf($(el).attr('data-color-id')) < 0) {
                        $(el).remove();
                    }
                });
            });
        });
    </script>
@endpush
