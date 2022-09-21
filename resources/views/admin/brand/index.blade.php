@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Brands</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.brand.create')}}">Add New Category</a></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card-body">
        <table class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Brand Name</th>
              <th>Nubmer of Items</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($brands as $index => $brand)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $brand['name_'.app()->getLocale()]}}</td>
              <td>{{ $brand->items()->count() }}</td>
              <td><img src="{{ asset($brand->image) }}"class="mg-fluid img-thumbnail"style="max-width: 75px"></td>
              <td>
                <a href="{{ route('admin.brand.show', $brand->id) }}" class="btn btn-primary btn-circle btn-sm" title="Show"><i class="fa fa-globe"></i></a>

                <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-primary btn-circle btn-sm" title="edit"><i class="fa fa-edit"></i></a>
                <a onclick="deleteCategory('{{ 'delete-brand-' . $brand->id }}')" href="#" class="btn btn-danger btn-circle btn-sm" title="delete"><i class="fas fa-trash"></i> </a>
                <!-- Form Delete brand -->
                <form
                    action="{{ route('admin.brand.destroy', $brand->id) }}"
                    method="POST"
                    id="{{ 'delete-brand-' . $brand->id }}">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- End Delete brand -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection
@push('js')
<script type="text/javascript">
  function deleteCategory(id) {
    event.preventDefault();
    swal({
        title: 'Are you sure to delete this brand ?',
        text: 'Once the brand has been deleted you cannot retrieve its data',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('#' + id).submit();
            swal('Brand successfully deleted', {
                icon: 'success',
            });
        } else {
            swal('Brand undeleted');
        }
    });
  }
</script>
@endpush
