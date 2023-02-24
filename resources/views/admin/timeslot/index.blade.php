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
                    <th>Name</th>
                    <th>Course</th>
                    <th>Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeslots as $key => $slot)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$slot->start_time}}</td>
                    <td>{{$slot->end_time}}</td>
                    <td>{{$slot->day->name}}</td>
                    
                    <td></td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <!--end: Datatable-->
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
@endsection
