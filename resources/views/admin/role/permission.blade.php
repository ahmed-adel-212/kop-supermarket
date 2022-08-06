@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Asign Permission</h1>
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
                    <h3 class="card-title">Permission Details</h3>
                </div>
                <form action="{{ route('admin.asign.permission' , $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header" id="headingOne"><h2 class="mb-0"><a class="btn btn-link" type="a" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Users</a></h2></div>
                                <div id="collapseOne" class="collapse show show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($users as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwo"><h2 class="mb-0"><a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Roles</a></h2></div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($roles as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree"><h2 class="mb-0"><a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Menu</a></h2></div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($menus as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                              <div class="card">
                                <div class="card-header" id="heading3">
                                    <h2 class="mb-0">
                                        <a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            Offers
                                        </a>
                                    </h2>
                                </div>
                                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($offers as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading4">
                                    <h2 class="mb-0">
                                        <a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            Branches
                                        </a>
                                    </h2>
                                </div>
                                <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($brnaches as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading5">
                                    <h2 class="mb-0">
                                        <a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                            Customers
                                        </a>
                                    </h2>
                                </div>
                                <div id="collapse5" class="collapse show" aria-labelledby="heading5" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($customers as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading6">
                                    <h2 class="mb-0">
                                        <a class="btn btn-link collapsed" type="a" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                            Orders
                                        </a>
                                    </h2>
                                </div>
                                <div id="collapse6" class="collapse show" aria-labelledby="heading6" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($orders as $permission)
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                                    <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

{{--
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-sm-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary'.{{$permission->id}}.'" value="{{$permission->id}}" name="permission[]" {{($role->permissions->contains($permission)) ? 'checked' : ''}}>
                                        <label for="checkboxPrimary'.{{$permission->id}}.'">{{$permission->display_name}}</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}
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
