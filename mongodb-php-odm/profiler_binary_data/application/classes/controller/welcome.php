<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		$binary = pack('H*', '80818283');

		Mongo_Collection::factory('test')
			->find(array('something' => new MongoBinData($binary)))
			->as_array();

		$this->response->body(View::factory('profiler/stats'));
	}

}
