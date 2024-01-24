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
        <h3 class="modal-title" id="exampleModalLongTitle">Marketer Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-6">Name</div><div class="col-xs-6 mb-2"><?php echo $member['first_name']; ?> <?php echo $member['last_name']; ?></div>
        	<div class="col-xs-6">Email</div><div class="col-xs-6 mb-2"><?php echo $member['email']; ?> </div>
        	<div class="col-xs-6">Mobile</div><div class="col-xs-6 mb-2"><?php echo $member['mobile']; ?> </div>

        	<div class="col-xs-6">Status</div><div class="col-xs-6 mb-2"><?php 
        		if($member['status']=='1') { echo '<span class="btn  btn-success btn-xs">Active</span>'; }else { echo '<span class="btn  btn-danger btn-xs">Inactive</span>';
        		} ?></div>
            <div class="col-xs-12"><h3>Bank Details</h3></div>
            <div class="col-xs-6">Acc Name</div><div class="col-xs-6 mb-2"><?php echo ($member['acc_name']) ? $member['acc_name'] : '--'; ?> </div>
            <div class="col-xs-6">Account Number</div><div class="col-xs-6 mb-2"><?php echo ($member['account_number']) ? $member['account_number'] : '--'; ?> </div>
            <div class="col-xs-6">Bank Name</div><div class="col-xs-6 mb-2"> <?php echo ($member['bank_name']) ? $member['bank_name'] : '--'; ?> </div>
    </div>
  </div>
<!-- /.box-body -->
              <?php /*$totlaMarketer = $this->db->get_where('users', array('role' => 'Marketer'))->num_rows(); */

               // $query = $this->db->select('id, first_name')
               //    ->from('users')
               //    // ->where('role', 'Marketer')
               //    ->where('id = refer_by')
               //    ->get();



?>          
</div>

