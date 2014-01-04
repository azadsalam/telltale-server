<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navigation_init') ?>
<?php $this->load->view('templates/sidebar') ?>
<?php $this->load->view('templates/top_navigation') ?>


<?php // Change the css classes to suit your needs
 //echo "MESAGE : ". validation_errors();
$attributes = array('class' => '', 'id' => '');
echo form_open('Registration/submit', $attributes); ?>

<p>
        <label for="name">Name <span class="required">*</span></label>
        <?php echo form_error('name'); ?>
        <br /><input id="name" type="text" name="name"  value="<?php echo set_value('name'); ?>"  />
</p>

<p>
        <label for="mail">Mail <span class="required">*</span></label>
        <?php echo form_error('mail'); ?>
        <br /><input id="mail" type="text" name="mail"  value="<?php echo set_value('mail'); ?>"  />
</p>

<p>
        <label for="password">Password <span class="required">*</span></label>
        <?php echo form_error('password'); ?>
        <br /><input id="password" type="password" name="password"  value="<?php echo set_value('password'); ?>"  />
</p>

<p>
        <label for="country">Country <span class="required">*</span></label>
        <?php echo form_error('country'); ?>
        <br /><input id="country" type="text" name="country"  value="<?php echo set_value('country'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>



<?php $this->load->view('templates/footer') ?>


