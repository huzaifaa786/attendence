@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Students
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">All Students
            </h3>
            <div class="text-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary "> Add Student</a>

            </div>

        </div>
        <div class="alert">
            <label id="alert"></label>
        </div>
    </div>
    <div class="card-body ">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Course</th>
                    <th>Profile</th>
                    <th>Roll No</th>
                    <th>Guardian Name</th>
                    <th>Guardian Email</th>
                    <th>Manage FingerPrint</th>
                    <th class="d-none">Action</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->course->title }}</td>
                    <td><img src="{{ $user->image }}" height="50" width="50"> </td>
                    <td>{{ $user->roll_no }}</td>
                    <td>{{ $user->guardian_name }}</td>
                    <td>{{ $user->guardian_email }}</td>
                    <td>
                        @if ($user->has_finger_id == false)
                        <button class="btn btn-primary fingerid_add" fingerId="{{ $user->id }}">Add Finger
                            Print</button>
                        @elseif( $user->enrolled)
                        <span class="badge btn-success">FingerPrint Enrolled</span>
                        @else
                        <button class="btn btn-primary">Waiting for FingerPrint</button>
                        @endif
                    </td>

                    <td>
                        <button type="button" class="btn btn-success m-r-20 btn-sm edit-btn mt-1" id="{{ $user->id }}"
                            fname="{{ $user->fname }}" lname="{{ $user->lname }}" phone="{{ $user->phone }}"
                            email="{{ $user->email }}" roll_no="{{ $user->roll_no }}"
                            guardian_name="{{ $user->guardian_name }}" guardian_email="{{ $user->guardian_email }}"
                            course="{{ $user->course->id }}" image="{{ $user->image }}" data-toggle="modal"
                            data-target="#defaultModal">Edit</button>
                        <button type="button" class="btn btn-danger waves-effect mt-1 m-r-20 btn-sm delete-btn"
                            id="{{ $user->id }}" data-toggle="modal" data-target="#delete_modal">Delete</button>
                    </td>
                    <td></td>
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
                <h5 class="modal-title">Delete student</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="GET" action="{{ route('delete/student') }}" enctype="multipart/form-data">
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
                <h4 class="title" id="defaultModalLabel">Edit Student</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('edit-student') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    @csrf
                    <label> First Name</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="fname" placeholder="Name" name="fname" required>
                    </div>
                    <label>Last Name</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="iname" placeholder="Name" name="lname" required>
                    </div>
                    <label>Email</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="email" placeholder="Name" name="email" required>
                    </div>
                    <label>Phone</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="phone" placeholder="Name" name="phone" required>
                    </div>
                    <label> Roll Number</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="roll_no" placeholder="Name" name="roll_no" required>
                    </div>
                    <label>Guardian_name</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="guardian_name" placeholder="Name"
                            name="guardian_name" required>
                    </div>
                    <label>Guardian_email</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="guardian_email" placeholder="Name"
                            name="guardian_email" required>
                    </div>

                    <div class="col-md-12">
                        <label>Select Course:</label>
                        <select id="course_id" name="course_id" class="form-control form-control-select2 txt4" data-fouc
                            required>
                            <option selected disabled>Select Course</option>

                            @foreach (App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label>image</label>
                    <div class="form-group form-float">
                        <input type="file" class="form-control" id="image" placeholder="Name" name="image">
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
    $(document).on('click', '.fingerid_add', function() {

            var fingerid = $(this).attr('fingerId');
            
            $.ajax({
                url: '{{ route('admin.finger.create') }}',
                type: 'POST',
                data: {
                    'fingerid': fingerid,
                },
                success: function(response) {
                    console.log(response);
                    $('#alert').show();
                    $('#alert').text(response);
                    $('.fingerid_add').text('Waiting for FingerPrint');
                }
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
            let fname = $(this).attr('fname');
            let iname = $(this).attr('lname');
            let email = $(this).attr('email');
            let phone = $(this).attr('phone');
            let roll_no = $(this).attr('roll_no');
            let guardian_email = $(this).attr('guardian_email');
            let guardian_name = $(this).attr('guardian_name');
            let image = $(this).attr('image');
            let course = $(this).attr('course');
          
        


            $('#fname').val(fname);
            $('#del_tech').val(id);
            
            $('#iname').val(iname);
            $('#email').val(email);
            $('#phone').val(phone);
            $('#roll_no').val(roll_no);
            $('#guardian_email').val(guardian_email);
            $('#guardian_name').val(guardian_name);
            $('#course_id').val(course);

            $('#image').val(image);
    
                // $('#updateForm').attr('action', '{{ route('edit-teacher', '') }}' + '/' + id);
    
            });
    
        })
</script>
@endsection