@extends('admin::layouts.master')
@section('title')
    View Role
@endsection

@section('content')

    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    {{--<section class="content-header">--}}
    {{--</section>--}}
    <!-- Main content -->
        @include('admin::role._form')
    </div>
@endsection

