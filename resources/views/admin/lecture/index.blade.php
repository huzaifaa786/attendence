@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Lectures

@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">All Lectures
            </h3>
            <div class="text-right">
            <a href="{{route('admin.lecture.create')}}" class="btn btn-primary "> Add Lecture</a>

            </div>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Subject</th>
                    <th>Room</th>
                    <th>Time</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lectures as $key => $lecture)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$lecture->subject->course->title}}</td>
                    <td>{{$lecture->subject->name}}</td>
                    <td>{{$lecture->room->room_no}}</td>
                    <td>{{$lecture->timeslot->start_time}}- {{$lecture->timeslot->end_time}}-{{$lecture->timeslot->day->name}}</td>
                
                    <td> <button type="button" class="btn btn-danger waves-effect m-r-20 btn-sm delete-btn"
                        id="{{ $lecture->id }}" data-toggle="modal"
                        data-target="#delete_modal">Delete</button>
                </td>
                <td> <button type="button" class="btn btn-success m-r-20 btn-sm edit-btn"
                        id="{{ $lecture->id }}" subjectid="{{ $lecture->subject->id }}" 
                         roomid="{{ $lecture->room->id }}"  dayid="{{$lecture->timeslot->id}}" data-toggle="modal"
                        data-target="#defaultModal">Edit</button></td>
                    </tr>
  
    @endforeach

    </tbody>
    </table>
    <!--end: Datatable-->
</div>
</div>



<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete lecture</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="GET" action="{{ route('delete/lecture') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="" class="text-danger"> Are you sure you want to delete ? </label>
                    <input type="hidden" name="id" id="del_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Edit Lecture</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('edit-lecture') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    @csrf
                 
                    <div class="col-md-12">
                        <label>Select Subject:</label>
                        <select id="name" name="subject_id" class="form-control form-control-select2 txt4" data-fouc required>
                            <option selected disabled>Select Course</option>

                            @foreach (App\Models\Subject::all() as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="col-md-12">
                        <label>Select Room:</label>
                        <select id="room" name="room_id" class="form-control form-control-select2 txt4" data-fouc required>
                            <option selected disabled>Select Course</option>

                            @foreach (App\Models\Room::all() as $room)
                                <option value="{{ $room->id }}">{{ $room->room_no }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="col-md-12">
                        <label>Select Time Slot:</label>
                        <select id="day" name="timeslot_id" class="form-control form-control-select2 txt4" data-fouc required>
                            <option selected disabled>Select timeslot</option>

                            @foreach (App\Models\TimeSlot::all() as $slot)
                                <option value="{{ $slot->id }}">{{ $slot->start_time }}--{{ $slot->end_time }}-- {{$slot->day->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id" id="del_tech">
                 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SAVE CHANGES</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3')}}"></script>
<!--end::Page users-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/js/pages/crud/datatables/basic/paginations.js?v=7.0.3')}}"></script>
<script>
    $(document).ready(function() {



        $('tbody').on('click', '.delete-btn', function() {

            let id = this.id;

            $('#del_id').val(id);

            // $('#deleteForm').attr('action', '{{ route('delete/teacher', '') }}' + '/' + id);

        });
        $('tbody').on('click', '.edit-btn', function() {
            
            let id = this.id;
            let name = $(this).attr('subjectid');
            let room = $(this).attr('roomid');
            let day = $(this).attr('dayid');
            let course = $(this).attr('courseid');
            // let image = $(this).attr('image');



            $('#name').val(name);
            $('#room').val(room);
            $('#day').val(day);
            $('#courseid').val(course);
            $('#del_tech').val(id);
            
           

            // $('#updateForm').attr('action', '{{ route('edit-teacher', '') }}' + '/' + id);

        });

    })
</script>
<!--end::Page Scripts-->

@endsection