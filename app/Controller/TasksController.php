<?php

App::uses('AppController', 'Controller');
App::uses('RequestHandler', 'Components');

class TasksController extends AppController {

	public $uses = array('Task', 'Project');
	public $components = array('RequestHandler');

	/*
	 * GET
	 */
	public function index() {

		$tasks = $this->Task->find('all');

		$this->set(
			array(
				'tasks' 		=> $tasks,
				'_serialize' 	=> array('tasks')
			)
		);
	}

	/*
	 * POST
	 */
	public function add() {

		$name = $this->request->data('name');
		$project_id = $this->request->data('project_id');

		$this->Task->create();

		$taskData = array(
			'Task' 	=> array(
				'project_id' => $project_id
				'name' 	=> $name
			)
		);

		if($this->Task->save($taskData)) {
			$message = "Saved";
		} else {
			$message = "Error";
		}

		$this->set(
			array(
				'message' 		=> $message,
				'_serialize' 	=> array('message')
			)
		);
	}

	/*
	 * PUT
	 */
	public function edit($id) {
        $this->Task->id = $id;

        $name = $this->request->data('name');
		$project_id = $this->request->data('project_id');

		$taskData = array(
			'Task' 	=> array(
				'project_id' => $project_id
				'name' 	=> $name
			)
		);

        if ($this->Task->save($taskData)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    /*
     * DELETE
     */
    public function delete($id) {
        if ($this->Task->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    /*
     * GET /tasks/123
     */
    public function view($id) {
        $task = $this->Task->findById($id);
        $this->set(array(
            'task' => $task,
            '_serialize' => array('task')
        ));
    }
}
