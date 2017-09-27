<div class="col-lg-3">
    <div class="box">
        <div class="box-body no-padding text-center">
            <a href="#">
                <img src="{{ $photo->image->url ( 'thumb' ) }}" alt="img" width="100%">
            </a>
        </div>
        <div class="box-title relative" style="height: 50px">
            <div class="edit-photo-name absolute">
                <div class="photo-form">
                    <div class="col-xs-7">
                        <input type="text" value="{{ $photo->title }}" class="form-control">
                    </div>
                    <div class="col-xs-5 text-right" style="padding-right: 20px">
                        <a class="btn btn-danger btn-sm close_edit_title">
                            <i class="fa fa-times"></i>
                        </a>
                        <a class="btn btn-success btn-sm edit_title" data-id="{{ $photo->id }}" data-action="{{ URL::route('admin.'.$params['route'].'.title') }}">
                            <i class="fa fa-check"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="edit-photo-block absolute">
                <div class="pull-left">
                    <span class="title_text">{{ $photo->title }}</span>
                </div>
                <div class="pull-right" style="padding-right: 20px">
                    <a title="Скрыть / Показать" class="hideShow btn {{ $photo->visible ? 'btn-success' : 'btn-warning' }} btn-sm vis {{ $photo->visible ? 'vis1' : 'vis0' }}"  data-toggle="tooltip"  data-id="{{$photo->id}}" data-action="{{ URL::route( 'admin.'.$params['route'].'.visibility') }}">
                        <i class="fa {{ $photo->visible ? 'fa-eye ' : 'fa-eye-slash' }}"></i>
                    </a>
                    <a class="edit-photo-title btn btn-info btn-sm" title="Редактировать" data-toggle="tooltip" data-id="{{$photo->id}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" title="Удалить" data-toggle="tooltip" href="{{ URL::route('admin.'.$params['route'].'.destroy', $photo->id) }}" data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>