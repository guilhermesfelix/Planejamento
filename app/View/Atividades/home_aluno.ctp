
<div class="container-fluid">

	<ul class="breadcrumb" id="bread">
    	<li class="active">Início</li>
  	</ul>   

  	<div class="row row-relative">
		<div class="col-md-3">
	      	<legend>Menu</legend>
			<ul class="nav nav-pills nav-stacked">
		    	<li class="active"><a href="">Início</a></li>
				<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../atividades/listar">Minhas Atividades</a></li>
        <li><a href="../atividades/historico">Histórico de Atividades</a></li>
		  	</ul>
		</div>
		<div class="col-md-1"></div>
		
		<div class="col-md-5">

          <div class="col-md-12">
              <?php echo $this->Flash->render('positive') ?>
          </div>

      		<legend>Próximas Atividades</legend>
      		<?php
            if(empty($atividades)){
              echo 'Você não possui nenhuma atividade próxima !<br /><br />';
            }
            else {

              //if array não é vazio, mas só tem atividades passadas
                 //echo 'Você não possui nenhuma atividade próxima !<br /><br />';

        			$meses = array('Jan' => 'JANEIRO', 'Feb' => 'FEVEREIRO', 'Mar' => 'MARÇO', 'Apr' => 'ABRIL', 'Mai' => 'MAIO', 'Jun' => 'JUNHO', 'Jul' => 'JULHO', 'Aug' => 'AGOSTO', 'Sep' => 'SETEMBRO', 'Oct' => 'OUTUBRO', 'Nov' => 'NOVEMBRO', 'Dec' => 'DEZEMBRO');

  	      		$diasemana = array(
    				    0 => "DOMINGO",
    				    1 => "SEGUNDA",
    				    2 => "TERÇA",
    				    3 => "QUARTA",
    				    4 => "QUINTA",
    				    5 => "SEXTA",
    				    6 => "SÁBADO"
      				);

        			$atvPorData = Set::sort($atividades, '{n}.Atividade.data', 'asc');//ordenar array por data

        			//dia atual
        			foreach ($atividades as $atv):
        				if($atv['Atividade']['data'] == date('Y-m-d', mktime(0,0,0, date('m'), date('d'), date('Y')))) {

        					$mes = date('M'); //mes

  						    echo '<div id="backData"><b>HOJE</b>, ' . strftime(date('d')+1-1 . ' de ' . $meses[$mes] .' de %Y') . ' </div><br />';
        					break;
        				}
        			endforeach;

        			foreach ($atvPorData as $a):
        				if($a['Atividade']['data'] == date('Y-m-d')){
        					echo '<a href="detalhes_atv2/' . $a['Atividade']['id'] . '/' . $a['Disciplina']['id'] . '" title="Ver Detalhes"><b>' . $a['Atividade']['nome'] . '</b> - ' . $a['Disciplina']['nome'] . ' - Valor: ' . $a['Atividade']['valor'] . ' pts</a><br/><br/>';
        				}
        			endforeach;
  	      		
        			//amanhã
        			foreach ($atividades as $atv):
        				if($atv['Atividade']['data'] == date('Y-m-d', mktime(0,0,0, date('m'), date('d')+1, date('Y')))) {

                  $mes = date('M', mktime(0,0,0, date('m'), date('d')+1, date('Y'))); //mes

        					echo '<div id="backData"><b>AMANHÃ</b>, ' . strftime(date('d')+1 . ' de ' . $meses[$mes] .' de %Y') . ' </div><br />';
        					break;
        				}
        			endforeach;

        			foreach ($atvPorData as $a):
        				if($a['Atividade']['data'] == date('Y-m-d', mktime(0,0,0, date('m'), date('d')+1, date('Y')))){
        					echo '<a href="detalhes_atv2/' . $a['Atividade']['id'] . '/' . $a['Disciplina']['id'] . '" title="Ver Detalhes"><b>' . $a['Atividade']['nome'] . '</b> - ' . $a['Disciplina']['nome'] . ' - Valor: ' . $a['Atividade']['valor'] . ' pts</a><br/><br/>';
        				}
        			endforeach;

        			//7 próximos dias 
        			for($i = 2; $i <= 7; $i++) {

        				foreach ($atividades as $atv):
        					if($atv['Atividade']['data'] == date('Y-m-d', mktime(0,0,0, date('m'), date('d')+$i, date('Y')))) {
        				
  				      		$diasemana_numero = date('w', mktime(0,0,0, date('m'), date('d')+$i, date('Y'))); //nº dia da semana

  				      		$mes = date('M', mktime(0,0,0, date('m'), date('d')+$i, date('Y'))); //mes

  							     echo '<div id="backData"> <b>' . $diasemana[$diasemana_numero] . '</b>, ' . strftime((date('d')+$i) . ' de ' . $meses[$mes] .' de %Y', strtotime('today')) . ' </div><br />'; //exibe dia da semana em pt
  							     break;
  						    }
  					    endforeach;

        				foreach ($atvPorData as $a): //exibe atividades
  	      				if($a['Atividade']['data'] == date("Y-m-d", mktime(0,0,0, date('m'), date('d')+$i, date('Y')))) {
  	      					echo '<a href="detalhes_atv2/' . $a['Atividade']['id'] . '/' . $a['Disciplina']['id'] . '" title="Ver Detalhes"><b>' . $a['Atividade']['nome'] . '</b> - ' . $a['Disciplina']['nome'] . ' - Valor: ' . $a['Atividade']['valor'] . ' pts</a><br/><br/>';
  	      				}
        				endforeach;		
        			}

              foreach ($atividades as $atv):
                if($atv['Atividade']['data'] >= date('Y-m-d', mktime(0,0,0, date('m'), date('d')+8, date('Y')))) {
                  echo '<div id="backData"><b>PRÓXIMAS SEMANAS</b></div><br />';
                  break;
                }
              endforeach;	

        			foreach ($atvPorData as $a): 
        				if($a['Atividade']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d')+8, date('Y')))) {
        					echo ' <a href="detalhes_atv2/' . $a['Atividade']['id'] . '/' . $a['Disciplina']['id'] . '" title="Ver Detalhes"><b>' . $a['Atividade']['nome'] . '</b> - ' . $a['Disciplina']['nome'] . ' - Valor: ' . $a['Atividade']['valor'] . ' pts</a><div class="pull-right"> ' . date('d/m/Y', strtotime($a['Atividade']['data'])) . '</div><br/><br/>';
        				}
    				  endforeach;
            }
      		?>
		<hr><br></div>
		<div class="col-md-3">
            <center><div id="datetimepicker"></div></center>
			
    		<script type="text/javascript">
        		$(function () {
            		$('#datetimepicker').datetimepicker({
                  inline: true,
                  sideBySide: true
            	});
        	});
			</script>
			<br>
		</div>
	</div>
</div>
