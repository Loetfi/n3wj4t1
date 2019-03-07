<?php 
function getSales($idsales='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from mssales where idsales = '$idsales' ")->row_array(); 

	return $query['namasales'];
}

function getProjectName($id ='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT projectname from trorder where trorderid = '$id' ")->row_array(); 

	return $query['projectname'];	
}

function getProjectNameArray($id)
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT related_order_id from trorderdetail where trorderid = '$id' ")->result_array(); 

	$data = [];
	foreach($query as $key => $val) {
		$rows = getProjectName($val['related_order_id']);
		$data[] = $rows;
	}

	return implode(', ', $data);	
}


function getMesin($idmesin='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from msmesin where idmesin = '".$idmesin."'  and status = 1  ")->row_array(); 

	return $query['namamesin'];
}

function getUkuran($idukuran='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from msukuran where idukuran = '".$idukuran."' ")->row_array(); 

	return $query['namaukuran'];
}

function getArrUkuran($idukuran='') 
{
	$ci = &get_instance();
	// $array = array();
	$query = $ci->db->query("SELECT * from msukuran where idukuran = '".$idukuran."' ")->row_array(); 

	return array(0=>$query['panjang'],1=>$query['lebar']);
}

function nilai_ukuran($matriks_a, $matriks_b)
{
	$hasil = array();
	for ($i=0; $i<sizeof($matriks_a); $i++) {
		for ($j=0; $j<sizeof($matriks_b[0]); $j++) {
			$temp = 0;
			for ($k=0; $k<sizeof($matriks_b); $k++) {
				$temp += $matriks_a[$i][$k] / $matriks_b[$k][$j];
			}
			$hasil[$i][$j] = $temp;
		}
	}
	return $hasil;
}


function getLaminating($laminatingid='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from mslaminating where idlaminating = '".$laminatingid."'  and status = 1  ")->row_array(); 

	return $query['namalaminating'];
}

function getFinishingSatu($finishingid='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from msfinishing where idfinishing = '".$finishingid."'  and status = 1  ")->row_array(); 

	return $query['namafinishing'];
}


function getStockName($namestock = '')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from product where barcode = '$namestock'")->row_array(); 
	return $query['name'];

}


function getProduk($productid='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from product where idproduct = '$productid'  ")->row_array(); 

	return $query['name'];
}


function getCustomer($id='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * FROM customer where idcustomer = '$id'  ")->row_array(); 
	return $query['name'];
}

function getCetak($id='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from msattrcetak where idattributecetak = '$id'  ")->row_array(); 
	return $query['attributecetak'];
}

// dump and die
function dd() {
	$args = func_get_args();
    ob_start();
    echo '<pre>';
    foreach($args as $vars){
        if(is_bool($vars) || is_null($vars))
            var_dump($vars);
        else
            echo htmlspecialchars(print_r($vars, true), ENT_QUOTES);
        echo PHP_EOL;
    }
    echo '</pre>';
    
    $ctx = ob_get_contents();
    ob_end_clean();
    
    echo $ctx;
    die;
}

function finishingsatu($finishingid) {
	$replace = str_replace(',', "','", $finishingid);
	$ci = &get_instance();
	$query = $ci->db->query("
			SELECT GROUP_CONCAT(namafinishing order by namafinishing ASC SEPARATOR  ', ') as concat_finishing from msfinishing where idfinishing in ('$replace')  and status = 1  ")->row_array(); 
	// return $ci->db->last_query();die();
	return $query['concat_finishing'];
}

function read_access() {
	$ci = &get_instance();

	$idgroup = $ci->session->login['idgroup'];
	
	$url =  $ci->uri->segment(1);
	if(!is_null($ci->uri->segment(2))) {
		$url = $ci->uri->segment(1) .'/'. $ci->uri->segment(2);
	}

	$module = $ci->db->query("
		SELECT m.Url, ga.ReadAccess, ga.GroupId
			FROM Menu AS m
			LEFT JOIN GroupsAccess ga ON m.MenuId = ga.MenuId
			WHERE ga.GroupId = '$idgroup' AND m.Url = '$url'
		")->row_array();
        
    $grant_access = $module['ReadAccess'];

    if($grant_access == 0){
        show_404();
    }
}

function get_transaction($id, $field) {
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * FROM transaction where idtransaction_group = '$id'")->row_array();
	return $query[$field];
}

?>