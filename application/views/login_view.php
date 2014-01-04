<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navigation_init') ?>
<?php $this->load->view('templates/sidebar') ?>
<?php $this->load->view('templates/top_navigation') ?>

<h2><br/>Login !</h2>

<?php // Change the css classes to suit your needs
echo validation_errors();
$attributes = array('class' => '', 'id' => '');
echo form_open('login/validate_credentials', $attributes);
?>

<p>
        <label for="mail">Mail <span class="required">*</span></label>
        <?php echo form_error('mail'); ?>
        <br /><input id="mail" type="text" name="mail"  value="<?php echo set_value('mail'); ?>"  />
</p>

<p>
        <label for="pass">Password <span class="required">*</span></label>
        <?php echo form_error('pass'); ?>
        <br /><input id="pass" type="password" name="pass"  value="<?php echo set_value('pass'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>

<?php $this->load->view('templates/footer') ?>


