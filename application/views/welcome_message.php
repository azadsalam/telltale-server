<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navigation_init') ?>
<?php $this->load->view('templates/sidebar') ?>
<?php $this->load->view('templates/top_navigation') ?>

<?php
     $name = $this->session->userdata('name');
     $nid = $this->session->userdata('nid');
     echo "Wecome $name -> NID : $nid";


?>


<?php $this->load->view('templates/footer') ?>


