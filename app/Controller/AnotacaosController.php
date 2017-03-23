<?php
	
	class AnotacaosController extends AppController {

		public $helpers = array('Html' , 'Form', 'Js' => array('Jquery'));
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

		public function add($ida){

			if (!empty($this->request->data)) {	

				$this->request->data['Anotacao']['atividade_id'] = $ida;

				if ($this->Anotacao->save($this->request->data)) {

		    	$this->Flash->success('A anotação "' . 
		    		$this->request->data['Anotacao']['nome'] . '" foi adicionada com 
		    		sucesso!', array('key' => 'positive'));

	    		if ($this->Session->Check('Aluno')) {
	    			if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . 
	    				'/Planejamento/atividades/listar'){
	    				$this->redirect(array('controller' => 'atividades', 
	    					'action' => 'listar'));
	    			}
	    			else{
	    				$this->redirect(array('action' => 'ver_notas', $ida));
	    			}
	    		} else {
	    			$this->redirect('/');
	    		}
	    		exit();
	    	}

			} else {
      	$this->redirect(array('controller' => 'alunos', 
      		'action' => 'home_aluno'));
      	exit();
      }
		}

		public function add2($ida){

			if (!empty($this->request->data)) {	

				if ($this->Anotacao->save($this->request->data)) {

		    	$this->Flash->success('A anotação "' . 
		    		$this->request->data['Anotacao']['nome'] . '" foi atualizada com 
		    		sucesso!', array('key' => 'positive'));

	    		if ($this->Session->Check('Aluno')) {
	    			$this->redirect(array('action' => 'ver_notas', $ida));
	    		} else {
	    			$this->redirect('/');
	    		}
	    		exit();
	    	}

			} else {
        	$this->redirect(array('controller' => 'alunos', 
        		'action' => 'home_aluno'));
        	exit();
        }
		}

		public function add_nota($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Anotacao->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);

			$atividade = $this->Anotacao->Atividade->findById($id);
			$this->set('atividade', $atividade);

		}

		public function ver_notas($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Anotacao->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);

			$atividade = $this->Anotacao->Atividade->findById($id);
			$this->set('atividade', $atividade);

			$options['conditions'] = array(
		    'Atividade.id' => $id //só mostrar as anotações da atividade especifica
			);

			$anotacao = $this->Anotacao->find('all', $options);
			$this->set('anotacao', $anotacao);
			
		}

		public function edit_nota($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Anotacao->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);	

			$anotacao = $this->Anotacao->findById($id);
			$this->set('anotacao', $anotacao);

			if (empty($this->request->data)) {
				$this->request->data = $anotacao;
			} 
		}

		public function listar(){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Anotacao->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);		
		}

		public function delete($idn, $ida){
			$nota = $this->Anotacao->findById($idn);
			$this->set('nota', $nota);

			$this->Anotacao->delete($idn);
		  	$this->Flash->success('A anotação "' . 
    		$nota['Anotacao']['nome'] . '" foi excluída com 
    		sucesso!', array('key' => 'positive'));
		  	$this->redirect(array('action' => 'ver_notas', $ida));
		}	

	}

?>