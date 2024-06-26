<?php include APPPATH . 'views/admin/test_header.php';?>
<?php include APPPATH . 'views/admin/test_sidebar.php';?>



<?php
$urlfromBroweser = $_SERVER['REQUEST_URI'];
$requestStatus =  isset($_GET['status']) ? $_GET['status'] : 'LIVE';

?>




<?php 
    session_start(); // Start the session
    $basePATH_URL = $this->uri->uri_string(); 

    // Check if the user type is set in the session
    if(isset($_COOKIE['sUserType'])) {
        $userType = $_COOKIE['sUserType'];
        
    }
?>                  

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1  style="margin-left: 30px;">
         <?php echo $requestStatus; ?>  Lender  Wallet Transfers info
        </h1>
    </section><br />

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <div class="col-md-6 pull-right">
                            <div class="col-md-12 pull-right">
                                <div class="w2wWithdrawalhistorypagination pull-right">
                                    <ul class="pagination bootpag">
                                    </ul>
                                </div>

                                <div class="searchlendersautoinvestPagination pull-right" style="display: none;">
                                    <ul class="pagination bootpag">
                                    </ul>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 pull-left">

                            <!-- <a href="walletToWalletHistory?status=LIVE"><button class="btn btn-warning btn-md">View Live User <i class="fa fa-angle-double-right"></i></button></a> -->
                            
                            <?php if ($userType === 'SUPERADMIN' || $userType === 'PRIMARYADMIN'): ?>
                                <a href="walletToWalletHistory?status=LIVE"><button class="btn btn-warning btn-md">View Live User <i class="fa fa-angle-double-right"></i></button></a>
<?php endif; ?>

<?php if ($userType === 'TESTADMIN' || $userType === 'MASTERADMIN'): ?>
    <a href="walletToWalletHistory?status=TEST"><button class="btn btn-primary btn-md">View Test User <i class="fa fa-angle-double-right"></i></button></a>
<?php endif; ?>
                             <!-- <a href="walletToWalletHistory?status=TEST"><button class="btn btn-primary btn-md">View Test User <i class="fa fa-angle-double-right"></i></button></a> -->



                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover" border="1">
                            <thead class="mobileDiv_4">
                                <tr>

                                    <th>Sender Info</th>
                                    <th>Receiver Info</th>
                                    <th>Requested Info</th>
                                    <!-- <th>Actions</th> -->

                                    <?php if ($userType !== 'TESTADMIN'): ?>
        <th>Actions</th>
    <?php endif; ?> 
                                </tr>
                            </thead>
                            <tbody id="wallethistorytableinfo" class="mobileDiv_3">

                                <tr id="displayNoRecords" class="displayRequests" style="display:none;">
                                    <td colspan="8">No Data found!</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-approve-withdrawfunds-w2w" tabindex="-1" role="dialog"
    aria-labelledby="modal-interested-borrower" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div align="center">
                    <h4>Are You Sure ?</h4>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-success lenderwithdrawwalletBtn " data-clikedId=""
                    onclick="lenderw2wapproval();">Yes</button> &nbsp;&nbsp; &nbsp;&nbsp;
                <button type="button" class="btn  btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-success fade" id="modal-withdrawalAprrovesuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thanks</h4>
            </div>
            <div class="modal-body wallet_text">
                <p class="w2werrormessage"> You have Approved this request.</p>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script id="loadlenderswalletTowallethistoryTpl" type="text/template">
    {{#data}}
      <tr>
      <td> 
       <b> Name </b> : {{senderName}} </br>
        <b> Id </b> : LR {{senderId}} </br>
       </td>
       
       <td>
        <b> Name </b> : {{receiverName}} </br>
        <b> Id </b> : LR {{receiverId}} </br>
       </td>
      
       <td>
        <b> Requested Amount </b> : {{amount}} </br>
        <b> Requested Date </b> :  {{requestedDate}} </br>
       </td>
           
       <?php if ($userType !== 'TESTADMIN'): ?>
        <td  class="finalw2wstatus" data-status="" data-tableId="">


<div class="w2w-block-{{statusobj}}" style="display:none">
 <button class="btn btn-info btn-xs approve-w2w btn-{{status}}-w2w" onclick="approveW2W('APPROVED',{{id}});" data-id="" data-satus="">approve</button>
 <button class="btn btn-warning btn-xs reject-w2w btn-{{status}}-w2w" onclick="approveW2W('ADMIN REJECTED',{{id}});" data-id="" data-satus="">reject</button>
</div>


    <div class="w2w-blockShow-{{statusobj}}" style="display:none">
      {{status}}
    </div>


</td>  
    <?php endif; ?>    
      </tr>

  {{/data}}



</script>

<script type="text/javascript">
window.onload = w2wWithdrawalhistory('<?php echo $requestStatus; ?>');
</script>

<style type="text/css">
#example2 tr th,
#example2 tr td {
    border: 1px solid #000;
}

#example2 tr th {
    background-color: #D3D3D3;
}
</style>
<script src="<?php echo base_url(); ?>/assets/js/mustache.js"></script>

<?php include 'admin_footer.php';?>