@layout('Master')

@section('title'){$appname} | Autentica&ccedil;&atilde;o Padr&atilde;o @endsection

@section('content')
<div class="container">

	@if (isset($feedback))
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{ldelim}{ldelim} htmlentities($feedback) {rdelim}{rdelim}
		</div>
	@endif
	
	<!-- #### this view/tempalate is used for multiple pages.  the controller sets the 'page' variable to display differnet content ####  -->
	
	@if ($page == 'login')
	
		<form class="well" method="post" action="login">
		<fieldset>
			<legend>Informe seu usu&aacute;rio e senha</legend>
				<div class="control-group">
				<input id="username" name="username" type="text" placeholder="Usu&aacute;rio..." />
				</div>
				<div class="control-group">
				<input id="password" name="password" type="password" placeholder="Senha..." />
				</div>
				<div class="control-group">
				<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</fieldset>
		</form>
	@endif

</div> <!-- /container -->
@endsection
