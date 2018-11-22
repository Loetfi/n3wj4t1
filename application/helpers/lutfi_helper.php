<?php 
function getSales($idsales='')
{
	$ci = &get_instance();
	$query = $ci->db->query("SELECT * from mssales where idsales = '$idsales' ")->row_array(); 

	return $query['namasales'];
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
?>
