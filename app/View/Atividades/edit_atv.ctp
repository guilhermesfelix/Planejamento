<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
		<?php 
			if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){ ?>

		    	<li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
				<li><?php echo $this->Html->link('Detalhes Atividade', array('action' => 'detalhes_atv2' , $atividade['Atividade']['id'], $atividade['Atividade']['disciplina_id'])); ?></li>
				<li class="active">Editar</li>
			
			<?php } else { ?>

				<li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
				<li><a href="../listar">Atividades</a></li>
				<li><?php echo $this->Html->link('Detalhes Atividade', array('action' => 'detalhes_atv' , $atividade['Atividade']['id'], $atividade['Atividade']['disciplina_id'])); ?></li>
				<li class="active">Editar</li>
			<?php } ?>
  	</ul>   

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
		 		<?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){ ?>

		    		<li class="active"><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
					<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
					<li><a href="../../atividades/listar">Minhas Atividades</a></li>
					<li><a href="../../atividades/historico">Histórico de Atividades</a></li>

				<?php } else { ?>

					<li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
					<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
					<li class="active"><a href="../../atividades/listar">Minhas Atividades</a></li>
					<li><a href="../../atividades/historico">Histórico de Atividades</a></li>

				<?php } ?>
	  		</ul>
		</div>
		<div class="col-md-6 col-md-offset-1">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>
  			
			<legend>Editar Disciplina</legend>

			<?php 
				if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){

					echo $this->Form->create('Atividade', array('action' => 'add4', $atividade['Atividade']['id']));
					
				} else {
					echo $this->Form->create('Atividade', array('action' => 'add3', $atividade['Atividade']['id']));
				}

				echo $this->Form->input('id', array('class' => 'form-control'));

				echo '<div class="col-xs-6">',
					$this->Form->input('nome', array('class' => 'form-control')) .
				'</div>';

				echo '<div class="col-xs-6">',
					$this->Form->label('Data'),
					$this->Form->date('data', array('class' => 'form-control')) .
				'</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('valor', array('class' => 'form-control')) 
				. '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->label('Aluno Id'),
					$this->Form->text('aluno_id', array('value' => $atividade['Atividade']['aluno_id'], 'class' => 'form-control', 'readonly')) . 
				'</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('disciplina_id', array('class' => 'form-control')). 
				'</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->input('tipo_id', array('class' => 'form-control')) . 
				'</div><div class="col-md-12"><br />';


					echo $this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';

					if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){

						echo $this->Html->link('Cancelar', array('action' => 'detalhes_atv2', $atividade['Atividade']['id'], $atividade['Atividade']['disciplina_id']), array('class' => 'btn btn-danger', 'target' => '_self')) . '<br /><br />';
					} else {

						echo $this->Html->link('Cancelar', array('action' => 'detalhes_atv', $atividade['Atividade']['id'], $atividade['Atividade']['disciplina_id']), array('class' => 'btn btn-danger', 'target' => '_self')) . '<br /><br />';
					}
				echo '</div>';
			?>
		</div>
	</div>
</div>

