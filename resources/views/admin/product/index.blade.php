
@extends('layouts.app')
@section('style')

@endsection
@section('content')
<div class="container">
    <div class="col-lg-12">
        @include('layouts.notification')

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Record Data
                
                  </h4>
                <div class="table-responsive">
                    <table id="table" class="table-hover table">
                        <thead>
                            <tr>
                                <th class=" font-weight-bold">Product Title</th>
                                <th class=" font-weight-bold">Description</th>
                                <th class=" font-weight-bold">Stock #</th>
                                <th class=" font-weight-bold">Price #</th>
                                <th class=" font-weight-bold">Assigned User</th>
                                <th class=" font-weight-bold">Date Created</th>
                                <th class=" font-weight-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                 
                            @forelse ($record as $product)
                            <tr>
                      
                                <td class="align-middle">{{ $product->title ? $product->title : '' }}</td>
                                <td class="align-middle">{{ $product->description ? $product->description : '' }}</td>
                                <td class="align-middle">{{ $product->stock ? $product->stock : '' }}</td>
                                <td class="align-middle">${{ $product->price ? $product->price : '' }}.00</td>
                                <td class="align-middle">{{ !empty($product->user) ?  $product->user->email : '' }}</td>
                                <td class="align-middle"> {{$product->created_at ? $product->created_at->format("F d Y") : '---'}}</td>
                                <td class="align-middle">

                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                         action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a href="{{route('admin.product.show',['id' => $product->id ? $product->id : ''])}}" class="dropdown-item">Edit</a></li>
                                          <li> <a href="{{ route('admin.product.destroy',['id' => $product->id ?  $product->id : '']) }}" class="dropdown-item">Delete</a>
                                           </li>
                                         
                                        </ul>
                                      </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No Records Found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
        
                </div>
   
        </div>
    </div>
    </div>
</div>
{{-- @include('layouts.delete-confirmation-modal') --}}
@endsection
@section('script')

<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    $(document).ready( function () {
        new DataTable('#table');
    } );
</script>
<script>
    https://code.jquery.com/jquery-3.7.1.js
    $("#delete-confirmation-modal").on('show.bs.modal',function(event){
        const content = $(event.relatedTarget);
        const action = content.data('action');
        const modal = $(this);
        modal.find("#delete-modal-form").attr('action',action);
    });

    $( function() {
        $("#datefrom").datepicker({
            dateFormat: 'yy/mm/dd',
            changeYear: true,
            changeMonth: true,
        });
        $("#dateend").datepicker({
            dateFormat: 'yy/mm/dd',
            changeYear: true,
            changeMonth: true,
        });
} );
</script>

@endsection