<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$radius_bumi = 6371;
		// LOKASI USER
		  $lat_user =  (-6.261882858762998 * 3.14) / 180;
		  $long_user = (107.08366194158123 * 3.14) / 180;
		// LOKASI USER
	
		// LOKASI SEKOLAH
		  $lat_sekolah = (-6.257274282458042 * 3.14) / 180;
		  $long_sekolah = (107.04022572816815 * 3.14) / 180;
		// LOKASI SEKOLAH
	
		// RUMUS HARVERSINE
		  $lat = $lat_sekolah - ($lat_user);
		  $long = $long_sekolah - $long_user;
		  $a = (sin($lat / 2) * sin($lat / 2))  + cos($lat_user) * cos($lat_sekolah) * (sin($long/2) * sin($long/2));
		  $c = 2 * asin(sqrt($a));
		  $jarak = $radius_bumi * 2 * $c;
		  $banding = floor($jarak * 1000);
		// RUMUS HARVERSINE

		
	
		if($banding > 0.005)
		{
			echo 'Panjang Segini'.$banding;
		}else{
			echo 'Jauh segini'.$banding;
		}
	}
}
