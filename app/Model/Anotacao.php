<?php

class Anotacao extends AppModel {

    public $belongsTo = array(
        'Atividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'atividade_id'
        )
    );
}

?>