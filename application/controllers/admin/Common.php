<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
		
	}

	public function getlawyerInfo($id = '')
	{
		if(!empty($id))
		{
		$data['title'] = 'Lawyer Information';
		$data['breadcrumb_title'] = 'Lawyer Information';
		$data['breadcrumb_menu'] = 'Lawyer Information';
		$data['section_title'] = 'Lawyer Information';
		$data['id'] = $id;

			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/left');
			$this->load->view('admin/common/lawyerinfo');
			$this->load->view('admin/include/footer');
		}else
		{
			redirect(base_url('admin/dashboard'));
		}

	}


	public function caseinfo($id = '')
	{
		if(!empty($id))
		{
		$data['title'] = 'Case Information';
		$data['breadcrumb_title'] = 'Case Information';
		$data['breadcrumb_menu'] = 'Case Information';
		$data['section_title'] = 'Case Information';
		$data['id'] = $id;

			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/left');
			$this->load->view('admin/common/caseinfo');
			$this->load->view('admin/include/footer');
		}else
		{
			redirect(base_url('admin/dashboard'));
		}

	}
        
        public function sendemail($email="",$title="",$msg=""){
//$title = "test";
//$msg = "test";
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user']  = 'cemiehwe@gmail.com';  
$config['smtp_pass']  = 'gvtwtkanfjhmahdf';  
$config['_smtp_auth'] = true;
$config['smtp_crypto'] = 'tls';
$config['protocol'] = 'smtp';
$config['mailtype']  = 'html'; 
$config['charset']    = 'iso-8859-1';
$config['wordwrap']   = TRUE;

$this->load->library('email');
$this->email->initialize($config);
$content = '<table cellspacing="0" cellpadding="0" border="0" width="650" align="center" style="border:1px solid #e2e2e2;color:#13324b;font-family:Arial,Helvetica,sans-serif;font-size:12px;font-weight:normal"><tbody><tr><td align="center" valign="top"><table cellspacing="0" cellpadding="0" width="100%" align="center" style="color:#000000;font-size:12px"><tbody><tr><td valign="top" bgcolor="#ffffff" style="text-align:center;padding:10px 0 0 0;border-bottom:1px solid #e2e2e2"><a href="https://247sue.com" target="_blank" ><img src="https://247sue.com/assets/images/logo.jpg" style="margin-bottom:10px;" border="0"></a></td></tr><tr><td style="padding:10px 10px 20px" align="center" valign="top"><table width="100%" cellspacing="0" cellpadding="0" align="center" style="font-size:12px;color:#333"><tbody><tr><td align="left" style="padding:10px 0;font-size:12px"><strong style="font-size:18px;color:#333;font-family:Arial,Helvetica,sans-serif">  Following message received via  247sue</strong></td></tr><tr><td height="5"></td></tr><tr><td width="100%" border="0"><table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;color:#666666;border-collapse:collapse;border:1px solid #ccc;border-bottom:0"><tbody>';
       $content .=  '<tr><td style="font-family:Arial,Helvetica,sans-serif;padding:10px;border-bottom:1px solid #ccc;width:66%">'.$msg.'</td></tr>';
               $content .=  '</tbody></table></td></tr></tbody></table></td></tr><tr><td><table cellpadding="0" cellspacing="0" border="0" width="100%" style="line-height:18px;padding:10px;border-top:solid 1px #ccc"><tbody><tr><td align="left" width="50%" style="text-align:left;font-size:12px;font-family:Arial,Helvetica,sans-serif"><strong>Thanks &amp; Regards</strong><br> Free Love Back Solution Team</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
//               echo $content;exit;
$this->email->set_newline("\r\n");
$this->email->from('info@247sue.com');  //same email u use for smtp_user 
$this->email->to($email);
//$this->email->to('hiten.digitalrooar@gmail.com');
$this->email->subject($title);
$this->email->message($content); 
$reponse = $this->email->send();
return  $reponse;
//print_r($reponse);exit;    
	}





}
