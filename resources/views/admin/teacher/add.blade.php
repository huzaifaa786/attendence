@extends('layout.admin')
@section('title')
Teacher Add
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title txt4">Register Teacher</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input name="fname" type="text" class="form-control" placeholder="Enter First Name"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input name="lname" type="text" class="form-control" placeholder="Enter Last Name"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>phone:</label>
                            <input name="phone" type="text" class="form-control" placeholder="Roll No"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email :</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter Email"
                                required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label>Password :</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter Email"
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
@endsection
