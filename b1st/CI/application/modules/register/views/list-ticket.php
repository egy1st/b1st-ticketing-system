<?php $this->load->view('front/header');
?>
    
	<table class="dibya tablesorter tableSort" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0 auto;">
		<thead>
		<tr>
			<th><span class="spany"><?php echo $this->lang->line('Ticket No');?></span></th>
			<th><span class="spany"><?php echo $this->lang->line('Subject');?></span></th>
			<th><span class="spany"><?php echo $this->lang->line('Department');?></span></th>
			<?php
			$promod=B1st_fetchmod('product');
			if($promod==1)
			{
			?>
			<th><span class="spany"><?php echo $this->lang->line('Product');?></span></th>
			<?php
			}
			?>
			<th><span class="spany"><?php echo $this->lang->line('Priority');?></span></th>
			<?php
			$ratingmod=B1st_fetchmod('rating');
			if($ratingmod==1)
			{
			?>
			<td><span class="spany"><?php echo $this->lang->line('Rating');?></span></td>
			<?php
			}
			?>
		</tr>
		</thead>
		<?php
		if(!empty($ticketdet))
		{
			foreach($ticketdet as $ticketdetlist)
			{
				if($ticketdetlist->status==0)
					continue;
			?>
			<tr>
				<td style="font-size:medium;"><center><a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/register/viewTicket/<?= $ticketdetlist->id ?>"><?php echo $ticketdetlist->ticket_no;?></a></center></th>
				<td style="font-size:medium;"><?php echo $ticketdetlist->subject;?></td>
				<td style="font-size:medium;"><center><?php echo $ticketdetlist->department_name;?></center></td>
				<?php
			if($promod==1)
			{
			?>
				<td style="font-size:medium;"><center><?php echo $ticketdetlist->product_name;?></center></td>
			<?php
			}
			?>	
				<td class="act">
					  <p style="background-color:<?= $ticketdetlist->priority_color ?>"><a style="color:#fff;" href="javascript:void(0);"><?= $ticketdetlist->priority_name ?></a></p>
				</td>
				<?php
				$ratingmod=B1st_fetchmod('rating');
				if($ratingmod==1)
				{
				?>
				<td><center>
					   <div class="basic <?php if(B1st_alreadyRated($_SESSION['c_userid'],$ticketdetlist->id )) echo "jDisabled"; ?>" data-average="<?php echo $ticketdetlist->rating;?>" data-id="<?= $ticketdetlist->id ?>">
					   </div>
					
				</center></td>
				<?php
				}
				?>
			</tr>
			<?php
			}
		}
		else
		{
		?>
		<tr>
			<td colspan="8">
				<center><?php echo $this->lang->line('Sorry no records found');?></center>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	
</div>
<?php $this->load->view('front/footer');?>
<?php
$chk=B1st_fetchmod('chat');
if($chk==1)
{
    $this->load->view('common/chatadmin');
}
?>