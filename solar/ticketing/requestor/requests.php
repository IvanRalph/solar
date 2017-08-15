
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
              $requests = $db->getRows('request_details', array('where'=>array('requested_by'=>$user[0]['account_id'], 'status!'=>'deleted')));
              if(!$requests){
                $requests = array();
              }
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
                  <div class="col-2" style="text-align: right;"><a href="makerequest.php" class="unstyle"><i class="icon-note upicons"></i></a>&emsp;<a href="" class="unstyle"><i class="icon-share-alt upicons"></i></a></div>
                </div>

                <div class="row" style="overflow-x: scroll;">
                    <table id="mainTable" class="table table-fixed table-striped table-bordered" style="width: 1920px;">
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
                          $acctId = $db->getRows('users', array('where'=>array('account_id'=>$requests[$i]['assigned_to'])));
                          $approveId = $db->getRows('users', array('where'=>array('account_id'=>$requests[$i]['approved_by'])));
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
                            <td><?php echo $approveId[0]['firstname']. ' ' . $approveId[0]['lastname']; ?></td>
                            <td><?php echo $acctId[0]['firstname'] . ' ' . $acctId[0]['lastname']; ?></td>
                            <td><?php echo $requests[$i]['resolved_date']; ?></td>
                            <td><?php echo $requests[$i]['on_hold_date']; ?></td>
                            <td><?php echo $requests[$i]['on_hold_description']; ?></td>
                            <td><a href="" title="View request" data-toggle="modal" data-target="#viewRequest" data-whatever="<?php echo $requests[$i]['request_no']; ?>" class="unstyle"><i class="icon-doc"></i>&emsp;<a href="" id="deleteRequest" title="Delete request" data-id="<?php echo $requests[$i]['request_no']; ?>" class="unstyle"><i class="icon-trash"></i></td>
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

        <div class="modal fade" id="viewRequest" tabindex="-1" role="dialog" aria-labelledby="ViewRequest" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-group">
                  <div class="form-group">
                    <label class="form-control-label">Type</label>
                    <input type="text" class="form-control" id="modal-type" disabled>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Category</label>
                    <input type="text" class="form-control" id="modal-category" disabled>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Subcategory</label>
                    <input type="text" class="form-control" id="modal-subcategory" disabled>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea id="modal-description" class="form-control" disabled></textarea>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Assigned To</label>
                    <input type="text" class="form-control" id="modal-assigned-to" disabled>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Status Tracking</label>
                    <table id="modal-status-tracking" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th>Date and Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td id="approval-status"></td>
                          <td id="approval-date"></td>
                        </tr>
                        <tr>
                          <td id="in-progress-status"></td>
                          <td id="in-progress-date"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div><br>
                  <div class="form-group">
                    <label class="form-control-label">Approvers</label>
                    <table id='modal-approvers' class="table table-striped">
                      <thead>
                        <tr>
                          <th>Approver Name</th>
                          <th>Approval Status</th>
                          <th>Date and Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td id="approver-name"></td>
                          <td id="approver-status"></td>
                          <td id="approver-date"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>

    <?php include "footer.php"; ?>