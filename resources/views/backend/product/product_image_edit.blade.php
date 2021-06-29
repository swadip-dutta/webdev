@extends('backend.master')
@section('products')
    active
@endsection
@can('add category')
@section('content')

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Edit Products</h5>
    </div>

    <div class="row row-sm mg-t-20">
        <div class="col-xl-10 m-auto">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                <form action="{{ route('MultiImageUpdate') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product_id }}" class="form-control">

                    @foreach($gellary as $imgg)

                        <input type="hidden" value="{{ $imgg->id }}" name="id">

                        <div class="row">
                            <label class="col-sm-4 form-control-label">Product Thumbnail ({{ $imgg->product_id }})
                                <span class="tx-danger">*</span></label>
                            {{-- <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                <input type="file" name="images[]" class="form-control"
                                    placeholder="Enter Product Thumbnail">
                            </div> --}}

                            <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                                <img src="{{ asset('gallery/'.$imgg->created_at->format('Y/m/').$imgg->product_id.'/'.$imgg->images) }}"
                                    style="height: 200px; width:200px; margin-bottom:5px;" alt="">
                            </div>

                            <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                                <a href="{{ route('ImageGalleryDelete', $imgg->id) }}"
                                    class="btn btn-outline-danger" style="margin-top: 45%">Delete</a>
                            </div>

                        </div>

                    @endforeach

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Product Thumbnail:<span
                                class="tx-danger">*</span></label>
                        <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                            <input type="file" name="images[]" class="form-control"
                                placeholder="Enter Product Thumbnail">
                        </div>

                        <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                            <img src="#" style="width:100" alt="">
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Product Thumbnail:<span
                                class="tx-danger">*</span></label>
                        <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                            <input type="file" name="images[]" class="form-control"
                                placeholder="Enter Product Thumbnail">
                        </div>

                        <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                            <img src="#" style="width:100" alt="">
                        </div>
                    </div>

                    <div class="form-layout-footer mg-t-30 text-center">
                        <button class="btn btn-info mg-r-5">Save</button>
                    </div>

                </form>

            </div>
        </div>



        <!-- form-layout-footer -->

    </div>
</div>

@endsection
@endcan
