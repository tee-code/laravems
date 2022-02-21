@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @endif

                @include('components.topactions',['data'=>$roles,'title'=>'Role','route'=>'roles.create', 'searchRoute' => 'roles.index'])

                <div class="card">


                    <div class="card-header bg-primary text-white">{{ __('Assign Permission') }}
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>

                                    <th scope="col">Role</th>

                                    <th scope="col">Permissions</th>

                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>

                                        <td>{{ $role->name ?? "NO_ROLE" }}</td>

                                        <td>{{ collect($role->permissions) }}</td>

                                        <td>
                                            <a href="{{ route('role_permissions.edit', $role->id) }}" class="btn btn-primary"><i class="fas fa-pen fa-sm"></i> Assign</a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center my-3">{{ $roles->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
