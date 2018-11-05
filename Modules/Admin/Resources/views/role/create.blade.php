@extends('backend::layouts.master')
@section('title')
    Create Role
@endsection
@section('content')
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        @include('backend::role._form')

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/js/backend/role/role-vailidate.js') }}"></script>
    <script src="{{ asset('modules/js/backend/role/role.js') }}"></script>
@endpush
