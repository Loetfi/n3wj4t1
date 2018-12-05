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

function generate_menu($idgroup)
{
	$ci =& get_instance();
	$ci->load->model('menu_model','menu');

	$list_menu = '';
	$list_menu .= '<ul class="accordion-menu">';
	
	// level1
	$menu1 = $ci->menu->get_menu($idgroup,1)->result_array();

	foreach($menu1 as $key => $value) {
		$parent_id = $value['MenuId'];
		// level 2
		$menu2 = $ci->menu->get_menu($idgroup,2, $parent_id)->result_array();
		if(count($menu2) > 0) {
			// level 1 with child
			$list_menu .='<li>';
	
			$list_menu .='<a href="javascript:void(0)">';
			$list_menu .='<i class="'.$value['Icon'].'"></i><span>'.$value['Name'].'</span>';
			$list_menu .='<i class="accordion-icon fa fa-angle-left"></i>';
			$list_menu .='</a>';
			
			$list_menu .='<ul class="sub-menu">';
			foreach ($menu2 as $k2 => $v2) {
				// level 3
				$parent_id = $v2['MenuId'];
				$menu3 = $ci->menu->get_menu($idgroup,3,$parent_id)->result_array();

				if(count($menu3) > 0) {
					// level 1 with child and cucu
					$list_menu .='<li>';
			
					$list_menu .='<a href="javascript:void(0)">';
					$list_menu .='<i class="'.$v2['Icon'].'"></i><span>'.$v2['Name'].'</span>';
					$list_menu .='<i class="accordion-icon fa fa-angle-left"></i>';
					$list_menu .='</a>';
					
					$list_menu .='<ul class="sub-menu">';

					foreach($menu3 as $k3 => $v3) {
						$list_menu .='<li>';
						$list_menu .='<a href="'.site_url($v3['Url']).'">'.$v3['Name'].'</a>';
						$list_menu .='</li>';
					}

					$list_menu .='</ul>';

					$list_menu .='</li>';
				} else {
					$list_menu .='<li>';
					$list_menu .='<a href="'.site_url($v2['Url']).'">'.$v2['Name'].'</a>';
					$list_menu .='</li>';	
				}
			}

			$list_menu .='</ul>';

			$list_menu .='</li>';
		} else {
			// level 1 with no child
			// $list_menu .= '<li class="active-page">';
			$list_menu .= '<li>';

			$list_menu .= '<a href="'.site_url($value['Url']).'">';
			$list_menu .= '<i class="'.$value['Icon'].'"></i><span>'.$value['Name'].'</span>';
			$list_menu .= '</a>';

			$list_menu .= '</li>';
		}
	}

	$list_menu .= '</ul>';
	/*
		<ul class="accordion-menu">
			<li class="active-page">
				<a href="index.html">
					<i class="menu-icon icon-home4"></i><span>Dashboard</span>
				</a>
			</li> 
			<li>
				<a href="javascript:void(0)">
					<i class="menu-icon fa fa-user"></i><span>Pengaturan</span><i class="accordion-icon fa fa-angle-left"></i>
				</a>
				<ul class="sub-menu">
					<li><a href="<?= site_url('manajemen/group') ?>">Manajemen Group</a></li>
					<li><a href="<?= site_url('manajemen/user') ?>">Manajemen Pengguna</a></li>
					<li><a href="ui-buttons.html">Pengaturan Sistem</a></li>  
				</ul>
			</li>
		</ul>
	*/
	return $list_menu;
}


?>
