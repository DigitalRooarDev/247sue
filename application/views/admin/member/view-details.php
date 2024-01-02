<style type="text/css">
.mb-2 {margin-bottom: 10px;}
#memberModal .modal-content
{
	position: relative;
}

#memberModal .modal-content .close
{
	position: absolute;
	right: 0px;
    top: 2px;
    width: 32px;
    height: 32px;
    background: #3c8dbc;
    opacity: 1;
    color: white;
}
</style>
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Member Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-6">Name</div><div class="col-xs-6 mb-2"><?php echo $member['first_name']; ?> <?php echo $member['last_name']; ?></div>
        	<div class="col-xs-6">Email</div><div class="col-xs-6 mb-2"><?php echo $member['email']; ?> </div>
        	<div class="col-xs-6">Mobile</div><div class="col-xs-6 mb-2"><?php echo $member['mobile']; ?> </div>
        	<div class="col-xs-6">Wallet Amount</div><div class="col-xs-6 mb-2"><?php echo currency_symbol; ?> <?php echo $member['wallet']; ?> </div>
        	<div class="col-xs-6">Status</div><div class="col-xs-6 mb-2"><?php 
        		if($member['status']=='1') { echo '<span class="btn  btn-success btn-xs">Active</span>'; }else { echo '<span class="btn  btn-danger btn-xs">Inactive</span>';
        		} ?></div>
        	<div class="col-xs-12"><h3>Documents</h3></div>
        	<div class="col-xs-6">	LLB certificate</div><div class="col-xs-6 mb-2">
        		<?php if($member['llb_certificate']) { ?> 
        		<a class="btn btn-sm btn-success" href="<?php echo base_url('upload/'.$member['llb_certificate']) ?>" download>View</a>
        	<?php }else { echo 'No uplaoded'; } ?>
        	</div> 
        	<div class="col-xs-6">  Call to bar certificate</div><div class="col-xs-6 mb-2">
        		<?php if($member['call_to_bar_certificate']) { ?> 
        		<a class="btn btn-sm btn-success" href="<?php echo base_url('upload/'.$member['call_to_bar_certificate']) ?>" download>View</a>
        	<?php }else { echo 'No uplaoded'; } ?>
        	</div>
        	<div class="col-xs-6">	Supreme court number</div><div class="col-xs-6 mb-2">
        		<?php if($member['supreme_court_number']) { ?> 
        		<a class="btn btn-sm btn-success" href="<?php echo base_url('upload/'.$member['supreme_court_number']) ?>" download>View</a>
        	<?php }else { echo 'No uplaoded'; } ?>
        	</div>
        	<div class="col-xs-6">	Annual practice fee</div><div class="col-xs-6 mb-2">
        		<?php if($member['annual_practice_fee']) { ?> 
        		<a class="btn btn-sm btn-success" href="<?php echo base_url('upload/'.$member['annual_practice_fee']) ?>" download>View</a>
        	<?php }else { echo 'No uplaoded'; } ?>
        	</div>
        </div>
      </div>
     
    </div>
  </div>
</div>