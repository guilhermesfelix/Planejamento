<?php 

App::uses('CakeEmail', 'Network/Email');

class AlunosController extends AppController {

	public $helpers = array('Html' , 'Form', 'Js' => array('Jquery'));
	public $components = array('Flash');

	public function afterFilter() {
  		if ($this->action != '../' and
  			$this->action != 'recuperar_senha' and
  			$this->action != 'info' and
  			$this->action != 'contato') {
  				$this->autenticarAluno();
  		}
	}

	public function autenticarAluno(){
    
  		if (!$this->Session->Check('Aluno')) {
        	$this->redirect(array('action' => '../'));
        	exit();
  		} 
	}

  public function validar(){
		$aluno = $this->Aluno->findAllByEmailAndSenha(
					$this->data['Aluno']['email'],
					md5($this->data['Aluno']['senha']));
		if (!empty($aluno)) {
			return $aluno;
		} else {
			return false;
		}
	}

	public function login(){

		$aluno = $this->Aluno->findAllByEmail($this->data['Aluno']['email']);
		$this->set('aluno', $aluno);

  	if (!empty($this->data['Aluno']['email']) and
  		!empty($this->data['Aluno']['senha'])) {

  		$aluno = $this->validar();

  		if ($aluno != false) {

  			if ($aluno['0']['Aluno']['status'] == '1'){
	  			$this->Session->write('Aluno', $aluno);
	  			$this->set('aluno', $aluno);
	  			$this->redirect(array('controller' => 'atividades', 'action' => 'home_aluno'));
	  			exit();

  			} else {
  				$this->Session->setFlash('Provavelmente você não confirmou o seu cadastro ! Acesse seu email, confirme seu cadastro e tente novamente.', 'alert-box', array('class'=>'alert-danger'));
  				$this->redirect(array('action' => '../'));
  				exit();
  			}

  		} else {

  			$aluno1 = $this->Aluno->findAllByEmail($this->data['Aluno']['email']);

				if (empty($aluno1)) {
					$this->Session->setFlash('Usuário não existe !', 'alert-box', array('class'=>'alert-danger'));
    			$this->redirect(array('action' => '../'));
    			exit();
				}

				else {
    			$this->Session->setFlash('Login e/ou senha inválidos !', 'alert-box', array('class'=>'alert-danger'));
    			$this->redirect(array('action' => '../'));
    			exit();
    		}
  		}
  	} else {
  		$this->Session->setFlash('Erro', 'alert-box', array('class'=>'alert-danger'));
  		$this->redirect(array('action' => '../'));
  		exit();
  	}
	}

	public function info(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);
	}

	public function contato(){
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);
	}

	public function confcadastro($email){

  	$aluno = $this->Aluno->findAllByEmail(base64_decode($email));
  	$this->set('aluno', $aluno);

  	if(!empty($aluno)) {

			$data = array('id' => $aluno['0']['Aluno']['id'], 'status' => '1');
			$this->Aluno->save($data);
			$this->Session->setFlash('Seu cadastro foi confirmado com sucesso ! Realize seu login e aproveite as 
				funcionalidades do nosso site!', 'alert-box', array('class'=>'alert-success'));
			$this->redirect(array('action' => '../'));

		}
		else {
			$this->Session->setFlash('Ocorreu algum erro ao validar seu Email. Favor tentar novamente mais tarde.', 
				'alert-box', array('class'=>'alert-danger'));
			$this->redirect(array('action' => '../'));
		}
	}

	public function add() {

		if (!empty($this->data)) {

			$aluno = $this->Aluno->find('all');
			$this->set('aluno', $aluno);

			$existe;

			foreach ($aluno as $a) { //verificar se email já existe

				if($a['Aluno']['email'] == $this->request->data['Aluno']['email']){
					$existe = 1;
					break;
				}
				else {
					$existe = 0;
				}

			}
				
			if($existe == 0){

				$Email = new CakeEmail('smtp');
				$Email->emailFormat('html');   
				$Email->to($this->request->data['Aluno']['email']);
				$Email->subject('Confirmação de cadastro');
				$Email->send('Olá ' . $this->request->data['Aluno']['nome'] . ', <br><br>
					Obrigado por se cadastrar em nosso site ! <br><br>
					Para concluir o seu cadastro, clique no link abaixo.<br><br>
					<a href="http://localhost:8282/Planejamento/alunos/confcadastro/' 
					. base64_encode($this->request->data['Aluno']['email']) . '">Clique aqui</a><br><br>
					Guilherme Silva Felix - Desenvolvedor do sistema planejAí.');

				$this->request->data['Aluno']['status'] = 0;

			}

			else{
				$this->Session->setFlash('O email informado já está cadastrado em nosso site !', 'alert-box', array('class'=>'alert-danger'));
				$this->redirect(array('action' => '../'));
			}
			

			if ($this->Aluno->save($this->request->data)) {
				$this->Session->setFlash('Cadastro realizado com sucesso! 
					Para ativar sua conta, confirme seu cadastro no email informado.', 
					'alert-box', array('class'=>'alert-success'));
				$this->redirect(array('action' => '../'));
				$this->Session->write('Aluno', $this->request->data); 
				exit();
    	}
		} else {
			$this->Session->setFlash('Erro. Não foi possível gravar os dados informados!', 
					'alert-box', array('class'=>'alert-danger'));
   	 	$this->redirect(array('action' => '../'));
  		exit();
    }
	}

	public function meu_perfil() {
	    $aluno = $this->Session->read('Aluno');
	    $aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);
	}

  	public function editar() {
		$aluno = $this->Session->read('Aluno');
    	$aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']); 
		$this->set('aluno', $aluno);

		if (empty($this->request->data)) {
			// Campos para edição
			$this->request->data = $this->Aluno->findById($aluno['Aluno']['id']);
		} else {
			// Atualizar os dados
			if ($this->Aluno->save($this->request->data)) {
				$this->Session->setFlash('Dados do aluno alterados com sucesso!', 'alert-box', array('class'=>'alert-success'));
				$this->redirect(array('action' => 'meu_perfil'));
			}
		}
	}

	function geraSenha($tamanho, $maiusculas, $numeros, $simbolos) {
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';

		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;

		if ($maiusculas) 
			$caracteres .= $lmai;
		if ($numeros) 
			$caracteres .= $num;
		if ($simbolos) 
			$caracteres .= $simb;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

	public function recupera(){

		if (!empty($this->data)) {

			$aluno = $this->Aluno->find('all');
			$this->set('aluno', $aluno);

			$existe;
			$senha;
			$nome;

			foreach ($aluno as $a) { //verificar se email existe

				if($a['Aluno']['email'] == $this->request->data['Aluno']['email']){

					$existe = 1;
					$senha = $this->geraSenha(6,true,true,true);
					$nome = $a['Aluno']['nome'];

					$data = array('id' => $a['Aluno']['id'], 'senha' => $senha);
			    $this->Aluno->save($data);

					break;
				}

				else {
					$existe = 0;
				}

			}
				
			if($existe == 1){

				$Email = new CakeEmail('smtp');
				$Email->emailFormat('html');   
				$Email->to($this->request->data['Aluno']['email']);
				$Email->subject('Solicitação de troca de senha');
				$Email->send('Olá ' . $nome . ', <br><br>
					Sua senha provisória é : ' . $senha . ' <br><br>
					Por segurança, acesse o sistema e altere esta senha ! <br><br>
					Guilherme Silva Felix<br>
					<i>Desenvolvedor do sistema planejAí.<i><br>');

				$this->Session->setFlash('A senha provisória foi enviada para o email informado !', 'alert-box', array('class'=>'alert-success'));
				$this->redirect(array('action' => 'recuperar_senha'));
			}

			else {
				$this->Session->setFlash('O email informado não está cadastrado em nosso site ! Informe outro email.', 'alert-box', array('class'=>'alert-danger'));
				$this->redirect(array('action' => 'recuperar_senha'));
			}
		}
	}

	public function altera(){
		$aluno = $this->Session->read('Aluno');
		$aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);

		if (!empty($this->data))  {

			if((md5($this->data['Aluno']['old_password']) == $aluno['Aluno']['senha'])){

				if ($this->data['Aluno']['new_password'] == $this->data['Aluno']['confirm_password']){

					$data = array('id' => $aluno['Aluno']['id'], 'senha' => $this->data['Aluno']['new_password']);

					if ($this->Aluno->save($data)){

						$this->Session->setFlash('Senha alterada com sucesso!', 'alert-box', array('class'=>'alert-success'));
						//erro aki. reiniciar sessão, sei lá
						$this->redirect(array('action' => 'editar'));
						exit();
					}
					else{
						$this->Session->setFlash('Ocorreu um problema, e não foi possível alterar a sua senha. Tente novamente mais tarde.', 'alert-box', array('class'=>'alert-danger'));
						$this->redirect(array('action' => 'editar'));
						exit();
					}
				}
				else{
					$this->Session->setFlash('A confirmação da nova senha está incorreta!', 'alert-box', array('class'=>'alert-danger'));
					$this->redirect(array('action' => 'altera_senha'));
					exit();
				}
			}
			else{
				$this->Session->setFlash('A senha atual informada está incorreta!', 'alert-box', array('class'=>'alert-danger'));
				$this->redirect(array('action' => 'altera_senha'));
				exit();
			}
		} 
	}

	public function altera_senha(){
		$aluno = $this->Session->read('Aluno');
		$aluno = $this->Aluno->findById($aluno['0']['Aluno']['id']);
		$this->set('aluno', $aluno);
	}

	public function recuperar_senha(){

	}

	public function delete($id){
		$this->Aluno->delete($id);
    $this->Flash->set('Aluno apagado com sucesso!');
    $this->Session->destroy();
    $this->redirect(array('action' => '../'));
	}	

	public function logout(){
  	$this->Session->destroy();
  	$this->redirect('/');
  	exit();
  }
}

?>