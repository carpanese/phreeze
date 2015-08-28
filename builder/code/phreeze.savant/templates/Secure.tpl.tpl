<?php
	$this->assign('title','Login');
	$this->assign('nav','secure');

	$this->display('_Header.tpl.php');
?>

<div class="container">

	<?php if ($this->feedback) { ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php $this->eprint($this->feedback); ?>
		</div>
	<?php } ?>
	
	<!-- #### this view/tempalate is used for multiple pages.  the controller sets the 'page' variable to display differnet content ####  -->
	
	<?php if ($this->page == 'login') { ?>
	
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
	
	<?php } ?>
	
</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>