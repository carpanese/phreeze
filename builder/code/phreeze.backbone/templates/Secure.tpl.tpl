{literal}
{extends file="Master.tpl"}

{block name=title}{/literal}{$appname|escape}{literal} Autentica&ccedil;&atilde;o Padr&atilde;o {/block}

{block name=banner}
{/block}

{block name=content}


	{if ($feedback)}
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{$feedback|escape}
		</div>
	{/if}
	
	<!-- #### this view/tempalate is used for multiple pages.  the controller sets the 'page' variable to display differnet content ####  -->
	
	{if ($page == 'login')}
	
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
	
	{/if}

{/block}
{/literal}