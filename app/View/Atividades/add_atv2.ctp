<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
    	<li><?php echo $this->Html->link('Início', 
		    array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
		<li><a href="../../listar">Minhas Atividades</a></li>
		<li class="active">Adicionar Atividade</li>
  	</ul> 

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
				<li><a href="../../../disciplinas/listar">Minhas Disciplinas</a></li>
				<li class="active"><a href="../../listar">Minhas Atividades</a></li>
				<li><a href="../../historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>
		
		<div class="col-md-6 col-md-offset-1"> 

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>

			<legend>Adicionar Atividade para <?php echo '"' . $disciplinas['Disciplina']['nome'] . '"'?></legend>

			<?php 
				echo $this->Form->create('Atividade', array('url' => array('controller' => 'atividades', 'action' => 'add', $ida, $idd), 'class' => 'horizontal-form')),

				'<div class="col-xs-6">',
					$this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome da Atividade (*)', 'autofocus')) , 
				
				'</div><div class="col-xs-6">',
					$this->Form->input('valor', array('class' => 'form-control', 'label' => 'Valor da Atividade (*)',)) , 
				
				'</div><div class="col-xs-6"><br />',
					$this->Form->label('Data de Entrega ou Realização (*)'),
					$this->Form->date('data', array('class' => 'form-control')) , 
				
				'</div><div class="col-xs-6"><br />',
					$this->Form->input('tipo_id', array('class' => 'form-control', 'label' => 'Tipo de Atividade (*)', 'empty' => 'Selecione o tipo')),
				
				'</div><div class="col-xs-12"><br />',

					'(*) Campos obrigatórios.<br /><br />',

					$this->Form->button('Salvar', array('class' => 'btn btn-primary ', 'label' => '')) . ' ',
					
					$this->Html->link('Cancelar', array('action' => 'listar'), array('class' => 'btn btn-danger', 'target' => '_self')),
					'<br /><br />
				</div>';
			?>
		</div>
	</div>
</div>
