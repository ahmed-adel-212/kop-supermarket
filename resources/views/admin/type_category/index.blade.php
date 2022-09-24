@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Type Categories</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.type_category.create')}}">Add New Type Category</a></li>
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
              <th>Category Name</th>
              <th>Nubmer of Items</th>
              <th>Parent Category</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $index => $category)
            <tr>
              <td>
                {{ $index + 1 }}
              </td>
              <td>
                {{ $category['name_'.app()->getLocale()]}}
                @if ($category->parent == null)
                <i class="fas fa-check-circle text-success"></i>
                @endif
              </td>
              <td>{{ $category->items_count }}</td>
              <td>
                @if ($category->parentSubCategory)
                <a href="{{ route('admin.sub_category.show', $category->parentSubCategory->id) }}" class="btn btn-primary btn-circle btn-sm" title="Show">
                  {{$category->parentSubCategory['name_' . app()->getLocale()]}}
                </a>
                @endif
              </td>
              <td><img src="{{ asset($category->image) }}"class="mg-fluid img-thumbnail"style="max-width: 75px"></td>
              <td>
                <a href="{{ route('admin.type_category.show', $category->id) }}" class="btn btn-primary btn-circle btn-sm" title="Show"><i class="fa fa-globe"></i></a>

                <a href="{{ route('admin.type_category.edit', $category->id) }}" class="btn btn-primary btn-circle btn-sm" title="edit"><i class="fa fa-edit"></i></a>
                <a onclick="deleteCategory('{{ 'delete-category-' . $category->id }}')" href="#" class="btn btn-danger btn-circle btn-sm" title="delete"><i class="fas fa-trash"></i> </a>
                <!-- Form Delete category -->
                <form
                    action="{{ route('admin.type_category.destroy', $category->id) }}"
                    method="POST"
                    id="{{ 'delete-category-' . $category->id }}">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- End Delete category -->
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
        title: 'Are you sure to delete this category ?',
        text: 'Once the category has been deleted you cannot retrieve its data',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('#' + id).submit();
            swal('Category successfully deleted', {
                icon: 'success',
            });
        } else {
            swal('Category undeleted');
        }
    });
  }
</script>
@endpush
