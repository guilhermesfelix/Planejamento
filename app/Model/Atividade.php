<?php

class Atividade extends AppModel {

    public $hasMany = array( //sai M chega 1
        'Lembrete' => array(
            'dependent' => true,
            'exclusive' => true
        ), 
        'Anotacao' => array(
            'dependent' => true,
            'exclusive' => true
        )
    ); 

	public $belongsTo = array( //sai 1 chega M
        'Aluno' => array(
            'className' => 'Aluno',
            'foreignKey' => 'aluno_id'
        ),
        'Disciplina' => array(
            'className' => 'Disciplina',
            'foreignKey' => 'disciplina_id'
        ),
        'Tipo' => array(
            'className' => 'Tipo',
            'foreignKey' => 'tipo_id'
        )
    );

    public $validate = array(

        'nome' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o seu nome!'
            )
        ),

        'valor' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o valor da atividade!'
            )
        ),

        'data' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe uma data!'
            )
        ),

        'tipo_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Selecione um tipo'
            )
        ),

        'disciplina_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Selecione uma disciplina'
            )
        )
    );
}
