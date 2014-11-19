<div class="modal fade bs-modal-sm" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" style=" width: 500px;">

        <div class="modal-content">



            <form class="form-horizontal" id="forfrm" action="index.php" method="post" onsubmit="return sendmailForgetPass();">

                <fieldset>

                    <div class="modal-header" >

                        <button class="close" data-dismiss="modal" type="button">×</button>

                        <h4 class="modal-title" id="myModalLabel">Forget Password</h4>

                    </div>

            <div class="modal-body">
                                <!-- Sign In Form -->

                                <!-- Text input-->

                                <div id="formsg"></div>
                                <div class="control-group">

                                    <label class="control-label" for="userid">Email:</label>

                                    <div class="controls">

                                        <input required="" id="userid" name="email" type="email" class="form-control" placeholder="Your Email Id" class="input-medium" required="">

                                    </div>

                                </div>


            </div>

            <div class="modal-footer">

                <button id="forsnd" name="forgetPassword" class="btn btn-success">Submit</button>

               

            </div>

        </fieldset>

        </form>

        </div>

        </div>

    </div>