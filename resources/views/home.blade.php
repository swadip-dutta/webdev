@extends('layouts.app')
@section('title')
Tohoney - Home Page
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
              <div class="card-header text-center bg-primary">{{ __('Dashboard') }}</div>

                   <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                     <p>You Are Login</p>
                        
                   </div>
                </div>

            </div>
         </div>
     </div>
  </div>
@endsection
