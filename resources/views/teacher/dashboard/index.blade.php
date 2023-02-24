@extends('layout.teacher')
@section('title')
    Teacher|Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-custom bg-danger card-stretch gutter-b">
                <div class="card-body my-3">
                    <a href="#"
                        class="card-title font-weight-bolder text-light text-hover-state-dark font-size-h6 mb-4 d-block">Total Subject Assigned</a>
                    <div class="font-weight-bold text-muted font-size-sm">
                        <span class="text-light font-size-h2 font-weight-bolder mr-2">{{auth()->user()->subjects->count()}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
