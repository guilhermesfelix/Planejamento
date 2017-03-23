<?php

class Aluno extends AppModel {

	public $hasMany = array(
		'Atividade' => array(
			'className' => 'Atividade',
            'dependent' => true,
            'exclusive' => true
		),
		'Disciplina' => array(
			'className' => 'Disciplina',
            'dependent' => true,
            'exclusive' => true
		)
	);

	public $validate = array(

		'nome' => array(
			'notBlank' => array(
	            'rule' => 'notBlank',
	            'message' => 'Informe o seu nome!'
	        )
        ),

        'sobrenome' => array(
        	'notBlank' => array(
	            'rule' => 'notBlank',
	            'message' => 'Informe o seu sobrenome!'
	        )
        ),

		// Aqui vai o nome do campo
		'email' => array(
	    // O nome que você quiser dar na validação do campo
		    'valid' => array(
		        // Tipo de regra
		        // parãmetro true verifica se o host é válido
		        'rule' => array('email', true),
		        //Sua mensagem de erro para esta regra
		        'message' => 'Insira um email válido!',
		        //Obriga a preencher
		        'required' => true,
		        //Se quer limitar a apenas alguma action
		        'on' => 'create'
		    ),
		    //Outra regra para o mesmo campo.
		    'unique' => array(
		        //Tipo de regra
		        'rule' => 'isUnique',
		        //Sua mensagem de erro para esta regra
		        'message' => 'Email já cadastrado!'
		    )
	    ),

        'senha' => array(
	    	'min' => array(
	            'rule' => array('minLength', '6'),
        		'message' => 'Senha deve possuir no mínimo 6 caracteres'
	        )
        ),

        'old_password' => array(
			'notBlank' => array(
	            'rule' => 'notBlank',
				'message' => 'Informe sua senha antiga'
			)
		),	

		'new_password' => array(
			'notBlank' => array(
	            'rule' => 'notBlank',
				'message' => 'Informe sua senha antiga'
			)
		),	

		'confirm_password' => array(
			'notBlank' => array(
	            'rule' => 'notBlank',
				'message' => 'Confirme sua senha'
			),
	        'Match passwords' => array(
				'rule' => 'matchPasswords',
				'message' => 'Senha/Confirmação da Senha não são iguais'
			)
		),
	);

	public function beforeSave($options = array()) {
		if(isset($this->data['Aluno']['senha'])) {
			$this->data['Aluno']['senha'] = md5($this->data['Aluno']['senha']);	
		}
		return parent::beforeSave($options);
	}

}

?>
