<?php include 'admin_header.php';?>
<?php include 'admin_sidebar.php';?>


<div class="content-wrapper">

    <section class="content-header">
        <h1 class="text-bold">
            Deal Based Auto Agreements
        </h1>
    </section>

    <div class="cls"></div>
    </br>
    </br>

    <section class="content">
        <div class="cls"></div>
        <div class="row customFormQ">
            <div class="cls"></div>
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-secondary"></br></br></br></br>
                    <div class="box-body editlendergroup">
                        <div class="form-group row">
                            <label for="dealId " class="col-sm-3 col-form-label ">UTM Source <em class="error">*</em>
                                :</label>
                            <div class="col-sm-3">
                                <input type="text" name="dealId" class="form-control utm"
                                    placeholder="Enter The UTM source" required="required" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dealId " class="col-sm-3 col-form-label ">Deal ID <em class="error">*</em>
                                :</label>
                            <div class="col-sm-3">
                                <input type="text" name="dealId" class="form-control dealId"
                                    placeholder="Enter The Deal ID" required="required" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lenderGroup " class="col-sm-3 col-form-label ">Disbursement Date<em
                                    class="error">*</em> :</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control disbursement" id="disbursement"
                                    placeholder="dd-mm-yyyy" name="disbursement" data validation="disbursement">
                            </div>
                        </div>
                        <div class="row">
                            <label for="duration" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-lg btn-primary pull-right"
                                    onclick="dealbasedAgreements();">Submit</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<div class="modal modal-success fade" id="modal-agreements-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thanks!</h4>
            </div>
            <div class="modal-body">
                <p> agreements generated successfully</br>
                    please wait for 2s page will refresh automatically</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal modal-success fade" id="modal-error-zaggle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thanks!</h4>
            </div>
            <div class="modal-body">
                <p id="erorr-zaggle">Please check duration it is not matching to admin duration value</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>

<script src="<?php echo base_url(); ?>/assets/js/mustache.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<link rel="stylesheet"
    href="<?php echo base_url(); ?>/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#disbursement').datepicker({
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});
</script>

<?php include 'admin_footer.php';?>