
<?php

App::uses('CakeEmail', 'Network/Email');

foreach ($aluno as $a):

	foreach ($atividade as $atv):

			if($a['Aluno']['id'] == $atv['Atividade']['aluno_id']){

				foreach ($lembrete as $l):

					if($atv['Atividade']['id'] == $l['Lembrete']['atividade_id'] and 
	                   $atv['Atividade']['data'] >= date('Y-m-d', mktime(0,0,0, date('m'), date('d'), date('Y')))) {

						if($l['Lembrete']['data'] == date('Y-m-d', mktime(0,0,0, date('m'), date('d'), date('Y')))) {

							$Email = new CakeEmail('smtp');
							$Email->emailFormat('html');   
							$Email->to($a['Aluno']['email']);
							$Email->subject('planejAí: Lembrete de atividade próxima');
							$Email->send('Olá ' . $a['Aluno']['nome'] . ', <br><br>
								Você possui uma atividade próxima cadastrada em nosso site pendente !  <br><br>
								<b><u>Detalhes da atividade:</u></b> <br><br>
								<b>Nome:</b> '. $atv['Atividade']['nome'] .'<br>
								<b>Disciplina:</b> '. $atv['Disciplina']['nome'] .'<br>
								<b>Data de Realização ou Entrega:</b> '. date("d/m/Y", strtotime($atv['Atividade']['data'])) .'<br>
								<b>Valor:</b> '. $atv['Atividade']['valor'] .'pts.<br><br>
								Guilherme Silva Felix<br>
                                <i>Desenvolvedor do sistema planejAí</i><br>');
						}
					}

				endforeach; 

			}

	endforeach;

endforeach; 

$this->requestAction(array('action' => 'redireciona')); 

?>