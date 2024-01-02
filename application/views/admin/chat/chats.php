<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .chatperson{
  display: block;
  border-bottom: 1px solid #eee;
  width: 100%;
  display: flex;
  align-items: center;
  white-space: nowrap;
  overflow: hidden;
  margin-bottom: 15px;
  padding: 4px;
}
.chatperson:hover{
  text-decoration: none;
  border-bottom: 1px solid orange;
}
.namechat {
    display: inline-block;
    vertical-align: middle;
}
.chatperson .chatimg img{
  width: 40px;
  height: 40px;
  background-image: url('http://i.imgur.com/JqEuJ6t.png');
}
.chatperson .pname{
  font-size: 18px;
  padding-left: 5px;
}
.chatperson .lastmsg{
  font-size: 12px;
  padding-left: 5px;
  color: #ccc;
}


.col-md-2, .col-md-10{
    padding:0;
}
.panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    position:fixed;
    float:right;
    margin-left:10px;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}
img {
    display: block;
    width: 100%;
}
.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}



.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $breadcrumb_title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">
        <?= $breadcrumb_menu; ?>
      </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php if ($this->session->flashdata('success_message')) {?>
    <div class="alert alert-success alert-dismissible" role="alert"> <strong><i class="icon fa fa-check"></i> </strong><?php echo $this->session->flashdata('success_message');?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <?php }?>
    <?php if ($this->session->flashdata('error_message')) {?>
    <div class="alert alert-danger alert-dismissible" role="alert"> <strong><i class="icon fa fa-warning"></i> </strong><?php echo $this->session->flashdata('error_message');?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <?php }?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box  box-primary">
          <div class="box-header"> </div>
          <!-- /.box-header -->
          <div class="box-body">
                <div class="row">



                <div class="col-sm-12">
                  <div class="chatbody">
                      <div class="panel panel-primary">
                        <div class="panel-heading top-bar">
                        <div class="col-md-12 col-xs-12">
                       
                        <h3 class="panel-title"><!-- <span class="glyphicon glyphicon-comment"></span>
 -->
                         <span style="float: right;"> <?php echo $rows[0]['laywer_first_name'] ?></span>
                         <span style="float: left;"> <?php echo $rows[0]['client_first_name'] ?></span>
                        

                       </h3>
                    
                        </div>
                        </div>


                           
                             
                            


                              <div class="panel-body msg_container_base">

                              <?php if($rows){ foreach ($rows as $key => $row) {  //echo '<pre>'; print_r($row);  ?>


                              <?php if($row['sender_id'] == $row['lawyer_id']) { ?>

                              <div class="row msg_container base_sent">
                              <div class="col-md-11 col-xs-11" style="padding: 0px;">
                              <div class="messages msg_sent">
                              <p><?php echo $row['message'];  ?></p>
                              <?php if(isset($row['attachment_fullpath']) && $row['attachment_fullpath']!=''){?><p>Attachement: <a target="_blank" href="<?php echo $row['attachment_fullpath']?>"> <?php echo $row['attachment']?></a></p><?php }?>
                              <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                              </div>
                              </div>
                              <div class="col-md-1 col-xs-1 avatar" style="padding: 0px;">
                              <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                              </div>
                              </div>

                            <?php } ?>

                             <?php if($row['sender_id'] == $row['client_id']) { ?>

                              <div class="row msg_container base_receive">
                              <div class="col-md-1 col-xs-1 avatar" style="padding: 0px;">
                              <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                              </div>
                              <div class="col-md-11 col-xs-11" style="padding: 0px;">
                              <div class="messages msg_receive">
                              <p><?php echo $row['message'];  ?></p>
                              <?php if(isset($row['attachment_fullpath']) && $row['attachment_fullpath']!=''){?><p>Attachement: <a target="_blank" href="<?php echo $row['attachment_fullpath']?>"> <?php echo $row['attachment']?></a></p><?php }?>
                              <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                              </div>
                              </div>
                              </div>

                               <?php } ?>


                               <?php  } } ?>
                              </div>
                  <!--     <div class="panel-footer">
                      <div class="input-group">
                      <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                      <span class="input-group-btn">
                      <button class="btn btn-primary btn-sm" id="btn-chat"><i class="fa fa-send fa-1x" aria-hidden="true"></i></button>
                      </span>
                      </div>
                      </div> -->
                    </div>

                    </div>
                  </div>
                </div>
               
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $('.msg_container_base').scrollTop($('.msg_container_base')[0].scrollHeight);
</script>