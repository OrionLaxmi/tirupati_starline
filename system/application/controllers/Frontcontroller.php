<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontcontroller extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->data['title'] ='Welcome To Tirupati Starline';
		$this->data['title2'] ='Welcome to  Tirupati Starline Play';
		$this->data['app_name'] ='tirupati_starline.apk';
		$result = $this->Frontamodel->getData($this->tb19);
			
			if(count($result)>0)
			{
				foreach($result as $rs)
				{
					$this->data['mobile_1'] = $rs->mobile_1;
					$this->data['mobile_2'] = $rs->mobile_2;
					$this->data['whatsapp_no'] = $rs->whatsapp_no;
					$this->data['email_1'] = $rs->email_1;
					$this->data['email_2'] = $rs->email_2;
					$this->data['facebook'] = $rs->facebook;
					$this->data['twitter'] = $rs->twitter;
					$this->data['youtube'] = $rs->youtube;
					$this->data['google_plus'] = $rs->google_plus;
					$this->data['instagram'] = $rs->instagram;
				}
			}
		$this->load->view('front/a',$this->data);
	}
	
}