<?php

namespace App\Services;

use App\Mission;

use Illuminate\Routing\Redirector;

class MissionServices extends Services
{

	public function add($mission){
		parent::save($mission);

		return response()->json([
        	'purpose' => $mission->purpose,
        	'method' => $mission->method,
        	'goals' => $mission->goals,
        	'id' => $mission->id
    	]);
	}

	public function delete($id){
		Mission::destroy($id);
	}

	public function edit($mission) {
		parent::save($mission);
	}


}
