<?php
    //GENERATING LANDING COST
    $costID=htmlentities($_POST['costID']);
    @$tr.="<table class='table table-bordered table-strip mb-3'>
          <th>S/N</th>
          <th>Description</th>
          <th>Amount</th>";

    for($i=1;$i<=$costID;$i++){
      @$tr.="<tr>
            <td>$i</td>
            <td><input type='text' name='desc[]' id='desc$i' class='form-control text-uppercase'></td>
            <td><input type='text' name='amount[]' id='amount$i' class='form-control amt'></td>
          </tr>";
    }
    @$tr.="<tr><td colspan='2' class='text-center'><label class='form-control-label mt-2'>TOTAL</label></td><td><input type='hidden' name='land_total' id='land_total' value='0' class='form-control' style='pointer-events:none;'><label class='form-control-label mt-2'><s style='text-decoration-style:double;'>N</s></label><span id='tot'>0</span></td></tr>
      </table>";

    // header("Content-Type:application/xls");
    // header("Content-Disposition:attachment; filename=download.xls");
    echo "$tr";
?>