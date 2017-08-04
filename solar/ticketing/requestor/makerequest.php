<?php include "header.php"; ?>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="icon-note"></i> Create Request</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="requests.php"><i class="icon-doc"></i> Requests</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="userprofile.php"><i class="icon-user"></i> User Profile</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">


            <div class="container-fluid">
                <div class="row" style="margin: 2% 0;">
                    <h3>Create Requests</h3>
                </div>

                <form id="makeRequestForm" style="margin-right: -50%;margin-left: 25%;">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-3">
                        <select id="request-type" class="form-control">
                            <option>Service Request</option>
                            <option>Restoration Request</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-3">
                        <select id="request-category" class="form-control">
                            <option>Printer</option>
                            <option>E-Mail</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Subcategory</label>
                      <div class="col-sm-3">
                        <select id="request-subcategory" class="form-control">
                            <option>E-Mail Attachment</option>
                            <option>Network</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Descrption</label>
                      <div class="col-sm-3">
                        <textarea class="form-control" id="request-description" rows="3" cols="50"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                          <input class="btn btn-primary" type="submit" value="Submit">&emsp;
                          <input class="btn btn-primary" type="reset" value="Clear">&emsp;
                          <input class="btn btn-primary" type="button" value="Cancel">
                      </div>
                    </div>
                  </form>
            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <!-- footer here  -->
    <?php include "footer.php"; ?>

    <!-- Bootstrap and necessary plugins -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/pace/pace.min.js"></script>



    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>

</body>

</html>
