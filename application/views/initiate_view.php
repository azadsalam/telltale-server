
<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navigation_init') ?>
<?php $this->load->view('templates/sidebar') ?>
<?php $this->load->view('templates/top_navigation') ?>


    <script>

$(document).ready(



function()
{



   function post_callback(data,status)
   {
       //$("#init").html("Data : "+data + " Status : "+status);
       alert(data);
       //data = 1 hole succesfully database a dhukse.... 0 hole hoy nai
       // do needed styling
   }


    function initiate_story()
    {
        var data = {"starting_post":"STORY"};
        var path = "<?=base_url() ?>index.php/initiate/submit";

        starting_post = $("#starting_post").val();
        nid = 0;
        //alert(starting_post);
        data = {"nid" : nid, "starting_post":starting_post, '<?=$this->security->get_csrf_token_name(); ?>': '<?=$this->security->get_csrf_hash(); ?>'};

        $.post(path,data,post_callback);
    }
    $("#initiate").click(initiate_story);
   /* POST  ENDS*/
}
);


</script>


<div id="init">
<?php

echo form_open();
$data = array(
              'name'        => 'starting_post',
              'id'          => 'starting_post',
              'value'       => 'Write your story here'
            );
echo form_textarea($data);
$data = array(
    'name' => 'initiate',
    'id' => 'initiate',
    'content' => 'Initiate a story'
);
echo form_button($data);
echo form_close();


?>



<?php $this->load->view('templates/footer') ?>


</div>


