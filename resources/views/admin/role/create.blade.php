@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Role</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Back</a></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Role Details</h3>
            </div>
            <form action="{{ route('admin.role.store') }}" method="POST" id="add-role">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputName"> Name</label>
                      <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Name" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class="help-block">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputDisplayName">Display Name</label>
                      <input type="text" class="form-control" id="exampleInputDisplayName" placeholder="Enter Display Name" value="{{old('display_name')}}" name="display_name">
                        @error('display_name')
                        <div class="help-block">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <textarea class="form-control" name="description" id="exampleInputDescription">{{old('description')}}</textarea>
                    </div>
                  </div>
                    @error('description')
                    <div class="help-block">{{ $message }}</div>
                    @enderror
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
  $(document).ready(() => {
    // $('#add-role').validate({
    //   rules: {
    //     name: "required"
    //   }
    // });
  });

  window.onbeforeunload = function() {
    return 'Are you sure you want to navigate away from this page?';
};



</script>
@endpush
