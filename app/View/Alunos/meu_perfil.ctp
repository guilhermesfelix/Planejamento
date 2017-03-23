<div class="container-fluid">

	<ul class="breadcrumb" id="bread">
    <li><a href="../atividades/home_aluno">Início</a></li>
    <li class="active">Meu Perfil</li>
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
		<div class="col-md-7" id="dados">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>

			<legend>Dados do Usuário:</legend>
	   	   	<b>Nome Completo:</b> <?php echo $aluno['Aluno']['nome'] . ' ' . $aluno['Aluno']['sobrenome'] ?> <br /><br />
	        <b>Email:</b> <?php echo $aluno['Aluno']['email'] ?> <br /><br />
		      
		    <?php 
				echo $this->Html->link('Editar Dados', 
					array('controller' => 'alunos', 'action' => 'editar'),
					array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';
			  
				echo $this->Form->button('Excluir Conta', array('class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modalExcluir', 'label' => ''));

				echo '<br /><br />';
					
			?>
		    
		    <div id="modalExcluir" class="modal fade" role="dialog">
			  	<div class="modal-dialog">
			   		<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
		       			<h4 class="modal-title">Atenção</h4>
			     		</div>
		      		<div class="modal-body">
		        		<p>Tem certeza que deseja EXCLUIR sua conta?</p>
		      		</div>
			      	<div class="modal-footer">
				      	<?php 
							  	echo $this->Html->link("Sim, desejo excluir minha conta", 
			  							array('controller' => 'alunos', 
			  									'action' => 'delete', $aluno['Aluno']['id']),
			  							array('class' => 'btn btn-default', 'target' => '_self'));
								?>
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Não, vou ficar com a conta!</button>
			      	</div>
			    	</div>
				 	</div>
				</div>
	    </div>
			<br /><br />
		</div>
	</div>
</div>
