@extends('layout.teacher')

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
                <h5 class="card-title txt4">Create content</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('teacher.content.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>Content Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Enter Subject Title"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Select Subject:</label>
                            <select id="course_id" name="subject_id" class="form-control form-control-select2 txt4" data-fouc required>
                                <option selected disabled>Select Subject</option>

                                @foreach (App\Models\Subject::all() as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>File Content:</label>
                            <input name="file" type="file" class="form-control" placeholder="choose file"
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
                    <th>Title</th>
                    <th>Subject</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allcontent as $key => $content)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$content->title}}</td>
                    <td>{{$content->subject->name}}</td>
                    <td><a href="{{$content->file}}"> file</td>
                    
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
