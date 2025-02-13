@extends('layouts.app')

@section('content')

<div class="container">
 
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
                                  {{isset( $product) ?  $product->count() : '0'}}
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
                                <p>Total No. User</p>
                            </div>
                            <div class="col-6 text-left">
                                <h3>
                                    {{ isset($user) ? $user->count() : '0' }}
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
@endsection
