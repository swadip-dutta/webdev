@extends('backend.master')

@section('shipping')
  active  
@endsection

@can('add users')

@section('content')

<div class="sl-pagebody">

<div class="card pd-20 pd-sm-5 mg-t-50">
  
    <div class="table-responsive">
      <table class="table table-hover mg-b-0">
        <thead>
          <tr>
 
            
            <th>F Name</th>
            <th>L Name</th>
            
            
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
        
       
          @foreach($shipping as $key => $item)
          
          <tr>


            <td>{{ $item->first_name }}</td>
            <td>{{ $item->last_name }}</td>
            
            
            <td>{{ $item->phone }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->payment_status }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->coupon_code }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
              <a href="{{ route('ShippingEdit', $item->id) }}"class="btn btn-purple">Edit</a>
            </td>
          </tr>
          @endforeach

        


       
        </tbody>
      </table>
    </div><!-- table-responsive -->
  </div><!-- card -->
</div>
    
@endsection
@endcan