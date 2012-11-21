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
   var path = "<?=base_url()?>index.php/initiate/submit";
   function initiate_story()
   {
       //alert("post");
       starting_post = $("#starting_post").val();
       //alert(starting_post);
       data = {"starting_post":starting_post};

       $.post(path,data,post_callback);
   }
   $("#initiate").click(initiate_story);
   /* POST  ENDS*/
}
);


</script>


<div id="init">
<?php
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
?>
</div>