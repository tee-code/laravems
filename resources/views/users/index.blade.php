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

                @include('components.topactions',['data'=>$users,'title'=>'User','route'=>'users.create', 'searchRoute'=>'users.index'])

                <div class="card">


                    <div class="card-header bg-primary text-white">{{ __('Users') }}
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username ?? "NO_USERNAME"}}</td>
                                        <td>{{ strtoupper($user->last_name) ?? "" }}, {{ ucfirst($user->first_name) ?? "" }}</td>
                                        <td>{{ $user->email ?? "NO_EMAIL" }}</td>
                                        <td>{{ $user->role ?? "NO_ROLE" }}</td>
                                        <td>{!!  $user->permissions ?? "NO_PERMISSION"  !!}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i class="fas fa-pen fa-sm"></i> </a>
                                            <form class = "d-inline" method = "POST" action="{{ route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-sm"></i> </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center my-3">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
