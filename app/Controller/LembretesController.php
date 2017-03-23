<?php
	
	class LembretesController extends AppController {

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

				$this->request->data['Lembrete']['atividade_id'] = $ida;
				//$this->request->data['Lembrete']['data'] = date("d/m/Y", strtotime($this->request->data['Lembrete']['data']));

				if($this->request->data['Lembrete']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))) {

					if ($this->Lembrete->save($this->request->data)) {

			    		$this->Flash->success('O lembrete "' . 
			    		$this->request->data['Lembrete']['marcador'] . '" foi adicionado com 
			    		sucesso!', array('key' => 'positive'));

			    		if ($this->Session->Check('Aluno')) {
			    			if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . 
			    				'/Planejamento/atividades/listar'){
			    				$this->redirect(array('controller' => 'atividades', 
			    					'action' => 'listar'));
			    			}
			    			else{
			    				$this->redirect(array('action' => 'ver_lembts', $ida));
			    			}
			    		} else {
			    			$this->redirect('/');
			    		}
		    		}
		    		exit();
		    	} else {

			    	$this->Session->setFlash('Data inválida ! Informe uma data igual ou após o dia atual.', 'alert-box', array('class'=>'alert-danger'));
			    	$this->redirect(array('action' => 'ver_lembts', $ida));
		    	}

			} else {
      			$this->redirect(array('controller' => 'alunos', 'action' => 'home_aluno'));
      			exit();
      		}
		}

		public function add2($ida){

			if (!empty($this->request->data)) {	

				if($this->request->data['Lembrete']['data'] >= date("Y-m-d", mktime(0,0,0, date('m'), date('d'), date('Y')))){

					if ($this->Lembrete->save($this->request->data)) {

				    	$this->Flash->success('O lembrete "' . 
				    		$this->request->data['Lembrete']['marcador'] . '" foi atualizado com 
				    		sucesso!', array('key' => 'positive'));

			    		if ($this->Session->Check('Aluno')) {
			    			$this->redirect(array('action' => 'ver_lembts', $ida));
			    		} else {
			    			$this->redirect('/Planejamento');
			    		}
			    		exit();
		    		}
		    	} else {
		    		$this->Session->setFlash('Data inválida ! Impossível cadastrar em momento passado.', 'alert-box', array('class'=>'alert-danger'));
					$this->redirect(array('action' => 'edit_lembt', $this->request->data['Lembrete']['id']));
		    	}

			} else {
        		$this->redirect(array('controller' => 'atividades', 
        		'action' => 'home_aluno'));
        		exit();
       	 	}
		}

		public function add_lembt($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Lembrete->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);

			$atividade = $this->Lembrete->Atividade->findById($id);
			$this->set('atividade', $atividade);
		}

		public function detalhes_lembt($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Lembrete->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);

			$lembrete = $this->Lembrete->findById($id);
			$this->set('lembrete', $lembrete);
		}

		public function ver_lembts($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Lembrete->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);

			$atividade = $this->Lembrete->Atividade->findById($id);
			$this->set('atividade', $atividade);

			$options['conditions'] = array(
		    'Atividade.id' => $id //só mostrar as anotações da atividade especifica
			);

			$lembrete = $this->Lembrete->find('all', $options);
			$this->set('lembrete', $lembrete);
			
		}

		public function edit_lembt($id){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Lembrete->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);	

			$lembrete = $this->Lembrete->findById($id);
			$this->set('lembrete', $lembrete);

			if (empty($this->request->data)) {
				$this->request->data = $lembrete;
			} else {
				if ($this->Lembrete->save($this->request->data)) {
					$this->Flash->success('O lembrete "' . 
		    		$this->request->data['Lembrete']['marcador'] . '" foi atualizado 
		    		com sucesso!', array('key' => 'positive'));
					$this->redirect(array('action' => 'ver_lembts', $this->request->data['Lembrete']['atividade_id']));
				}
			}
		}

		public function listar(){
			$aluno = $this->Session->read('Aluno');
    		$aluno = $this->Lembrete->Atividade->Aluno->findById($aluno['0']['Aluno']['id']);
			$this->set('aluno', $aluno);		
		}

		public function envia_lembt(){
			$aluno = $this->Lembrete->Atividade->Aluno->find('all');
			$this->set('aluno', $aluno);

			$atividade = $this->Lembrete->Atividade->find('all');
			$this->set('atividade', $atividade);			

			$lembrete = $this->Lembrete->find('all');
			$this->set('lembrete', $lembrete);	
		}

		public function delete($id){
			$lembrete = $this->Lembrete->findById($id);
			$this->set('lembrete', $lembrete);
			$this->Lembrete->delete($id);
			$this->Flash->success('O lembrete foi excluído com sucesso!', array('key' => 'positive'));
			$this->redirect(array('action' => 'ver_lembts', $lembrete['Lembrete']['atividade_id']));
		}	

		public function redireciona(){
			$this->redirect(array('action' => '../'));
		}

	}
	
?>