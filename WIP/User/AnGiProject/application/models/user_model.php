<?php
class User_model extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function insertUser($data)
    {
		return $this->db->insert('users', $data);
	}

	function updateUser($id,$data){
		$this->db->where('userID', $id);
		return $this->db->update("users", $data);
	}

	function insertAddress($data)
    {
		$this->db->insert('address', $data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function getData($table)
    {
		$query=$this->db->get($table);
        $data=$query->result_array();
   		return  $data;
	}

	function getUser($ID)
    {
    	$query = $this->db->get_where('users', array('userID' => $ID));
        $data=$query->result_array();
   		return  $data;
	}

	function getAddress($ID)
    {
    	$this->db->select('*');
        $this->db->from('address a'); 
        $this->db->join('province p', 'p.provinceID = a.provinceID');
        $this->db->join('ward w', 'w.wardid = a.wardID');
        $this->db->join('district d', 'd.districtID = a.districtID');
        $this->db->where('a.addressID',$ID); 
        $query = $this->db->get(); 
        $data=$query->result_array();
   		return  $data;
	}



	
	
	//send verification email to user's email id
	// function sendEmail($to_email)
	// {
	// 	$from_email = 'team@mydomain.com';
	// 	$subject = 'Verify Your Email Address';
	// 	$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
		
	// 	//configure email settings
	// 	$config['protocol'] = 'smtp';
	// 	$config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
	// 	$config['smtp_port'] = '465'; //smtp port number
	// 	$config['smtp_user'] = $from_email;
	// 	$config['smtp_pass'] = '********'; //$from_email password
	// 	$config['mailtype'] = 'html';
	// 	$config['charset'] = 'iso-8859-1';
	// 	$config['wordwrap'] = TRUE;
	// 	$config['newline'] = "\r\n"; //use double quotes
	// 	$this->email->initialize($config);
		
	// 	//send mail
	// 	$this->email->from($from_email, 'Mydomain');
	// 	$this->email->to($to_email);
	// 	$this->email->subject($subject);
	// 	$this->email->message($message);
	// 	return $this->email->send();
	// }
	
	// //activate user account
	// function verifyEmailID($key)
	// {
	// 	$data = array('satusUser' => 1);
	// 	$this->db->where('md5(email)', $key);
	// 	return $this->db->update('users', $data);
	// }

}