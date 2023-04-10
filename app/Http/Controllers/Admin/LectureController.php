<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures =  Lecture::all();
        // foreach ($lectures as $key => $value) {
        //     dd($value->timeslot);
        // }
        return view('admin.lecture.index')->with('lectures',$lectures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lecture.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => ['required'],
            'room_id' => ['required'],
            'timeslot_id' => ['required'],
        ]);
        $lecture = Lecture::where('subject_id',$request->subject_id)->where('room_id',$request->room_id)->where('timeslot_id',$request->timeslot_id)->first();
        if($lecture){
            toastr()->error('lecture with this timeslot and room already exists');
            return redirect()->back();
        }
        if($validator->fails()){
            toastr()->error($validator->errors()->first());
             return redirect()->back();
        }
        Lecture::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {

        $product = Lecture::find($request->id);

        $product->delete();
        // toastr()->success('Delete successfully ');
        return redirect()->back();
    }
    public function update(Request $request)
    {



        $city = Lecture::find($request->id);

        $city->update($request->all());
        // toastr()->success('update successfully ');
        return redirect()->back();
    }
}
