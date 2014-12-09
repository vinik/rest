<?php

App::uses('AppController', 'Controller');
App::uses('RequestHandler', 'Components');

class ProjectsController extends AppController {

	public $uses = array('Project');
	public $components = array('RequestHandler');

	/*
	 * GET
	 */
	public function index() {

		$projects = $this->Project->find('all');

		$this->set(
			array(
				'projects' 		=> $projects,
				'_serialize' 	=> array('projects')
			)
		);
	}

	/*
	 * POST
	 */
	public function add() {
		$name = $this->request->data('name');

		$this->Project->create();

		$projectData = array(
			'Project' 	=> array(
				'name' 	=> $name
			)
		);

		if($this->Project->save($projectData)) {
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

		$name = $this->request->data('name');
		$projectData = array(
			'Project' 	=> array(
				'name' 	=> $name
			)
		);

        $this->Project->id = $id;
        if ($this->Project->save($projectData)) {
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
        if ($this->Project->delete($id)) {
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
     * GET /projects/123
     */
    public function view($id) {
        $project = $this->Project->findById($id);
        $this->set(array(
            'project' => $project,
            '_serialize' => array('project')
        ));
    }
}
