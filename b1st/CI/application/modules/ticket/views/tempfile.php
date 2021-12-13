<?php
//echo "<pre>";
//print_r($filedet);
//echo "</pre>";
if(!empty($filedet))
{
?>
<ul>
  <?php
  $chkopswat=B1st_fetchmod('opswat');
  foreach($filedet as $filedetlist)
  {
    $txt = "";
    if($filedetlist['scan'] === true && ($chkopswat==1))  // by MAA inverse logic
    {
      $txt = " <strong class='scanthreat'>[Virus detected!]<strong>";
    }
  ?>
  <li id="delfil<?php echo $filedetlist['id'];?>">
    <?php echo $filedetlist['filename'].$txt;?>
    <span onclick="delfile('<?php echo $filedetlist['id'];?>','<?php echo $filedetlist['filename'];?>')"><i class="fa fa-times-circle"></i></span>
    <?php if(empty($filedetlist['scan'])){ ?>
    <input type="hidden" name="files[]" readonly="true" value="<?php echo $filedetlist['filename'];?>" />
    <?php } ?>
  </li>
  <?php
  }
  ?>
</ul>
<?php
}
?>