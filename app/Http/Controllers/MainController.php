<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function viewall()
    {
        $student = Student::all();
        if ($student->count() > 0) {
            $data = [
                'status' => 200,
                'student' => $student

            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No record Found'
            ];
            return response()->json($data, 404);
        }

    }
    public function viewone($id)
    {
        $student = Student::find($id);
        if ($student) {
            $data = [
                'status' => 200,
                'studnet' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Such record found'
            ];
            return response()->json($data, 404);
        }

    }
    public function studentcreate(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:250',
                'email' => 'required|email|max:250',
                'section' => 'required|string|max:250',
                'roll' => 'required|integer|max:250',
                'department' => 'required|string|max:250',
                'is_active' => 'required|string|max:250'
            ]
        );
        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data, 522);
        } else {

            $student = new Student;
            $student->name = $request['name'];
            $student->email = $request['email'];
            $student->section = $request['section'];
            $student->roll = $request['roll'];
            $student->department = $request['department'];
            $student->is_active = $request['is_active'];
            $student->save();
            if ($student) {
                $data = [

                    'status' => 200,
                    'message' => 'Successfully created'
                ];
                return response()->json($data, 200);
            } else {
                $data = [
                    'status' => 522,
                    'message' => 'Something went wrong!'
                ];
                return response()->json($data, 200);

            }
        }
    }
    public function studentupdate(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:250',
                'email' => 'required|email|max:250',
                'section' => 'required|string|max:250',
                'roll' => 'required|integer|max:250',
                'department' => 'required|string|max:250',
                'is_active' => 'required|string|max:250'
            ]
        );
        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data, 522);
        } else {
            $student = Student::find($id);
            if ($student) {
                $student->name = $request['name'];
                $student->email = $request['email'];
                $student->section = $request['section'];
                $student->roll = $request['roll'];
                $student->department = $request['department'];
                $student->is_active = $request['is_active'];
                $student->save();
                if ($student) {
                    $data = [
                        'status' => 200,
                        'message' => 'Successfully updated'
                    ];
                    return response()->json($data, 200);
                } else {
                    $data = [
                        'status' => 522,
                        'message' => 'Something went wrong!'
                    ];
                    return response()->json($data, 522);

                }
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'id not found!'
                ];
                return response()->json($data, 404);

            }
        }
    }
    public function studentdelete($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            $data = [
                'status' => 200,
                'message' => 'successfully deleted'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'NO matched record found'
            ];
            return response()->json($data, 404);
        }

    }
}