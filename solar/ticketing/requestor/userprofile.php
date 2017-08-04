<?php include "header.php"; ?>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="makerequest.php"><i class="icon-note"></i> Create Request</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="requests.php"><i class="icon-doc"></i> Requests</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="icon-user"></i> User Profile</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
            <div class="container-fluid">
                <div class="row" style="margin: 2% 0;">
                    <h3>User Profile</h3>
                </div>
                <div class="row">
                  <div class="col-sm-8">
                    <form style="margin-right: -50%;margin-left: 25%;">
                      <div class="form-group row">
                        <label class="col-2 col-form-label">First name</label>
                        <div class="col-4">
                          <input class="form-control" type="text" value="John" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-2 col-form-label">Last name</label>
                        <div class="col-4">
                          <input class="form-control" type="text" value="Doe" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-2 col-form-label">E-Mail Address</label>
                        <div class="col-4">
                          <input class="form-control" type="email" value="John.Doe@solarphilippines.com" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-2 col-form-label">Username</label>
                        <div class="col-4">
                          <input class="form-control" type="text" value="John.Doe@solarphilippines.com" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-2 col-form-label">User rights</label>
                        <div class="col-4">
                          <input class="form-control" type="email" value="Requestor Only" readonly>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-sm-4">
                    <img src="img/dl_icon_github.png" class="rounded" alt="...">
                  </div>
                </div>
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
