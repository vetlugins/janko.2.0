

<div class="col-md-12 col-sm-12">
	<div class="box">
		<div class="box-title">
			<h3>{{ trans('admin_titles.adding') }}</h3>
		</div>
		<div class="box-body">
			<div id="dropzone">
				<form action="{{ route('admin.photos.store',[$params['object_type'].'/'.$params['object_id']]) }}" method="post" class="dropzone" id="uploadPhoto" enctype="multipart/form-data">

				</form>
			</div>
		</div>
	</div>
</div>

