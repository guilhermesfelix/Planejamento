<?php

//App::import('Controller', 'Anotacaos'); //importar outro controller 

//$Anotacaos = new AnotacaosController(); //carregá-lo 

//If we want the model associations, components, etc to be loaded
//$Anotacaos->constructClasses();

class AtividadesController extends AppController {

	public $helpers = array('Html' , 'Form');
	public $components = array('Flash');

	public function afterFilter() {
  		if ($this->action != '../') {
  			$this->autenticarAluno();
  		}
	}

	public function autenticarAluno(){
    
  		if (!$this->Session->check('Aluno')) {
        	$this->redirect(array('action' => '../'));
        	exit();
  		} 
	}

	public function home_aluno(){
    	$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$options['conditions'] = array(
		    'Aluno.id' => $aluno['Aluno']['id'] //só mostrar as disciplinas do aluno especifico
		);

		$options2['conditions'] = array(
		    'Aluno.id' => $aluno['Aluno']['id'], //só mostrar as disciplinas do aluno especifico.
		    'Atividade.data >=' => date('Y-m-d') //só mostrar as atividades do aluno especifico e data maior que a atual.
		);

		$disciplinas = $this->Atividade->Disciplina->find('all', $options);
		$this->set('disciplinas', $disciplinas);

		$atividades = $this->Atividade->find('all', $options2);
		$this->set('atividades', $atividades);
	}

	public function add($ida, $idd){
		if (!empty($this->data['Atividade']['nome'])) {	

			$this->request->data['Atividade']['disciplina_id'] = $idd;
			$this->request->data['Atividade']['aluno_id'] = $ida;

			$disciplinas = $this->Atividade->Disciplina->findById($idd);
			$this->set('disciplinas', $disciplinas);

			if($this->request->data['Atividade']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))) {

				if ($this->Atividade->save($this->request->data)) {

		    		$this->Flash->success('A atividade "' . $this->request->data['Atividade']['nome'] . '" para a disciplina "' . $disciplinas['Disciplina']['nome'] . '" foi adicionada com sucesso!', 
		    			array('key' => 'positive'));

		    		if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/add_atv2/' . $ida . '/' . $idd){
	    				$this->redirect(array('action' => 'listar'));
	    			} else {
	    				$this->redirect(array('controller' => 'disciplinas', 'action' => 'listar'));
	    			}
		    	}
		    }
		    else {
		    	$this->Session->setFlash('Data inválida ! Informe uma data igual ou após o dia atual.', 'alert-box', array('class'=>'alert-danger'));
		    	$this->redirect(array('action' => 'add_atv2', $ida, $idd));
		    }	
		} else {
        	exit();
        }
	}

	public function add2($ida){
		if (!empty($this->data['Atividade']['nome'])) {	

			$this->request->data['Atividade']['aluno_id'] = $ida;

			$disciplinas = $this->Atividade->Disciplina->findById($this->request->data['Atividade']['disciplina_id']);
			$this->set('disciplinas', $disciplinas);

			if($this->request->data['Atividade']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))){

				if ($this->Atividade->save($this->request->data)) {

		    		$this->Flash->success('A atividade "' . $this->request->data['Atividade']['nome'] . '" para a disciplina "' . $disciplinas['Disciplina']['nome'] . '" foi adicionada com sucesso!', 
		    			array('key' => 'positive'));

	    			$this->redirect(array('action' => 'listar'));
		    	}
		    }
		    else {
		    	$this->Session->setFlash('Data inválida ! Informe uma data igual ou após o dia atual.', 'alert-box', array('class'=>'alert-danger'));
		    	$this->redirect(array('action' => 'add_atv2', $ida, $this->request->data['Atividade']['disciplina_id']));
		    }
		} else {
        	exit();
        }
	}

	public function add3($id){
		if (!empty($this->request->data)) {	

			$disciplinas = $this->Atividade->Disciplina->findById($this->request->data['Atividade']['disciplina_id']);
			$this->set('disciplinas', $disciplinas);

			if($this->request->data['Atividade']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))){
				
				if ($this->Atividade->save($this->request->data)) {
					
		    		$this->Flash->success('A atividade "' . $this->request->data['Atividade']['nome'] . '" foi atualizada com sucesso!', 
		    			array('key' => 'positive'));

		    		if ($this->Session->Check('Aluno')) {
		    			$this->redirect(array('action' => 'detalhes_atv', $id, $this->request->data['Atividade']['disciplina_id']));
		    		} else {
		    			$this->redirect(array('action' => 'home_aluno'));
		    		}
		    		exit();
		    	}
		    }
		    else {
		    	$this->Session->setFlash('Data inválida ! Informe uma data igual ou após o dia atual.', 'alert-box', array('class'=>'alert-danger'));

		    	if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/atividades/edit_atv/' . $id){

		    		$this->redirect(array('action' => 'edit_atv', $id));
		    	} else {
		    		$this->redirect(array('action' => 'add_atv2', $this->request->data['Atividade']['aluno_id'], $this->request->data['Atividade']['disciplina_id']));
		    	}
		    }
		} else {
        $this->redirect(array('action' => 'home_aluno'));
        exit();
      }
	}

	public function add4($id){
		if (!empty($this->request->data)) {	

			$disciplinas = $this->Atividade->Disciplina->findById($this->request->data['Atividade']['disciplina_id']);
			$this->set('disciplinas', $disciplinas);

			if($this->request->data['Atividade']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))){

				if ($this->Atividade->save($this->request->data)) {

		    		$this->Flash->success('A atividade "' . $this->request->data['Atividade']['nome'] . '" foi atualizada com sucesso!', 
		    			array('key' => 'positive'));

		    		if ($this->Session->Check('Aluno')) {
		    			$this->redirect(array('action' => 'detalhes_atv2', $id, $this->request->data['Atividade']['aluno_id']));
		    		} else {
		    			$this->redirect(array('action' => 'home_aluno'));
		    		}

		    		exit();
		    	}
		    }
		    else {
		    	$this->Session->setFlash('Data inválida ! Informe uma data igual ou após o dia atual.', 'alert-box', array('class'=>'alert-danger'));
		    	$this->redirect(array('action' => 'edit_atv', $id));
		    }
		} else {
        $this->redirect(array('action' => 'home_aluno'));
        exit();
      }
	}

	public function add_atv($ida, $idd){ //add por lista de disciplinas
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$this->loadModel('Tipo');
		$tipos = $this->Tipo->find('list', array('fields' => array('id', 'tipo'))); 
		$this->set('tipos', $tipos);
		
		$this->set('ida', $ida); //faz com que eu possa utilizar esta variavel na view
		$this->set('idd', $idd);

		$disciplinas = $this->Atividade->Disciplina->findById($idd);
		$this->set('disciplinas', $disciplinas);
	}

	public function add_atv2($ida, $idd){ //add por lista de atividades
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$this->loadModel('Tipo');
		$tipos = $this->Tipo->find('list', array('fields' => array('id', 'tipo'))); 
		$this->set('tipos', $tipos);
		
		$this->set('ida', $ida);
		$this->set('idd', $idd);

		$disciplinas = $this->Atividade->Disciplina->findById($idd);
		$this->set('disciplinas', $disciplinas);
	}

	public function add_atv3($ida){ //nenhuma disciplina cadastrada

    	$aluno = $this->Atividade->Aluno->findById($ida);
		$this->set('aluno', $aluno);

		$this->loadModel('Tipo');
		$tipos = $this->Tipo->find('list', array('fields' => array('id', 'tipo'))); 
		$this->set('tipos', $tipos);

		$this->loadModel('Disciplina');
		$disciplinas = $this->Disciplina->find('list', array(
	        'fields' => array('id', 'nome'),
	        'conditions' => array('Aluno.id' => $aluno['Aluno']['id']),
	        'recursive' => 0
	    ));
		$this->set('disciplinas', $disciplinas);
		
		$this->set('ida', $ida);
	}

	public function listar(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$options['conditions'] = array(
		    'Aluno.id' => $aluno['Aluno']['id'] //só mostrar as disciplinas do aluno especifico
		);

		$disciplinas = $this->Atividade->Disciplina->find('all', $options);
		$this->set('disciplinas', $disciplinas);

		$atividades = $this->Atividade->find('all', $options);
		$this->set('atividades', $atividades);
	}

	public function detalhes_atv($ida, $idd){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$disciplina = $this->Atividade->Disciplina->findById($idd);
		$this->set('disciplina', $disciplina);

		$atividade = $this->Atividade->findById($ida);
		$this->set('atividade', $atividade);
	}

	public function detalhes_atv2($ida, $idd){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$disciplina = $this->Atividade->Disciplina->findById($idd);
		$this->set('disciplina', $disciplina);

		$atividade = $this->Atividade->findById($ida);
		$this->set('atividade', $atividade);
	}

	public function edit_atv($id){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$this->loadModel('Disciplina');
		$disciplinas = $this->Disciplina->find('list', array(
	        'fields' => array('id', 'nome'),
	        'conditions' => array('Aluno.id' => $aluno['Aluno']['id']),
	        'recursive' => 0
	    ));
		$this->set('disciplinas', $disciplinas);
		
		$this->set('tipos', $this->Atividade->Tipo->find('list', array('fields' => array('id', 'tipo'))));

		$atividade = $this->Atividade->findById($id);
		$this->set('atividade', $atividade);

		if (empty($this->request->data)) {
			$this->request->data = $this->Atividade->findById($id);
		} else {
			if ($this->Atividade->save($this->request->data)) {
				$this->Flash->success('A atividade "' . $this->request->data['Atividade']['nome'] . '" para a disciplina "' . $disciplinas['Disciplina']['nome'] . '" foi atualizada com sucesso!', 
	    			array('key' => 'positive'));
				$this->redirect(array('action' => 'listar'));
			}
		}
	}

	public function historico(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$options['conditions'] = array(
		    'Aluno.id' => $aluno['Aluno']['id'] //só mostrar as disciplinas do aluno especifico
		);

		$disciplinas = $this->Atividade->Disciplina->find('all', $options);
		$this->set('disciplinas', $disciplinas);

		$atividades = $this->Atividade->find('all', $options);
		$this->set('atividades', $atividades);

		//carregar função de outro controller
		//$this->requestAction(array('controller'=>'Anotacaos', 'action'=>'ver_notas'));	
	}

	public function delete($id){
		$this->Atividade->delete($id);
	    $this->Flash->success('A atividade foi excluída com sucesso!', 
	    			array('key' => 'positive'));
	    $this->redirect(array('action' => 'listar'));
	}

	public function delete2($id){
		$this->Atividade->delete($id);
	    $this->Flash->success('A atividade foi excluída com sucesso!', 
	    			array('key' => 'positive'));
	    $this->redirect(array('action' => 'historico'));
	}	

	public function delete3($id){
		$this->Atividade->delete($id);
	    $this->Flash->success('A atividade foi excluída com sucesso!', 
	    			array('key' => 'positive'));
	    $this->redirect(array('action' => 'home_aluno'));
	}

	public static function str2Upper($str) {
   		return strtr(strtoupper($str),'àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ','ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß');
	}
}