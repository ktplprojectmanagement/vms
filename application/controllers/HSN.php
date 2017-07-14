<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HSN extends CI_Controller {

	function __Construct()
	{
		parent::__construct();
		$this->load->helper('url');
		//$this->load->library('database');
		$this->load->model('common_model');
	}

	public function index()
	{
if($this->session->userdata('vendor_id'))
{
$data['state_details'] = $this->common_model->get_all_data('state_code_list');
$data['sap_state'] = $this->common_model->get_all_data('sap_state');
		$data['country_details'] = $this->common_model->get_all_data('country_list');
		$data['industry_list'] = $this->common_model->get_all_data('industry_list');
		$data['Reconciliation_Account'] = $this->common_model->get_all_data('Reconciliation_Account');
		$data['planning_group'] = $this->common_model->get_all_data('planning_group');
		$data['payment_code'] = $this->common_model->get_all_data('payment_code');

		$data['status_flag'] = 1;
		$data['table_name'] = 'vendor_details';
		$query = "where Vendor_id = ?";
		$data['edit_user_details'] = $this->common_model->fetch_data('vendor_details',$query,$this->session->userdata('vendor_id'));

		$data['table_name'] = 'vendor_details_update';
		$query = "where Vendor_id = ?";
		$data['edit_user_details1'] = $this->common_model->fetch_data('vendor_details_update',$query,$this->session->userdata('vendor_id'));

		

		//print_r($this->session->userdata('vendor_id'));die();
		$this->load->view('header_view',$data);
		$this->load->view('hsn_list',$data);
		//$this->load->view('footer_view');
}
else
{
redirect('/Login', 'refresh');
}
		
	}
	
	function check()
	{
	    if($this->session->userdata('vendor_id'))
{
$data['state_details'] = $this->common_model->get_all_data('state_code_list');
$data['sap_state'] = $this->common_model->get_all_data('sap_state');
		$data['country_details'] = $this->common_model->get_all_data('country_list');
		$data['industry_list'] = $this->common_model->get_all_data('industry_list');
		$data['Reconciliation_Account'] = $this->common_model->get_all_data('Reconciliation_Account');
		$data['planning_group'] = $this->common_model->get_all_data('planning_group');
		$data['payment_code'] = $this->common_model->get_all_data('payment_code');

		$data['status_flag'] = 1;
		$data['table_name'] = 'vendor_details';
		$query = "where Vendor_id = ?";
		$data['edit_user_details'] = $this->common_model->fetch_data('vendor_details',$query,$this->session->userdata('vendor_id'));

		$data['table_name'] = 'vendor_details_update';
		$query = "where Vendor_id = ?";
		$data['edit_user_details1'] = $this->common_model->fetch_data('vendor_details_update',$query,$this->session->userdata('vendor_id'));

		

		//print_r($this->session->userdata('vendor_id'));die();
		$this->load->view('header_view',$data);
		$this->load->view('hsn_view',$data);
		//$this->load->view('footer_view');
}
else
{
redirect('/Login', 'refresh');
}
	}
	
	function getdata()
	{
	    $code = $_POST['prod_name'];

        $query = "SELECT code FROM HSN_list1 where hsn_desc LIKE '%$code' or '$code%' or '%$code%'";
        $data['mail_recive41'] = $this->db->query($query)->result_array();
        
        $cd = $data['mail_recive41']['0']['code'];
         
        $query = "SELECT code FROM HSN_list1 where code LIKE '$cd%'";
        $data['code_list'] = $this->db->query($query)->result_array();
        
       // print_r(count($data['code_list']));die();
        $html = '';
        for($i=0;$i<count($data['code_list']);$i++)
        {
            if($html == '')
            {
                $html = '<p style="margin-left:10px"><input type="checkbox" class="hsn_val" id="'.$data['code_list'][$i]['code'].'"><lable style="margin-left:10px">'.$data['code_list'][$i]['code'].'</lable></p>';
            }
            else
            {
                $html = $html.'<p style="margin-left:10px"><input type="checkbox" class="hsn_val" id="'.$data['code_list'][$i]['code'].'"><lable style="margin-left:10px">'.$data['code_list'][$i]['code'].'</lable></p>';
            }
            
        }
        
		//print_r($html);die();
		$details = array();
		$details[0] = $data['mail_recive41']['0']['code'];
		$details[1] = $html;
		echo json_encode($details);
	}
	
	function hsn_data()
	{
		$html = '';$html1 = '';
	//	print_r();die();
		for($i=0;$i<count($_POST['HSN_list']);$i++)
		{
		    $data = array(				
    			'code' => $_POST['HSN_list'][$i],
    		);
		    $table_name = 'HSN_list1';
    		$where = 'where code = ?';
    		$data['product_data'] = $this->common_model->fetch_data($table_name,$where,$data);
    		$cnt = $i+1;
    		if($data['product_data'] != '' && count($data['product_data'])>0)
    		{
    		    if($html == '')
        		{
        		    $html = $cnt.') '.$data['product_data']['0']['hsn_desc'].'<br>';
        		}
        		else
        		{
        		    $html = $html.$cnt.') '.$data['product_data']['0']['hsn_desc'].'<br>';
        		}
        		if($html1 == '')
        		{
        		    $html1 = '<textarea id="other_'.$i.'"></textarea><br><br>';
        		}
        		else
        		{
        		    $html1 = $html1.'<textarea id="other_'.$i.'"></textarea><br>'.'<br><br>';
        		}
    		}
    		else
    		{
    		     $key = md5(microtime().rand());
                $html1 =  '<textarea id="other_'.$i.'"></textarea><br><br>';
    		}
    		
    		
		}
		$details[1] = $html1;
		$details[0] = $html;
		echo json_encode($details);
	}
	
	function getdata_code()
	{
	    $cd = $_POST['prod_code'];
	     $query = "SELECT code FROM HSN_list1 where code LIKE '$cd%'";
        $data['code_list'] = $this->db->query($query)->result_array();
        
        //print_r($data['code_list']);die();
        $html = '';$html1 = '';
        if(count($data['code_list']) == '')
        {
             $key = md5(microtime().rand());
                $html1 =  '<textarea id="other_0"></textarea><br><br>';
           
        }
        else
        {
    		  for($i=0;$i<count($data['code_list']);$i++)
            {
                if($html == '')
                {
                    $html = '<p style="margin-left:10px"><input type="checkbox" class="hsn_val" id="'.$data['code_list'][$i]['code'].'"><lable style="margin-left:10px">'.$data['code_list'][$i]['code'].'</lable></p>';
                }
                else
                {
                    $html = $html.'<p style="margin-left:10px"><input type="checkbox" class="hsn_val" id="'.$data['code_list'][$i]['code'].'"><lable style="margin-left:10px">'.$data['code_list'][$i]['code'].'</lable></p>';
                }
                $html1 =  '<textarea id="other_"'.$i.'""></textarea><br><br>';
            }
        }
        
        
		//print_r($html1);die();
		$details = array();
		$details[0] = $html;
		$details[1] = $html1;
		echo json_encode($details);
	}
	
	function deldata()
	{
	    $data = array(				
			'Vendor_id' => $_POST['vendor_id'],
		);
		$table_name = 'vendor_details_update';
		$where = 'where Vendor_id = ?';
		$data['user_details'] = $this->common_model->fetch_data($table_name,$where,$data);
		$list = explode('%^%',$data['user_details']['0']['hsn_code']);
		$list_cmnt = explode('%^%',$data['user_details']['0']['other_comment']);
		$cd_list = ''; $code1 = "";
		for($i=0;$i<count($list);$i++)
		{
		    if($list[$i] != $_POST['code']['1'])
		    {
		        if($cd_list == '')
    		   {
    		       $cd_list = $list[$i];
    		       $code1 = $list_cmnt[$i];
    		   }
    		   else
    		   {
    		       $cd_list = $cd_list.'%^%'.$list[$i];
    		       $code1 = $code1.'%^%'.$list_cmnt[$i];
    		   }
		    }
		}
	    //$code = $data['user_details']['0']['hsn_code'].'%^%'.$code;
	    $data['data'] = array(
			'hsn_code' => $cd_list,
			'other_comment' => $code1,
			//'hsn_desc' => isset($_POST['code_comment']) ? $_POST['code_comment'] : NULL,
			'Vendor_id' => $_POST['vendor_id']				
		);
		//print_r($_POST['code']['1']);die();
		$field_list = 'hsn_code = ?,other_comment = ?';
		$where = 'where Vendor_id = ?';
		$data['user_details'] = $this->common_model->edit_data_record($table_name,$field_list,$where,$data['data']);
	}
	
	function savedata()
	{
	    $data = array(				
			'Vendor_id' => $_POST['vendor_id'],
		);
		$table_name = 'vendor_details_update';
		$where = 'where Vendor_id = ?';
		$data['user_details'] = $this->common_model->fetch_data($table_name,$where,$data);
		$code = '';
		//print_r($_POST['code_comment']);die();
		for($i=0;$i<count($_POST['code_list']);$i++)
		{
	    if($_POST['code_list'][$i] != '')
	    {
		    if($code == '')
		    {
		        $code = $_POST['code_list'][$i];
		         //$code1 = $_POST['code_comment'][$i];
		    }
		    else
		    {
		        $code = $code.'%^%'.$_POST['code_list'][$i];
		         //$code1 = $code1.'%^%'.$_POST['code_comment'][$i];
		    }
		}
		}
		$code1 = $_POST['code_comment'];
		//print_r($_POST['code_comment']);die();
		if(count($data['user_details'])>0)
		{
		    if($data['user_details']['0']['hsn_code'] != '')
		    {
		        $code = $data['user_details']['0']['hsn_code'].'%^%'.$code;
		    }
		    
		    if($data['user_details']['0']['other_comment'] != '')
		    {
		         $code1 = $data['user_details']['0']['other_comment'].'%^%'.$code1;
		    }
		   
		    $data['data'] = array(
				'hsn_code' => isset($_POST['code_list']) ? $code : $data['user_details']['0']['hsn_code'],
			    'other_comment' => isset($_POST['code_comment']) ? $code1 : $data['user_details']['0']['other_comment'],
				'Vendor_id' => $_POST['vendor_id']				
			);
			//print_r($code);die();
			$field_list = 'hsn_code = ?,other_comment = ?';
			$where = 'where Vendor_id = ?';
			$data['user_details'] = $this->common_model->edit_data_record($table_name,$field_list,$where,$data['data']);print_r($data['user_details']);die();
		}
		else
		{
		    $data['data'] = array(
				'Vendor_id' => $_POST['vendor_id'],
				'hsn_code' => isset($_POST['code_list']) ? $code : NULL,
				'other_comment' => isset($_POST['code_comment']) ? $code1 : NULL,
			);
				//print_r($data['data']);die();
				$table_name = 'vendor_details_update';
				$field_list = '(Vendor_id,hsn_code,other_comment)';
				$qry = '(?,?,?,?)';
				$data['user_details'] = $this->common_model->save_data_record($table_name,$field_list,$qry,$data['data']);
		}
		
	    //print_r($data['user_details']);die();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */