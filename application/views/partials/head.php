	<?php
	// Periksa session login
	if(!$this->session->userdata('authenticated')) {
    	  redirect('auth');
    	}
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>
		<?php
			if ($this->uri->segment(1)) {
				$sparator = " | ";
			} else {
				$sparator = null;
			}
			echo SITE_NAME ."$sparator". ucfirst($this->uri->segment(1));
		?>	
	</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/books.png">

	<!-- Fonts and icons -->
	<script src="<?php echo base_url('assets/js/plugin/webfont/webfont.min.js') ?> "></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url("assets/css/fonts.min.css") ?>']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?> ">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/atlantis.min.css') ?> ">

	<!-- CSS Just for demo purpose, don't include it in your project -->
<<<<<<< HEAD
	<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?> ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
=======
	<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?> ">
>>>>>>> d1b8c56b57908e07ede54c3c7ccada25c9bcf72c
