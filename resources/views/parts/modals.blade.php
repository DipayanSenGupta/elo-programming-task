    <!-- MODAL SECTION -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Product Form</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Product Name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>
        </div>
    </div>