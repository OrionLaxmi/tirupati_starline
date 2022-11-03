<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acontroller extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
	}
	
	public function gameResultDetailsChart()
	{
		$select = 'game_id,game_name,open_time_sort';
		$by = 'open_time_sort';
		$order_type = 'asc';
		$this->data['games'] = $this->Frontamodel->getDataSelectBy($this->tb35,$select,$by,$order_type);
		$this->data['totalGames'] = count($this->Frontamodel->getDataSelectBy($this->tb35,$select,$by,$order_type));
		
		$group_by = 'result_date';
		$select = 'id,game_id,result_date,GROUP_CONCAT(open_number ORDER BY game_id ASC SEPARATOR ",") as open_number';
		$by = 'id';
		$order_type = 'asc';
		$this->data['gamesResult'] = $this->Frontamodel->getDataSelectBy1($this->tb36,$select,$by,$order_type,$group_by);
	
		 	//echo "<pre>";print_r($this->data['gamesResult']);
		$this->load->view('front/g',$this->data);
	}
	
	
	public function gameResultChart()
	{
		$this->data['title']="RR StarLine";
		$this->data['meta_description']='<meta name="keywords" content="" />
        <meta name="description" content="" />';
		$this->data['banner_title']="Game Result Chart";
		
		$game_id = $this->uri->segment(2);
		$where = array ($this->tb21.'.game_id' => $game_id);
		
		$joins = array(
			array(
				'table' => $this->tb16,
				'condition' => $this->tb16.'.game_id = '.$this->tb21.'.game_id',
				'jointype' => 'LEFT'
			)
		);
		$columns = ''.$this->tb21.'.game_id,game_name,result_date,game_name,open_number,close_number,
		open_decleare_status as open_status,close_decleare_status as close_status';
		$by='id';
		$result = $this->Frontamodel->get_joins_where_asc($this->tb21,$columns,$joins,$where,$by);
		foreach($result as $rs)
		{
			$this->data['game_name'] = $rs->game_name;
		}
		$this->data['flag']=1;
		$this->data['result'] = $result;
		/* $this->middle = 'front/c'; 
		$this->frontLayout(); */
		$this->load->view('front/c',$this->data);
	}
	
	public function galidisswarResultDetailsChart()
	{
		$select = 'game_id,game_name,open_time_sort';
		$by = 'open_time_sort';
		$order_type = 'asc';
		$where = array('status'=>1);
		/* $this->data['games'] = $this->Frontamodel->getDataSelectBy($this->tb44,$select,$by,$order_type); */
		$this->data['games'] = $this->Frontamodel->getDataSelectByWhere($this->tb44,$select,$by,$order_type,$where);
		$this->data['totalGames'] = count($this->Frontamodel->getDataSelectByWhere($this->tb44,$select,$by,$order_type,$where));
		/* echo "<pre>";print_r($this->data['games']); */
		$group_by = 'result_date';
		$select = 'id,game_id,result_date,GROUP_CONCAT(open_number ORDER BY game_id ASC  SEPARATOR ",") as open_number,GROUP_CONCAT(game_id ORDER BY game_id ASC  SEPARATOR ",") as game_id_main';
		$by = 'id';
		$order_type = 'asc';
		$this->data['gamesResult'] = $this->Frontamodel->getDataSelectBy1($this->tb45,$select,$by,$order_type,$group_by);
		/* echo "<pre>";print_r($this->data['gamesResult']); */
		$this->load->view('front/h',$this->data);
	}
}