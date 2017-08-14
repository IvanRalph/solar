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

                <?php 
                    $getRequest = $db->getRows('request_type', array('select'=>'type, category, subcategory', 'where'=>array('selection_status'=>'active')));

                    function populateData($subcatget, $getRequest, $status){
                      if(isset($_GET['subcategory'])){
                        for($i = 0; $i < count($getRequest); $i++){
                            if($getRequest[$i]['subcategory'] == $_GET['subcategory']){
                              echo "<option selected>". $getRequest[$i][$status] ."</option>";
                            }else{
                              echo "<option>". $getRequest[$i][$status] ."</option>";
                            }
                        }
                      }else{
                        for($i = 0; $i < count($getRequest); $i++){
                            echo "<option>". $getRequest[$i][$status] ."</option>";
                        }
                      }
                    }
                ?>

                <form id="makeRequestForm" style="margin-right: -50%;margin-left: 25%;">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-3">
                        <select name="request-type" class="form-control">
                          <option>Type</option>
                            <?php
                                populateData($_GET['subcategory'], $getRequest, 'type');
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-3">
                        <select name="request-category" class="form-control">
                        <option>Category</option>
                            <?php
                                populateData($_GET['subcategory'], $getRequest, 'category');
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Subcategory</label>
                      <div class="col-sm-3">
                        <select name="request-subcategory" class="form-control">
                        <option>Subcategory</option>
                            <?php
                                populateData($_GET['subcategory'], $getRequest, 'subcategory');
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-3">
                        <textarea class="form-control" name="request-description" rows="3" cols="50"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                          <input class="btn btn-primary" id="submit" type="submit" value="Submit">&emsp;
                          <input class="btn btn-primary" type="reset" value="Clear">&emsp;
                          <input class="btn btn-primary" id="cancel" type="button" value="Cancel">
                      </div>
                    </div>
                  </form>
            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <!-- footer here  -->
    <?php include "footer.php"; ?>