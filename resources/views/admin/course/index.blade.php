@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Courses
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title txt4">Register Course</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.course.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>Course Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Enter Course Title"
                                required>
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
            <h3 class="card-label">All Courses
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
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $key => $course)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$course->title}}</td>
                    <td> <button type="button" class="btn btn-danger waves-effect m-r-20 btn-sm delete-btn"
                        id="{{ $course->id }}" data-toggle="modal"
                        data-target="#delete_modal">Delete</button>
                </td>
                <td> <button type="button" class="btn btn-success m-r-20 btn-sm edit-btn"
                        id="{{ $course->id }}" title="{{ $course->title }}"  data-toggle="modal"
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
                <h5 class="modal-title">Delete Course</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="GET" action="{{ route('delete/course') }}" enctype="multipart/form-data">
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
                <h4 class="title" id="defaultModalLabel">Edit Course</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="Post" action="{{ route('edit-course') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    @csrf
                    <label> Title</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="title" placeholder="Name" name="title"
                            required>
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
            let title = $(this).attr('title');
          

            // let image = $(this).attr('image');



            $('#title').val(title);
            $('#del_tech').val(id);
            
           

            // $('#updateForm').attr('action', '{{ route('edit-teacher', '') }}' + '/' + id);

        });

    })
</script>
@endsection
