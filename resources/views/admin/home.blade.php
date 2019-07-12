@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>

                        You are logged in!
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('admin.welcome', ['name' => Auth::user()->name ]) }}</div>
                <div class="card-body">
                    <h2> {{ __('admin.aboutyou') }}</h2>
                    <p>{{ Auth::user()->name . ' ' . Auth::user()->lastname }}<br/>
                    {{ Auth::user()->country }}</p>
                </div>
            </div>
        </div>
    </div>
    <users title="{{ __('admin.users') }}"></users>
    <flights title="{{ __('admin.flights') }}"></flights>
</div>
@endsection
