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
                            <li class="breadcrumb-item"><a href="{{route('admin.aboutUS.index')}}">Back</a></li>
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
                    <form action="{{ route('admin.aboutUS.update' , $about->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en">Title English</label>
                                        <input type="text"
                                               class="form-control"
                                               id="title_en" placeholder="Enter Title" value="{{$about->title_en}}"
                                               name="title_en">
                                        @error('title_en')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar">Title Arabic</label>
                                        <input type="text"
                                               class="form-control "
                                               id="title_ar" placeholder="Enter Title" value="{{$about->title_ar}}"
                                               name="title_ar">
                                        @error('title_ar')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($about->type === 'feat')
                                    <div class="form-group">
                                        <label for="title_ar">Icon</label>
                                        <input type="text"
                                               class="form-control "
                                               id="title_ar" placeholder="Enter Icon Name" name="icon" value="{{old('icon')}}" >
                                        @error('icon')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group d-flex align-items-center justify-content-center">
                                            select icon from &nbsp; <a href='https://fontawesome.com/v4/icons/' target="_blank">Here</a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar">Type</label>
                                        <select name="type" class="form-control">
                                            @foreach (['first', 'bg-st', 'feat', 'bg-nd', 'emp'] as $ty)
                                                <option value="{{$ty}}" @if(old('type') === $ty) selected @endif @if($about->type === $ty) selected @endif>
                                                    {{__('general.'. $ty)}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @unless ($about->type === 'emp')                                    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_en">Description English</label>
                                        <textarea rows="5" class="form-control p-1" id="description_en"
                                                  placeholder="Enter Description" name="description_en"
                                        >{{$about->description_en}}</textarea>
                                        @error('description_en')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_ar">Description Arabic</label>
                                        <textarea rows="5" class="form-control p-1" id="description_ar"
                                                  placeholder="Enter Description"
                                                  name="description_ar">{{$about->description_ar}}</textarea>
                                        @error('description_ar')
                                        <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endunless
                            </div>
                            <div class="row">
                                @if($about->type === 'emp')
                                <div class="col-12" id="social">
                                    Social Media Links
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="url" class="form-control" id="facebook" placeholder="Enter Facebook Profile Link"
                                                    name="links[]" value="{{isset($about->links[0]) ? $about->links[0] : null}}">
                                                @error('facebook')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="twitter">Twitter</label>
                                                <input type="url" class="form-control" id="twitter" placeholder="Enter Twitter Profile Link"
                                                    name="links[]" value="{{isset($about->links[1]) ? $about->links[1] : null}}">
                                                @error('twitter')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="instgram">Instgram</label>
                                                <input type="url" class="form-control" id="instgram" placeholder="Enter Instgram Profile Link"
                                                    name="links[]" value="{{isset($about->links[2]) ? $about->links[2] : null}}">
                                                @error('instgram')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="behance">Behance</label>
                                                <input type="url" class="form-control" id="behance" placeholder="Enter Behance Profile Link"
                                                    name="links[]" value="{{isset($about->links[3]) ? $about->links[3] : null}}">
                                                @error('behance')
                                                    <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
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
