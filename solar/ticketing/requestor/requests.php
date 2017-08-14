
<?php include "header.php"; ?>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="makerequest.php"><i class="icon-note"></i> Create Request</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="icon-doc"></i> Requests</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="userprofile.php"><i class="icon-user"></i> User Profile</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
            <?php
              $requests = $db->getRows('request_details', array('where'=>array('requested_by'=>$user[0]['account_id'], '')));
            ?>

            <div class="container-fluid">
                <div class="row" style="margin: 2% 0;">
                    <h3>Requests</h3>
                </div>
                <div class="form-group row my-mobile">
                  <div class="col-2">
                    <input class="form-control" type="text"  placeholder="Enter Keyword here" id="example-text-input">
                  </div>
                  <div class="col-2">
                    <select class="form-control" id="selectFilter">
                      <option>Search</option>
                      <option>Filter</option>
                    </select>
                  </div>
                  <div class="col-6"></div>
                  <div class="col-2" style="text-align: right;"><a href="" class="unstyle"><i class="icon-note upicons"></i></a>&emsp;<a href="" class="unstyle"><i class="icon-share-alt upicons"></i></a></div>
                </div>

                <div class="row" style="overflow-x: scroll;">
                    <table class="table table-fixed table-striped table-bordered" style="width: 1920px;">
                      <thead>
                        <tr>
                          <th class="headcol">Request No.</th>
                          <th>Type</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Created Date & Time</th>
                          <th>Approved Date</th>
                          <th>Disapproved Date</th>
                          <th>Approved By</th>
                          <th>Assigned To</th>
                          <th>Resolved Date & Time</th>
                          <th>On Hold Date</th>
                          <th>On Hold Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($i = 0; $i < count($requests); $i++){
                          $requestType = $db->getRows('request_type', array('where'=>array('request_type_id'=>$requests[$i]['request_type_id']), 'select'=>'type, category, subcategory'));
                        ?>
                          <tr>
                            <th><?php echo $requests[$i]['request_no']; ?></th>
                            <td><?php echo $requestType[$i]['type']; ?></td>
                            <td><?php echo $requestType[$i]['category']; ?></td>
                            <td><?php echo $requestType[$i]['subcategory']; ?></td>
                            <td class="desc"><?php echo $requests[$i]['description']; ?></td>
                            <td><?php echo $requests[$i]['status']; ?></td>
                            <td><?php echo $requests[$i]['created_date']; ?></td>
                            <td><?php echo $requests[$i]['approved_date']; ?></td>
                            <td><?php echo $requests[$i]['disapproved_date']; ?></td>
                            <td><?php echo $requests[$i]['approved_by']; ?></td>
                            <td><?php echo $requests[$i]['assigned_to']; ?></td>
                            <td><?php echo $requests[$i]['resolved_date']; ?></td>
                            <td><?php echo $requests[$i]['on_hold_date']; ?></td>
                            <td><?php echo $requests[$i]['on_hold_description']; ?></td>
                            <td></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                <br>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                    </li>
                  </ul>
                </nav>

            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <?php include "footer.php"; ?>