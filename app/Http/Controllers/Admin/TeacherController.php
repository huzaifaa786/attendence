<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Validate;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers  = Teacher::all();
        return view('admin.teacher.index')->with('teachers',$teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = Validate::teacher_register($request, Teacher::class);
        Teacher::create($credentials);
        toastr()->info('Teacher was registered');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $Teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $Teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $Teacher
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {

        $product = Teacher::find($request->id);

        $product->delete();
        // toastr()->success('Delete successfully ');
        return redirect()->back();
    }
    public function update(Request $request)
    {



        $city = Teacher::find($request->id);

        $city->update($request->all());
        // toastr()->success('update successfully ');
        return redirect()->back();
    }
}
