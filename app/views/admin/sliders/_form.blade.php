@section('head')

	<script src='/js/admin/jscal2/jscal2.js'></script>    
	<script src="/js/admin/jscal2/lang/ru.js"></script>
	<link type="text/css" href='/stylesheets/admin/jscal2/jscal.css' />	
	<link type="text/css" href="/stylesheets/admin/jscal2/steel.css" />  



@endsection

<div class="col-md-8 form-horizontal">
  @include ( 'admin.'.$params['route'].'._main' )
</div>
<div class="col-md-4">
  @include ( 'admin.'.$params['route'].'._sidebar' )
</div>