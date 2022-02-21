@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>

                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Assign Permission') }}
                        <a class="text-white float-right" href="{{ route('role_permissions.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body">
                        <form

                            id = "edit-user-form"
                            method="POST"
                            action="{{ route('role_permissions.update', $role->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $role->name) }}" required autocomplete="name" disabled="true">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                                <div class="col-md-8">
                                    <select name="permissions[]" id="permissions" class="form-control @error('name') is-invalid @enderror"  required autocomplete="name" multiple>
                                        <option class = "bg-primary p-2 mb-3" value="0" disabled>Select Permissions</option>
                                        @foreach($permissions as $permission)
                                            <option class = "bg-primary p-2 mb-1 cursor-pointer" value="{{ $permission->id }}"
                                                @php
                                                    if(in_array($permission->id, $role_with_permission)){ echo "selected"; }
                                                @endphp>
                                                {{ $permission->name }}
                                            </option>

                                        @endforeach
                                    </select>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    <button id = "update-user" type="submit" class="btn btn-primary btn-block">
                                        {{ __('Assign') }}
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


