
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
                    <div class="float-end">
                        <a href="{{  route('admin.dashboard.index')  }}" class="btn btn-info">Back to Dashboard</a>
                    </div>  
                  </h4>
                <div class="table-responsive">
                    <table id="table" class="table-hover table">
                        <thead>
                            <tr>
                                <th class=" font-weight-bold">User Name</th>
                                <th class=" font-weight-bold">User Email</th>
                          
                                <th class=" font-weight-bold">Date Created</th>
                                <th class=" font-weight-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                   
                            @forelse ($record as $users)
                            <tr>
                                <td class="align-middle">{{ $users->name ? $users->name : '' }}</td>
                                <td class="align-middle">{{ $users->email ? $users->email : '' }}</td>
                    
                                <td class="align-middle"> {{$users->created_at ? $users->created_at->format("F d Y") : '---'}}</td>
                                <td class="align-middle">

                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                         action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a href="{{route('admin.users.show',['id' => $users->id ? $users->id : ''])}}" class="dropdown-item">Show Product</a></li>
                                         
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