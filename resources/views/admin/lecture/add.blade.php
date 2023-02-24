@extends('layout.admin')
@section('title')
Lecture Add
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title txt4">Create Lecture</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.lecture.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Select Subject:</label>
                            <select id="course_id" name="subject_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select Course</option>

                                @foreach (App\Models\Subject::all() as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Select Room:</label>
                            <select id="course_id" name="room_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select Course</option>

                                @foreach (App\Models\Room::all() as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label>Select Time Slot:</label>
                            <select id="course_id" name="timeslot_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select timeslot</option>

                                @foreach (App\Models\TimeSlot::all() as $slot)
                                    <option value="{{ $slot->id }}">{{ $slot->start_time }}--{{ $slot->end_time }}-- {{$slot->day->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
