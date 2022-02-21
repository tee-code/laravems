@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>

                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Update Permission') }}
                        <a class="text-white float-right" href="{{ route('permissions.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body">
                        <form

                            id = "edit-user-form"
                            method="POST"
                            action="{{ route('permissions.update', $permission->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Permission Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $permission->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">

                                    <button id = "update-user" type="submit" class="btn btn-primary btn-block">
                                        {{ __('Update') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


