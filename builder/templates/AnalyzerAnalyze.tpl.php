<?php include_once '_header.tpl.php'; ?>

<h2><i class="icon-user"></i>Passo 1 - Autentica&ccedil;&atilde;o Padr&atilde;o</h2>

<p>Esta modifica&ccedil;&atilde;o do framework, conta com um m&oacute;dulo de autentica&ccedil;&atilde;o padr&atilde;o.</p>

<p>Para que a autentica&ccedil;&atilde;o padr&atilde;o seja gerada corretamente, &eacute; necess&aacute;rio a execu&ccedil;&atilde;o 
da cria&ccedil;&atilde;o das tabelas do banco de dados e carregamento das fun&ccedil;&otilde;es principais de perfis. Clique no link abaixo 
para realizar o Download do script.</p>

<p><a href="autenticacao.sql"><i class="icon-download-alt"></i>Download Autentica&ccedil;&atilde;o.sql</a> </p>
<br />
<h2><i class="icon-check"></i>Passo 2 - Selecione as Tabelas</h2>

<p>Selecione as tabelas que voc&ecirc; deseja que fa&ccedil;a parte da gera&ccedil;o do sistema.  
Os nomes de Plural e Singular dever&atilde;o ser modificados caso necess&aacute;rio, n&atilde;o utilize
espa&ccedil;os e acentua&ccedil;&atilde;o. Voc&ecirc; poder&aacute; modificar os nomes depois.  
Os prefixos de colunas devem ser mantidos caso existam (ex a_id, a_name).</p>

<p>Note que tabelas sem primary keys e com chaves compostas n&atilde;o s&atilde;o suportadas. 
Views s&atilde;o suportadas desde que n&atilde;o possuam opera&ccedil;&otilde;es de update.  Por padr&atilde;o, views s&atilde;o desabiltadas.</p>

<form id="generateForm" action="generate" method="post" class="form-horizontal">

	<table class="collection table table-bordered table-striped">
	<thead>
		<tr>
			<th class="checkboxColumn"><input type="checkbox" id="selectAll" checked="checked"
				onclick="$('input.tableCheckbox').attr('checked', $('#selectAll').attr('checked')=='checked');"/></th>
			<th>Tabela</th>
			<th>Nome no Singular</th>
			<th>Nome no Plural</th>
			<th>Prefixo de Coluna</th>
			<th>Info</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	
	/* these are reserved words that will conflict with phreeze */
	function is_reserved_table_name($name)
	{
		$reserved = array('criteria','phreezer','phreezable','reporter','controller','dataset');
		return in_array(strtolower($name), $reserved);
	} 

	/* these are property names that cannot be used due to conflicting with the client-side libraries */
	function is_reserved_column_name($name)
	{
		$reserved = array('url','urlroot','idattribute','attributes','isnew','changedattributes','previous','previousattributes','defaults');
		return in_array(strtolower($name), $reserved);
	} 
	?>
	
	<?php foreach ($this->dbSchema->Tables as $table) { 
	
		$invalidColumns = array();
		foreach ($table->Columns as $column) {
			if (is_reserved_column_name($column->NameWithoutPrefix) )
			{
				$invalidColumns[] = $column->Name;
			}
		} 
	?>
		<tr id="">
			<td class="checkboxColumn">
			<?php if ($table->Name == "role" || $table->Name == "user") { ?>
					<input type="checkbox" class="tableCheckbox" name="table_name[]" value="<?php $this->eprint($table->Name); ?>" disabled="disabled" />
			<?php } elseif (count($invalidColumns)>0) { ?>
				<a href="#" class="popover-icon" rel="popover" onclick="return false;"
					data-content="This table contains one or more column names that conflict with the client-side libraries.  To include this table, please rename the following column(s):<br/><br/><ul><li><?php $this->eprint( implode("</li><li>", $invalidColumns) ); ?></li></ul>"
					data-original-title="Reserved Word"><i class="icon-ban-circle">&nbsp;</i></a>
			<?php } elseif ($table->IsView) { ?>
				<input type="checkbox" class="tableCheckbox" name="table_name[]" value="<?php $this->eprint($table->Name); ?>" />
			<?php } elseif ($table->NumberOfPrimaryKeyColumns() < 1) { ?>
				<a href="#" class="popover-icon" rel="popover" onclick="return false;"
					data-content="Phreeze does not currently support tables without a primary key column"
					data-original-title="No Primary Key"><i class="icon-ban-circle">&nbsp;</i></a>
			<?php } elseif ($table->NumberOfPrimaryKeyColumns() < 1) { ?>
				<a href="#" class="popover-icon" rel="popover" onclick="return false;"
					data-content="Phreeze does not currently support tables with multiple/compound key columns"
					data-original-title="Compound Primary Key"><i class="icon-ban-circle">&nbsp;</i></a>
			<?php } else { ?>
				<input type="checkbox" class="tableCheckbox" name="table_name[]" value="<?php $this->eprint($table->Name); ?>" checked="checked" />
			<?php } ?>
			</td>
			
			<td class="tableNameColumn">
			<?php if (is_reserved_table_name($table->Name)) { ?>
				<a href="#" class="popover-icon error" rel="popover" onclick="return false;"
					data-content="This table name is a reserve word in the Phreeze framework.<br/><br/>'Model' has been appended to the end of your class name.  You can change this to something else as long as you do not use the reserved Phreeze classname as-is."
					data-original-title="Reserved Word"><i class="icon-info-sign">&nbsp;</i></a>
			<?php } elseif ($table->IsView) { ?>
				<a href="#" class="popover-icon view" rel="popover" onclick="return false;"
					data-content="Views are supported by Phreeze however only read-operations will be allowed by default.<br/><br/>Because views do not support keys or indexes, Phreeze will treat the leftmost column of the view as the primary key.  For optimal results please design your view so that the leftmost column returns a unique value for each row."
					data-original-title="View Information"><i class="icon-table">&nbsp;</i></a>
			<?php }else{ ?>
				<i class="icon-table">&nbsp;</i>
			<?php } ?>
			<?php $this->eprint($table->Name); ?></td>
			
			<?php if ($table->Name == "user") { ?>
				<td><input class="objname objname-singular" disabled="disabled" type="text" id="<?php $this->eprint($table->Name); ?>_singular" name="<?php $this->eprint($table->Name); ?>_singular" value="Usuario" /></td>
				<td><input class="objname objname-plural"  disabled="disabled"  type="text" id="<?php $this->eprint($table->Name); ?>_plural" name="<?php $this->eprint($table->Name); ?>_plural" value="Usuarios" /></td>
				<td><input type="text" class="colprefix span2" disabled="disabled" id="<?php $this->eprint($table->Name); ?>_prefix" name="<?php $this->eprint($table->Name); ?>_prefix" value="<?php $this->eprint($table->ColumnPrefix); ?>" size="15" /></td>
				<td><a href="#" class="popover-icon error"  rel="popover" onclick="return false;"
					data-content="Esta tabela &eacute; utilizada na autentica&ccedil;&atilde;o padr&atilde;o. Se voc&ecirc; est&aacute; vendo isto, &eacute; porque seguiu o Passo 1 corretamente."
					data-original-title="Autentica&ccedil;&atilde;o Padr&atilde;o"><i class="icon-ban-circle">&nbsp;</i></a></td>
			<?php } elseif ($table->Name == "role") { ?>
				<td><input class="objname objname-singular" disabled="disabled" type="text" id="<?php $this->eprint($table->Name); ?>_singular" name="<?php $this->eprint($table->Name); ?>_singular" value="Funcao" /></td>
				<td><input class="objname objname-plural"  disabled="disabled"  type="text" id="<?php $this->eprint($table->Name); ?>_plural" name="<?php $this->eprint($table->Name); ?>_plural" value="Funcoes" /></td>
				<td><input type="text" class="colprefix span2" disabled="disabled" id="<?php $this->eprint($table->Name); ?>_prefix" name="<?php $this->eprint($table->Name); ?>_prefix" value="<?php $this->eprint($table->ColumnPrefix); ?>" size="15" /></td>
				<td><a href="#" class="popover-icon error"  rel="popover" onclick="return false;"
					data-content="Esta tabela &eacute; utilizada na autentica&ccedil;&atilde;o padr&atilde;o. Se voc&ecirc; est&aacute; vendo isto, &eacute; porque seguiu o Passo 1 corretamente."
					data-original-title="Autentica&ccedil;&atilde;o Padr&atilde;o"><i class="icon-ban-circle">&nbsp;</i></a></td>
			<?php } elseif (is_reserved_table_name($table->Name)) { ?>
				<td><input class="objname objname-singular" type="text" id="<?php $this->eprint($table->Name); ?>_singular" name="<?php $this->eprint($table->Name); ?>_singular" value="<?php $this->eprint($this->studlycaps($table->Name)); ?>Model" /></td>
				<td><input class="objname objname-plural" type="text" id="<?php $this->eprint($table->Name); ?>_plural" name="<?php $this->eprint($table->Name); ?>_plural" value="<?php $this->eprint($this->studlycaps($table->Name)); ?>Models" /></td>
				<td><input type="text" class="colprefix span2" id="<?php $this->eprint($table->Name); ?>_prefix" name="<?php $this->eprint($table->Name); ?>_prefix" value="<?php $this->eprint($table->ColumnPrefix); ?>" size="15" /></td>
				<td></td>
			<?php } else { ?>
				<td><input class="objname objname-singular" type="text" id="<?php $this->eprint($table->Name); ?>_singular" name="<?php $this->eprint($table->Name); ?>_singular" value="<?php $this->eprint($this->studlycaps( $table->GetObjectName() )); ?>" /></td>
				<td><input class="objname objname-plural" type="text" id="<?php $this->eprint($table->Name); ?>_plural" name="<?php $this->eprint($table->Name); ?>_plural" value="<?php $this->eprint($this->studlycaps($this->plural( $table->GetObjectName() ))); ?>" /></td>
				<td><input type="text" class="colprefix span2" id="<?php $this->eprint($table->Name); ?>_prefix" name="<?php $this->eprint($table->Name); ?>_prefix" value="<?php $this->eprint($table->ColumnPrefix); ?>" size="15" /></td>
				<td></td>
			<?php } ?>
		</tr>
	<?php } ?>
	</tbody>
	</table>

	<h2><i class="icon-cogs"></i>Passo 3 - Op&ccedil;&otilde;es da Aplica&ccedil;&atilde;o</h2>

	<p>Essas op&ccedil;&otilde;es n&atilde;o precisam ser alteradas.
	Qualquer op&ccedil;&atilde;o pode ser alterada posteriormente caso necess&aacute;rio e desejado.</p>

	<fieldset class="well">

		<div id="packageContainer" class="control-group">
			<label class="control-label" for="package">Gera&ccedil;&atilde;o do pacote <i class="popover-icon icon-question-sign" 
					data-title="Gera&ccedil;&atilde;o do pacote" 
					data-content="Voc&ecirc; pode escolher entre v&aacute;rios pacotes de gerar. Muito provavelmente voc&ecirc; vai estar interessado em escolher o Phreeze App que usa seu mecanismo de modelo preferido (RenderEngine) para a camada de vis&atilde;o.<br/><br/>O RenderEngine pode ser alterado em <code>_app_config.php</code>, contudo alterar o RenderEngine tamb&eacute;m exige re-gerar os modelos."></i></label>
			<div class="controls inline-inputs">
				<select name="package" class="input-xxlarge">
				<?php foreach ($this->packages as $package) { ?>
					<option value="<?php $this->eprint($package->GetConfigFile()) ?>"><?php $this->eprint($package->GetName()) ?></option>
				<?php } ?>
				</select>
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="appNameContainer" class="control-group">
			<label class="control-label" for=""appname"">Nome da Aplica&ccedil;&atilde;o <i class="popover-icon icon-question-sign" 
					data-title="Nome da Aplica&ccedil;&atilde;o" 
					data-content="O nome do aplicativo aparece no topo nav / cabe&ccedil;alho, bem como o rodap&eacute; do aplicativo. Você pode alterar isso mais tarde na pasta de modelos."></i></label>
			<div class="controls inline-inputs">
				<input type="text" name="appname" id="appname" value="<?php $this->eprint($this->studlycaps($this->appname)); ?>" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="appRootContainer" class="control-group">
			<label class="control-label" for="appRoot">Contexto de URL da aplica&ccedil;&atilde;o <i class="popover-icon icon-question-sign" 
					data-title="Contexto de URL da aplica&ccedil;&atilde;o" 
					data-content="Seu aplicativo Phreeze deve saber que &eacute; local raiz a fim de apoiar as URLs limpas. Voc&ecirc; vai precisar para assegurar esta &eacute; a URL correta para o seu app. Ao implantar o seu aplicativo para outro servidor, esse valor ter&aacute; de ser ajustado.<br/><br/>O GlobalConfig::$ROOT_URL pode ser modificado em <code>_machine_config.php</code>"></i></label>
			<div class="controls inline-inputs">
				<span>http://servername/</span>
				<input type="text" class="span2" name="appRoot" id="appRoot" value="<?php $this->eprint(strtolower($this->appname)); ?>/" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="includePathContainer" class="control-group">
			<label class="control-label" for="includePath">Caminho do /phreeze/libs <i class="popover-icon icon-question-sign" 
					data-title="Caminho do /phreeze/libs" 
					data-content="A menos que seu aplicativo &eacute; auto-suficiente (veja a pr&oacute;xima op&ccedil;&atilde;o), ent&atilde;o ele deve ser capaz de localizar os arquivos de classe em &acirc;mbito Phreeze <code>/phreeze/libs/</code>.  O aplicativo ir&aacute; verificar o PHP incluem caminho, no entanto, voc&ecirc; pode especificar um caminho de arquivo relativo adicional aqui.<br/><br/>Esta configura&ccedil;&atilde;o pode ser ajustada em <code>_app_config.php</code>"></i></label>
			<div class="controls inline-inputs">
				<input type="text" name="includePath" id="includePath" value="../phreeze/libs" />
				<span class="help-inline"></span>
			</div>
		</div>

		<div id="enableLongPollingContainer" class="control-group">
			<label class="control-label" for="includePhar">Embutir Framework <i class="popover-icon icon-question-sign" 
					data-title="Embutir Framework" 
					data-content="Selecionando 'Sim' ir&aacute; incluir o quadro Phreeze como um arquivo .phar pr&eacute;-constru&iacute;do, localizado em / libs /. Isso permitir&aacute; que seu aplicativo para stand-alone sem a necessidade de as bibliotecas Phreeze no servidor.<br/><br/>Isto &eacute; recomendado quando a distribui&ccedil;&atilde;o de aplicativos pr&eacute;-empacotados e ir&aacute; torn&aacute;-los mais f&aacute;ceis de instalar. N&atilde;o &eacute; recomendado durante o desenvolvimento."></i></label>
			<div class="controls inline-inputs">
				<select name="includePhar" id="includePhar"  class="input-xxlarge">
					<option value="0">N&atilde;o (Requer o Phreeze externamente no servidor)</option>
					<option value="1">Sim (Inclui Bibliotecas do Phreeze no Phar)</option>
				</select>
				<span class="help-inline"></span>
			</div>
		</div>
		
		<div id="enableLongPollingContainer" class="control-group">
			<label class="control-label" for="enableLongPolling">Long Polling <i class="popover-icon icon-question-sign" 
					data-title="Long Polling" 
					data-content="With long polling enabled, the table views will 'poll' the database every few seconds for changes and update the page automatically if necessary.  This will make your site appear to be a real-time collaberative app.  Use with caution as this will also place additional load on the server.<br/><br/>This setting can be adjusted in <code>/scripts/model.js</code>"></i></label>
			<div class="controls inline-inputs">
				<select name="enableLongPolling" id="enableLongPolling">
					<option value="0">Desativado</option>
					<option value="1">Ativado</option>
				</select>
				<span class="help-inline"></span>
			</div>
		</div>
		
	</fieldset>
	
	<div id="errorContainer"></div>

	<p>
		<input type="hidden" name="host" id="host" value="<?php $this->eprint($this->host) ?>" />
		<input type="hidden" name="port" id="port" value="<?php $this->eprint($this->port) ?>" />
		<input type="hidden" name="type" id="type" value="<?php $this->eprint($this->type) ?>" />
		<input type="hidden" name="schema" id="schema" value="<?php $this->eprint($this->schema) ?>" />
		<input type="hidden" name="username" id="username" value="<?php $this->eprint($this->username) ?>" />
		<input type="hidden" name="password" id="password" value="<?php $this->eprint($this->password) ?>" />

		<button class="btn btn-inverse"><i class="icon-play"></i> Gerar Aplica&ccedil;&atilde;o</button>
	</p>
</form>

<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/analyze.js"></script>

<?php include_once '_footer.tpl.php'; ?>