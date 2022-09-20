@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Color </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.color.create')}}">Add New Color</a></li>
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
                                <th>Color & code</th>
                                <th>Items Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name_ar }}</td>
                                <td>{{ $color->name_en }}</td>
                                <td>
                                    <div style="padding: 10px;background-color: #{{ $color->code }}"></div>
                                    #{{ $color->code }}
                                </td>
                                <td>{{ $color->items_count }}</td>
                                {{-- <td><img src="{{ $color->image }}" style="max-width: 75px" ></td> --}}
                                <td>
                                    <a href="{{ route('admin.color.edit', $color->id) }}" class="btn btn-primary btn-circle btn-sm" title="edit"><i class="fa fa-edit"></i></a>
                                    <a onclick="deleteCategory('{{ 'delete-color-' . $color->id }}')" href="#" class="btn btn-danger btn-circle btn-sm" title="delete"> <i class="fas fa-trash"></i></a>
                                    <form action="{{ route('admin.color.destroy', $color->id) }}" method="POST" id="{{ 'delete-color-' . $color->id }}">
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
                title: 'Are you sure to delete this color ?',
                text: 'Once the color has been deleted you cannot retrieve its data',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#' + id).submit();
                    swal('Color successfully deleted', {
                        icon: 'success',
                    });
                } else {
                    swal('Color undeleted');
                }
            });
        }

    </script>
    @endpush
