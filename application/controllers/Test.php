<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		/* Fungsi perkalian matriks
		* @f2face - 2013
		*/
		function perkalian_matriks($matriks_a, $matriks_b) {
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
		//---------------------------------------------------------------------------
		// Contoh penggunaan :
		// Matriks A
		$a = array();
		$a[] = array(42.00,29.70);
		// $a[] = array(4);
		// Matriks B
		$b = array();
		$b[] = array(14.80,21);
		// $b[] = array(5);
		// Kalikan
		$hasil = perkalian_matriks($a, $b);
		// die();
		// echo "<table border='1' cellspacing='0' cellpadding='5'>";
		$jumlah = 0;
		for ($i=0; $i<sizeof($hasil); $i++) {
			// echo "<tr>";
			// $hasilnya[] = 
			// echo $i;
			$jumlahnya =  round($hasil[$i][0],0) * round($hasil[$i][1],0);
			// for ($j=0; $j<sizeof($hasil[$i]); $j++) {
			// 	$hasilnya[] = round($hasil[$i][$j], 0);
			// 	$hasilnya = round($hasil[$i][$j], 0)*round($hasil[$i][$j], 0);
			// }
			// echo "</tr>";
		}
		echo ceil(100/@$jumlahnya);
		// echo "</table>";
		die();
		// $a[0] = 44.50; 
		// $a[1] = 44.50;

		// $b[0] = 21.00;
		// $b[1] = 29.70;

		// $hasil1 = $a[0]  
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */
