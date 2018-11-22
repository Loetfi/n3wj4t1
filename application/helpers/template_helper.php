<?php 


function template($view = '' , $data = '' , $not_use_menu = false)
{
	$ci =& get_instance(); 

	$data = array_merge($data);

	$ci->load->view('template/header', $data);
	
	if ($not_use_menu === false) {
		$ci->load->view('template/menu', $data);
	}
	$ci->load->view($view, $data);
	$ci->load->view('template/footer', $data);


}

function is_login()
{
	$ci =& get_instance(); 
	if ($ci->session->userdata('login') > 0) { 
		$login = $ci->session->userdata('login');
		$sesi = array(
			'username' => $login['username'], 
			'name' => $login['name'], 
			'idgroup' => $login['idgroup'], 
			'group_name' => $login['group_name']
		);

		return $sesi;
	} 
}



?>
