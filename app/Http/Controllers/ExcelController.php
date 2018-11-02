<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
use App\Result;
use Datatables;
use Session;
use Validator;


class ExcelController extends Controller
{
    //
    public function index()
    {
        return view('excel/index');
    }

    public function downloadExcel($type)
    {
        $data = Result::get()->toArray();
            
        return Excel::create('easyservice_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
 
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['name' => $value->name, 'faculty' => $value->faculty,'subject' => $value->subject,'total_marks' => $value->total_marks,'obtained_marks' => $value->obtained_marks,'remarks' => $value->remarks,'created_at' => $value->created_at,'updated_at' => $value->updated_at];
            }
 
            if(!empty($arr)){
                Result::insert($arr);
            }
        }
       // return redirect()->action('ExcelController@displayData');
       // return view('excel/display')->withArr($arr);
 
        return back()->with('success', 'Insert Record successfully.');
    }


    public function displayData(){
        //$data = Result::get();
        return view('excel/display');
    }

    public function getData(){
        // return datatables()->of(Result::query())->toJson();
         $result = Result::select(['id', 'name', 'faculty', 'subject','total_marks','obtained_marks','remarks' ,'created_at', 'updated_at']);
          return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href="#edit-'.$result->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
    }

    public function postData(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'faculty'  => 'required',
            'subject'  => 'required',
            'total_marks' => 'required',
            'obtained_marks'  => 'required',
            'remarks' => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            if($request->get('button_action') == "insert")
            {
                $result = new Result([
                    'name'  =>  $request->get('name'),
                    'faculty'  =>  $request->get('faculty'),
                    'subject'  =>  $request->get('subject'),
                    'total_marks'  =>  $request->get('total_marks'),
                    'obtained_marks'  =>  $request->get('obtained_marks'),
                    'remarks'  =>  $request->get('remarks'),

                ]);
                $result->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
            $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
            );
            echo json_encode($output);
        }
    }

}
