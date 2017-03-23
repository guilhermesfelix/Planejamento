
<script language="Javascript">
	function confirma(id) {
	     var resposta = confirm("Você realmente deseja excluir esta disciplina?");
	 
	     if (resposta == true) {
	          window.location.href = "delete2/"+id;
	     }
	}
</script>

<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
    <li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
		<li class="active">Histórico</li>
  </ul> 

  	<div class="row">
		<div class="col-md-3">
    		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><?php echo $this->Html->link('Início', array('action' => 'home_aluno')); ?></li>
				<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../atividades/listar">Minhas Atividades</a></li>
				<li class="active"><a href="../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>

		<div class="col-md-7 col-md-offset-1">

			<div class="col-md-12">
				<?php echo $this->Flash->render('positive') ?>
			</div>

			<legend>Histórico de Atividades</legend> 

			<?php
				if(!empty($atividades['0']['Atividade']['id'])) {

					$atvPorData = Set::sort($atividades, '{n}.Atividade.data', 'asc');//ordenar array por data

					$discPorNome = Set::sort($disciplinas, '{n}.Disciplina.nome', 'asc');//ordenar array por nome

				  	foreach($discPorNome as $d): 

				  		$str = $this->requestAction(array('controller' => 'atividades', 'action' => 'str2Upper', $d['Disciplina']['nome'])); 

						echo '<div id="backData"><b>' . $str . '</b></div><br>'; 

						foreach($atvPorData as $a):

							if ($a['Atividade']['disciplina_id'] == $d['Disciplina']['id']) {

								if($a['Atividade']['data'] < date('Y-m-d', mktime(0,0,0, date('m'), date('d'), date('Y')))) {
		   	   			
			 	   					echo '<div class="dropdown">
			 	   						<button id="discButton" class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown" title="Clique para ver opções"><h3>' . $a['Atividade']['nome'] . ' ( ' . date("d/m/Y", strtotime($a['Atividade']['data'])) . ' ) - </h3><h4>Valor: ' . $a['Atividade']['valor'] . ' pts</h4>

										 	<span class="glyphicon glyphicon-menu-down pull-right"></span>
										 </button>';

										echo '<ul class="dropdown-menu pull-right">

										    <li><a href="javascript:func()" onclick="confirma(' . $a['Atividade']['id'] . ');"> Excluir <span class="glyphicon glyphicon-trash pull-left" id="teste"></span> </a>   
						    				</li>
										    
									 	 </ul>
									</div>';
								}
								else {
					   	  			echo 'Até o momento, nenhuma atividade foi concluída para esta disciplina ! <br />';
					   				break;
					   			}
							} else {
				   	  			echo 'Até o momento, nenhuma atividade foi concluída para esta disciplina ! <br />';
				   	  			break;
				   			}
			   			endforeach;	
			   			echo "<br /><br /><hr>";
			 		endforeach; 
			  	} 
				else {
					echo 'Você ainda não realizou nenhuma atividade em nenhuma disciplina !<br /><br />';
				} 
			?>

			<div id="modalExcluir" class="modal fade" role="dialog">
		  		<div class="modal-dialog">
		   			<div class="modal-content">
	      				<div class="modal-header">
	        				<button type="button" class="close" data-dismiss="modal">&times;</button>
	       					<h4 class="modal-title">Atenção</h4>
		     			</div>
	      				<div class="modal-body">
	        				<p>Tem certeza que deseja EXCLUIR esta disciplina?</p>
	      				</div>
		      			<div class="modal-footer">
			      			<?php
						  		echo $this->Html->link('Sim', 
	  								array('action' => 'delete', $disciplinas['Disciplina']['id']),
	  								array('class' => 'btn btn-default'));
							?>
			        		<button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
		      			</div>
		    		</div>
		 		</div>
			</div>
		</div>
	</div>
</div>
