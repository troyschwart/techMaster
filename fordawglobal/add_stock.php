<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Breverage"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//EDITING CATEGORY
    if(isset($_GET['cat_Edit'])){
      $id=$_GET['cat_Edit'];
      $results=mysqli_query($link,"SELECT * FROM tbl_category WHERE CID='$id'");
      $show_result=mysqli_fetch_array($results);
      $res=$show_result[1];
      $btn="<input type='submit' name='submit_update' class='btn btn-success form-control' id='submit_update' value='Update Category'>";
    }

//ADD CATEGORY
  if(isset($_POST['submit_cat'])){
    @$category=strtoupper(htmlentities($_POST['catName']));
    $allStock=mysqli_query($link,"SELECT * FROM tbl_category WHERE category='$category'");
    if(mysqli_num_rows($allStock)>0){
       $div="<script>
          swal('Category Added Already !','','warning')
            </script>";
    }
    else{
      $sql=mysqli_query($link,"INSERT INTO tbl_category(category,postDate) VALUES ('$category',CURRENT_TIMESTAMP)");
          
      if($sql){
         $div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
            <button type=button class=close data-dismiss=alert><span>&times;</span></button>
             Category Added Succcessfully.
            </div>
            <script>
            swal({
                title: 'Category has just been added Successfully!',
                icon: 'success',
                button: 'Close!',
              });
          </script>";
        }
    }
    
  }
  // SELECTING CATEGORY
  $result_stock=mysqli_query($link,"SELECT * FROM tbl_category ORDER BY category ASC");
  while($row_stock=mysqli_fetch_array($result_stock)){
    @$stocks.="<option value=$row_stock[0]>$row_stock[1]</option>";
  } 
  
  //SELECT CATEGORY TO TABLE
  $results=mysqli_query($link,"SELECT * FROM tbl_category ORDER BY category ASC");
  $i=1;
  while ($rows=mysqli_fetch_array($results)) {
    @$option.="<tr>
          <td> $i</td>
          <td>$rows[1] <input type='hidden' name='cat' value='$rows[1]' id='cat' class='form-control'></td>
          <td>$rows[2]</td>
          <td>
            <a href='add_stock?$rand1&&id_4&&cat_Edit=$rows[0]' class='btn btn-info btn-sm' role='button' id='update_cat'><span class='fa fa-edit'>&nbsp;Edit</span></a>
            <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$rows[0]'><span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }
  //UPDATING CATEGORY
    if(isset($_POST['submit_update'])){
      //echo "<script>alert('hi')</script>";
      $id=$_GET['cat_Edit'];
      $cat=strtoupper($_POST['catName']);
      $update=mysqli_query($link,"UPDATE tbl_category SET category='$cat' WHERE CID='$id'");
      if($update){
        $div="<script>
          swal('Category Updated Successfully','','success')
          setTimeout(function(){
          window.location.href='add_stock?$rand1&&id_4'
          },2000)
        </script>";
      }
    }

  // DELETE CATEGORY DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_category WHERE CID='$id'");
      $div="<script>
              swal('Category has been Removed Successfully','','warning')
              setTimeout(function(){
              window.location.href='add_stock?$rand1&&id_4'
              },3000)
          </script>";
    }
    
    //EDITING STOCK
    if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $results=mysqli_query($link,"SELECT * FROM tbl_stock WHERE cartID='$id'");
      $res=mysqli_fetch_array($results);
      $btn_stock="<input type='submit' name='btn_stock' class='btn btn-success form-control' id='update_stock' value='Update Stock'>";
    }

    //SELECT STOCKS
    $result=mysqli_query($link,"SELECT * FROM tbl_stock ORDER BY cartID DESC");
    $i=1; 
    while ($row=mysqli_fetch_array($result)) {
      @$options.="<tr>
            <td> $i</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td><s style='text-decoration-style: double'>N</s>".number_format($row[4],2)."</td>
          <td>$row[6]</td>
          <td><a href='add_stock?$rand1&ed=$row[0]&id_4' class='btn btn-success btn-sm' id='edit'><span class='fa fa-edit'>&nbsp;</span></a>
          
            <a href='add_stock?$rand1&Del=$row[0]&id_4&' class='btn btn-danger btn-sm' role='button'><span class='fa fa-trash'>&nbsp;</span></a> 
          </td>
        </tr>";
    
    $i++;
  }

  if(isset($_POST['btn_stock'])){
      $id=$_GET['ed'];
      @$stockName=strtoupper(htmlentities($_POST['stockName']));
      @$product=strtoupper(htmlentities($_POST['product']));
      @$qty=htmlentities($_POST['qty']);
      @$price=htmlentities($_POST['price']);

      $update=mysqli_query($link,"UPDATE tbl_stock SET CID='$stockName',product='$product',qty=qty+$qty,price='$price' WHERE cartID='$id'");
      if($update){
        $div="<script>
          swal('Stock Updated Successfully','','success')
          setTimeout(function(){
          window.location.href='add_stock?vw=$rand1&&id_4'
          },3000)
        </script>";
      }
    }

    // DELETE STOCK DETAILS
    if(isset($_GET['Del'])){
      $id=$_GET['Del'];
      mysqli_query($link,"DELETE FROM tbl_stock WHERE cartID='$id'");
      $div="<div class='alert alert-info alert-dismissible col-lg-12 col-lg-push-0 text-center'>
       <button type=button class=close data-dismiss=alert><span>&times;</span></button>
       Stock Removed Successfully
      </div>
      <script>
               swal('Stock has been Removed Successfully','','success')
                setTimeout(function(){
                window.location.href='add_stock?vw=$rand1&&id_4'
                },3000)
            </script>";
    }
  //SUMMING QUANTITY
  $result=mysqli_query($link,"SELECT SUM(qty) AS totals,SUM(price) as prize FROM tbl_stock");
  $val=mysqli_fetch_array($result);
  $qtyNum=$val['totals'];
  $prize=$val['prize'];

  /*$today=date('Y-m-d');
  $result=mysqli_query($link,"SELECT SUM(qty) AS total,SUM(price) as price FROM tbl_stock WHERE postDate='$today'");
  $val=mysqli_fetch_array($result);
  @$qty1=$val['total'];
  @$prize1=$val['price'];*/
?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Add Stock Details Page</h2>
            <a href="add_stock?vw=<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Add Stock Details</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center text-uppercase">
                <div class="col-8">
                  <h3 class="mb-0"><?=$list?> </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <div class="row">
                <div class="col-md-12">
                  <!-------------------------- FOR CATEGORY ---------------------->
                  <div <?php if(isset($_GET['vw'])){echo "style='display:none;'";} if(isset($_GET['ed'])){echo "style='display:none;'";}?>>
                    <div class="text-center text-uppercase"><h2>Add Stock form</h2><h6 style="color:#888;">Ford Breverages (Nigeria Limited)</h6></div>
                    <form  method="POST" action="<?php $PHP_SELF ?>" name="form-cat" id="form-cat">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <!-- CATEGORY NAME -->
                          <label for="catName">Category Name: <span class="text-danger">*</span></label>
                          <input type="text" name="catName" id="catName" placeholder="Enter Category name" class="form-control" value="<?php if(isset($_GET['cat_Edit'])){echo @$res;}else{echo @$catName;}?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>&nbsp;</label>
                        <input type="submit" name="submit_cat" class="btn btn-danger form-control" id="submit_cat" value="Add Category" <?php if(isset($_GET['cat_Edit'])){echo "style=display:none;";}?>>
                        <?=@$btn; ?>
                      </div>
                    </div>
                  </form>
                    <h2 class="text-center">List of Category Added</h2>
                    <table class="table table-hover table-striped table-bordered text-black text-center text-capitalize" width="100%" id="example">
                        <thead class="th">
                          <th>S/N</th>
                          <th>Name of Category</th>
                          <th>Date Added</th>
                          <th>Action</th>
                        </thead>
                        <?=@$option;?>
                    </table>
                  <!------------------------- END CATEGORY --------------------------->
                  <hr>
                </div>
                <div <?php if(isset($_GET['vw'])){echo "style='display:none;'";}?>>
                  <h2 class="text-center mb-5" <?php if(isset($_GET['ed'])){echo "style=display:none;";}?>><b>ADD STOCKS HERE <span class="fa fa-angle-double-down"></span></b></h2>
                  <h2 class="text-center mb-5" <?php if(!isset($_GET['ed'])){echo "style=display:none;";}?>><b>EDIT STOCKS HERE <span class="fa fa-angle-double-down"></span></b></h2>
                  <form  method="POST" action="<?php $PHP_SELF ?>" id="form-stock" name="form-stock">
                  <div class="form-row">
                    <!-- STOCK INFORMATIONS -->
                    <div class="form-group col-sm-6 col-md-3">
                        <!-- STOCK NAME -->
                          <label for="reg">Stock Name: </label>
                          <select name="stockName" id="stockName" class="form-control">
                            <option value="choose">Select Category</option>
                            <?=@$stocks; ?>
                          </select>
                      </div>
                      <div class="form-group col-sm-6 col-md-3">
                        <!-- Product -->
                          <label for="reg">Product:</label>
                          <input type="text" name="product" id="product" placeholder="Enter Product" class="form-control" value="<?php if(isset($_GET['ed'])){echo @$res[2];}else{echo @$product;}?>" >
                      </div>
                      <div class="form-group col-sm-6 col-md-2">
                        <!-- QUANTITY -->
                          <label for="reg">Quantity:</label>
                          <input type="text" name="qty" id="qty" placeholder="Enter Quantity" class="form-control" value="<?php if(isset($_GET['ed'])){echo @$res[3];}else{echo @$qty;}?>">
                      </div>
                      <div class="form-group col-sm-6 col-md-2">
                        <!-- PRICE -->
                          <label for="reg">Price:</label>
                          <input type="text" name="price" id="price" placeholder="Enter Price" class="form-control" value="<?php if(isset($_GET['ed'])){echo @$res[4];}else{echo @$price;}?>">
                      </div>
                      <div class="form-group col-sm-6 col-md-2">
                        <label>&nbsp;</label>
                        <input type="submit" name="submit_stock" class="btn btn-info form-control" id="submit_stock" value="Add Stock" <?php if(isset($_GET['ed'])){echo "style=display:none;";}?>>
                        <?=@$btn_stock; ?>
                      </div>
                    </div><!-- END STOCK LIST -->
                    </form>
                 </div>
                 <!-- TABLE STOCK 1-->
                  <div id="tabList" <?php if(isset($_GET['ed'])){echo "style=display:none;";}?>>
                    <div class="form-group">
                        <h3><b>Total Quantity of Stock Added:</b> <span class="text-danger"><?= $qtyNum; ?></span></h3>
                        <h3><b>Total Price:</b> <s style="text-decoration-style: double; " class="text-danger"> N</s><span class="text-danger"><?= number_format($prize); ?></span></h3>
                      </div>
                      
                    <h2 class="text-center">List of Stocks Added</h2>
                    <table class="table table-hover table-striped table-bordered text-black text-capitalize" width="100%" id="example1">
                        <thead class="th">
                          <th>S/N</th>
                          <th>product</th>
                          <th>Quantity</th>
                          <th>price (<s style="text-decoration-style: double">N</s>)</th>
                          <th>Date Added</th>
                          <th>Action</th>
                        </thead>
                        <?= @$options;?>
                    </table>
                  </div>
                </div><!-- END Column -->
              </div><!-- End Row -->

            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>