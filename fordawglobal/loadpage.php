<?php
include 'header.php'; 
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
?>
<script type="text/javascript">
    $(document).ready(function(){
      $('#modal_prints1').modal('show');
    });
    setTimeout(function(){
        window.location='dashboard?<?=$rand1?>&&welcome&&ic=?<?=$rand?>'
    },3000);
</script>
<?php include 'footer.php'; ?>