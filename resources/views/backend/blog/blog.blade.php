@extends('backend.master')

@section('view_blog')
  active
 @endsection

@can('add category')
@section('content')

<div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Blog Views</h5>
        </div><!-- sl-page-title -->
        

        <div class="card pd-20 pd-sm-40 mg-t-50">
      
          <div class="table-responsive">
            <table class="table table-hover mg-b-0">
              <thead>
                <tr>
                  <th ><input type="checkbox" id="CheakAll">Select All</th>
                  
                  <th>SL#</th>
                  <th>Title</th>
                  <th>Summary</th>
                  <th>Thumbnail</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <form action="{{ route('blog.store') }}" method="POST">
                @csrf
                @foreach($blog as $key => $item)
                
                <tr>
                  <td><input type="checkbox" name="" value="{{ $item->id }}"></td>
                  <td>
                   {{ $blog->firstItem() + $key }}
                  </td>
                  <td>{{ $item->title }}</td>
                  <td>{!! Str::limit($item->summary, 180, '.......') ?? 'N/A' !!}</td>
                  <td>{{ $item->thumbnail ?? 'N/A'}}</td>
                  <td>{{ $item->created_at->format('d-M-Y l')}}</td>
                  <td>
                    <a href="{{ route('blog.edit', $item->id) }}"class="btn btn-purple">Edit</a>
                    <a href="{{ route('destroy', $item->id) }}"class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach

                <tr class="text-center">
                <td colspan="10"><button class="btn btn-outline-danger" style="cursor: pointer">Delete</button></td>
                </tr>
              </form>
              </tbody>
            </table>
            {{ $blog->links() }}
          </div><!-- table-responsive -->
        </div><!-- card -->

      

      </div>

@endsection
@endcan




