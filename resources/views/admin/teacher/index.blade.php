@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Teachers

@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">All Teachers
            </h3>
            <div class="text-right">
                <a href="{{route('admin.teacher.create')}}" class="btn btn-primary "> Add Teacher</a>

            </div>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th class="d-none">Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $key => $teacher)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$teacher->fname}}</td>
                    <td>{{$teacher->lname}}</td>
                    <td>{{$teacher->email}}</td>
                    <td>{{$teacher->phone}}</td>
                    <td> <button type="button" class="btn btn-danger waves-effect m-r-20 btn-sm delete-btn"
                            id="{{ $teacher->id }}" data-toggle="modal" data-target="#delete_modal">Delete</button>
                        <button type="button" class="btn btn-success m-r-20 btn-sm edit-btn" id="{{ $teacher->id }}"
                            fname="{{ $teacher->fname }}" iname="{{ $teacher->lname }}" email="{{ $teacher->email }}"
                            phone="{{ $teacher->phone }}" data-toggle="modal" data-target="#defaultModal">Edit</button>
                    </td>
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
                <h5 class="modal-title">Delete Teacher</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="GET" action="{{ route('delete/teacher') }}" enctype="multipart/form-data">
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
                <h4 class="title" id="defaultModalLabel">Edit Teacher</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('edit-teacher') }}" enctype="multipart/form-data">
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
    $(document).ready(function() {



        $('tbody').on('click', '.delete-btn', function() {

            let id = this.id;

            $('#del_id').val(id);

            // $('#deleteForm').attr('action', '{{ route('delete/teacher', '') }}' + '/' + id);

        });
        $('tbody').on('click', '.edit-btn', function() {

            let id = this.id;
            let fname = $(this).attr('fname');
            let iname = $(this).attr('iname');
            let email = $(this).attr('email');
            let phone = $(this).attr('phone');

            // let image = $(this).attr('image');



            $('#fname').val(fname);
            $('#del_tech').val(id);
            
            $('#iname').val(iname);
            $('#email').val(email);
            $('#phone').val(phone);

            // $('#updateForm').attr('action', '{{ route('edit-teacher', '') }}' + '/' + id);

        });

    })
</script>


@endsection