<?php include_once '_header.tpl.php'; ?>

<div class="hero-unit">
	<h1><img src="images/banner.png" alt="Phreeze Builder" /></h1>
	<div class="subheader">
		<div>Informe os dados de conex&atilde;o do banco de dados.</div>
		<div>Phreeze ir&aacute; analisar e ir&aacute; gerar a sua aplica&ccedil;&atilde;o.</div>
	</div>
</div>

<form action="analyze" method="post" class="form-horizontal">
	<fieldset class="well">
		<div id="hostPortContainer" class="control-group">
			<label class="control-label" for="host">Host MYSQL : Porta</label>
			<div class="controls inline-inputs">
				<input type="text" class="span2" id="host" name="host"  placeholder="exemplo: localhost" /> :
				<input type="text" class="span1" id="port" name="port" value="3306" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="schemaContainer" class="control-group">
			<label class="control-label" for="schema">Driver MYSQL</label>
			<div class="controls inline-inputs">
				<select name="type" id="type">
					<option value="MySQL">mysql_connect</option>
					<option value="MySQLi">mysqli_connect</option>
					<option value="MySQL_PDO">PDO</option>
				</select>
				<span class="help-inline"></span>
			</div>
		</div>
		
		<div id="schemaContainer" class="control-group">
			<label class="control-label" for="schema">Nome do Esquema</label>
			<div class="controls inline-inputs">
				<input type="text" class="span3" id="schema" name="schema" placeholder="exemplo: minhabasedados" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="usernameContainer" class="control-group">
			<label class="control-label" for="username">Usu&aacute;rio MYSQL</label>
			<div class="controls inline-inputs">
				<input type="text" class="span3" id="username" name="username" placeholder="Usu&aacute;rio" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="passwordContainer" class="control-group">
			<label class="control-label" for="password">Senha MYSQL</label>
			<div class="controls inline-inputs">
				<input type="password" class="span3" id="password" name="password" placeholder="Senha MYSQL" />
				<span class="help-inline"></span>
			</div>
		</div>
	</fieldset>

	<p>
		<input type="submit" class="btn btn-inverse" value="Analisar Banco de Dados &raquo;" />
	</p>
</form>

<?php include_once '_footer.tpl.php'; ?>