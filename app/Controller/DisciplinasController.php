<?php 

class DisciplinasController extends AppController {

	public $helpers = array('Html' , 'Form');
	public $components = array('Flash');

	public function index() {
		
	}

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

			$this->request->data['Disciplina']['aluno_id'] = $ida;

			if(empty($this->request->data['Disciplina']['codigo'])){	
				$this->request->data['Disciplina']['codigo'] = '-';
			}

			if(empty($this->request->data['Disciplina']['carga_horaria'])){	
				$this->request->data['Disciplina']['carga_horaria'] = '-';
			}

			if(empty($this->request->data['Disciplina']['professor'])){	
				$this->request->data['Disciplina']['professor'] = '-';
			}
			if(empty($this->request->data['Disciplina']['email_prof'])){	
				$this->request->data['Disciplina']['email_prof'] = '-';
			}
			if(empty($this->request->data['Disciplina']['site_disc'])){	
				$this->request->data['Disciplina']['site_disc'] = '-';
			}

			if ($this->Disciplina->save($this->request->data)) {
	    		$this->Session->setFlash('A disciplina "' . $this->request->data['Disciplina']['nome'] . '" foi cadastrada com sucesso!', 'alert-box', array('class'=>'alert-success'));

    		if ($this->Session->Check('Aluno')) {
    			$this->redirect(array('action' => 'listar'));
    		} else {
    			$this->redirect(array('controller' => 'atividades', 'action' => 'home_aluno'));
    		}
    		exit();
    	}

		} else {
        	$this->redirect(array('controller' => 'alunos', 'action' => 'home_aluno'));
        	exit();
        }
	}

	public function add2($id){
		if (!empty($this->request->data)) {		
			if ($this->Disciplina->save($this->request->data)) {
	    		$this->Session->setFlash('Disciplina "' . $this->request->data['Disciplina']['nome'] . '" atualizada com sucesso!', 'alert-box', array('class'=>'alert-success'));

	    		if ($this->Session->Check('Aluno')) {
	    			$this->redirect(array('action' => 'detalhes_disc', $id));
	    		} else {
	    			$this->redirect(array('controller' => 'alunos', 'action' => 'home_aluno'));
	    		}
	    		exit();
	    	}
		} else {
        	$this->redirect(array('controller' => 'alunos', 'action' => 'home_aluno'));
        	exit();
        }
	}

	public function detalhes_disc($id){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);

		$disciplina = $this->Disciplina->findById($id);
		$this->set('disciplina', $disciplina);
	}

	public function edit_disc($id){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);	

		$disciplina = $this->Disciplina->findById($id);
		$this->set('disciplina', $disciplina);

		if (empty($this->request->data)) {
			// Campos para edição
			$this->request->data = $this->Disciplina->findById($id);
		} else {
			// Atualizar os dados
			if ($this->Disciplina->save($this->request->data)) {
				$this->Flash->set('Disciplina atualizada com sucesso!');
				$this->redirect(array('action' => 'listar'));
			}
		}
	}

	public function add_atv($id){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$options['conditions'] = array(
		    'Disciplina.id' => $id
		);

		$disciplinas = $this->Disciplina->find('all', $options);
		$this->set('disciplinas', $disciplinas);
	}

	public function add_disc(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);
	}

	public function add_disc2(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);
	}

	public function listar(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Disciplina->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		$options['conditions'] = array(
		    'Aluno.id' => $aluno['Aluno']['id'] //só mostrar as disciplinas do aluno especifico
		);

		$disciplinas = $this->Disciplina->find('all', $options);
		$this->set('disciplinas', $disciplinas);		
	}

	public function delete($id){
		$this->Disciplina->delete($id, true);
	    $this->Session->setFlash('Disciplina excluída com sucesso!', 'alert-box', array('class'=>'alert-success'));
	    $this->redirect(array('action' => 'listar'));
	}	

}

?>