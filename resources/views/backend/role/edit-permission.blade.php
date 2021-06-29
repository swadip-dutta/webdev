@extends('backend.master')

@section('role')
    active
@endsection
@can('add users')

@section('content')
    
<div class="sl-pagebody">

    <div class="row row-sm mg-t-20">

        <div class="col-xl-12 mg-t-25 mg-xl-t-0">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <form action="{{ route('ChangePermission') }}" method="post">
              @csrf
              <h3>{{ $user->name }}</h3>
              <h5>{{ $role->name }}</h5>
  
            <div class="row" style="margin-top: 10px">
              <label class="col-sm-4 form-control-label" style="display: block">Permission: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                  @foreach ($permissions as $permission)
                  <li style="list-style: none;">
                  <input type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ $user->hasPermissionTo($permission->name) ? "checked" : '' }}><span>{{ $permission->name }}</span>
                  </li>
                  @endforeach
                
              </div>
            </div><!-- row -->
            
            <div class="form-layout-footer text-center">
              <button style="margin-top: 30px; margin-top: 30px; margin-left: -190px; padding: 12px 60px;" type="submit" class="btn btn-info">Change Permission</button>
            </div><!-- form-layout-footer -->
           
          </form><!-- form-layout-footer -->
          </div><!-- card -->
        </div><!-- col-6 -->
      </div>


</div>
@endsection
@endcan