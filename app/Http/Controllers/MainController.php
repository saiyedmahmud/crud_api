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

                    'status' => 201,
                    'message' => 'Successfully created'
                ];
                return response()->json($data, 201);
            } else {
                $data = [
                    'status' => 400,
                    'message' => 'Bed request!'
                ];
                return response()->json($data, 400);

            }
        }
    }
    public function studentupdate(Request $request, $id)
    {
        $student = Student::find($id);
        
        $student->name = empty($request->name)? $student->name : $request['name'];
        $student->email =empty($request->email)? $student->email : $request['email'];
        $student->section = empty($request->section)? $student->section : $request['section'];
        $student->roll = empty($request->roll)? $student->roll : $request['roll'];
        $student->department = empty($request->department)? $student->department : $request['department'];
        $student->is_active = empty($request->is_active)? $student->is_active : $request['is_active'];
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
                        return response()->json($data, 522);}
                    }
    
            // $student = Student::find($id);
            // if ($student) {
            //     $student->name = $request['name'];
            //     $student->email = $request['email'];
            //     $student->section = $request['section'];
            //     $student->roll = $request['roll'];
            //     $student->department = $request['department'];
            //     $student->is_active = $request['is_active'];
            //     $student->save();
            //     if ($student) {
            //         $data = [
            //             'status' => 200,
            //             'message' => 'Successfully updated'
            //         ];
            //         return response()->json($data, 200);
            //     } else {
            //         $data = [
            //             'status' => 522,
            //             'message' => 'Something went wrong!'
            //         ];
            //         return response()->json($data, 522);

            //     }
            // } else {
            //     $data = [
            //         'status' => 404,
            //         'message' => 'id not found!'
            //     ];
            //     return response()->json($data, 404);

            // }
        // }


        // if($request->name){
        //     $validate = $request->validate([
        //         'name' => 'required|string|max:250'
        //     ]);
        //     if($validate){
        //         $student = Student::find($id);
        //         $student->name=$request['name'];
        //         $student->save();
        //         if ($student) {
        //             $data = [
        //                 'status' => 200,
        //                 'message' => 'Successfully updated'
        //             ];
        //             return response()->json($data, 200);
        //         } else {
        //             $data = [
        //                 'status' => 522,
        //                 'message' => 'Something went wrong!'
        //             ];
        //             return response()->json($data, 522);

        //         }

        //     }
        // }else if($request->email){
        //     $validate = $request->validate([
        //         'email' => 'required|string|max:250'
        //     ]);
        //     if($validate){
        //         $student = Student::find($id);
        //         $student->email=$request['email'];
        //         $student->save();
        //         if ($student) {
        //             $data = [
        //                 'status' => 200,
        //                 'message' => 'Successfully updated'
        //             ];
        //             return response()->json($data, 200);
        //         } else {
        //             $data = [
        //                 'status' => 522,
        //                 'message' => 'Something went wrong!'
        //             ];
        //             return response()->json($data, 522);

        //         }

        //     }}else if($request->section){
        //         $validate = $request->validate([
        //             'section' => 'required|string|max:250'
        //         ]);
        //         if($validate){
        //             $student = Student::find($id);
        //             $student->section=$request['section'];
        //             $student->save();
        //             if ($student) {
        //                 $data = [
        //                     'status' => 200,
        //                     'message' => 'Successfully updated'
        //                 ];
        //                 return response()->json($data, 200);
        //             } else {
        //                 $data = [
        //                     'status' => 522,
        //                     'message' => 'Something went wrong!'
        //                 ];
        //                 return response()->json($data, 522);
    
        //             }
    
        //         }}else if($request->roll){
        //             $validate = $request->validate([
        //                 'roll' => 'required|integer|max:250'
        //             ]);
        //             if($validate){
        //                 $student = Student::find($id);
        //                 $student->roll=$request['roll'];
        //                 $student->save();
        //                 if ($student) {
        //                     $data = [
        //                         'status' => 200,
        //                         'message' => 'Successfully updated'
        //                     ];
        //                     return response()->json($data, 200);
        //                 } else {
        //                     $data = [
        //                         'status' => 522,
        //                         'message' => 'Something went wrong!'
        //                     ];
        //                     return response()->json($data, 522);
        
        //                 }
        
        //             }}else if($request->department){
        //                 $validate = $request->validate([
        //                     'department' => 'required|string|max:250'
        //                 ]);
        //                 if($validate){
        //                     $student = Student::find($id);
        //                     $student->department=$request['department'];
        //                     $student->save();
        //                     if ($student) {
        //                         $data = [
        //                             'status' => 200,
        //                             'message' => 'Successfully updated'
        //                         ];
        //                         return response()->json($data, 200);
        //                     } else {
        //                         $data = [
        //                             'status' => 522,
        //                             'message' => 'Something went wrong!'
        //                         ];
        //                         return response()->json($data, 522);
            
        //                     }
            
        //                 }
        //             }else if($request->is_active){
        //                     $validate = $request->validate([
        //                         'is_active' => 'required|string|max:250'
        //                     ]);
        //                     if($validate){
        //                         $student = Student::find($id);
        //                         $student->is_active=$request['is_active'];
        //                         $student->save();
        //                         if ($student) {
        //                             $data = [
        //                                 'status' => 200,
        //                                 'message' => 'Successfully updated'
        //                             ];
        //                             return response()->json($data, 200);
        //                         } else {
        //                             $data = [
        //                                 'status' => 522,
        //                                 'message' => 'Something went wrong!'
        //                             ];
        //                             return response()->json($data, 522);
                
        //                         }
                
        //                     }
        //                 }
                        // if($request->all()){
        // $validator = validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|string|max:250',
        //         'email' => 'required|email|max:250',
        //         'section' => 'required|string|max:250',
        //         'roll' => 'required|integer|max:250',
        //         'department' => 'required|string|max:250',
        //         'is_active' => 'required|string|max:250'
        //     ]
        // );
        
    // }
    // }
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