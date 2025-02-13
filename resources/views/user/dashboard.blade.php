@extends('layouts.app')
@section('style')

@endsection
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.notification')
            
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}   <div class="float-end">
                    <a href="{{  route('user.product.index')  }}" class="btn btn-info">List Product</a>
                </div>  </div>
 
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="card-group row ">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="card ">
                                    <div class="card-body ">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 text-right ">
                                                <p >Total No. Products</p>
                                            </div>
                                            <div class="col-6 text-left" >
                                                <h3 >
                                                  {{ isset($product) ? $product->count() : ''}}
                                               </h3>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 text-right ">
                                                <p>Total No. Of</p>
                                            </div>
                                            <div class="col-6 text-left">
                                                <h3>
                                                  0
                                               </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 text-right ">
                                                <p>Total No. of</p>
                                            </div>
                                            <div class="col-6 text-left">
                                                <h3>
                                                  0
                                               </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 text-right ">
                                                <p>Total No. of</p>
                                            </div>
                                            <div class="col-6 text-left">
                                                <h3>
                                                  0
                                               </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                
                
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection