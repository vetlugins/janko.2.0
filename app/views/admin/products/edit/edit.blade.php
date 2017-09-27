@extends('admin.layout')

@section('breadcrumbs')
    <li>{{ link_to_route('admin', trans ( 'admin_titles.main_title' ) ) }}</li>
    <li>{{ link_to_route('admin.'.$params['route'].'.index', 'Каталог продукции' ) }}</li>
    @if ( $edit_type == 'create' )
        <li class="active">{{ trans('admin_titles.adding') }} </li>
    @else
        <li class="active">{{trans('admin_titles.editing')}} "{{ $item->title }}"</li>
    @endif
@endsection

@section('header')
    @if ( $edit_type == 'edit' )
        <a href="{{route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
            <span class="btn-label">{{ HTML::icon('plus'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}
        </a>

        <a href="{{route('admin.photos.index', [$params['model'], $item->id] ) }}" class="btn btn-labeled btn-info pull-right margin-right-xs">
            <span class="btn-label">{{ HTML::icon('camera'); }}</span> Фотографии
        </a>
    @endif
@endsection

@section('content')
    <div class="row">
        @if ( $edit_type == 'create' )
            {{ Form::model($item, ['method' => 'post', 'route' => ['admin.'.$params['route'].'.store'], 'files' => true]) }}
        @else
            {{ Form::model($item, ['method' => 'put', 'route' => ['admin.'.$params['route'].'.update', $item->id], 'files' => true]) }}
        @endif
        @include('admin.'.$params['route'].'.edit._form')
        {{ Form::close() }}
    </div>
@endsection

@section('bottom')

    <script src="/help_utilities/ckeditor/ckeditor.js"></script>

    <script src="/js/admin/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/stylesheets/admin/bootstrapValidator/bootstrapValidator.min.css" />

    <script type="text/javascript" src="/js/admin/plugins/bootstrap-file-input/bootstrap-file-input.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            //iCheck
            $(".check-success").iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            CKEDITOR.replace('preview', {

            });

            CKEDITOR.replace('text', {
                height: '400px'
            });

            CKEDITOR.replace('characteristics', {
                height: '400px'
            });

            $('#form-std').bootstrapValidator({
                message: 'Это значение недействительно',
                fields: {
                    title: {
                        message: 'Введите название страницы',
                        validators: {
                            notEmpty: {
                                message: 'Введите название страницы'
                            }
                        }
                    }
                }
            });

            //File Input
            $('.file-inputs').bootstrapFileInput();
        });
    </script>
@endsection