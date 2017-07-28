<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendorlist extends CI_Controller {

	function __Construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('common_model');
	}

	public function index()
	{


$this->db->select('Vendor_id');
$this->db->from('vendor_details_update');
$this->db->where('updation_state = 1');
$data['vendor_details1'] = $this->db->get()->result_array();

$vendor_list = '';

for($i=0;$i<count($data['vendor_details1']);$i++)
{
if($vendor_list == '')
{
$vendor_list = $data['vendor_details1'][$i]['Vendor_id'];
}
else
{
$vendor_list = $vendor_list.','.$data['vendor_details1'][$i]['Vendor_id'];
}
}

$query = "SELECT Vendor_id FROM vendor_details
HAVING Vendor_id NOT IN (SELECT Vendor_id FROM vendor_details_update)";

//$query = "SELECT  a.* FROM vendor_details a where not exists ('select * from vendor_details_update WHERE updation_state != 1')";

//$query = "select * from vendor_details where Vendor_id IN $vendor_list";

$data['vendor_details'] = $this->db->query($query)->result_array();

		
		//print_r(count($data['vendor_details']));die();
		$data['status'] = 'vendor_list';
		//print_r($data['state_details']);die();
		$this->load->view('admin_header_view',$data);
		$this->load->view('vendorlist_view',$data);
		$this->load->view('footer_view');
	}

	function get_vendor()
	{
 
               if($_POST['purch_id'] != '--Select--')
{
$where = 'where Purchaser_Email_ID = ?';
		//print_r($_POST['customer_id']);die();
		$data['user_details'] = $this->common_model->fetch_data('vendor_details',$where,$_POST['purch_id']);
		$vendor_data = '';
			if (isset($data['user_details']) && count($data['user_details'])>0) {
			for ($i=0; $i < count($data['user_details']); $i++) { 
				if ($vendor_data == '') {
					$vendor_data = '
					<tr>
						<td><input type="checkbox" value='.$data['user_details'][$i]['Vendor_id'].'  id='.$data['user_details'][$i]['Vendor_id'].'></td>
						<td>'.$data['user_details'][$i]['Purchaser_Name'].'</td>
						<td>'.$data['user_details'][$i]['Vendor_id'].'</td>
						<td>'.$data['user_details'][$i]['Name'].'</td>
						<td>'.$data['user_details'][$i]['vendor_type'].'</td>
						<td>
							<form method="post" action='.base_url().'index.php/Vendordata">
								<input type="text" name="vendor_id" value='.$data['user_details'][$i]['Vendor_id'].'>
								<input type="submit" name="submit"  value="Check">
							</form>
						
						</td>
					</tr>';
				}
				else
				{
					$vendor_data = $vendor_data.'
					<tr>
						<td><input type="checkbox" value='.$data['user_details'][$i]['Vendor_id'].' id='.$data['user_details'][$i]['Vendor_id'].'></td>
						<td>'.$data['user_details'][$i]['Purchaser_Name'].'</td>
						<td>'.$data['user_details'][$i]['Vendor_id'].'</td>
						<td>'.$data['user_details'][$i]['Name'].'</td>
						<td>'.$data['user_details'][$i]['vendor_type'].'</td>
						<td>
							<form method="post" action='.base_url().'index.php/Vendordata">
								<input type="text" name="vendor_id" value='.$data['user_details'][$i]['Vendor_id'].'>
								<input type="submit" name="submit"  value="Check">
							</form>
						
						</td>
					</tr>';
				}
			}
		}
		else
		{
			$vendor_data = '<tr colspan="6"><td>No Record Found</td></tr>';
		}
}
else
{
$where = 'where 1';
		//print_r($_POST['customer_id']);die();
		$data['user_details'] = $this->common_model->fetch_data('vendor_details',$where,$_POST['purch_id']);
		$vendor_data = '';
			if (isset($data['user_details']) && count($data['user_details'])>0) {
			for ($i=0; $i < count($data['user_details']); $i++) { 
				if ($vendor_data == '') {
					$vendor_data = '
					<tr>
						<td><input type="checkbox" value='.$data['user_details'][$i]['Vendor_id'].'  id='.$data['user_details'][$i]['Vendor_id'].'></td>
						<td>'.$data['user_details'][$i]['Purchaser_Name'].'</td>
						<td>'.$data['user_details'][$i]['Vendor_id'].'</td>
						<td>'.$data['user_details'][$i]['Name'].'</td>
						<td>'.$data['user_details'][$i]['vendor_type'].'</td>
						<td>
							<form method="post" action='.base_url().'index.php/Vendordata">
								<input type="text" name="vendor_id" value='.$data['user_details'][$i]['Vendor_id'].'>
								<input type="submit" name="submit"  value="Check">
							</form>
						
						</td>
					</tr>';
				}
				else
				{
					$vendor_data = $vendor_data.'
					<tr>
						<td><input type="checkbox" value='.$data['user_details'][$i]['Vendor_id'].' id='.$data['user_details'][$i]['Vendor_id'].'></td>
						<td>'.$data['user_details'][$i]['Purchaser_Name'].'</td>
						<td>'.$data['user_details'][$i]['Vendor_id'].'</td>
						<td>'.$data['user_details'][$i]['Name'].'</td>
						<td>'.$data['user_details'][$i]['vendor_type'].'</td>
						<td>
							<form method="post" action='.base_url().'index.php/Vendordata">
								<input type="text" name="vendor_id" value='.$data['user_details'][$i]['Vendor_id'].'>
								<input type="submit" name="submit"  value="Check">
							</form>
						
						</td>
					</tr>';
				}
			}
		}
		else
		{
			$vendor_data = '<tr colspan="6"><td>No Record Found</td></tr>';
		}
}

		
		print_r($vendor_data);die();
	}

	function send_mails()
	{
		$list = explode('!',$_POST['vendor_value']);
		//print_r($list);die();
		if (count($list)>0) {
			foreach($list as $row) {
				$where = 'where Vendor_id = ?';
				//print_r($_POST['customer_id']);die();
				$data['user_details'] = $this->common_model->fetch_data('vendor_details',$where,$row);
				//print_r($data['user_details']);die();
				$config = Array(
		           'protocol' => 'smtp',
		            'smtp_host' => 'smtp.office365.com',
		            'smtp_port' => 587,
		            'smtp_user' => 'gst@metalpower.net',
		            'smtp_pass' => 'H@eel@098',
'newline'  => "\r\n",
'crlf' => "\r\n",
'smtp_crypto' => 'tls'
		        );
		        $this->load->library('email', $config);
		       
 $this->email->set_mailtype("html");
		     //print_r($data['user_details']);die();
		        $this->email->from('gst@metalpower.net', 'Metal Power GST Team');
		       $data1 = array(
		             'Name'=> $data['user_details']['0']['Name'],
		             'vendor_id'=> $data['user_details']['0']['Vendor_id'],
		       );
		      // print_r(strtolower($data['user_details']['0']['EMail_id']));die();
		$this->email->to(strtolower($data['user_details']['0']['EMail_id']));  // replace it with receiver mail id
//$list = array('purchase@metalpower.net','gst@metalpower.net','digamber.phalak@metalpower.net');
$this->email->cc($list);
			  //  $this->email->cc($list);  // replace it with receiver mail id
//$this->email->bcc('demo.appraisel@gmail.com');
//$this->email->to('demo.appraisel@gmail.com');
$this->email->bcc('demo.appraisel@gmail.com');
			    $this->email->subject('GST Registration Process'); // replace it with relevant subject
		        //$body = $this->load->view('welcome_rem.php',$data1,TRUE);
		        //$body = $this->load->view('welcome.php',$data1,TRUE);
		        $body = $this->load->view('welcome.php',$data1,TRUE);
		        $this->email->message($body); 
		        if ($this->email->send()) { 
		        	$data5 = array(
						'vendor_id' => $data['user_details']['0']['Vendor_id'], 
						'mail_sent' => '1',
						'changes_date' => date("Y-m-d h:i:s"),
                                                'reminder_date' => date("Y-m-d"),
					);
		        	$table_name = 'mail_record';
					$field_list = '(vendor_id,mail_sent,changes_date)';
					$qry = '(?,?,?)';
		        	$data['user_details'] = $this->common_model->save_data_record($table_name,$field_list,$qry,$data5);
		        }
		        else
		        {
		        	$data5 = array(
						'vendor_id' => $data['user_details']['0']['Vendor_id'], 
						'mail_bounse' => '2',
						'changes_date' => date("Y-m-d h:i:s"),
'reminder_date' => date("Y-m-d"),
					);
		        	$table_name = 'mail_record';
					$field_list = '(vendor_id,mail_bounse,changes_date)';
					$qry = '(?,?,?)';
		        	$data['user_details'] = $this->common_model->save_data_record($table_name,$field_list,$qry,$data5);
		        }
			}
		}
		else
		{
			echo "Please select vendor from list.";
		}
		
	}

function tech_send_mails()
	{
		$list = explode('!',$_POST['vendor_value']);
		//print_r($list);die();
		if (count($list)>0) {
			foreach($list as $row) {
				$where = 'where Vendor_id = ?';
				//print_r($_POST['customer_id']);die();
				$data['user_details'] = $this->common_model->fetch_data('vendor_details',$where,$row);
				//print_r($data['user_details']);die();
				$config = Array(
		           'protocol' => 'smtp',
		            'smtp_host' => 'outlook.office365.com',
		            'smtp_port' => 995,
		            'smtp_user' => 'partners@vvfltd.com',
		            'smtp_pass' => 'vvfltd@123',
'newline'  => "\r\n",
'crlf' => "\r\n",
'smtp_crypto' => 'ssl'
		        );
		        $this->load->library('email', $config);
		       
 $this->email->set_mailtype("html");
		     //print_r($data['user_details']);die();
		        $this->email->from('partners@vvfltd.com', 'Metal Power GST Team');
		       $data1 = array(
		             'Name'=> $data['user_details']['0']['Name'],
		             'vendor_id'=> $data['user_details']['0']['Vendor_id'],
		       );
		   $this->email->to(strtolower($data['user_details']['0']['EMail_id']));  // replace it with receiver mail id
$list = array($data['user_details']['0']['Purchaser_Email_ID'],$data['user_details']['0']['Sub_Purchaser_Email_ID'],'jayesh.menon@kritva.com','demo.appraisel@vvfltd.com');
			    //$this->email->cc($list);  // replace it with receiver mail id
$this->email->bcc('demo.appraisel@vvfltd.com');
			    $this->email->subject('Technical Assistance in sharing GST registration details with Metal Power'); // replace it with relevant subject
		       
		        $body = $this->load->view('tech_support.php',$data1,TRUE);
		        $this->email->message($body); 
		        if ($this->email->send()) { 
		        	$data5 = array(
						'vendor_id' => $data['user_details']['0']['Vendor_id'], 
						'mail_sent' => '1',
						'changes_date' => date("Y-m-d h:i:s"),
                                                'reminder_date' => date("Y-m-d"),
					);
		        	$table_name = 'mail_record';
					$field_list = '(vendor_id,mail_sent,changes_date,reminder_date)';
					$qry = '(?,?,?,?)';
		        	$data['user_details'] = $this->common_model->save_data_record($table_name,$field_list,$qry,$data5);
		        }
		        else
		        {
		        	$data5 = array(
						'vendor_id' => $data['user_details']['0']['Vendor_id'], 
						'mail_bounse' => '2',
						'changes_date' => date("Y-m-d h:i:s"),
'reminder_date' => date("Y-m-d"),
					);
		        	$table_name = 'mail_record';
					$field_list = '(vendor_id,mail_bounse,changes_date,reminder_date)';
					$qry = '(?,?,?,?)';
		        	$data['user_details'] = $this->common_model->save_data_record($table_name,$field_list,$qry,$data5);
		        }
			}
		}
		else
		{
			echo "Please select vendor from list.";
		}
		
	}

function send_mails_pending()
	{
		$list = explode('!',$_POST['vendor_value']);
		//print_r($list);die();
		if (count($list)>0) {
			foreach($list as $row) {
				$where = 'where Vendor_id = ?';
				//print_r($_POST['customer_id']);die();
				$data['user_details'] = $this->common_model->fetch_data('vendor_details',$where,$row);
				//print_r($data['user_details']);die();
				$config = Array(
		           'protocol' => 'smtp',
		            'smtp_host' => 'outlook.office365.com',
		            'smtp_port' => 995,
		            'smtp_user' => 'partners@vvfltd.com',
		            'smtp_pass' => 'vvfltd@123',
'newline'  => "\r\n",
'crlf' => "\r\n",
'smtp_crypto' => 'ssl'
		        );
		        $this->load->library('email', $config);
		       
 $this->email->set_mailtype("html");
		     //print_r($data['user_details']);die();
		        $this->email->from('partners@vvfltd.com', 'Metal Power GST Team');
		       $data1 = array(
		             'Name'=> $data['user_details']['0']['Name'],
		             'vendor_id'=> $data['user_details']['0']['Vendor_id'],
		       );
		   $this->email->to(strtolower($data['user_details']['0']['EMail_id']));  // replace it with receiver mail id
$list = array($data['user_details']['0']['Purchaser_Email_ID'],$data['user_details']['0']['Sub_Purchaser_Email_ID'],'jayesh.menon@kritva.com','demo.appraisel@gmail.com');
			    //$this->email->cc($list);  // replace it with receiver mail id
$this->email->bcc('demo.appraisel@gmail.com');
			    $this->email->subject('GST Verification'); // replace it with relevant subject
		       
		        $body = $this->load->view('welcome.php',$data1,TRUE);
		        $this->email->message($body); 
		     
			}
		}
		else
		{
			echo "Please select vendor from list.";
		}
		
	}


	function New_login($vendor_id = null)
	{
		//print_r($vendor_id);die();
		$this->session->set_userdata('username',$vendor_id);
	}

	function print_data()
	{
		// /$this->session->set_userdata('username_new','1');
		print_r($this->session->userdata('username'));
	}
}