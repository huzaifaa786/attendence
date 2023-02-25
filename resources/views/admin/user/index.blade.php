@extends('layout.admin')

@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('title')
    Students
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5">
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
                        <th>Course</th>
                        <th>Profile</th>
                        <th>Roll No</th>
                        <th>Guardian Name</th>
                        <th>Guardian Email</th>
                        <th>Manage FingerPrint</th>
                        <th class="d-none">Action</th>
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
                            @if ($user->has_finger_id == false)
                                <td><button class="btn btn-primary fingerid_add" fingerId="{{ $user->id }}">Add Finger
                                        Print</button></td>
                            @else
                                <td><button class="btn btn-primary">Waiting for FingerPrint</button></td>
                            @endif



                            <td>
                                <div class="pull-right">

                                </div>

        </div>
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
                    <h5 class="modal-title">Delete Product</h5>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" enctype="multipart/form-data">
                        @method('DELETE')
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
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
    <!--end::Page users-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/paginations.js?v=7.0.3') }}"></script>
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
                    // $.ajax({
                    //     url: "manage_users_up.php"
                    // }).done(function(data) {
                    //     $('#manage_users').html(data);
                    // });
                }
            });
        });
    </script>
@endsection
