@if(session()->has('notification-message'))

<div class="w-100 justify-content-start ">

  @if (session()->get('notification-status') == "success")
  <div  class="alert alert-success alert-dismissible fade show"  role="alert">
    
    <h4 class="alert-heading">   {{session()->get('notification-message')}}</h4>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @else
  <div  class="alert alert-danger alert-dismissible fade show"  role="alert">
    
    <h4 class="alert-heading">   {{session()->get('notification-message')}}</h4>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
   
</div>
@endif