<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
	    <li><a href="../../home_aluno">Início</a></li>
	    <li class="active">Detalhes Atividade</li>
	</ul>   

  	<div class="row">
		<div class="col-md-3">
        	<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li class="active"><a href="../../home_aluno">Início</a></li>
				<li><a href="../../../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../../listar">Minhas Atividades</a></li>
				<li><a href="../../historico">Histórico de Atividades</a></li>
		  	</ul>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-7" id="dados">

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<legend>Detalhes da Atividade</legend>

	   	   	<b>Nome:</b> <?php echo $atividade['Atividade']['nome'] ?> <br /><br />
	       	<b>Valor:</b> <?php echo $atividade['Atividade']['valor'] . ' pts'?> <br /><br />
	       	<b>Data de Entrega ou Realização:</b> <?php echo date("d/m/Y", strtotime($atividade['Atividade']['data'])) ?> <br /><br />
	       	<!--<b>Tipo:</b> <?php //echo $tipos['0']['Tipo']['tipo'] ?> <br /><br />-->
	       	<b>Disciplina:</b> <?php echo $disciplina['Disciplina']['nome'] ?> <br /><br />
		    
		    <?php 
		    	echo $this->Html->link('Voltar', 
					array('action' => 'home_aluno'),
					array('class' => 'btn btn-danger', 'target' => '_self')) . ' ';

		    	echo $this->Html->link('', array('action' => 'delete3', $atividade['Atividade']['id']),
					array('class' => 'del glyphicon glyphicon-trash btn btn-danger', 'title' => 'Excluir', 
                        'confirm' => 'Podem existir anotações e/ou lembretes para esta atividade. Você realmente deseja excluí-la?', 'escape' => false)) . ' ';

				echo $this->Html->link('Editar Dados', 
					array('action' => 'edit_atv',  $atividade['Atividade']['id']),
					array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';

				echo $this->Html->link('Ver Anotações', 
					array('controller' => 'anotacaos', 'action' => 'ver_notas',  $atividade['Atividade']['id']),
					array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';

				echo $this->Html->link('Ver Lembretes', 
					array('controller' => 'lembretes', 'action' => 'ver_lembts',  $atividade['Atividade']['id']),
					array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';
			?>
			<br /><br />
		</div>
	</div>
</div>