<div class="container-fluid">

	<ul class="breadcrumb" id="bread"> 
		<li><?php echo $this->Html->link('Início', 
		array('controller' => 'atiivdades', 'action' => 'home_aluno')); ?></li>
		<li><a href="../../atividades/listar">Minhas Atividades</a></li>
		<li><?php echo $this->Html->link('Ver Lembretes', 
		array('action' => 'ver_lembts', $atividade['Atividade']['id'])); ?></li>
		<li class="active">Adicionar Lembrete</li>
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
	  		</ul><br />
		</div> 
	
		<div class="col-md-7 col-md-offset-1">
			<legend>Adicionar Lembrete para <?php echo '"' . $atividade['Atividade']['nome'] . ' - ' . $atividade['Disciplina']['nome'] . '"'?></legend>
		</div>

		<div class="col-md-4 col-md-offset-2">
			
			<?php 

				if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/listar'){

					echo $this->Form->create('Lembrete', array('url' => array('controller' => 'lembretes', 'action' => 'add', $atividade['Atividade']['id']), 'class' => 'horizontal-form'));
				}
				else {
					echo $this->Form->create('Lembrete', array('url' => array('action' => 'add', $atividade['Atividade']['id']), 'class' => 'horizontal-form'));
				}

					echo '<div class="col-md-12">',
						$this->Form->input('marcador', array('class' => 'form-control', 'autofocus', 'placeholder' => 'Lembrar de...', 'label' => '')). '<br />',
					'</div>',
					
					'<div class="col-md-6">',
						$this->Form->label('Data'),
						$this->Form->date('data', array('class' => 'form-control', 'id' => 'data')) . '<br />',
					'</div>',

					'<div class="col-md-6">',
						$this->Form->label('Horário'),
						$this->Form->time('horario', array('class' => 'form-control')) . '<br />',
					'</div>',

					'<div class="col-md-12">',
						$this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';

						if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/listar'){
				
							echo $this->Html->link('Cancelar', array('controller' => 'atividades', 'action' => 'listar'), array('class' => 'btn btn-danger', 'target' => '_self'));
						}
						else {
							echo $this->Html->link('Cancelar', array('action' => 'ver_lembts', $atividade['Atividade']['id']), array('class' => 'btn btn-danger', 'target' => '_self'));
						}
				echo '</div>';
			?>
		</div>
	</div>
</div>


