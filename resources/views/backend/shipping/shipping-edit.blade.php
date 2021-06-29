@extends('backend.master')

@section('shipping')
  active  
@endsection

@can('add users')

@section('content')
    

<div class="col-lg-12 sl-pagebody">
    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
      <h4 class="card-body-title">Payment Status Edit</h4>
      <form action="{{ route('ShippingUpdate') }}" method="post">
        @csrf 

      <div class="row text-center">
        <label class="col-sm-4 text-right"><h6>Payment Status</h6><span class="tx-danger">*</span></label>
        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
          <input type="text" name="payment_status" value="{{ $shipping->payment_status }}" class="form-control" placeholder="Enter Your Status">
        </div>
      </div>
      <!-- row -->
      <input type="hidden" name="shipping_id" value="{{ $shipping->id }}" class="form-control">


      <div class="row text-center">
        <label class="col-sm-4 text-right"><h6>Delivary Status</h6><span class="tx-danger">*</span></label>
        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
          <input type="text" name="status" value="{{ $shipping->status }}" class="form-control" placeholder="Enter Your Status">
        </div>
      </div>
      

      <div class="form-layout-footer mg-t-30 text-center">
        <button class="btn btn-info mg-r-5">Save</button>
      </div><!-- form-layout-footer -->
    </form>
    </div><!-- card -->
  </div>



@endsection
@endcan