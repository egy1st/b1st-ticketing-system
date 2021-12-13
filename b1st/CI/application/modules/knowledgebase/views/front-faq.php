<?php $this->load->view('front/header');?> 
    <div class="frm_area">
       <p><?php echo $this->lang->line('Fill out the form below and we will be in touch soon');?></p>
       <pre>
       <?php
       print_r($knowledgebasedet);
        ?>
        
  </div>
<?php $this->load->view('front/footer');?>
<?php $this->load->view('common/chatadmin');?>
