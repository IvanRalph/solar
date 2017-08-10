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
                        <a class="nav-link" href="userprofile.php"><i class="icon-user"></i> User Profile</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">


            <div class="container-fluid">
                <div class="row" style="margin: 2% 0;">
                    <h3>Requests</h3>
                </div>
                <?php 
                    function getRequestDetails($status, $userid, $db){
                        return $db->getRows('request_details', array('where'=>array('requested_by'=>$userid, 'status'=>$status), 'return_type'=>'count'));
                    }
                ?>
                <div class="row">
                  <div class="col-sm-6 col-lg-3">
                    <a href="requests.php?status=in progress" style="text-decoration: none;">
                        <div class="card card-inverse card-warning">
                          <div class="card-block">
                            <div class="h4 m-0"><?php if(getRequestDetails('in progress', $user[0]['account_id'], $db)==false){echo "0";}else{echo getRequestDetails('in progress', $user[0]['account_id'], $db);} ?></div>
                            <div>In Progress</div>
                            <div class="progress progress-white progress-xs my-1">
                              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                    </a>
                  </div><!--/.col-->
                  <div class="col-sm-6 col-lg-3">
                    <a href="requests.php?status=for approval" style="text-decoration: none;">
                        <div class="card card-inverse card-primary">
                          <div class="card-block">
                            <div class="h4 m-0"><?php if(getRequestDetails('for approval', $user[0]['account_id'], $db)==false){echo "0";}else{echo getRequestDetails('for approval', $user[0]['account_id'], $db);} ?></div>
                            <div>For Approval</div>
                            <div class="progress progress-white progress-xs my-1">
                              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                    </a>
                  </div><!--/.col-->
                  <div class="col-sm-6 col-lg-3">
                    <a href="requests.php?status=resolved" style="text-decoration: none;">
                        <div class="card card-inverse card-success">
                          <div class="card-block">
                            <div class="h4 m-0"><?php if(getRequestDetails('resolved', $user[0]['account_id'], $db)==false){echo "0";}else{echo getRequestDetails('resolved', $user[0]['account_id'], $db);} ?></div>
                            <div>Resolved</div>
                            <div class="progress progress-white progress-xs my-1">
                              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                    </a>
                  </div><!--/.col-->
                  <div class="col-sm-6 col-lg-3">
                    <a href="requests.php?status=on hold" style="text-decoration: none;">
                        <div class="card card-inverse card-default" style="background-color: #aaa;">
                          <div class="card-block">
                            <div class="h4 m-0"><?php if(getRequestDetails('on hold', $user[0]['account_id'], $db)==false){echo "0";}else{echo getRequestDetails('on hold', $user[0]['account_id'], $db);} ?></div>
                            <div>On Hold</div>
                            <div class="progress progress-white progress-xs my-1">
                              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                    </a>
                  </div><!--/.col-->
                </div><!--/.row-->

                <div class="row" style="margin: 2% 0;">
                    <h3>Create a Request</h3>
                </div>
                <div id="onMobile">
                    <h5><u>Service Request</u></h5>
                    <a href="makerequest.php?subcategory=software installation">Software Installation</a><br><br>
                    <a href="makerequest.php?subcategory=fileserver access">Fileserver Access</a><br><br>
                    <a href="makerequest.php?subcategory=e-mail password reset">E-Mail password Reset</a><br><br>
                    
                    <br>
                    <h5><u>Restoration Request</u></h5>
                    <a href="makerequest.php?subcategory=non-licensed software installation">Non-licensed Software Installation</a><br><br>
                    <a href="makerequest.php?subcategory=software activation">Software Activation</a><br><br>
                    <a href="makerequest.php?subcategory=hardware">Hardware</a><br><br>
                    <a href="makerequest.php?subcategory=internet/wifi">Internet/WIFI</a><br><br>
                    <a href="makerequest.php?subcategory=printer">Printer</a><br><br>
                    <a href="makerequest.php?subcategory=google drive">Google Drive</a><br><br>
                    <a href="makerequest.php?subcategory=web application">Web Application</a><br><br>
                </div>
                
                <div id="nonMobile">
                    <div class="row">
                        <br>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3"><h5><u>Service Request</u></h5></div>
                        <div class="col-sm-3"><h5><u>Restoration Request</u></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=software installation">Software Installation</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=non-licensed software installation">Non-licensed Software Installation</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=printer">Printer</a></div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=fileserver access">Fileserver Access</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=software activation">Software Activation</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=google drive">Google Drive</a></div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=e-mail password reset">E-Mail password reset</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=hardware">Hardware</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=web application">Web Application</a></div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3"><a href=""></a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=internet/wifi">Internet/WIFI</a></div>
                        <div class="col-sm-3"><a href="makerequest.php?subcategory=e-mail">E-Mail</a></div>
                    </div>
                    <br>
                </div>
            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <!-- footer here  -->
    <?php include "footer.php"; ?>
