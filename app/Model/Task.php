<?php

App::uses('AppModel', 'Model');
class Task extends AppModel {
    public $name = 'Task';

    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id'
        )
    );
}