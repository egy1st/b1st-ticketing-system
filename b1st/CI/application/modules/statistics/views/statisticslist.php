<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($companydet);
//echo "</pre>";
//echo $priority_json;
$chkrespond=B1st_fetchmod('response_time');
?>
<style>
.chart-area ul {
  list-style: none;
}
.chart-area ul li {
  display: block;
  padding-left: 30px;
  position: relative;
  margin-bottom: 4px;
  border-radius: 5px;
  padding: 2px 8px 2px 28px;
  font-size: 14px;
  cursor: default;
  -webkit-transition: background-color 200ms ease-in-out;
  -moz-transition: background-color 200ms ease-in-out;
  -o-transition: background-color 200ms ease-in-out;
  transition: background-color 200ms ease-in-out;
}
.chart-area li span {
  display: block;
  position: absolute;
  left: 0;
  top: 0;
  width: 20px;
  height: 100%;
  border-radius: 5px;
}
.chart-area div{
  float:left
    }
</style>
<script src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/Chart.js"></script>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-area-chart"></i></span><?php echo $this->lang->line('Statistics');?></h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->
           
           <!-- <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/statistics" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-plus"></i></span>Statistics</a> -->
           
           <!--<a href="#"  class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-times"></i></span>Delete message</a>-->
         </div>
       </div>
       <!--/page_title-->
       <!--main_section-->
       <div class="main_section">
  <?php $this->load->view('common/ticketpanel');?>
         <!--vertical_menu-->
          <!--<div class="left_ver" id="change_bar">
          <span><i class="fa fa-angle-double-right"></i></span>
          </div>-->
         <!--/vertical_menu-->
   
         <!--product_box-->
         <div class="product_box" id="side_area">
          <div class="headding_bl">
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Statistics');?></p>
          <!--  <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/company/index/<?= $this->uri->segment(3) ?>" method="post">
             Show&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">
              <?php $array = array(5,10,20,40,80,100); 
              foreach($array as $no){
               $sel = $no == $noPage ? 'selected':'';
              ?>
               <option value="<?= $no ?>" <?= $sel ?>><?= $no ?></option>
              <?php } ?>
             </select>&nbsp;Entries
           </form> -->
          </div>
          <div class="main_pro_pi">
           
           
         <div class="child_cake">
            <div class="drop_down_pi">
             <div class="all_dro">

             </div>
        
      <form method="post" id="periodform">
        <div id="periodselect" class="form_holder" style="width:25%;display: inline-block;">
    <label><span><?php echo $this->lang->line('Period');?></span></label>
    <div class="select_cover">
      <select name="timeperiod" id="timeperiod" onchange="return showtimeperiod()">
        <option value="today" <?php if($timeperiod=="today") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Today');?></option>
        <option value="yesterday" <?php if($timeperiod=="yesterday") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Yesterday');?></option>
        <option value="lastweek" <?php if($timeperiod=="lastweek") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Last Week');?></option>
        <option value="currentmonth" <?php if($timeperiod=="currentmonth") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Current Month');?></option>
        <option value="lastmonth" <?php if($timeperiod=="lastmonth") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Last Month');?></option>
        <option value="currentyear" <?php if($timeperiod=="currentyear") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Current Year');?></option>
        <option value="lastyear" <?php if($timeperiod=="lastyear") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Last Year');?></option>
        <option value="customdate" <?php if($timeperiod=="customdate") { ?> selected="true" <?php } ?>><?php echo $this->lang->line('Custom Date');?></option>
      </select>
    </div>
        </div>
       <div id="customdatecontainer" style="<?php if($timeperiod!="customdate") { ?> display: none; <?php } ?>">
        <div  class="form_holder" style="width:25%;">
    <label><span><?php echo $this->lang->line('From');?></span></label>
    <input type="text" name="customdatefrom" readonly="true" id="from" <?php if(!empty($customdatefrom)) { ?> value="<?php echo $customdatefrom;?>" <?php } ?> />
        </div>
        <div  class="form_holder" style="width:25%;">
    <label><span><?php echo $this->lang->line('To');?></span></label>
    <input type="text" name="customdateto" readonly="true" id="to"  <?php if(!empty($customdateto)) { ?> value="<?php echo $customdateto;?>" <?php } ?> />
        </div>
        <div class="form_holder" style="width:25%;">
           <label></label>
           <button style="margin-top: 18px;" class="sbmt sbmt_base sbmt_base-no-border" type="button" onclick="submitcustomdate()"><?php echo $this->lang->line('Submit');?></button>
         </div>
      </div>
      </form>
       
            </div>
              <div class="main_panel">
        <ul class="tabs" data-persist="true">
                <li><a href="#prodchart"><?php echo $this->lang->line('Product');?></a></li>
                <li><a href="#prioritychart"><?php echo $this->lang->line('Priority');?></a></li>
                <li><a href="#departmentchart"><?php echo $this->lang->line('Department');?></a></li>
                <li><a href="#statechart"><?php echo $this->lang->line('Ticket State');?></a></li>
                <li><a href="#companychart"><?php echo $this->lang->line('Company');?></a></li>
        </ul>
            <div class="tabcontents">

              <?php
              $prodchk=B1st_fetchmod('product');
              if($prodchk==1)
              {
                ?>
                <div id="view2" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Product');?></h1>
      
      <div class="chart-area" style="width: 100%">
        <canvas id="chart-bar" height="450" width="600"></canvas>
      </div>
      <!--chart for product-->
      
                </div>
                <?php
                }
                ?>

                <div id="view3" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Priority');?></h1>
      
      <div class="chart-area" style="text-align: center;">
        <div id="legend_priority"></div>
        <canvas id="chart-priority" width="300" height="300"/>
      </div>
      <!--chart for priority-->
      
                </div>
                <div id="view4" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Department');?></h1>
                  
      <div class="chart-area" style="text-align: center;">
        <div id="legend_department"></div>
        <canvas id="chart-department" width="300" height="300"/>
      </div>
      <!--chart for department-->
      
                </div>
                <div id="view5" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Ticket State');?></h1>
                  
      <div class="chart-area" style="text-align: center;">
        <div id="legend_state"></div>
        <canvas id="chart-state" width="300" height="300"/>
      </div>
      <!--chart for state-->
      
                </div>

              <?php
              $companychk=B1st_fetchmod('company');
              if($companychk==1)
              {
                ?>
                <div id="view7" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Company');?></h1>
                  
      <div class="chart-area" style="text-align: center;">
        <div id="legend_company"></div>
        <canvas id="chart-company" width="300" height="300"/>
      </div>
      <!--chart for company-->
      
                </div>
                <?php
              }
              ?>


    <div id="view8" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Rating');?></h1>
                  
      <div class="chart-area" style="text-align: center;">
        <canvas id="chart-rate" width="300" height="300"/>
      </div>
      <!--chart for rate-->
      
                </div>
    
    <?php
    if($chkrespond==1)
    {
    ?>
    <div id="view9" class="clearfix">
              <h1 class="tab_name"><?php echo $this->lang->line('Average Response time');?></h1>
                  
      <div class="chart-area" style="text-align: center;">
        <canvas id="chart-response" width="500" height="1200"/>
      </div>
      <!--chart for response-->
      
                </div>
    <?php
    }
    ?>
            </div>
          </div>
         </section>
                </div>
      
                
              
               
              </div>
              </div>
          </div>
          
         </div>
           
         <!--/product_box-->
         
       
         
       </div>
       <!--/main_section-->
       
       <!--recent_activity-->
       <!-- <div class="recent_act_box">
        <h1>Recent Activity</h1>
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
           <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic01.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><i class="fa fa-lock"></i><strong>Completed</strong></a></span>
            </p>
            <p class="det_all"><strong>Milestone Title</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
             
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi ui_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi bhu_txt">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
             <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic02.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><strong class="red_imp">Important</strong></a></span>
            </p>
            <p class="det_all"><strong>Milestone Title</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           <div class="icon_ht"></div>
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
           <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic03.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><i class="fa fa-lock"></i><strong>Completed</strong></a></span>
            </p>
            <p class="det_all"><strong>Milestone Title</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
            <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic04.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
           <span class="lock_pi"><a href="#"><strong class="red_imp">Important</strong></a></span>
            </p>
            <p class="det_all"><strong>Milestone Title</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           </div>
          </div>
         </div>
         
        </div>-->
       <!--/recent_activity-->
    </div>
    
  </div>
</div>
<script type="text/javascript">
  $('.rtabs').find('li').removeClass('selected');
</script>
<script>
//var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
  
var pieDataPriority = <?php echo $priority_json;?>;

var pieDataDepartment = <?php echo $department_json;?>;

var pieDataState = <?php echo $state_json;?>;

var pieDataCompany = <?php echo $company_json;?>;

//$(document).ready(function(){
var ctx1 = document.getElementById("chart-priority").getContext("2d");
window.myPie1 = new Chart(ctx1).Pie(pieDataPriority);

var legendHolder = document.createElement('div');
legendHolder.innerHTML = window.myPie1.generateLegend();
document.getElementById('legend_priority').appendChild(legendHolder.firstChild);

var ctx2 = document.getElementById("chart-department").getContext("2d");
window.myPie2 = new Chart(ctx2).Pie(pieDataDepartment);

var legendHolder = document.createElement('div');
legendHolder.innerHTML = window.myPie2.generateLegend();
document.getElementById('legend_department').appendChild(legendHolder.firstChild);

var ctx3 = document.getElementById("chart-state").getContext("2d");
window.myPie3 = new Chart(ctx3).Pie(pieDataState);

var legendHolder = document.createElement('div');
legendHolder.innerHTML = window.myPie3.generateLegend();
document.getElementById('legend_state').appendChild(legendHolder.firstChild);

<?php
if($companychk==1)
{
?>
var ctx4 = document.getElementById("chart-company").getContext("2d");
window.myPie4 = new Chart(ctx4).Pie(pieDataCompany);

var legendHolder = document.createElement('div');
legendHolder.innerHTML = window.myPie4.generateLegend();
document.getElementById('legend_company').appendChild(legendHolder.firstChild);
<?php
}
?>
<?php
if($prodchk==1)
{
?>
var barChartData = {
  labels : <?php echo $productname_json;?>,
  datasets : [
    {
      fillColor : "rgba(<?php echo $deccolor;?>,0.5)",
      strokeColor : "rgba(<?php echo $deccolor;?>,0.8)",
      highlightFill: "rgba(<?php echo $deccolor;?>,0.75)",
      highlightStroke: "rgba(<?php echo $deccolor;?>,1)",
      data : <?php echo $productnum_json;?>
    }
  ]
}

var ctxbar = document.getElementById("chart-bar").getContext("2d");
window.myBar1 = new Chart(ctxbar).Bar(barChartData);
<?php
}
?>


//var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var lineChartData = {
      labels : <?php echo $ratename_json;?>,
      datasets : [
        {
          label: "Line Curve Rating",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : <?php echo $rateval_json;?>
        }
      ]

    }
    
var lineChartDataResponse = {
      labels : <?php echo $responsename_json;?>,
      datasets : [
        {
          label: "Line Average Response",
          fillColor : "rgba(137,165,240,0.2)",
          strokeColor : "rgba(137,165,240,1)",
          pointColor : "rgba(137,165,240,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(137,165,240,1)",
          data : <?php echo $responseval_json;?>
        }
      ]

    }

var ctxline = document.getElementById("chart-rate").getContext("2d");
window.myLine1 = new Chart(ctxline).Line(lineChartData);

var ctxlineresponse = document.getElementById("chart-response").getContext("2d");
window.myLine11 = new Chart(ctxlineresponse).Line(lineChartDataResponse);
//});
</script>
<script>
$(document).ready(function(){
      $( "#from" ).datepicker({
      changeMonth: true,
      dateFormat: "yy/mm/dd",
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      changeMonth: true,
      dateFormat: "yy/mm/dd",
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
});

function showtimeperiod()
{
  var timeperiodval=$('#timeperiod').val();
  if (timeperiodval=="customdate")
  {
    $('#customdatecontainer').fadeIn();
    return false;
  }
  else
  {
    $('#customdatecontainer').fadeOut();
  }
  $('#periodform').submit();
}

function submitcustomdate() {
   var from = $("#from").val();
   var to = $("#to").val();
   var pattern =/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/;
   if(/\S/.test(from) && /\S/.test(to))
   {
    if(pattern.test(from) && pattern.test(to))
    {
      $('#periodform').submit();
    }
    else
    {
      alert("Select a Valid (yyyy/mm/dd) From and To date !!");
    }
   }
   else
   {
      alert("Select To and From date !!");
   }
}
</script>
<?php
unset($_SESSION["open_tab"]);
$this->load->view('common/footer');
?>
