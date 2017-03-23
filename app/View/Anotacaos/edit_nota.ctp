<div class="container-fluid">
	<ul class="breadcrumb" id="bread"> 
		<li><?php echo $this->Html->link('Início', 
		array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
		<li><a href="../../atividades/listar">Minhas Atividades</a></li>
		<li><?php echo $this->Html->link('Detalhes Atividade', array('controller' => 'atividades', 'action' => 'detalhes_atv', $anotacao['Atividade']['id'], $anotacao['Atividade']['disciplina_id'])); ?></li>
		<li><?php echo $this->Html->link('Ver Anotações', array('action' => 'ver_notas', $anotacao['Atividade']['id'])); ?></li>
		<li class="active">Editar Anotação</li>
  	</ul>    

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('controller' => 'atividades','action' => 'home_aluno')); ?>
				</li>
				<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
				<li class="active"><a href="../../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div> 

		<div class="col-md-4 col-md-offset-1">
			<legend>Editar Anotação</legend>

			<?php 
				echo $this->Form->create('Anotacao', array('url' => array('action' => 'add2', $anotacao['Anotacao']['atividade_id']), 'class' => 'horizontal-form'));
				
				echo $this->Form->input('id', array('class' => 'form-control'));

				echo '<div class="col-xs-12">',
				 $this->Form->input('nome', array('class' => 'form-control', 'label' => '')) , '</div>';

				echo '<div class="col-xs-12"><br />',
					$this->Form->textarea('texto', array('class' => 'form-control')) . 
				'</div><br /><br /><br /><br />',
				
				'<div class="col-md-12"><br />';
					echo $this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';

					echo $this->Html->link('Cancelar', array('action' => 'ver_notas', $anotacao['Atividade']['id']), array('class' => 'btn btn-danger', 'target' => '_self')) . '</div>
				</div>';
			?>
		</div>
	</div>
</div>
