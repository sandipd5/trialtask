<?php

namespace App\Http\Controllers;
use Mapper;

class MapController extends Controller {
	//
	public function getMap($latitude = 1.1123, $longitude = 1.1233) {

		$map = Mapper::map($latitude, $longitude);
		return view('map')->withMap($map);

	}
}
