<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
    	<li><?php echo $this->Html->link('Início', 
	    		array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
		<li><a href="../listar">Minhas Disciplinas</a></li>
		<li><?php echo $this->Html->link('Detalhes Disciplina', array('action' => 'detalhes_disc' , $disciplina['Disciplina']['id'])); ?></li>
		<li class="active">Editar</li>
  	</ul>   

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', 
	    		array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
				<li class="active"><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>
		<div class="col-md-6 col-md-offset-1">
			
			<legend>Editar Disciplina</legend>

			<?php 
				echo $this->Form->create('Disciplina', array('action' => 'add2', $disciplina['Disciplina']['id'], 'class' => 'horizontal-form'));
				
				echo $this->Form->input('id', array('class' => 'form-control'));

				echo '<div class="col-xs-6">',
					$this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome da disciplina')) . '</div>';

				echo '<div class="col-xs-6">',
				 $this->Form->input('codigo', array('class' => 'form-control', 'label' => 'Código da disciplina')) , '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('carga_horaria', array('class' => 'form-control', 'label' => 'Carga Horária')) . '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('professor', array('class' => 'form-control')) . '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->label('Email do Professor'),
					$this->Form->text('email_prof', array('class' => 'form-control')) . '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('site_disc', array('class' => 'form-control', 'label' => 'Site da disciplina')),
				
				'</div><div class="col-md-12"><br />';
					echo $this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';

					echo $this->Html->link('Cancelar', array('action' => 'detalhes_disc', $disciplina['Disciplina']['id']), array('class' => 'btn btn-danger', 'target' => '_self')) . '</div>
				</div>';
			?>
		</div>
	</div>
</div>
