<?php
	$this->assign('title','Autentica&ccedil;&atilde;o Padr&atilde;o');
	$this->assign('nav','users');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("bootstrap/js/bootstrap-datepicker.js")
	.script("bootstrap/js/bootstrap-timepicker.js")
	.script("bootstrap/js/bootstrap-combobox.js")
	.script("scripts/libs/underscore-min.js").wait()
	.script("scripts/libs/underscore.date.min.js")
	.script("scripts/libs/backbone-min.js")
	.script("scripts/app.js")
	.script("scripts/model.js").wait()
	.script("scripts/view.js").wait()
	.script("scripts/app/users.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Usu&aacute;rios
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="userCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_RoleId">Fun&ccedil;&atilde;o<% if (page.orderBy == 'RoleId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Username">Usu&aacute;rio<% if (page.orderBy == 'Username') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FirstName">Nome<% if (page.orderBy == 'FirstName') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_LastName">Sobrenome<% if (page.orderBy == 'LastName') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('roleName') || '') %></td>
				<td><%= _.escape(item.get('username') || '') %></td>
				<td><%= _.escape(item.get('firstName') || '') %></td>
				<td><%= _.escape(item.get('lastName') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="userModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="roleIdInputContainer" class="control-group">
					<label class="control-label" for="roleId">Fun&ccedil;&atilde;o</label>
					<div class="controls inline-inputs">
						<select id="roleId" name="roleId"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="usernameInputContainer" class="control-group">
					<label class="control-label" for="username">Usu&aacute;rio</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="username" placeholder="Usu&aacute;rio" value="<%= _.escape(item.get('username') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="passwordInputContainer" class="control-group">
					<label class="control-label" for="password">Senha</label>
					<div class="controls inline-inputs">
						<input type="password" class="input-xlarge" id="password" placeholder="Senha" value="">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="firstNameInputContainer" class="control-group">
					<label class="control-label" for="firstName">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="firstName" placeholder="Nome" value="<%= _.escape(item.get('firstName') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="lastNameInputContainer" class="control-group">
					<label class="control-label" for="lastName">Sobrenome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="lastName" placeholder="Sobrenome" value="<%= _.escape(item.get('lastName') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteUserButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteUserButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Deletar Usu&aacute;rio</button>
						<span id="confirmDeleteUserContainer" class="hide">
							<button id="cancelDeleteUserButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteUserButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="userDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Usu&aacute;rio
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="userModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancelar</button>
			<button id="saveUserButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="userCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newUserButton" class="btn btn-primary">Adicionar Usu&aacute;rio</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
