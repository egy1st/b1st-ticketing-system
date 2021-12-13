</div>
<script type="text/javascript">
$(document).ready(function(){
      // get the clicked rate !
      $(".basic").jRating({
	      	bigStarsPath : '<?= TICKET_PLUGIN_URL;?>CI/assets/css/icons/stars.png',
	      	smallStarsPath : '<?= TICKET_PLUGIN_URL;?>CI/assets/css/icons/small.png',
	      	phpPath : '<?= TICKET_PLUGIN_URL ?>CI/index.php/rating/rate',
	      	type : 'big',
	      	decimalLength : 1,
	      	length:5,
	      	rateMax : 5,

	        onClick : function(element,rate) {
	         
	        }
      });
});
</script>



</body>
</html>

