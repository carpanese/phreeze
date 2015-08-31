@layout('Master')

@section('title'){$appname} | Home@endsection

@section('container')

	<div class="modal hide fade" id="getStartedDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>Iniciando com o Phreeze</h3>
		</div>
		<div class="modal-body" style="max-height: 300px">
			<p>Este aplicativo foi gerado utilizando o gerador modificado do Phreeze. Deve ser 
			modificado para o uso em aplica&ccedil;&otilde;es de grande porte, este aplicativo &eacute;
			apenas um ponto inicial para seu aplicativo. Uma p&aacute;gina foi criada para cada tabela em seu 
			banco de dados. Clique nos links na barra de navega&ccedil;&atilde;o superior para 
			visualizar as p&aacute;ginas.</p>

			<p>O aplicativo gerado &eacute; um ponto de partida para a sua necessidade. Todas as p&aacute;ginas s&atilde;o geradas
			de forma padr&atilde;o e algumas delas podem sofrer altera&ccedil;&otilde;es para se adequar as suas necessidades. 
			Pode ser que o gerador gerou mais c&oacute;digo do que voc&ecirc; realmente necessita. Voc&ecirc; pode e deve excluir os 
			controladores, m&eacute;todos e pontos de vista que voc&ecirc; n&atilde;o precisa.</p>

			<h4>Controladores de Interface</h4>

			<p>Os controles de interface do usu&aacute;rio para campos de edi&ccedil;&atilde;o s&atilde;o gerados com base nos tipos de colunas do banco de dados. 
			O gerador n&atilde;o sabe o prop&oacute;sito de cada campo. Por exemplo, um campo INT pode ser melhor apresentado como uma 
			campo normal, um campo do tipo picker ou um checkbox por exemplo. &Eacute; poss&iacute;vel que o campo n&atilde;o deva ser editado pelo 
			usu&aacute;rio. O gerador n&atilde;o sabe essas coisas e por isso faz um melhor palpite baseado em tipos e tamanhos das colunas. 
			Voc&ecirc/ provavelmente ter&aacute; que mudar a controles de Interface que s&atidel;o melhores para a sua aplica&ccedil;&atilde;o. Bootstrap oferece uma s&eacute;rie 
			de grandes controles de interface do usu&aacute;rio para voc&ecirc; usar.</p>

			<h4>Controladores</h4>

			<p>Um controlador foi criado para cada tabela no aplicativo. Os controladores est&atilde;o localizados em / libs / Controller /. 
			Voc&ecirc; deve modificar os controladores de acordo com sua necessidade. Um exemplo pode ser uma tabela usada em uma atribui&ccedil;&atilde;o de muitos-para-muitos.</p>

			<h4>Modelos</h4>

			<p>V&aacute;rios arquivos de modelo foram criados para cada tabela no aplicativo.
				Os arquivos de modelo est&atilde;o localizados em / libs / Model /.
				Se o seu esquema ou tabela de banco de dados for modificado, voc&ecirc; pode voltar a gerar apenas o DAO (de acesso a dados de objeto)
				arquivos, selecionando o pacote DAO-Only no construtor de classe. basta depois, trocar os arquivos no diret&oacute;rio / libs / Model / DAO /, 
				em seguida, voc&ecirc; pode fazer com seguran&ccedil;a	altera&ccedil;&otilde;es em seu esquema de banco de dados e c&oacute;digo regenerado sem perder qualquer
				personaliza&ccedil;&atilde;o.</p>

		</div>
		<div class="modal-footer">
			<button id="okButton" data-dismiss="modal" class="btn btn-primary">Vamos L&aacute;...</button>
		</div>
	</div>

	<div class="container">

		<!-- Main hero unit for a primary marketing message or call to action -->
		<div class="hero-unit">
			<h1>Sua Aplica&ccedil;&atilde;o<i class="icon-thumbs-up"></i></h1>
			<p>Esta aplica&ccedil;&atilde;o foi gerada automaticamente utilizando a vers&atide;o modificada do Phreeze.
			 Utilize esta aplica&ccedil;&atilde;o como um ponto de partida para gera&ccedil;&atilde;o de uma app.</p>
			 
			 <p>Note que nesta vers&atilde;o modificada, foi implementada uma autentica&ccedil;&atilde;o padr&atilde;o para facilitar
			  a constru&ccedil;&atilde;o e o aprendizado. Ela pode ser modificada de acordo com a necessidade.</p>
			
			<p>Por padr&atilde;o, o Phreeze utiliza o Bootstrap como estilo e &eacute; poss&iacute;vel customizar e alterar o mesmo 
			sobrescrevendo o tema atual. Verifique novos temas em
			<a href="https://wrapbootstrap.com/?ref=phreeze">Bootstrap</a>
			e <a href="http://www.google.com/search?q=bootstrap+themes"> para mais reposit&oacute;rios</a>.</p>
			
			<p><em>Gerado com Phreeze Modificado vers&atilde;o {$PHREEZE_VERSION}.
			{literal}Rodando com Phreeze {{$PHREEZE_VERSION}}@if($PHREEZE_PHAR) 
			({{basename($PHREEZE_PHAR)}})@endif.</em></p>{/literal}
			
			<p><a class="btn btn-primary btn-large" data-toggle="modal" href="#getStartedDialog">Inicie Agora</a></p>
		</div>

		<!-- Example row of columns -->
		<div class="row">
			<div class="span3">
				<h2><i class="icon-cogs"></i> Phreeze</h2>
				 <p>Phreeze &eacute; um framework MVC + ORM para PHP que fornece servi&ccedil;os de 
				 roteamento de URL, de acesso DB orientada a objeto e JSON RESTful que s&atilde;o 
				 consumidos pela camada de vis&atilde;o...</p>
				<p><a class="btn" href="http://phreeze.com/">Sobre o Phreeze Oficial &raquo;</a></p>
			</div>
			<div class="span3">
				<h2><i class="icon-th"></i> Backbone</h2>
				 <p>Backbone.js &eacute; um Framework JavaScript que &eacute; utilizado para fornecer
					modelos do lado do cliente, a liga&ccedil;&atilde;o do modelo e persist&ecirc;ncia usando AJAX
					chamadas para os servi&ccedil;os de back-end RESTful.</p>
				<p><a class="btn" href="http://documentcloud.github.com/backbone/">Sobre o Backbone &raquo;</a></p>
		 	</div>
			<div class="span3">
				<h2><i class="icon-twitter-sign"></i> Bootstrap</h2>
				<p>Bootstrap pelo Twitter fornece um layout de cross-browser limpo
				e componentes de interface do usu&aacute;rio. Bootstrap &eacute; um kit de ferramentas de front-end completa com
				componentes prontos para uso funcionais.</p>
				<p><a class="btn" href="http://twitter.github.com/bootstrap/">Sobre o Bootstrap &raquo;</a></p>
			</div>
			<div class="span3">
				<h2><i class="icon-signin"></i> Bibliotecas</h2>
				<p>Tamb&eacute;m foram utilizadas neste framework, bibliotecas open-source como:
				<a href="https://github.com/eternicode/bootstrap-datepicker">datepicker</a>,
				<a href="https://github.com/danielfarrell/bootstrap-combobox">combobox</a>,
				<a href="http://fortawesome.github.com/Font-Awesome/">FontAwesome</a>,
				<a href="http://jquery.com/">jQuery</a>,
				<a href="http://labjs.com/">LABjs</a>,
				<a href="http://documentcloud.github.com/underscore/">Underscore</a>,
				<a href="http://www.smarty.net">Smarty</a>,
				<a href="https://github.com/jdewit/bootstrap-timepicker">timepicker</a>,
				<a href="http://docs.jquery.com/Qunit">QUnit</a>.
				Todas as bibliotecas e plugins utilizados neste framework s&atilde;o livres para uso pessoal e comercial.
				</p>
			</div>
		</div>

		<hr>

		<footer>
			<p>&copy; <?php echo date('Y'); ?> {$appname}</p>
		</footer>

	</div> <!-- /container -->

@endsection
