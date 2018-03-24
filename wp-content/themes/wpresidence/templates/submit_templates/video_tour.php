<?php
global $virtual_tour;
?>

<div class="submit_container "> 
<div class="submit_container_header"><?php _e('Virtual Tour','wpestate');?></div>

   
   <p class="full_form sidebar_full_form">     
       <label for="embed_virtual_tour"><?php _e('Virtual Tour: ','wpestate');?></label>
       <textarea id="embed_virtual_tour" class="form-control"  name="embed_virtual_tour"> <?php print $virtual_tour;?></textarea>
   </p>
</div> 
