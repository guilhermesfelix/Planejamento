<?php

class Disciplina extends AppModel {

    public $hasMany = array(
        'Atividade' => array(
            'dependent' => true,
            'exclusive' => true
        )
    ); 

    public $belongsTo = array(
        'Aluno' => array(
            'className' => 'Aluno',
            'foreignKey' => 'aluno_id'
        )
    );

	public $validate = array(

        'nome' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o nome da disciplina!'
            )
        )
    );
}
?>
