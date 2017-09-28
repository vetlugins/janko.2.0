@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
    <li>{{ link_to_route( 'admin', trans('admin_titles.main_title') ) }}</li>

    <li class="active">Фильтр "{{ $filter->title }}"</li>

@endsection

@section('header')


@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-title">
                    Фильтр "{{ $filter->title }}"
                </div>
                <div class="box-body">
                   @include('admin.'.$params['route'].'._includes._'.$filter->type)
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom')

@endsection