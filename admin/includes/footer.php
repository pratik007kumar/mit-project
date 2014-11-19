
<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width: 500px;">

        <div class="modal-content">
            <form method="post" onsubmit="return changepassword()" id="frm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body form-horizontal">
            <div class="row">
                <div class="control-group col-lg-12 " >
                    <label for="current_password" class="control-label">Current Password</label>
                    <div class="controls ">
                        <input name="current_password" id="current_password" type="password" class="col-lg-8" required="required">
                    </div>
                </div>
                <div class="control-group col-lg-12 ">
                    <label for="new_password" class="control-label">New Password</label>
                    <div class="controls">
                        <input name="new_password" id="new_password" type="password" class="col-lg-8" required>
                    </div>
                </div>
                <div class="control-group col-lg-12 ">
                    <label for="confirm_password" class="control-label">Confirm Password</label>
                    <div class="controls">
                        <input name="confirm_password" id="confirm_password" type="password" class="col-lg-8" required>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary" onclick="" >Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>