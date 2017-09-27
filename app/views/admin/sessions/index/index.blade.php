<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Janko.cmc 2.0 - Авторизация</title>

	<!-- Maniac stylesheets -->
	<link rel="stylesheet" href="/stylesheets/admin/bootstrap.min.css" />
	<link rel="stylesheet" href="/stylesheets/admin/font-awesome.min.css" />
	<link rel="stylesheet" href="/stylesheets/admin/animate/animate.min.css" />
	<link rel="stylesheet" href="/stylesheets/admin/bootstrapValidator/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="/stylesheets/admin/iCheck/all.css" />
	<link rel="stylesheet" href="/stylesheets/admin/style.css" />

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="login fixed">
<div class="wrapper animated flipInY">
	<div class="logo"><a href="#"><i class="fa fa-bolt"></i> <span>Janko.cms 2.0</span></a></div>
	<div class="box">
		<div class="header clearfix">
			<div class="pull-left"><i class="fa fa-sign-in"></i> Вход в панель управления</div>
			<div class="pull-right"><a href="#"><i class="fa fa-times"></i></a></div>
		</div>
		<form id="loginform" method="post" action="{{ URL::route('admin.login.create') }}">

			@if(Session::has('success') or Session::has('error'))
				@if(Session::has('success'))
					<div class="alert alert-success alert-dismissable no-radius no-margin padding-sm">
						<i class="fa fa-info-circle"></i> {{ Session::get('success') }}
					</div>
				@endif
				@if(Session::has('error'))
					<div class="alert alert-danger alert-dismissable no-radius no-margin padding-sm">
						<i class="fa fa-info-circle"></i> {{ Session::get('error') }}
					</div>
				@endif
			@else
				<div class="alert alert-warning no-radius no-margin padding-sm">
					<i class="fa fa-info-circle"></i> Введите свой email и пароль!
				</div>
			@endif

			<div class="box-body padding-md">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Ваш email"/>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Ваш пароль"/>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success btn-block">Войти</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Javascript -->
<script src="/js/admin/plugins/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/js/admin/plugins/jquery-ui/jquery-ui-1.10.4.min.js" type="text/javascript"></script>

<!-- Bootstrap -->
<script src="/js/admin/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>

<!-- Interface -->
<script src="/js/admin/plugins/pace/pace.min.js" type="text/javascript"></script>

<!-- Forms -->
<script src="/js/admin/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="/js/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<script type="text/javascript">
	//iCheck
	$("input[type='checkbox'], input[type='radio']").iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal'
	});

	$(document).ready(function() {
		$('#loginform').bootstrapValidator({
			message: 'This value is not valid',
			fields: {
				email: {
					message: 'The username is not valid',
					validators: {
						notEmpty: {
							message: 'Введите свой email'
						},
						emailAddress:{
							message: 'Вы ввели не правильный email адрес'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: 'Введите свой пароль'
						}
					}
				}
			}
		});
	});
</script>
</body>
</html>