<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
$(function(){
$("button").click(function(){
			var radioValue = $("input[name='answer']:checked").val();
            

  $.ajax({
		type: "POST", 
		url: "<?php echo HOME.'admin/insert_poll'; ?>", 
		data:{answer:radioValue},
		success: function(responseHTML){
		alert("Done");
		updatedResults();
		$(".container2").hide("500");
		$("#container").show("500");
		$(".container3").show("500");
		
		}
	});
	
  });
  $("#go_back").click(function(){
	  
	    $(".container2").show("500");
		$("#container").hide("500");
		$(".container3").hide("500");
		
  });
  
  $("#view").click(function(){
	  
	  updatedResults();
	    $(".container2").hide("500");
		$("#container").show("500");
		$(".container3").show("500");
		
  });
  
  function updatedResults(){
	  $("#container").empty();
  $.ajax({
		type: "POST",
		dataType:"json",
		url: "<?php echo HOME.'admin/results'; ?>", 
		success: function(response){
		
  // Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		 width: 510,
        height: 400
    },
    title: {
        text: '<?php	echo "".($data[0]['question'])."";?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true
        }
    },
	
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: response
		

		
		
    }]
		});
		}
	});
  }
	
});
</script>
<style>
a {
    cursor:pointer; 
}

.container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
	
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Polling</a>
    </div>
    <ul class="nav navbar-nav" style="float:right;"> 
		<li class="active" >
		<a class="nav-item nav-link" href="<?php echo HOME.'admin/logout'; ?>">Logout</a>
		</li>
      
    </ul>
  </div>
</nav>
  <div class="container">
	<div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-arrow-right"></span><?php	echo "".($data[0]['question'])."";?>
                    </h3>
                </div>
                <div class="panel-body">
				<div class="container3" style="display:none;">				
					<div id="container" style="min-width: 510px; height: 400px; max-width: 600px; margin: 0 auto"></div>
						<div class="panel-footer">
                    
							<a href="#" id="go_back">Go Back</a>
						</div>
				</div>

				<div class="container2">
                    <ul class="list-group">
                             
						
				<?php
		
				for($i=0;$i<count($data)-1;$i++){
			
					echo "  <li class='list-group-item'>
                            <div class='radio'>
                                <label><input type='radio' name='answer' value= ".$data[$i+1]['id'].">" .$data[$i+1]['answer']."
                                </label>
                            </div>
                        </li>";
			
					}
		
					?>
                        
                    </ul>
                </div>
				</div>
				<div class="container2">
                <div class="panel-footer">
                    <button type="button" class="btn btn-primary btn-sm">
                        Vote</button>
                    <a href="#" id="view">View Result</a></div>
            </div>
			</div>
        </div>
        </div>
		