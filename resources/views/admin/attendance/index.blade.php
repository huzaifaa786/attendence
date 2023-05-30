@extends('layout.admin')

@section('styles')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.3')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('title')
Attendance
@endsection

@section('content')

<div class="card card-custom mt-5">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Attendance of All Students
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
                    <th>Subject Name</th>
                    <th>Date & time</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Attendance::all() as $key => $attendance)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{App\Models\User::find($attendance->fingerprint_id)->fname}}</td>
                    <td>{{$attendance->lecture->subject->name}}</td>
                    <td>{{Carbon\Carbon::parse($attendance->created_at)->format('d M Y g:i:A')}}</td>

                    
                    <td></td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>

@endsection