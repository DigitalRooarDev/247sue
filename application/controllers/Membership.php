<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Membership extends CI_Controller
{

    function __construct() {
		Parent::__construct();
		 // check_login_admin();
          $this->load->model('Api_model', 'api'); 
	}


    public function index(){
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		/*$txt = print_r(file_get_contents('php://input'),true);
		fwrite($myfile, $txt);*/
		$data = json_decode(file_get_contents('php://input'), true);
		$response = array();
		$response['result'] = '0';
		$response['response'] = '';
		$plan_arr = array(
			'number_of_cases'=>'No of Cases (Per year)',
			'messaging'=>'Instant messaging',
			'video_recording'=>'Record non-doctorable Video and Audio Evidences',
			'evidence_sharing'=>'Evidence sharing',
			'representation'=>'Discount on Legal Representation in Government Agency Meetings in(%)',
			'storage_space'=>'Storage space (in GB)',
			'sue_individuals'=>'Civil Cases against Individuals',
			'sue_organizations'=>'Sue organizations',
			'rec_audio_evidence'=>'Record Audio Evidences',
			'lawyer_assignment_timings'=>'Lawyer assignment timing',
			'criminal_cases'=>'Petitions for Criminal Cases',
			'court_representation'=>'Discount on Legal Representation in Court in(%)',
			'lawyer_percentage'=>'Lawyer Percentage in(%)',
			'corporations_cases'=>'Civil Cases against corporations',
			'government_agencies_cases'=>'Civil Cases against Government Agencies',
			'discount_on_bail'=>'Discount on Administrative Bail from security and Anti-Graft Agencies in(%)',
		);	
	
		
			$plans = $this->api->getAllPlans('membership_plan',array());
			if($plans && count($plans) > 0){
				//echo "<pre>"; print_r($plans); die;
				foreach($plans as $eachplan){
					$services = array();
					foreach(unserialize($eachplan['service']) as $key=>$value){
						$name = $plan_arr[$key];
						$features['key'] =  $key;
						$features['name'] =  $name;
						$features['value'] =  $value;
						$services[] = $features;		
					}
					$eachplan['service'] = $services; 
					if($eachplan['id']!=DEFAULT_PLAN_ID){
						$allplans[] = $eachplan;
					}
				}
				//$plans['service'] = $features;
				$response['result'] = '1';
				$response['response'] = $allplans;
			}else{
				$response['result'] = '0';
				$response['response'] = 'No Membership Plans available.';
			}
			
			//echo "<pre>"; print_r($response); die;
			$this->load->view('layout/header');
			$this->load->view('front_view/membership',$response);
			$this->load->view('layout/footer');
		
		
		//echo json_encode($response , JSON_PRETTY_PRINT);
	}

	
}

?>