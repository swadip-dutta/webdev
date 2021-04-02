@extends('backend.master')

 @section('category')
  active
 @endsection

@section('content')

<div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Delete Or Restore Category</h5>
          <a href="{{ url('subcategory-from') }}" style="float: right;"><i class="fa fa-plus"></i> Add</a>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
      
          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th>SL#</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($trush_category as $key => $t_item)
                
                <tr>
                 

                  <td>{{ $trush_category->firstItem() + $key }}</td>
                  <td>{{ $t_item->category_name ?? 'N/A' }}</td>
                  <td>{{ $t_item->slug ?? 'N/A' }}</td>
                  <td>
                    <a href=""class="btn btn-success">Restore</a>
                    <a href=""class="btn btn-danger">Permanent Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{ $trush_category->links() }}
          </div><!-- table-responsive -->
        </div><!-- card -->

      

      </div>

@endsection
