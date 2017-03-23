
<script language="Javascript">
	function confirma(id) {
	    var resposta = confirm("Podem existir anotações e/ou lembretes para esta atividade. Você realmente deseja excluí-la?");
	 
	    if (resposta == true) {
	          window.location.href = "delete/"+id;
	    }
	}
</script>

<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
    <li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
		<li class="active">Minhas Atividades</li>
  </ul> 

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
				<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
				<li class="active"><a href="../atividades/listar">Minhas Atividades</a></li>
				<li><a href="../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>

		<div class="col-md-7 col-md-offset-1">

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<?php echo 'Para adicionar alguma <b>disciplina</b> <a href="../disciplinas/add_disc" class="btn btn-default btn-xs" title="Adicionar Disciplina"> Clique aqui </a> <br><br>'; ?>

			<legend>Minhas Atividades</legend> 

			<?php
			if(!empty($atividades['0']['Atividade']['id'])) {

				$atvPorData = Set::sort($atividades, '{n}.Atividade.data', 'asc');//ordenar array por data

				$discPorNome = Set::sort($disciplinas, '{n}.Disciplina.nome', 'asc');//ordenar array por nome

				$aux = 0;

			  	foreach($discPorNome as $d): 

			  		$str = $this->requestAction(array('controller' => 'atividades', 'action' => 'str2Upper', $d['Disciplina']['nome'])); 
					
					echo '<div id="backData"><b>' . $str . '</b></div>'; ?><br>

					<?php echo '<a href="add_atv2/' . $aluno['Aluno']['id'] . '/' . $d['Disciplina']['id'] . '" class="btn btn-primary btn-xs" title="Adicionar Atividade"><span class="glyphicon glyphicon-plus"></span> Nova Atividade</a><br><br>';

					foreach($atvPorData as $a):

						if ($a['Atividade']['disciplina_id'] == $d['Disciplina']['id'] and $a['Atividade']['data'] >= date('Y-m-d', mktime(0,0,0, date('m'), date('d'), date('Y')))) {

							$aux++;
	   	   			
 	   						echo '<div class="dropdown">
	 	   						<button id="discButton" class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" title="Clique para ver opções"><h3>' . $a['Atividade']['nome'] . ' ( ' . date("d/m/Y", strtotime($a['Atividade']['data'])) . ' ) - </h3><h4>Valor: ' . $a['Atividade']['valor'] . ' pts</h4>

								 	<span class="glyphicon glyphicon-menu-down pull-right"></span>
								 </button>';

								echo '<ul class="dropdown-menu pull-right">

								  	<li><a href="detalhes_atv/'. $a['Atividade']['id'] . '/' . $d['Disciplina']['id'] . '"> Ver Detalhes <span class="glyphicon glyphicon-th-list pull-left" id="teste"></span> </a>
								    </li>

								    <li class="divider"></li>

								    <li><a href="../anotacaos/add_nota/' . $a['Atividade']['id'] .'"> Adicionar Anotação <span class="glyphicon glyphicon-pencil pull-left" id="teste"></span> </a>   
						    		</li>

						    		<li><a href="../anotacaos/ver_notas/' . $a['Atividade']['id'] .'"> Ver Anotações <img id="glyphiconNote" class="pull-left" src="../img/glyphicons/glyphicons-40-notes.png" /> </a>   
						    		</li>

								    <li class="divider"></li>

								    <li><a href="../lembretes/add_lembt/'. $a['Atividade']['id'] . '"> Adicionar Lembrete <img id="glyphicon" class="pull-left" src="../img/glyphicons/glyphicons-54-alarm.png" /></a>   
						    		</li>

								    <li><a href="../lembretes/ver_lembts/'. $a['Atividade']['id'] . '"> Ver Lembretes <span class="glyphicon glyphicon-eye-open pull-left" id="teste"></span> </a>   
						    		</li>

						    		<li class="divider"></li>

								    <li><a href="javascript:func()" onclick="confirma(' . $a['Atividade']['id'] . ');"> Excluir <span class="glyphicon glyphicon-trash pull-left" id="teste"></span> </a>   
						    		</li>
								    
							 	 </ul>
							</div><br />';
						} /*else {
		   	  				echo 'Ainda não foram adicionadas atividades para esta disciplina ! <br /><br />';
		   				}*/
		   			endforeach;	
		   			if($aux == 0){
						echo 'Esta disciplina não possui nenhuma atividade pendente ! <br />';
					}
					$aux = 0;
		   			echo '<br /><hr>'; 
		 		endforeach; 
		  	} 
			else {
				echo 'Você ainda não possui atividades em nenhuma disciplina !<br /><br /><a href="add_atv3/' . $aluno['Aluno']['id'] .'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Nova Atividade</a>';
			} 
			?>
		</div>
	</div>
</div>
