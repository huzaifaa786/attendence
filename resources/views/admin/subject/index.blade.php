@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Subjects
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title txt4">Create Subject</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.subject.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>Subject Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Subject Title"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Select Course:</label>
                            <select id="course_id" name="course_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select Course</option>

                                @foreach (App\Models\Course::all() as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Select Teacher:</label>
                            <select id="teacher_id" name="teacher_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select Teacher</option>
                                @foreach (App\Models\Teacher::all() as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->fname }} {{ $teacher->lname }}</option>
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
            <h3 class="card-label">All Subject
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
                    <th>Teacher</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $key => $subject)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$subject->name}}</td>
                    <td>{{$subject->teacher->fname}} {{$subject->teacher->lname}}</td>
                    <td>{{$subject->course->title}}</td>
                    
                  
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
