@extends('backend.master')

@section('content')
    
    @can('add category')
@section('content')

<div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Message Views</h5>
        </div><!-- sl-page-title -->
        

        <div class="card pd-20 pd-sm-40 mg-t-50">
      
          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th ><input type="checkbox" id="CheakAll">Select All</th>
                  
                  <th>SL#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
                
                @foreach($msg as $key => $item)
                
                <tr>
                  <td><input type="checkbox" name="id" value="{{ $item->id }}"></td>
                  <td>
                   {{ $msg->firstItem() + $key }}
                  </td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->subject }}</td>
                  <td>{!! Str::limit($item->message, 100, '...') ?? 'N/A' !!}</td>
                  <td>{{ $item->created_at->format('d-M-Y l') }}</td>
            
                  <td>
                    <a href="{{ route('DeleteMessage', $item->id) }}"class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach

                <tr class="text-center">
                <td colspan="10"><button class="btn btn-outline-danger" style="cursor: pointer">Delete</button></td>
                </tr>
              
              </tbody>
            </table>
            {{ $msg->links() }}
          </div><!-- table-responsive -->
        </div><!-- card -->

      

      </div>

@endsection
@endcan

@endsection


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
$('#CheakAll').click(function(){
  $('input:checkbox').not(this).prop('checked', this.checked);
});

})

</script>