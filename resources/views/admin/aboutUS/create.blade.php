@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New AboutUS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.aboutUS.index') }}">Back</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">AboutUS Details</h3>
                    </div>
                    <form action="{{ route('admin.aboutUS.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en">Title English</label>
                                        <input type="text" class="form-control" id="title_en" placeholder="Enter Title"
                                            name="title_en" value="{{ old('title_en') }}">
                                        @error('title_en')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar">Title Arabic</label>
                                        <input type="text" class="form-control " id="title_ar" placeholder="Enter Title"
                                            name="title_ar" value="{{ old('title_ar') }}">
                                        @error('title_ar')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon</label>
                                        <input type="text" class="form-control " id="icon"
                                            placeholder="Enter Icon Name" name="icon" value="{{ old('icon') }}"
                                            readonly>
                                        @error('icon')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group d-flex align-items-center justify-content-center">
                                            select icon from &nbsp; <a href='https://fontawesome.com/v4/icons/'
                                                target="_blank">Here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            @foreach (['first', 'bg-st', 'feat', 'bg-nd', 'emp'] as $ty)
                                                <option value="{{ $ty }}"
                                                    @if (old('type') === $ty) checked @endif>
                                                    {{ __('general.' . $ty) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="description">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_en">Description English</label>
                                        <textarea rows="5" class="form-control p-1" id="description_en" placeholder="Enter Description"
                                            name="description_en">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_ar">Description Arabic</label>
                                        <textarea rows="5" class="form-control p-1" id="description_ar" placeholder="Enter Description"
                                            name="description_ar">{{ old('description_ar') }}</textarea>
                                        @error('description_ar')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input {!! $errors->first('image', 'is-invalid') !!}"
                                                id="exampleInputFile" name="image" value="{{ old('image') }}">
                                            @error('image')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="social" style="display: none">
                                    Social Media Links
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="url" class="form-control" id="facebook" placeholder="Enter Facebook Profile Link"
                                                    name="links[]" value="{{ old('links[0]') }}">
                                                @error('facebook')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="twitter">Twitter</label>
                                                <input type="url" class="form-control" id="twitter" placeholder="Enter Twitter Profile Link"
                                                    name="links[]" value="{{ old('twitter') }}">
                                                @error('twitter')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="instgram">Instgram</label>
                                                <input type="url" class="form-control" id="instgram" placeholder="Enter Instgram Profile Link"
                                                    name="links[]" value="{{ old('instgram') }}">
                                                @error('instgram')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="behance">Behance</label>
                                                <input type="url" class="form-control" id="behance" placeholder="Enter Behance Profile Link"
                                                    name="links[]" value="{{ old('behance') }}">
                                                @error('behance')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
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
    @push('js')
        <script>
            $(document).ready(function() {
                $('#type').on('change', function() {
                    let type = $(this).val();

                    if (type === 'feat') {
                        $('#icon').removeAttr('readonly');
                    } else {
                        $('#icon').attr('readonly', true);
                    }

                    if (type === 'emp') {
                        $('#social').css('display', 'block');
                        $('#description').css('display', 'none');
                    } else {
                        $('#social').css('display', 'none');
                        $('#description').css('display', 'block');
                    }
                });
            });
        </script>
    @endpush
@endsection
