{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    {{ __('You are logged in!') }}--}}
{{--                        @canany(['role-create', 'role-edit', 'role-delete'])--}}
{{--                            <a class="btn btn-primary" href="{{ route('role.index') }}">--}}
{{--                                <i class="bi bi-person-fill-gear"></i> Manage Roles</a>--}}
{{--                        @endcanany--}}
{{--                        @canany(['user-create', 'user-edit', 'user-delete'])--}}
{{--                            <a class="btn btn-success" href="{{ route('users.index') }}">--}}
{{--                                <i class="bi bi-people"></i> Manage Users</a>--}}
{{--                        @endcanany--}}
{{--                        <p>&nbsp;</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
