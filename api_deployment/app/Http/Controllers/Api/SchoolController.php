<?php

namespace App\Http\Controllers\Api;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scholls = DB::table('schools')->get();
        return response()->json($scholls);
        // return School::get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'school_name' => 'required | unique:schools'
        ]);
        $check = School::create($request->all());

        // $schools = School::class;
        // $scholls->school_name = $request->school_name;
        // $check = $scholls->save();

        // $data = array();
        // $data['school_name'] = $request->school_name;
        // DB::table('schools')->insert($data);
        
     
        return response('Inserted done');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $show = School::whrer('id', $id)->first();
         $show = School::findOrFail($id);

        // $show = DB::table('schools')->whrer('id', $id)->first();

        return  response()->json($show);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'school_name' => 'required | unique:schools'
        ]);
        School::findOrFail($id)->update($request->all());
        return response('update done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        School::where('id', $id)->delete();
        return response('Deleted !');
    }
}
