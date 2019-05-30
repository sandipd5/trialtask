<?php

namespace App\Http\Controllers;

use Illuminate\support\Collection;
use Excel;
use Illuminate\Http\Request;

class FormController {

	public function getData(Request $request) {
		$request->validate([
			'name' => 'required|alpha|max:255',
			'email' => 'required|email|max:255|unique:users',
			'gender' => 'required',
			'number' => 'required|numeric',
			'address' => 'required|string|max:255',
			'nationality' => 'required',
			'education' => 'required|string|max:255',
			'contact' => 'required',
		]);
		$file = Excel::create('text', function ($excel) use ($request) {
			$excel->sheet('sheet', function ($sheet) use ($request) {
				$sheet->row(1, array('name', 'email', 'address', 'gender', 'number', 'dob', 'nationality', 'education', 'contact'));
				$sheet->row(2, array($request->name, $request->email, $request->address, $request->gender, $request->number, $request->dob, $request->nationality, $request->education, $request->contact));
			});
		})->store('csv', storage_path('csv'));
		return redirect()->action('FormController@getCsv');
	}

	public function getCsv() {
		$data = Excel::load(storage_path('csv\text.csv'))->toArray()[0];
		//dd($data);
		//var_dump($data);
		return view('show')->withData($data);
	}

	public function demo()
	{
		$sites = collect([
		'http://google.com',
        'http://plus.google.com',
        'http://facebook.com',
        'http://twitter.com',
        'http://search.twitter.com',
        'http://apple.com'
		])->map(function($site){
			return str_replace('http://','https://www.',$site);
			})->reject(function($sit){
				return str_contains($sit,'facebook')==true;
			});
		dd($sites);

	}
}
