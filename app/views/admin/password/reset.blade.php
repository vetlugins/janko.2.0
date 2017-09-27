@extends('admin.layout_no_header')

@section('content')
	<div class="row">
	    <div class="col-md-6 col-md-offset-3">
			<div class="page-header">
				<h1>Сбросить пароль</h1>
			</div>
			@if(Session::has('success') or Session::has('error'))
		        @if(Session::has('success'))
		            <div class="alert alert-success alert-dismissable">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                {{ Session::get('success') }}
		            </div>
		        @endif
		        @if(Session::has('error'))
		            <div class="alert alert-danger alert-dismissable">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                {{ Session::get('error') }}
		            </div>
		        @endif
			@endif
			<div class="alert alert-info">
				Чтобы сбросить пароль, заполните эту форму.
			</div>
			{{ Form::open(['route' => 'admin.password.reset'])}}
			    <input type="hidden" name="token" value="{{ $token }}">
			    <div class="form-group">
			    	{{ Form::label('email', 'Email') }}
			    	{{ Form::email('email', '', ['class' => 'form-control']) }}
			    </div>
			    <div class="form-group">
			    	{{ Form::label('password', 'Пароль') }}
			    	{{ Form::password('password', ['class' => 'form-control']) }}
			    </div>
			    <div class="form-group">
			    	{{ Form::label('password_confirmation', 'Потдвердите пароль') }}
			    	{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
			    </div>
				{{ Form::submit('Сбросить пароль', ['class' => 'btn btn-primary']) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection