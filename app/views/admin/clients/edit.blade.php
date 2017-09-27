@extends('admin.layout')

@section('breadcrumbs')
  <li>{{ link_to_route( $cur_lang_route.'admin', trans ( 'admin_titles.main_title' ) ) }}<span>→</span></li>
  <li>{{ link_to_route( $cur_lang_route.'admin.'.$params['route'].'.index', trans ( 'admin_titles.'.$params['route'].'.titles' ) ) }}<span>→</span></li>  
  @if ( $params['edit_type'] == 'create' )
  <li class="active">{{ trans('admin_titles.adding') }} </li>
  @else
  <li class="active">{{trans('admin_titles.editing')}} "{{ $item->title }}"</li>
  @endif 
@endsection

@section('header')
  @if ( $params['edit_type'] == 'edit' )
  <h1 class="f-left">{{ HTML::icon('file-text', trans ( 'admin_titles.editing' ) ) }}</h1>    
  <a href="{{URL::route( $cur_lang_route.'admin.'.$params['route'].'.create')}}" class="btn button f-right btn-primary btn-large btn-block">{{ HTML::icon ('plus') }} {{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}</a>  
  @endif  
@endsection

@section('content')
  <div class="row">
  @if ( $params['edit_type'] == 'create' )
  {{ Form::model($item, ['method' => 'post', 'route' => [ $cur_lang_route.'admin.'.$params['route'].'.store'], 'files' => true]) }}
  @else
    {{ Form::model($item, ['method' => 'put', 'route' => [ $cur_lang_route.'admin.'.$params['route'].'.update', $item->id], 'files' => true]) }}
  @endif
     @include('admin.'.$params['route'].'._form')
    {{ Form::close() }}
  </div>
@endsection