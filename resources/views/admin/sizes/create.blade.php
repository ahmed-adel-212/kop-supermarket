@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Size</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-size"><a href="{{route('admin.size.index')}}">Back</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Size Details</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.size.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Size Arabic Name</label>
                                    <input type="text" class="form-control {!! $errors->first('name_ar', 'is-invalid') !!}" placeholder="Enter Size Arabic Name" name="name_ar" value="{{ old('name_ar') ?? "" }}">
                                    {!! $errors->first('name_ar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Size English Name</label>
                                    <input type="text" class="form-control {!! $errors->first('name_en', 'is-invalid') !!}" placeholder="Enter Size English Name" name="name_en" value="{{ old('name_en') ?? "" }}">
                                    {!! $errors->first('name_en', '<p class="help-block">:message</p>') !!}
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
// window.onbeforeunload = function () {
//         return 'Are you sure? Your work will be lost. ';
//     };
//     $('.custom-file-input').on('change',function(){
//         //get the file name
//         var fileName = $(this).val();
//         //replace the "Choose a file" label
//         $(this).next('.custom-file-label').html(fileName);
//     })

</script>
@endpush
