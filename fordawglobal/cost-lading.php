<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Accountant" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
$continue=false;
    //PRINTING BL USING BL NUMBER 
    if(isset($_POST['btn_land_print1'])){
        $bl=htmlentities($_POST['land_bl1']);
        if($bl==""){
          $div="<script>swal('Please enter the BL Number before printing','','warning')</script>";
        }
        else{
          $results=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$bl'");
          if(mysqli_num_rows($results)>0){
              $continue=true;
             /*$result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_invest WHERE blNo='$bl'");
              $row_t=mysqli_fetch_array($result_t);
              $total=$row_t['total'];
               <td>$row[10]</td>
                      <td>$row[11]</td>
                      <td>$row[12]</td>
                      <td>".number_format($row[13],2)."</td>
                      <td>".number_format($row[14],2)."</td>
                      <td>".number_format($row[15],2)."</td>
                      <td>".number_format($row[16],2)."</td>
                      <td>".number_format($row[17],2)."</td>
                      <td>$row[18]</td>
                      <td>".number_format($row[19],2)."</td>
                      <td>$row[20]</td>*/
              $rows=mysqli_fetch_array($results);
                $blNo=$rows[1];
                $sice=$rows[2];
                $eta=$rows[3];
                @$option="<tr>
                      <td> 1</td>
                      <td>Container Deposit</td>
                      <td>$rows[9]</td>
                    </tr>
                    <tr>
                      <td> 2</td>
                      <td>Shipping</td>
                      <td>$rows[10]</td>
                    </tr>
                    <tr>
                      <td> 3</td>
                      <td>Terminal</td>
                      <td>$rows[11]</td>
                    </tr>
                    <tr>
                      <td> 4</td>
                      <td>Transportation</td>
                      <td>$rows[12]</td>
                    </tr>
                    <tr>
                      <td> 5</td>
                      <td>PAAR</td>
                      <td>$rows[13]</td>
                    </tr>
                    <tr>
                      <td> 6</td>
                      <td>CPC/DTI</td>
                      <td>$rows[14]</td>
                    </tr>
                    <tr>
                      <td> 7</td>
                      <td>Duty</td>
                      <td>$rows[15]</td>
                    </tr>
                    <tr>
                      <td> 8</td>
                      <td>Clearing Settlement</td>
                      <td>$rows[16]</td>
                    </tr>
                    <tr>
                      <td> 9</td>
                      <td>NAFDAC</td>
                      <td>$rows[17]</td>
                    </tr>
                    <tr>
                      <td> 10</td>
                      <td>SON</td>
                      <td>$rows[18]</td>
                    </tr>
                    <tr>
                      <td> 11</td>
                      <td>Agency/Miscellenious</td>
                      <td>$rows[19]</td>
                    </tr>
                    <tr>
                      <td> 12</td>
                      <td>ICNL</td>
                      <td>$rows[20]</td>
                    </tr>";
               
          }
          else{
            $div="<script>swal('No result found','','warning')</script>";
          }
      }
    }

?>

  <!-- Main content -->
  <div class="main-content" id="panel">
<style type="text/css">
  td,th{
      padding-left: 1.5rem;
    }
</style>
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Lading Cost of BL Page</h2>
            <a href="cost-lading?act=<?=$rand1;?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Lading Cost Added</a>
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
              <div class="row text-uppercase">
                <div class="col-12 align-items-center">
                  <h3 class="mb-0">Lading Cost of BL </h3>
                  <button type="button" class="btn btn-default" onclick="window.history.back();" style="float:right;margin-top:-2rem;">Back</button>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
            <form id="form_landing1" name="form_landing1" action="" method="POST">
              <div class="row mt-5" id="print_tab1" <?php if($continue==true){echo "style='display:none;'";}?>>
                <h2 class="text-center">Extract cost of landing sheet with BL Number</h2>
                <h6 class="heading-small text-muted mb-4 text-center">Ford A.W Global (Nigeria Limited)</h6>
                <div class="col-6 mb-4" style="margin:0 auto;width:100%;">
                    <label class="form-control-label" for="land_bl1"> Enter BL Number to extract</label>
                    <div class="form-row">
                      <input type="text" id="land_bl1" name="land_bl1" class="form-control text-uppercase col-md-6" placeholder="Bl Number" maxlength="20" value="">
                      <button type="submit" id="btn_land_print1" name="btn_land_print1" class="btn btn-primary ml-2"><i class="fa fa-print"></i> Check BL </button>
                    </div>
                </div>
              </div>

              <div id="print_tab2" <?php if($continue==false){echo "style='display:none;'";}?>>
                <div class="col-md-12">
                 <h1 class="text-center" style="font-size:1.5rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1>
                 <div class="col-md-12 text-right"><b>Date:</b> <?php echo date('d-m-Y');?></div>
                  <div class="row mt-5 text-uppercase">
                    <div class="form-row col-12">
                      <label class="col-md-4 form-control-label"><h4>LADING COST OF BL: <u><?=$blNo;?></u></h4></label>
                      <label class="col-md-4 form-control-label"><h4>SIZE: <u><?=$sice;?></u></h4></label>
                      <label class="col-md-4 form-control-label"><h4>E.T.A: <u><?=$eta;?></u></h4></label>
                    </div>
                  </div>
                  <table border="1" width="100%" id="example">
                      <th>S/N</th>
                      <th>Description</th>
                      <th>Amount</th>
                    <?= @$option;?>
                    <tr><td colspan="2" class="text-center"><b>total</b></td><td><s style='text-decoration-style:double;'>N</s>  <?=number_format(@$total,2)?></td></tr>
                  </table>
                  <button type="submit" id="btn_land_prints" name="btn_land_prints" class="btn btn-danger mt-4" onclick="print_all('print_tab2')">Print BL</button>
                </div>
              </div><!-- END DIV OF PRINT2 -->
          </form>
        </div>
      </div>
    </div>
  </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>
<script type="text/javascript">
  function print_all(el) {
    //print_all('print_tab2')
        var body=document.body.innerHTML;
        var print_tab=document.getElementById(el).innerHTML;
        document.body.innerHTML=print_tab;
        $('#btn_land_prints').hide();
        window.print();
        document.body.innerHTML=body;
      }
</script>