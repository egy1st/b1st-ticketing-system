<script type="text/javascript">
$(function(){
  $('#sidemenu a').on('click', function(e){
    e.preventDefault();

    if($(this).hasClass('open')) {
      // do nothing because the link is already open
    } else {
      var oldcontent = $('#sidemenu a.open').attr('href');
      var newcontent = $(this).attr('href');
      
      $(oldcontent).fadeOut('fast', function(){
        $(newcontent).fadeIn().removeClass('hidden');
        $(oldcontent).addClass('hidden');
      });
      
     
      $('#sidemenu a').removeClass('open');
      $(this).addClass('open');
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
 
      // get the clicked rate !
      $(".basic").jRating({
          bigStarsPath : '<?= TICKET_PLUGIN_URL;?>CI/assets/css/icons/stars.png',
          smallStarsPath : '<?= TICKET_PLUGIN_URL;?>CI/assets/css/icons/small.png',
          phpPath : '<?= TICKET_PLUGIN_URL ?>CI/index.php/rating/rate',
          type : 'big',
          length:5,
          rateMax : 5,

          onClick : function(element,rate) {
           
          }
      });
});
</script>

</body>

</html>

<script>
$(document).ready( function() { 

$('.sub_old').mouseover( function() {
	$('.fr_buttn').fadeIn('slow');
	$('.fr_buttn').css('display','block');
	
});

	$('#click_hre').click( function() {
	//$(this).toggleClass('fliph'); 
	$('.vertical_menu').toggleClass('fliph');
		//$('#click_hre').fadeOut('slow');
		$('#side_area').toggleClass('fliph_right');
		//$('#target').fadeIn('slow');
		
	});
});
</script>