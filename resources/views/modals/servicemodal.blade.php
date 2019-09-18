<div id="addservice" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Service</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-bd lobidrag">
                <div class="panel-body">
                    <form class="col-sm-12" method="POST" action="{{ url('/servicelist') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name of Service</label>
                            <input type="text" class="form-control" name="name" placeholder=" Ambulance Service" required>
                        </div>
                        <div class="form-group">
                            <label>Description of Service</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>                      
                        <div class="form-group">
                            <label>Quantity/Price</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>                      
                        <div class="form-group">
                            <label>Rate (Per Day/Per Service</label>
                            <input type="number" class="form-control" name="rate">
                        </div>
                        <div class="reset button">
                             <a href="#" class="btn btn-primary">Reset</a>
                             <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>