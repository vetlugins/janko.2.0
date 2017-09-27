<div class="panel-group" id="news-options">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
      <a href="#page-options-cover" data-parent="#page-options" data-toggle="collapse">
       {{ trans ( 'admin_fields.cover' ) }}
      </a>
      </div>
    </div>
    <div id="page-options-cover" class="panel-collapse collapse in">
      <div class="panel-body">
      {{ View::make('admin.covers._form', ['cover' => $item->cover,'type' => $params['cover_type'] ]) }}
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a href="#news-options-params" data-parent="#news-options" data-toggle="collapse">
          {{trans('admin_fields.publ_params')}}
        </a>
      </h4>
    </div>
    <div id="news-options-params" class="panel-collapse collapse" style="height:0;">
      <div class="panel-body">
		<div class="form-group">
          <label>
           {{ HTML::form_checkbox('visible', '', '<span></span>'.trans('admin_fields.visible'), 1, $item->visible, $errors) }}
          </label>         
        </div>    
      </div>
    </div>
  </div>
  @if ( $params['edit_type'] == 'edit' && Config::get ( 'data.other_langs' ) )
  <div class="panel panel-default">    
	<div class="panel-heading">
      <h4 class="panel-title">
        <a href="#page-options-lang" data-toggle="collapse" data-parent="#page-options">
          {{ trans ( 'admin_fields.lang' ) }}
        </a>
      </h4>
    </div>
    <div id="page-options-lang" class="panel-collapse collapse" style="height:0;">
      <div class="panel-body">		
		<div class="form-group">          
          {{ Form::select('lang', $params['langs'], $item->lang, ['class' => 'form-control']) }}
        </div>       
      </div>
    </div>
  </div>
  @endif

</div>