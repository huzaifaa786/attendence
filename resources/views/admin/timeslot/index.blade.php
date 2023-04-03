@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Time Slots
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title txt4">Create Time Slot</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.timeslot.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>Start Time</label>
                            <input name="start_time" type="time" class="form-control" placeholder="Enter Course Title"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Time</label>
                            <input name="end_time" type="time" class="form-control" placeholder="Enter Course Title"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Select Day:</label>
                            <select id="course_id" name="day_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select day</option>

                                @foreach (App\Models\Day::all() as $day)
                                    <option value="{{ $day->id }}">{{ $day->name }}</option>
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

<div class="card card-custom mt-5">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">All TimeSlots
            </h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>start_time</th>
                    <th>end_time</th>
                    <th>Day</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeslots as $key => $slot)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$slot->start_time}}</td>
                    <td>{{$slot->end_time}}</td>
                    <td>{{$slot->day->name}}</td>
                    
                    <td> <button type="button" class="btn btn-danger waves-effect m-r-20 btn-sm delete-btn"
                        id="{{ $slot->id }}" data-toggle="modal"
                        data-target="#delete_modal">Delete</button>
                </td>
                <td> <button type="button" class="btn btn-success m-r-20 btn-sm edit-btn"
                        id="{{ $slot->id }}" start="{{ $slot->start_time }}"  end="{{ $slot->end_time }}" 
                         day="{{ $slot->day->id }}"  data-toggle="modal"
                        data-target="#defaultModal">Edit</button></td>
                    </tr>
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
                <h5 class="modal-title">Delete TimeSlot</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="{{ route('delete/timeslot') }}" enctype="multipart/form-data">
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
                <h4 class="title" id="defaultModalLabel">Edit TimeSlot</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('edit-timeslot') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    @csrf
                    <label> Start Time</label>
                    <div class="form-group form-float">
                        <input type="time" class="form-control" id="startid" placeholder="Name" name="start_time"
                            required>
                    </div>
                    <label>End Time</label>
                    <div class="form-group form-float">
                        <input type="time" class="form-control" id="endid" placeholder="Name" name="end_time"
                            required>
                    </div>
                    <div class="col-md-12">
                        <label>Select Day:</label>
                        <select id="dayid" name="day_id" class="form-control form-control-select2 txt4" data-fouc required>
                            <option selected disabled>Select day</option>

                            @foreach (App\Models\Day::all() as $day)
                                <option value="{{ $day->id }}">{{ $day->name }}</option>
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
<!--end::Page Scripts-->
<script>
    $(document).ready(function(){
        // $('tbody').on('click','.edit-btn',function(){

        //     let id = this.id;
        //     let name = $(this).attr('name');
        //     let email = $(this).attr('email');
        //
        //     $('#name').val(name);
        //     $('#email').val(email);
        //  $('#updateForm').attr('action','{{route('admin.user.update','')}}' +'/'+id);

        // });

        $('body').on('click', '.delete-btn', function(){
                        let id = $(this).attr('id');
                        $('#del_id').val(id);
                        $('#deleteForm').attr('action','{{route('admin.user.destroy','')}}' +'/'+id);
        });
    });
</script>
<script>
    $(document).ready(function() {



        $('tbody').on('click', '.delete-btn', function() {

            let id = this.id;

            $('#del_id').val(id);

            // $('#deleteForm').attr('action', '{{ route('delete/teacher', '') }}' + '/' + id);

        });
        $('tbody').on('click', '.edit-btn', function() {

            let id = this.id;
            let start = $(this).attr('start');
            let end = $(this).attr('end');
            let day = $(this).attr('day');
            // let image = $(this).attr('image');



            $('#startid').val(start);
            $('#endid').val(end);
            $('#dayid').val(day);
            $('#del_tech').val(id);
            
           

            // $('#updateForm').attr('action', '{{ route('edit-teacher', '') }}' + '/' + id);

        });

    })
</script>
@endsection
