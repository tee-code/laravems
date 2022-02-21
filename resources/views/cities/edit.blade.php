@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session()->has('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif

                <div class="card">

                    <div class="card-header bg-primary text-white">{{ __('Update City') }}
                        <a class="text-white float-right" href="{{ route('cities.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body">

                        <form

                            id = "edit-user-form"
                            method="POST"
                            action="{{ route('cities.update', $city->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $city->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                                <div class="col-md-6">

                                    <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror"  required autocomplete="state_id">
                                        <option class = "bg-primary p-2 mb-3" value="0" disabled>Select Role</option>
                                        @foreach($states as $state)

                                            <option class = "bg-primary p-2 mb-2 cursor-pointer" value="{{ $state->id }}"

                                            >
                                                {{ $state->name }}
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('state_id')
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


