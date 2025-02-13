<div class="modal fade" role="dialog" id="delete-confirmation-modal">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Delete Confirmation</h3>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="delete-modal-form">
                <div class="modal-body">
                    @csrf
                    @method("DELETE")
                    <h5 class="font-weight-bold">Are you sure you want do delete this? This cannot be undone.</h5>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-danger mr-2">Delete</button>
                    <button class="btn btn-warning" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>