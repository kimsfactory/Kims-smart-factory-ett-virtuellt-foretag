    <!--update modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Update Title: </label>
                            <input type="text" class="form-control" name="title" for="recipient-name">
                            <label for="recipient-name" class="col-form-label">Update Description: </label>
                            <textarea class="form-control" name="description" for="recipient-name" rows="6"></textarea>
                            <label for="recipient-name" class="col-form-label">Update Price: </label>
                            <input type="text" class="form-control" name="price" for="recipient-name">
                            <input type="hidden" class="form-control" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="updateBtn" value="Update" class="btn btn-success update-product-btn">
                    </div>
                </form>
                    </div>
                </div>
            </div>