<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 */
class TagsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tag->recursive = 0;
		$tags = $this->paginate();
		$info = $this->Tag->Book->getSummaryInfo();
		$this->set(compact('tags', 'info'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$options = array(
			'conditions' => array(
				'Tag.' . $this->Tag->primaryKey => $id
			),
			'recursive' => 2
		);

		$tag  = $this->Tag->find('first', $options);
		$info = $this->Tag->Book->getSummaryInfo();
		$this->set(compact('tag', 'info'));
	}

}