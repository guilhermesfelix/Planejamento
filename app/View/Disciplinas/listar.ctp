
<script language="Javascript">
function confirma(id) {
     var resposta = confirm("Podem existir atividades para esta disciplina. Você realmente deseja excluí-la?");
 
     if (resposta == true) {
          window.location.href = "delete/"+id;
     }
}
</script>

<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
  		<li><?php echo $this->Html->link('Início', array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
		<li class="active">Minhas Disciplinas</li>
	</ul> 

	<div class="row">
		<div class="col-md-3">
	  		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('controller' => 'atividades', 'action' => 'home_aluno')); ?></li>
				<li class="active"><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>

		<div class="col-md-7 col-md-offset-1">

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>

			<a href="add_disc" class="btn btn-primary" title="Adicionar Disciplina"><span class="glyphicon glyphicon-plus"></span> Nova Disciplina</a>

			<br><br>

			<legend>Minhas Disciplinas</legend>

			<?php

				if(empty($disciplinas)){
					echo "Você não possui disciplinas cadastradas!";
				}

				$discPorNome = Set::sort($disciplinas, '{n}.Disciplina.nome', 'asc'); //ordenar array por nome 

		 		foreach ($discPorNome as $d):

					echo '<div class="dropdown">
					  <button id="discButton" class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" title="Clique para ver opções"><h3>' . $d['Disciplina']['nome'] . '</h3>

					 		<span class="glyphicon glyphicon-menu-down pull-right"></span>
					 	</button>';

					  	echo '<ul class="dropdown-menu pull-right">

						  	<li><a href="detalhes_disc/'. $d['Disciplina']['id'] .'"> Ver Detalhes <span class="glyphicon glyphicon-th-list pull-left" id="teste"></span> </a>
						    </li>

						    <li class="divider"></li>

						    <li><a href="../atividades/add_atv/'. $aluno['Aluno']['id'] . '/'. $d['Disciplina']['id'] . '"> Adicionar Atividade <span class="glyphicon glyphicon-plus pull-left" id="teste"></span> </a>   
						    </li>

						    <li class="divider"></li>

					     	<li><a href="javascript:func()" onclick="confirma(' . $d['Disciplina']['id'] . ');"> Excluir <span class="glyphicon glyphicon-trash pull-left" id="teste"></span> </a>   
							</li>

					  	</ul>
					</div><br />';
				endforeach; 
			?>
		</div>
	</div>
</div>
