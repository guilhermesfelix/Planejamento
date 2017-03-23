<div class="container-fluid">
	<ul class="breadcrumb" id="bread"> 
		<?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){ ?>

			<li><?php echo $this->Html->link('Início', 
			array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
			<li><?php echo $this->Html->link('Detalhes Atividade', array('controller' => 'atividades', 'action' => 'detalhes_atv2' , $atividade['Atividade']['id'], $atividade['Atividade']['disciplina_id'])); ?></li>
			<li class="active">Ver Anotações</li>

		<?php } else { ?>

			<li><?php echo $this->Html->link('Início', 
			array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
			<li><a href="../../atividades/listar">Minhas Atividades</a></li>
			<li class="active">Ver Anotações</li>

		<?php } ?>
  	</ul> 

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
		 		<?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/detalhes_atv2/' . $atividade['Atividade']['id'] . '/' . $atividade['Atividade']['disciplina_id']){ ?>

		    		<li class="active"><?php echo $this->Html->link('Início', array('controller' => 'atividades','action' => 'home_aluno')); ?>
					</li>
					<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
					<li><a href="../../atividades/listar">Minhas Atividades</a></li>
					<li><a href="../../atividades/historico">Histórico de Atividades</a></li>

				<?php } else { ?>

					<li><?php echo $this->Html->link('Início', array('controller' => 'atividades','action' => 'home_aluno')); ?>
					</li>
					<li><a href="../../disciplinas/listar">Minhas Disciplinas</a></li>
					<li class="active"><a href="../../atividades/listar">Minhas Atividades</a></li>
					<li><a href="../../atividades/historico">Histórico de Atividades</a></li>

				<?php } ?>
	  		</ul><br />
		</div> 

		<div class="col-md-7 col-md-offset-1">

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<legend>Minhas Anotações para <?php echo '"' . $atividade['Atividade']['nome'] . ' - ' . $atividade['Disciplina']['nome'] .'"'?></legend>

				<?php 
					if(empty($anotacao)) {
						echo 'Você ainda não possui anotações para esta atividade!<br><br>';
						echo '<a href="../../anotacaos/add_nota/' . $atividade['Atividade']['id'] . '" class="btn btn-default" role="button" /><span class="glyphicon glyphicon-plus"></span> Nova Anotação</a>';
					}

					else {
				 		echo '<div class="col-md-6"><a href="../../anotacaos/add_nota/' . $atividade['Atividade']['id'] . '" class="btn btn-default" role="button" /><span class="glyphicon glyphicon-plus"></span> Nova Anotação</a>'; 
				 	}
				?>
					</div><br /><br /><br />
		</div>

		<div class="col-md-6 col-md-offset-1">

			<?php foreach ($anotacao as $nota): ?>

				<div class="col-md-6">
					<div class="thumbnail">
				      	<div class="caption">
					        <h3><?php echo $nota['Anotacao']['nome'] ?></h3> 

					        <?php echo $this->Html->link('',
						    		array('action' => 'delete', $nota['Anotacao']['id'], $nota['Anotacao']['atividade_id']),
						    		array('class' => 'del glyphicon glyphicon-trash btn btn-default pull-right', 'title' => 'Excluir', 'confirm' => 'Você realmente deseja excluir esta anotação? ', 'escape' => false)
								) . $this->Html->link('',
						    			array('action' => 'edit_nota', $nota['Anotacao']['id']),
						    			array('class' => 'glyphicon glyphicon-pencil btn btn-default pull-right', 'title' => 'Editar')
								); ?>

							<br><br>

					        <textarea id="textarea" readonly="readonly"><?php echo $nota['Anotacao']['texto'] ?> </textarea><br />
				      	</div>
				    </div>
				</div>
				
			<?php endforeach; ?>
		</div>
	</div>
</div>

