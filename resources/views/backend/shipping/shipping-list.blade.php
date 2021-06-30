@extends('backend.master')
@section('shipping')
  active  
@endsection
@can('add users')
@section('content')
    
<div class="sl-pagebody" style="padding: 2px">
    <div class="sl-page-title">
      <h5>Shipping Views({{ $shippings->total() }})</h5>

      <div class="search text-right" style="margin-right: 15px">
        <form action="{{ route('ShippingSearch') }}" method="get">
          <input type="text" name="q" placeholder="Search Here...">
            <button><i class="fa fa-search"></i></button>
        </form>
      </div>

    </div><!-- sl-page-title -->
    

    <div class="card pd-20 pd-sm-5 mg-t-50">
  
      <div class="table-responsive">
        <table class="table table-hover mg-b-0">
          <thead>
            <tr>
              <th><input type="checkbox" name="shipping_id" id="CheakAll">SelectAll</th>
              
              <th>SL#</th>
              <th>F Name</th>
              <th>L Name</th>
              <th>Shipping Id</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Pay St</th>
              <th>
                Delivary<br>
                (1=delivery 2=pending)
              </th>
              <th>Coupon</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
         
            @foreach($shippings as $key => $item)
            
            <tr>
            <td><input type="checkbox" name="shipping_id" value="{{ $item->id }}"></td>
              <td>
                  {{ $shippings->firstItem() + $key }}
              </td>
              <td>{{ $item->first_name }}</td>
              <td>{{ $item->last_name }}</td>
              <td>{{ $item->id }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->address }}</td>
              <td>{{ $item->payment_status }}</td>
              <td>{{ $item->status }}</td>
              <td>{{ $item->coupon_code }}</td>
              <td>{{ $item->created_at }}</td>
              <td>
                <a href="{{ route('ShippingEdit', $item->id) }}"class="btn btn-purple">Edit</a>
                <a href="{{ route('ShippingDelete', $item->id) }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach



         
          </tbody>
        </table>
        {{ $shippings->links() }}
      </div><!-- table-responsive -->
    </div><!-- card -->

  

  </div>


@endsection
@endcan