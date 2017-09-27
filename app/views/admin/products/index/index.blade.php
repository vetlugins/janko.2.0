@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
    <li>{{ link_to_route( 'admin', trans('admin_titles.main_title') ) }}</li>

    <li class="active">Продукция каталога</li>

@endsection

@section('header')

    <a href="{{URL::route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
        <span class="btn-label">{{ HTML::icon('plus'); }}</span> Добавить продукт
    </a>

@endsection

