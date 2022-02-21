
@extends('layouts.dashboard')

@section('content')
    <div id="app" class="col-12">
        <router-view class="view">
            <employee-index></employee-index>
        </router-view>
    </div>
@endsection
