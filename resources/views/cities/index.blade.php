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

                @include('components.topactions',['data'=>$cities,'title'=>'City','route'=>'cities.create', 'searchRoute'=>'cities.index'])

                <div class="card">


                    <div class="card-header bg-primary text-white">{{ __('City') }}
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->id }}</td>
                                        <td>{{ $city->name ?? "NO_NAME"}}</td>
                                        <td>{{ strtoupper($city->state->name) ?? "" }}</td>
                                        <td>
                                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary"><i class="fas fa-pen fa-sm"></i> </a>
                                            <form class = "d-inline" method = "POST" action="{{ route('cities.destroy', $city->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-sm"></i> </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center my-3">{{ $cities->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
