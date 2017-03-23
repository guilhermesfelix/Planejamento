<div class="container-fluid">
	<ul class="breadcrumb" id="bread"> 
		<li><?php echo $this->Html->link('Início', 
		array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
		<li><a href="../../atividades/listar">Minhas Atividades</a></li>
		<li><?php echo $this->Html->link('Ver Lembretes', array('action' => 'ver_lembts', $lembrete['Atividade']['id'])); ?></li>
		<li class="active">Editar Lembrete</li>
  	</ul>    

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('controller' => 'atividades', 'action' => 'home_aluno')); ?>
				</li>
				<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
				<li class="active"><a href="../../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div> 

		<div class="col-md-6 col-md-offset-1">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>

			<legend>Editar Lembrete <?php echo '"' . $lembrete['Lembrete']['marcador'] . '" da atividade "' . $lembrete['Atividade']['nome'] . '"'?> </legend>
		</div>
		<div class="col-md-4 col-md-offset-2">
			<?php 
				echo $this->Form->create('Lembrete', array('url' => array('action' => 'add2', $lembrete['Lembrete']['atividade_id']), 'class' => 'horizontal-form'));
				
				echo $this->Form->input('id', array('class' => 'form-control'));

				echo '<div class="col-xs-12">',
				 $this->Form->input('marcador', array('class' => 'form-control')) , '</div>';

				echo '<div class="col-xs-6"><br />',
					$this->Form->label('Data'),
					$this->Form->date('data', array('class' => 'form-control')) . 
				'</div>
				<div class="col-xs-6"><br />',
					$this->Form->label('Horário'),
					$this->Form->time('horario', array('class' => 'form-control')) .
				'</div><br /><br /><br /><br />',
				
				'<div class="col-md-12"><br />';
					echo $this->Form->button('Salvar', array('class' => 'btn btn-primary', 'label' => '')) . ' ';

					echo $this->Html->link('Cancelar', array('action' => 'ver_lembts', $lembrete['Atividade']['id']), array('class' => 'btn btn-danger', 'target' => '_self')) . 
				'<br><br></div>';
			?>
		</div>
	</div>
</div>
