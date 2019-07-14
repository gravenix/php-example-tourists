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

                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header"><h1>{{ __('admin.welcome', ['name' => Auth::user()->name ]) }}</h1></div>
            </div>
        </div>
    </div>
    <users title="{{ __('admin.users') }}"></users>
    <flights title="{{ __('admin.flights') }}"></flights>
    <div class="row justify-content-end">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#adduserModal">{{ __('admin.adduser') }}</a>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addflightModal">{{ __('admin.addflight') }}</a>   
    </div>

    <!-- Modals -->
    @include('admin.modals.adduser')
    @include('admin.modals.addflight')
    @include('admin.modals.editmodal')
</div>
@endsection
