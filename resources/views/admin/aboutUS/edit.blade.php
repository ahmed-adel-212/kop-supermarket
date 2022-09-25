@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit AboutUS</h1>
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
                    <form action="{{ route('admin.aboutUS.update', $about->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar">Type</label>
                                        <select name="type" class="form-control">
                                            @foreach (['return', 'about'] as $ty)
                                                <option value="{{ $ty }}"
                                                    @if (old('type') === $ty) selected @endif
                                                    @if ($about->type === $ty) selected @endif>
                                                    {{ __('general.' . $ty) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_en">Description English</label>
                                        <textarea rows="5" class="form-control p-1" id="description_en" placeholder="Enter Description"
                                            name="description_en">{{ $about->description_en }}</textarea>
                                        @error('description_en')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_ar">Description Arabic</label>
                                        <textarea rows="5" class="form-control p-1" id="description_ar" placeholder="Enter Description"
                                            name="description_ar">{{ $about->description_ar }}</textarea>
                                        @error('description_ar')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
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
    </script>
@endpush
