
<div class="form-group">
	{{ Form::file('cover[image]', ['class' => 'btn btn-info file-inputs','title' => 'Выберите файлы для загрузки'] ) }}
</div>
@if($cover !== null && $cover->image_file_name !== null)
<div class="form-group">
	<img src="{{ $cover->image->url($type) }}" style="width: 100%; height: auto" />
</div>
@endif
