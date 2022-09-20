@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Size </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.size.create')}}">Add New Size</a></li>
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
                                <th>Name AR</th>
                                <th>Name EN</th>
                                <th>Items Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $size->id }}</td>
                                <td>{{ $size->name_ar }}</td>
                                <td>{{ $size->name_en }}</td>
                                <td>{{ $size->items_count }}</td>
                                {{-- <td><img src="{{ $size->image }}" style="max-width: 75px" ></td> --}}
                                <td>
                                    <a href="{{ route('admin.size.edit', $size->id) }}" class="btn btn-primary btn-circle btn-sm" title="edit"><i class="fa fa-edit"></i></a>
                                    <a onclick="deleteCategory('{{ 'delete-size-' . $size->id }}')" href="#" class="btn btn-danger btn-circle btn-sm" title="delete"> <i class="fas fa-trash"></i></a>
                                    <form action="{{ route('admin.size.destroy', $size->id) }}" method="POST" id="{{ 'delete-size-' . $size->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
                title: 'Are you sure to delete this size ?',
                text: 'Once the size has been deleted you cannot retrieve its data',
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
