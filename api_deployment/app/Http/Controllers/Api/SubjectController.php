<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = DB::table('subjects')->get();
        return response()->json($subjects);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'school_id' => 'required',
            'subject_name' => 'required | unique:subjects',
            'subject_code' => 'required | unique:subjects',
        ]);
        $data = array();
        $data['school_id'] = $request->school_id;
        $data['subject_name'] = $request->subject_name;
        $data['subject_code'] = $request->subject_code;
        DB::table('subjects')->insert($data);
        return response('Inserted done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = DB::table('subjects')->where('id', $id)->first();
        return  response()->json($show);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'school_id' => 'required',
            'subject_name' => 'required | unique:subjects',
            'subject_code' => 'required | unique:subjects',
        ]);
        $sub = Subject::findOrFail($id);
        $sub->school_id = $request->school_id;
        $sub->subject_name = $request->subject_name;
        $sub->subject_code = $request->subject_code;
        $sub->save();
        return response('update done'); 

        // $sub = $request->all();
        // return  response()->json($sub);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::where('id', $id)->delete();
        return response('Deleted !');
    }
}
