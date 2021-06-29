@extends('backend.master')
@section('users')
    active
@endsection
@can('edit users')
@section('content')



    
<div class="col-lg-12 sl-pagebody">
    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
      <h4 class="card-body-title">User Edit</h4>
      <form action="{{ route('UsersUpdate') }}" method="post" enctype="multipart/form-data">
        @csrf 

      <div class="row text-center">
        <label class="col-sm-4 text-right"><h6 style="display: inline-block">Name:</h6><span class="tx-danger">*</span></label>
        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
          <input type="text" name="name" value="{{ $users->name }}" class="form-control" placeholder="Enter Your Name">
        </div>
      </div>
      <!-- row -->
      <input type="hidden" name="user_id" value="{{ $users->id }}" class="form-control">
      
      <div class="row text-center mg-t-20">
        <label class="col-sm-4 text-right"><h6 style="display: inline-block">Email:</h6><span class="tx-danger">*</span></label>
        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
          <input type="email" name="email" value="{{ $users->email }}" class="form-control" placeholder="Enter email address">
        </div>
      </div>

      <div class="row text-center mg-t-20">
        <label class="col-sm-4 text-right"><h6 style="display: inline-block">Profile Image:</h6><span class="tx-danger">*</span></label>
        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
          <input type="file" name="images" class="form-control" placeholder="Enter Your Profile Image">
        </div>
      </div>

      <div class="form-layout-footer mg-t-30 text-center">
        <button type="submit" class="btn btn-info mg-r-5">Save</button>
      </div><!-- form-layout-footer -->
    </form>
    </div><!-- card -->
  </div>




@endsection
@endcan