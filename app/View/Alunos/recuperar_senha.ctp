<!DOCTYPE html>
<html>
	<body>
		<div class="container-fluid">
			<header class="row" id="menu">
				<nav class="navbar navbar-inverse navbar-fixed-top">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
						<a class="navbar-brand" href="/Planejamento"><h4>planejAÍ</h4></a>
					</div>	

					<div class="collapse navbar-collapse" id="myNavbar">
						<div class="col-xs-5">
						  	<ul class="nav navbar-nav">						    
							    <li><a href="tabela.html">Informações</a></li> 
							    <li><a href="contato.html">Contato</a></li>  
						  	</ul>
						  </div>

					  	<div class="col-xs-6">
				  		
						</div>					
					</div>
	    		</nav>
			</header>

			<div class="jumbotron">
				<div class="row">
					<div class="col-xs-5">
					    <img class="img-responsive" id="logo" src="../img/calendar3.png" alt="Calendario">
					</div>
				
					<div class="col-md-1">
					</div>

					<div class="col-md-5">

						<div class="col-md-12">
		    				<?php echo $this->Session->flash(); ?>
			    		</div>	

			    		<legend>Esqueceu sua senha?</legend>

			    		Informe o seu email no campo abaixo. Caso o email informado esteja cadastrado em nosso site, uma senha provisória será enviada para o mesmo. <br><br>

			    		Obs.: <b><i>Por segurança, acesse o sistema e altere a senha !</i></b> <br><br>
				
						<?php 
							echo $this->Form->create('Aluno', array('controller' => 'alunos', 'action' => 'recupera'));

							echo $this->Form->input('email', array('class' => 'form-control', 'type' => 'email', 'autofocus')) . '<br />';

							//botões
							echo $this->Form->button('Enviar', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => '')) . ' ';
						
							echo $this->Html->link('Voltar', array('action' => '../'), array('class' => 'btn btn-danger', 'target' => '_self'));
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
	
	
