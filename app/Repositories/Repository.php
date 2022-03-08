<?php

namespace App\Repositories;

abstract class Repository{

	public function save($m){
	   $m->save();
	}

	public abstract function add($model);

	public abstract function read($id);

	public abstract function update($model);

	public abstract function delete($model);

}