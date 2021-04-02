@extends('backend.master')
@section('content')
    
<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Total Users ( {{ $user_count }} )</h5>
    </div><!-- sl-page-title -->

    @can('add users')

    <div class="card pd-20 pd-sm-40 mg-t-50">
  
      <div class="table-responsive">
        <table class="table table-hover mg-b-0">
          <thead>
            <tr>
              <th>SL#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Registered Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $key => $user)
            
            <tr>
              <td>
               {{ $users->firstItem() + $key }}
              </td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email ?? 'N/A'}}</td>
              <td>{{ $user->created_at->format('d-M-Y l')}}</td>
              <td>
                <a href=""class="btn btn-purple">Edit</a>
                <a href="{{ url('category/delete') }}/{{ $user->id }}"class="btn btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div><!-- table-responsive -->
    </div><!-- card -->
    @endcan

  

  </div>

@endsection