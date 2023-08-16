<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function student()
    {
       
        $studentdata = DB::table('students')->select('*')->get();
        $student = json_decode(json_encode($studentdata, true));
        return view('student', compact('student'));
    }

    public function add_student()
    {
        return view('add');
    }

    public function addstudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'class' => 'required|numeric',
            'address' => 'required|max:300',
            'dob'     => 'required',
            // 'dob'     => 'required|date_format:d M Y',
            'image'=>'required|mimes:jpg,png'

        ]);
        if ($validator->fails()) {
            return response()->json(['error_message' => $validator->errors()->first(), 'status' => 0]);
        } else {

            if ($request->hasFile('image')) {
                $file = $request->image;
                $filename = 'tech_' . rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('image'), $filename);
            }

            $student_detail = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'class' => $request->class,
                'address' => $request->address,
                'dob' => $request->dob,
                'image' => $filename,
            ];

            $result = DB::table('students')->insertGetId($student_detail);
            if ($result) {
                return response()->json(['success_message' => 'Student record created', 'status' => 1]);
            }
        }
    }


    public function edit_student($id)
    {
        $student_data = DB::table('students')->select('*')->where('id', $id)->get();
        $student_detail = json_decode(json_encode($student_data, true));
        return view('update', compact('student_detail'));
    }
    public function update_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'class' => 'required|numeric',
            'address' => 'required|max:300',
            'dob' => 'required',
            'image'=>'mimes:jpg,png'
            

        ]);
        if ($validator->fails()) {
            return response()->json(['error_message' => $validator->errors()->first(), 'status' => 0]);
        } else {
            if ($request->hasFile('image')) {
                $file = DB::table('students')->select('image')->where('id', $request->id)->get();
                $exist_file = json_decode(json_encode($file, true));
                $path = 'image/' . $exist_file[0]->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->image;
                $filename = 'tech_' . rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('image'), $filename);

                $detail = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'class' => $request->class,
                    'address' => $request->address,
                    'dob'=>$request->dob,
                    'image'=>$filename,
                ];

            }else{
                $detail = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'class' => $request->class,
                    'address' => $request->address,
                    'dob'=>$request->dob,
                ];

            }
            $result = DB::table('students')->where('id', $request->id)->update($detail);
            if ($result) {
                return response()->json(['success_message' => 'Updated successfully', 'status' => 1]);
            } else {
                return response()->json(['error_message' => 'something went wrong', 'status' => 0]);
            }
        }
    }
    public function delete_student($id)
    {
        $file = DB::table('students')->select('image')->where('id', $id)->get();
        $exist_file = json_decode(json_encode($file, true));
        $path = 'image/' . $exist_file[0]->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $delete_result = DB::table('students')->where('id', $id)->delete();
        if ($delete_result) {
           return back();
        } else {
            return response()->json(['error_message' => 'something went wrong', 'status' => 0]);
        }
    }
}
