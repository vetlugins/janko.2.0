@extends('admin.layout')

@section('breadcrumbs')
  <li>{{ link_to_route('admin', trans ( 'admin_titles.main_title' ) ) }}</li>
  <li>{{ link_to_route('admin.'.$params['route'].'.index', trans ( 'admin_titles.'.$params['route'].'.titles' ) ) }}</li>
  @if ( $params['edit_type'] == 'create' )
  <li class="active">{{ trans('admin_titles.adding') }} </li>
  @else
  <li class="active">{{trans('admin_titles.editing')}} "{{ $items->name }}"</li>
  @endif 
@endsection

@section('header')
    @if ( $params['edit_type'] == 'edit' )
        <a href="{{URL::route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
            <span class="btn-label">{{ HTML::icon('plus'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}
        </a>
    @endif
@endsection

@section('content')
<!-- Main row -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-title">
                @if ( $params['edit_type'] == 'edit' )
                    {{ HTML::icon('edit'); }} Редактирование
                @else
                    {{ HTML::icon('plus'); }} Добавление
                @endif
            </div>
            <div class="box-body">
                @if ( $params['edit_type'] == 'create' )
                  {{ Form::model($items, ['method' => 'post', 'route' => ['admin.'.$params['route'].'.store'], 'files' => true,'class' => 'form-horizontal']) }}
                @else
                  {{ Form::model($items, ['method' => 'put', 'route' => ['admin.'.$params['route'].'.update', $items->id], 'files' => true,'class' => 'form-horizontal']) }}
                @endif

                @include('admin.'.$params['route'].'.edit._form')

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection