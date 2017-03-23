<?php

class Lembrete extends AppModel {

    public $belongsTo = array(
        'Atividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'atividade_id'
        )
    );

    public $validate = array(

        'marcador' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o nome da disciplina!'
            )
        ),

        'data' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe a data!'
            )
        ),

        'horario' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o horario!'
            )
        )

    );
}

?>