<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
    	<li><a href="../../atividades/home_aluno">Início</a></li>
    	<li><a href="listar">Minhas Disciplinas</a></li>
    	<li class="active">Detalhes Disciplina</li>
  	</ul>   

  	<div class="row">
		<div class="col-md-3">
      		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><a href="../../atividades/home_aluno">Início</a></li>
				<li class="active"><a href="../listar">Minhas Disciplinas</a></li>
				<li><a href="../../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>

		<div class="col-md-1"></div>
		<div class="col-md-7" id="dados">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<legend>Detalhes da Disciplina</legend>

	   	   	<b>Nome:</b> <?php echo $disciplina['Disciplina']['nome'] ?> <br /><br />
	   	   	<b>Código:</b> <?php echo $disciplina['Disciplina']['codigo'] ?> <br /><br />
	       	<b>Carga Horária:</b> 
	       	<?php if($disciplina['Disciplina']['carga_horaria'] == '-'){
	       			echo $disciplina['Disciplina']['carga_horaria'] . '<br /><br />';
	       		  }  
	       		  else {
	       		  	echo $disciplina['Disciplina']['carga_horaria'] . ' horas/aula<br /><br />';
	       		  } ?> 
	       		  
	       	<b>Professor:</b> <?php echo $disciplina['Disciplina']['professor'] ?> <br /><br />
	       	<b>Email do Professor:</b> <?php echo $disciplina['Disciplina']['email_prof'] ?> <br /><br />
	       	<b>Site da Disciplina:</b><?php echo '<a href="../../../' . $disciplina['Disciplina']['site_disc'] . '"> ' . $disciplina['Disciplina']['site_disc'] . '</a><br>'; ?> <br /><hr />
		    
		    <?php 
				echo $this->Html->link('Editar Dados', 
					array('action' => 'edit_disc', $disciplina['Disciplina']['id']),
					array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';
			  
				echo $this->Html->link('Voltar', 
					array('action' => 'listar'),
					array('class' => 'btn btn-danger', 'target' => '_self')) . ' ';
			?>
			<br /><br />
		</div>
	</div>
</div>
