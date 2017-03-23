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
						    <li><?php echo $this->Html->link('Informações', array('controller' => 'alunos', 'action' => 'info')); ?></li> 
						    <li><?php echo $this->Html->link('Contato', array('controller' => 'alunos', 'action' => 'contato')); ?></li>  
					  	</ul>
					  </div>

					  <div class="col-xs-6">
				  		<?php 
				    		echo $this->Form->create('Aluno', array('action' => 'login', 'class' => 'navbar-form pull-right horizontal-form'));

					    	echo '<div class="col-xs-4 input-group ">
			 						<span class="input-group-addon" id="sizing-addon3"><img id="icone" src="img/user.png" alt="iconeUser"/></span>';

	    						echo $this->Form->text('email', array('class' => 'form-control', 'type' => 'email', 'aria-describedby' => 'sizing-addon3', 'placeholder' => 'Email'));
				    		echo '</div>';

				    		echo '  ';

				    		echo '<div class="col-xs-4 input-group">
			 						<span class="input-group-addon" id="sizing-addon3"><img id="icone" src="img/lock.png" alt="iconeLock"/></span>';

	    						echo $this->Form->text('senha', array('class' => 'form-control', 'type' => 'password', 'aria-describedby' => 'sizing-addon3', 'placeholder' => 'Senha'));
				    		echo '</div>';

	    					echo '  ';

	    					echo '<div class="col-xs-2 input-group input-group-sm">';
	    									echo $this->Form->button('<b>Entrar</b>', array('type' => 'submit', 'class' => 'btn btn-default'));
	    					echo '</div>';

	    					
	    					echo '<div class="col-xs-2 input-group input-group-sm">
	    					</div>';
	    					echo '<div class="col-xs-3 input-group input-group-sm">
	    					</div>';
	    					echo '  ';
				    		echo '<div class="col-xs-3 input-group input-group-sm">	
												<a href="alunos/recuperar_senha" id="recuperar">Esqueci minha senha!</a>
											</div>';	
								echo $this->Form->end();
				    	?>
						</div>					
					</div>
	    	</nav>
			</header>

			<div class="jumbotron">
				<div class="row">
					<div class="col-xs-5">
					    <img class="img-responsive" id="logo" src="img/calendar3.png" alt="Calendario">
					</div>
				
					<div class="col-md-1">
					</div>

					<div class="col-md-5">

					<div class="col-md-12">
	    				<?php echo $this->Session->flash(); ?>
		    		</div>	
		    		
		    		Ainda não possui uma conta? <br /><br />
					<legend>Cadastre-se:</legend>	
						
		    		<?php 
			    		echo $this->Form->create('Aluno', 
			    					array('action' => 'add', 'class' => 'pull-left horizontal-form')); 

			    		echo '<div class="col-xs-6">';
					    	echo $this->Form->input('nome', array('class' => 'form-control', 'placeholder' => 'Nome')) . '<br>';
					    echo '</div>';

					    echo '<div class="col-xs-6">';
					    	echo $this->Form->input('sobrenome', array('class' => 'form-control', 'placeholder' => 'Sobrenome')) . '<br>';
					    echo '</div>';

					    echo '<div class="col-xs-12">';
			    			echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Ex: email@email.com')) . '<br>';
			    		echo '</div>';

			    		echo '<div class="col-xs-12">';
			    			echo $this->Form->input('senha', array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Senha'));
			    		echo '</div>';

			    		/*echo '<div class="col-xs-6">';
			    			echo $this->Form->input('confirm_password', array('class' => 'form-control', 'type' => 'password', 'label'=>'Confirme a Nova Senha', 'placeholder' => 'Confirme sua senha'));
			    		echo '</div>';*/

			    		echo '<div class="col-xs-12">';
			    			echo $this->Form->input('CADASTRAR', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'label' => ''));
			    		echo '</div>';
		    		?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>