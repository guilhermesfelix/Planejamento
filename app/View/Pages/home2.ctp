<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
	</head>
	
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
						<a class="navbar-brand" href="home.html">agendAí</a>
					</div>	

					<div class="collapse navbar-collapse" id="myNavbar">
						<div class="col-xs-5">
					  	<ul class="nav navbar-nav">						    
						    <li><a href="tabela.html">Informações</a></li> 
						    <li><a href="contato.html">Contato</a></li>  
					  	</ul>
					  </div>
					  <div class="col-xs-6">
				  		<?php 
				    		echo $this->Form->create(
					    			"Aluno", 
					    			array('controller' => 'alunos',
					    				'action'=>'home_aluno'));

					    	echo '<div class="col-md-5 input-group input-group-sm">

						 						<span class="input-group-addon" id="sizing-addon3"><img id="icone" src="img/user.png" alt="iconeUser"/></span>';

				    						echo $this->Form->text('email', array('class' => 'form-control', 'aria-describedby' => 'sizing-addon3', 'placeholder' => 'Email'));

						 						echo '<span class="input-group-addon" id="sizing-addon3"><img id="icone" src="img/lock.png" alt="iconeLock"/></span>';

				    						echo $this->Form->text('senha', array('class' => 'form-control', 'type' => 'password', 'aria-describedby' => 'sizing-addon3', 'placeholder' => 'Senha'));
				    		echo '</div>';

	    					echo $this->Form->reset('Limpar', array('class' => 'btn btn-warning', 'label' => ''));

	    					echo $this->Form->submit('Entrar', array('class' => 'btn btn-success', 'label' => ''));

				    		echo '
												<a href="../alunos/recuperar_senha" id="recuperar">Esqueci minha senha!</a>
											';	
				    	?>
						</div>					
					</div>
	    	</nav>
			</header>

			<div class="jumbotron">
				<div class="row">
					<div class="col-md-5">
					  <div class="thumbnail inner-border">
					    <img class="img-responsive" id="logo" src="images/ufop.png" alt="Logo Sistêmico">
					  </div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6 ">					    
			      <form class="form-horizontal" role="form" name="Cadastro" method="get" action="homeAluno.html">
							<legend>Cadastro de Usuário:</legend>								
						  <div class="form-group">
					      <label class="col-md-2 control-label" for="matricula">Matrícula:</label>
					      <div class="col-md-8">
				          <input type="text" class="form-control" placeholder="Digite sua matrícula">
				        </div>
					    </div>
					    <div class="form-group">
				        <label class="col-md-2 control-label" for="nome">Nome completo:</label>
				        <div class="col-md-8">
				            <input type="text" class="form-control" placeholder="Digite seu nome">
				        </div>
					    </div>
					    <div class="form-group">
				        <label class="col-md-2 control-label" for="email">Email:</label>
				        <div class="col-md-8">
				          <input type="text" class="form-control" placeholder="Ex: email@email.com">
				        </div>
					    </div>
					    <div class="form-group">
					    	<label class="col-md-2 control-label" for="tipo">Tipo de usuário:</label>
				        <div class="col-md-8">
			            <select class="form-control" id="periodo">
			            	<option>Selecione seu tipo</option>
			            	<option>Aluno</option>
			            	<option>Professor</option>
									</select>
				        </div>
					    </div>
					    <div class="form-group">
					    	<div class="col-md-2"></div>
					    	<div class="col-md-4">
									<input type="reset" class="btn btn-warning" value="Limpar">
									<input type="submit" class="btn btn-success" value="Cadastrar">	
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
      <div class="container-fluid" id="foot">
				<footer id="footerRow">
        	<div class="col-md-6">
        		Sistêmico © Sistema Acadêmico<br />Universidade Federal de Ouro Preto		        
        	</div>	

        	<div class="col-md-6">
        		Guilherme Silva Felix - guilhermesfelix@gmail.com
        	</div>
      	</footer>
      </div>
		</div>
	</body>
</html>