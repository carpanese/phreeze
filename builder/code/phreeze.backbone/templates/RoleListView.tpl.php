<?php
	$this->assign('title','Autentica&ccedil;&atilde;o Padr&atilde;o | Fun&ccedil;&otilde;es');
	$this->assign('nav','roles');

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
	.script("scripts/app/roles.js").wait(function(){
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
	<i class="icon-th-list"></i> Fun&ccedil;&otilde;es
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="roleCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Nome<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CanAdmin">&Eacute; Admin<% if (page.orderBy == 'CanAdmin') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CanEdit">Pode Editar<% if (page.orderBy == 'CanEdit') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CanWrite">Pode Gravar<% if (page.orderBy == 'CanWrite') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CanRead">Pode Ler<% if (page.orderBy == 'CanRead') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= item.get('canAdmin') == '1' ? 'Sim' : 'N&atilde;o' %></td>
				<td><%= item.get('canEdit') == '1' ? 'Sim' : 'N&atilde;o' %></td>
				<td><%= item.get('canWrite') == '1' ? 'Sim' : 'N&atilde;o' %></td>
				<td><%= item.get('canRead') == '1' ? 'Sim' : 'N&atilde;o' %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="roleModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nameInputContainer" class="control-group">
					<label class="control-label" for="name">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="name" placeholder="Nome" value="<%= _.escape(item.get('name') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="canAdminInputContainer" class="control-group">
					<label class="control-label" for="canAdmin">&Eacute; Admin</label>
					<div class="controls inline-inputs">
						<input type="checkbox" class="input-xlarge" id="canAdmin" placeholder="Can Admin" value="1" <%= item.get('canAdmin') == '1' ? 'checked="checked"' : '' %> >
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="canEditInputContainer" class="control-group">
					<label class="control-label" for="canEdit">Pode Editar</label>
					<div class="controls inline-inputs">
						<input type="checkbox" class="input-xlarge" id="canEdit" placeholder="Can Edit" value="1" <%= item.get('canEdit') == '1' ? 'checked="checked"' : '' %> >
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="canWriteInputContainer" class="control-group">
					<label class="control-label" for="canWrite">Pode Gravar</label>
					<div class="controls inline-inputs">
						<input type="checkbox" class="input-xlarge" id="canWrite" placeholder="Can Write" value="1" <%= item.get('canWrite') == '1' ? 'checked="checked"' : '' %> >
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="canReadInputContainer" class="control-group">
					<label class="control-label" for="canRead">Pode Ler</label>
					<div class="controls inline-inputs">
						<input type="checkbox" class="input-xlarge" id="canRead" placeholder="Can Read" value="1" <%= item.get('canRead') == '1' ? 'checked="checked"' : '' %> >
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteRoleButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteRoleButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Deletar Fun&ccedil;&atilde;o</button>
						<span id="confirmDeleteRoleContainer" class="hide">
							<button id="cancelDeleteRoleButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteRoleButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="roleDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Fun&ccedil;&atilde;o
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="roleModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancelar</button>
			<button id="saveRoleButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="roleCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newRoleButton" class="btn btn-primary">Adicionar Fun&ccedil;&otilde;o</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
