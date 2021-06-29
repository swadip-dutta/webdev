@extends('backend.master')

@section('view_category')
  active
 @endsection

@can('add category')
@section('content')

<div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Category Views</h5>
        </div><!-- sl-page-title -->
        

        <div class="card pd-20 pd-sm-40 mg-t-50">
      
          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th ><input type="checkbox" id="CheakAll">SelectAll</th>
                  
                  <th>SL#</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <form action="{{ route('SelectedCategoryDelete') }}" method="post">
                @csrf
                @foreach($categories as $key => $item)
                
                <tr>
                <td><input type="checkbox" name="cat_id[]" value="{{ $item->id }}"></td>
                  <td>
                   {{ $categories->firstItem() + $key }}
                  </td>
                  <td>{{ $item->category_name }}</td>
                  <td>{{ $item->slug ?? 'N/A'}}</td>
                  <td>{{ $item->created_at->format('d-M-Y l')}}</td>
                  <td>
                    <a href=""class="btn btn-purple">Edit</a>
                    <a href="{{ route('CategoryDelete', $item->id) }}"class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach

                <tr class="text-center">
                <td colspan="10"><button class="btn btn-outline-danger" style="cursor: pointer">Delete</button></td>
                </tr>


              </form>
              </tbody>
            </table>
          </div><!-- table-responsive -->
        </div><!-- card -->

      

      </div>

@endsection
@endcan




<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function(){
$('#CheakAll').click(function(){
  $('input:checkbox').not(this).prop('checked', this.checked);
});



const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
@if(session('delete1'))
Toast.fire({
  icon: 'error',
  title: '{{ session('delete1') }}'
});
@endif
@if(session('delete2'))
  Toast.fire({
  icon: 'success',
  title: '{{ session('delete2') }}'
});
@endif


});

</script>   



