
<?php 
	if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/'){ ?>

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

						<legend>Contato:</legend>

						Para entrar em contato com o administrador do sistema envie uma mensagem para o email abaixo:<br><br>

						<b>Email:</b> guilhermesfelix@planejai.pe.hu <br><br>

						Obrigado, te responderemos em breve.
					</div>
				</div>
			</div>
		</div>
<?php } else { ?>


		<div class="container-fluid">
			<ul class="breadcrumb" id="bread">
			    <li><a href="../atividades/home_aluno">Início</a></li>
			    <li class="active">Contato</li>
		  	</ul>   

		  	<div class="row">
				<div class="col-md-3">
		      		<legend>Menu</legend>
				 	<ul class="nav nav-pills nav-stacked">
			    		<li><a href="../atividades/home_aluno">Início</a></li>
						<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
						<li><a href="../atividades/listar">Minhas Atividades</a></li>
		        		<li><a href="../atividades/historico">Histórico de Atividades</a></li>
			  		</ul>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">

					<legend>Contato:</legend>

					Para entrar em contato com o administrador do sistema envie uma mensagem para o email abaixo:<br><br>

					Email: guilhermesfelix@planejai.pe.hu <br><br>

					Obrigado, te responderemos em breve.
				</div>
			</div>
		</div>
<?php } ?>