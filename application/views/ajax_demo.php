PLACE IT WHERE YOU WANT TO START A STORY 

<script src="<?php echo base_url();?>jquery/jquery.js"></script>

    <script>

$(document).ready(



function()
{

    
//    alert("loaded");
   function post_callback(data,status)
   {
       //$("#init").html("Data : "+data + " Status : "+status);
       alert(data);
       //data = 1 hole succesfully database a dhukse.... 0 hole hoy nai
       // do needed styling
   }

   var data = {"starting_post":"STORY"};
   var path = "<?=base_url()?>index.php/initiate/ajax_test";

   function ajax_from_cookie()
   {
       starting_post = $("#starting_post").val();
       //alert(starting_post);
       data = {"starting_post":starting_post, '<?=$this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>'};
       $.post(path,data,post_callback);
   }

   function initiate_story()
   {
       // get the token value
     //   var cct = $("input[name=<?=$this->security->get_csrf_token_name();?>]").val();
       //alert("post");
       starting_post = $("#starting_post").val();
       //alert(starting_post);
       data = {"starting_post":starting_post, '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'};


       $.post(path,data,post_callback);
   }
   $("#initiate").click(initiate_story);
   $("#cookie_ajax_test").click(ajax_from_cookie);
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

echo "<br/>".$this->security->get_csrf_token_name();

?>


</div>

<div id="cookie_ajax_test" style="width: 400px;height: 400px;background-color: burlywood">
    CLICK HERE TO INITIATE THROUGH  AJAX WITHOUT FORM :( :(


</div>


