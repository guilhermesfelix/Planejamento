<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
		<?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/listar'){ ?>
		    <li><?php echo $this->Html->link('Início', 
				array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
				<li><a href="../atividades/listar">Minhas Atividades</a></li>
				<li class="active">Adicionar Disciplina</li>
		<?php } else { ?>
				<li><?php echo $this->Html->link('Início', 
				array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
				<li><a href="listar">Minhas Disciplinas</a></li>
				<li class="active">Adicionar Disciplina</li>
		<?php } ?>
  	</ul> 

  		<div class="row">
			<div class="col-md-3">
    			<legend>Menu</legend>
		 		<ul class="nav nav-pills nav-stacked">

		 			<?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/listar'){ ?>

		    			<li><?php echo $this->Html->link('Início', array('controller' => 'atividades','action' => 'home_aluno')); ?>
						</li>
						<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
						<li class="active"><a href="../atividades/listar">Minhas Atividades</a></li>
						<li><a href="../atividades/historico">Histórico de Atividades</a></li>

					<?php } else { ?>

						<li><?php echo $this->Html->link('Início', array('controller' => 'atividades','action' => 'home_aluno')); ?>
						</li>
						<li class="active"><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
						<li><a href="../atividades/listar">Minhas Atividades</a></li>
						<li><a href="../atividades/historico">Histórico de Atividades</a></li>

					<?php } ?>
	  			</ul>
			</div> 
	
			<div class="col-md-6 col-md-offset-1">
			<legend>Adicionar Disciplina</legend>


			<?php 
				echo $this->Form->create('Disciplina', array('url' => array('controller' => 'disciplinas', 'action' => 'add', $aluno['Aluno']['id']), 'class' => 'horizontal-form')),

				'<div class="col-xs-6"><br />',
					$this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome da disciplina (*)', 'autofocus')) ,

				'</div><div class="col-xs-6"><br />',
					$this->Form->input('codigo', array('class' => 'form-control', 'label' => 'Código da disciplina')) ,
					
				'</div><div class="col-xs-6"><br />',
					$this->Form->input('carga_horaria', array('class' => 'form-control', 'label' => 'Carga Horária')), 
					 
				'</div><div class="col-xs-6"><br />',
					$this->Form->input('professor', array('class' => 'form-control')) ,
					
				'</div><div class="col-xs-6"><br />',
					$this->Form->label('Email do professor'), 
					$this->Form->email('email_prof', array('class' => 'form-control')) , 
					 
				'</div><div class="col-xs-6"><br />' ,
					$this->Form->input('site_disc', array('class' => 'form-control', 'label' => 'Site da disciplina')) ,	

				'</div><div class="col-xs-12"><br />',
					'(*) Campo obrigatório.<br /><br />',
					
					$this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';
		
					if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/listar'){ //compara se o endereço anterior é igual a este. O $_SERVER['HTTP_HOST'] retorna localhost:8282
						echo $this->Html->link('Cancelar', array('controller' => 'atividades', 'action' => 'listar'), array('class' => 'btn btn-danger', 'target' => '_self'));
					}
					else if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/add_atv3/' . $aluno['Aluno']['id']){ //compara se o endereço anterior é igual a este. O $_SERVER['HTTP_HOST'] retorna localhost:8282
						echo $this->Html->link('Cancelar', array('controller' => 'atividades', 'action' => 'add_atv3', $aluno['Aluno']['id']), array('class' => 'btn btn-danger', 'target' => '_self'));
					}
					else {
						echo $this->Html->link('Cancelar', array('action' => 'listar'), array('class' => 'btn btn-danger', 'target' => '_self')) . '<br /><br />';
					}
				echo '</div>';
			?>
		</div>
	</div>
</div>
