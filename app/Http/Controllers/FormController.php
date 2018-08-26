<?php

namespace App\Http\Controllers;
use  Excel;
use Illuminate\Http\Request;
use Storage;
class FormController {
    
  public function getData(Request $request)
   {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender'=>'required',
            'number'=>'required|numeric',
            'address'=>'required|string|max:255',
            'nationality'=>'required|string',
            'education'=>'required|string|max:255',
            'contact'=>'required|string'

        ]);
        $file= Excel::create('text', function($excel) use($request){
        $excel->sheet('sheet',function($sheet) use($request){

            $sheet->row(1,array('name','email','address','gender','number','dob','nationality','education','contact'));
            $sheet->row(2,array($request->name, $request->email,$request->address,$request->gender,$request->number,$request->dob,$request->nationality,$request->education,$request->contact));
            
        });
        })->store('csv', storage_path('csv'));
        return redirect()->action('FormController@getCsv');
      

   }
 public function getCsv(){
     $data = Excel::load(storage_path('csv\text.csv'))->toArray()[0];
     return view('show')->withData($data);
     
 }
}




