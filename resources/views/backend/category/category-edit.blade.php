@extends('layouts.app')
@section('content')
<div class="container">
  @can('edit category')

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-center bg-primary">{{ __('Edit Category') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Created_at</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $key => $cat)
              <tr>
                <th scope="row">{{ $categories->firstItem() + $key }}</th>
                <td>{{ $cat->category_name ?? 'N/A'}}</td>
                <td>{{ $cat->slug ?? 'N/A'}}</td>
                <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A'}}</td>
                <td>

                  <a href="{{ url('/category/edit') }}/{{ $cat->id }}" class="btn btn-outline-primary">Edit</a>
                  <a href="{{ url('/category/delete') }}/{{ $cat->id }}" class="btn btn-outline-danger">Delete</a>
                </td>
              </tr>

              

              @endforeach
            </tbody>
          </table>



           {{ $categories->links() }}

        </div>

        <div class="card-body">
        <div class="card-header text-center bg-danger">{{ __('Edit Category') }}</div>
          @if (session('PermanentDelete'))
          <div class="alert alert-danger PermanentDelete" role="alert">
            {{ session('PermanentDelete') }}
          </div>
          @endif

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Created_at</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($trush_category as $key => $t_cat)
              <tr>
                <th scope="row">{{ $trush_category->firstItem() + $key }}</th>
                <td>{{ $t_cat->category_name ?? 'N/A'}}</td>
                <td>{{ $t_cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A'}}</td>
                <td>
                  <a href="{{ url('/category/restore') }}/{{ $t_cat->id }}" class="btn btn-outline-success">Restore</a>
                  <a href="{{ url('/category/permanent') }}/{{ $t_cat->id }}" class="btn btn-outline-danger">Permanent Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $trush_category->links() }}

        </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="card">



        <div class="card-header text-center bg-success">{{ __('Edit Category') }}</div>

        @if(session('CategoryAdd'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Good News!</strong> {{session('CategoryAdd')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif


        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form action="{{ url('category-update') }}" method="POST">
            <div class="form-group">
                <input type="hidden" value="{{ $edit_category->id }}" name="id">
              <label for="category_name">Name</label>
              <input type="name" class="form-control" value="{{ $edit_category->category_name }}" id="category_name" name="category_name" placeholder="Ex:- Fashion">
            </div>

            <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div> 
  @endcan
  
</div>


@endsection




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary">{{ __('View Category') }}</div>

<div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry the Bird</td>
        <td>Thornton 2</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>

</div>
</div>
</div>


<div class="col-md-4">
  <div class="card">
    <div class="card-header text-center bg-success">{{ __('Add Category') }}</div>

    <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif

      <form>
        <div class="form-group">
          <label for="category_name">Name</label>
          <input type="name" class="form-control" value=" {{ $edit_category->category_name }} " id="category_name" name="category_name" placeholder="Ex:- Fashion">
        </div>

        <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection --}}