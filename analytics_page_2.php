<html lang="fr">
    <head>
    	<meta charset="utf-8">
    	<title>Alexa Designer</title>
    	
        <script src="controller/bootstrap/js/jquery-2.1.0.min.js"></script>
        
    	<!-- Chart.js Library -->
    	<script src="controller/Chart.js-master/Chart.js"></script>
    	<!-- d3.js Libraryi -->
        <script src="controller/d3.js" charset="utf-8"></script>
        <!-- Sankey Lybrary -->
        <script src="controller/sankey.js"></script>
    	<!-- Bootstrap -->
        <link href="controller/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="controller/bootstrap/js/bootstrap.js"></script>
        <!-- Controller Henri -->
        <script src="controller/dashboard-controller.js"></script>
        <!-- CSS Henri -->
        <link href="style/dashboard.css" rel="stylesheet">
        

    </head>		
	<body>
		
		<?php 
        //include('dasboard_bdd.php');
			/*include('dasboard_bdd.php');
		
			$session_this_week = get_day_tendance_conversation('2016-04-19  00:00:00.000000', 7, 'music_quiz_official_v1.81936');				
			
			var_dump($session_this_week);
			$nb = $session_this_week[0]['session'];
			echo "NB_SESSIONS : ".$nb;
							
        
        $tab_test = get_week_month_conversation('2016-04-18  00:00:00.000000', 7, 'music_quiz_official_v1.81936');	
        var_dump($tab_test);
        	*/	
		?>
		
	    <div class="row" style="position:fixed; z-index: 1; background-color: #272D33; padding-bottom: 100%; width:100px ; ">
    	    <div  class="container-fluid"align="center">
    	        <div class="col-sm-6" >
        		    <br>
        	        <br>
        	        <br>
        	        <a href="analytics_page_0.html" data-toggle="tooltip" data-placement="right" title="Over View">
        	            <img  src="dashboard.svg" onmouseover="this.src='dashboard_1.svg'" onmouseout="this.src='dashboard.svg'" height="50" width="50">
        	            </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_1.html" data-toggle="tooltip" data-placement="right" title="Users">
        	            <img src="active_users.svg" onmouseover="this.src='active_users_1.svg'" onmouseout="this.src='active_users.svg'" height="50" width="50"/>
        	        </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_2.html" data-toggle="tooltip" data-placement="right" title="Sessions">
        	            <img  src="conversation_1.svg" height="50" width="50">
        	        </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_3.html" data-toggle="tooltip" data-placement="right" title="Intents">
        	            <img  src="radar.svg" onmouseover="this.src='radar_1.svg'" onmouseout="this.src='radar.svg'" height="50" width="50">
        	        </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_4.html" data-toggle="tooltip" data-placement="right" title="User Log">
        	            <img  src="log.svg" onmouseover="this.src='log_1.svg'" onmouseout="this.src='log.svg'" height="50" width="50">
        	        </a>
                  <br>
                  <br>
                  <br>
                  <br>
                  <a href="#" data-toggle="tooltip" data-placement="right" title="API Key">
                      <img  src="key.svg" onmouseover="this.src='key_1.svg'" onmouseout="this.src='key.svg'" height="50" width="50">
                  </a>
    	        </div>
    	    </div>
        </div>
        <div class="row" style="padding-top: 50px; padding-bottom: 100%;padding-left: 150px;padding-right: 5%; background-color: #F0F2F1;">
    	    <div class="container-fluid centered">
        
        	    <!-- Sessions Pane-->
        		<div class="row">				
            		<div class="panel panel-default" style="max-width:1020px; padding-bottom : 20px;">
                        <div class="panel-body">
                            
                            <!-- First Row-->
                            <div class="row" >
                                <div class="container-fluid" >
                                    <div class="in-line">
                			            <h2>Sessions </h2>
                    					<h6 style="color:#E93122;" name="session_number_triangle" ><span class="glyphicon glyphicon-triangle-right" ></span></h6>
                    				    <h4 name="session_number" style="color:#E93122;">0</h4>
                    				    <h4> this week</h4>
                				    </div>
                    			    <!-- Pane Content Left-->
                    				<div class="col-sm-8">
                				        <br>
                    				    <div>
                    				   		 <canvas class="col-sm-12" id="Sessions-Line-Chart" style="height:200px"></canvas>
                    		    		</div>
                    				</div>
                    				<!-- Pane Content Right-->
                    				<div class="col-sm-4">					
                    				    <br>
                				        <br>
                				        <br>
                        	            <div class="panel panel-default col-sm-offset-1 col-sm-10 col-sm-offset-1" style="background-color: #FFA841; max-width:225px">
                                            <div class="panel-body">
                                                <div class="media">
                                                  <div class="media-body">
                                                    <div class="in-line">
                                                        <h3 class="media-heading" name="session_evolution_sign" style="color:white;">+</h3>
                                                        <h3 class="media-heading" name="session_evolution_number" style="color:white;">0</h3>
                                                        <h3 class="media-heading" style="color:white;">%</h3>
                                                    </div>
                                                    <p style="color:white;">Sessions</p>
                                                  </div>
                                                  <div class="media-right">
                                                      <img class="media-object" src="conversation.svg" height="50" width="50">
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            <!-- End First Row-->
                            
                            <br>
                            <br>
                            <!-- Second Row-->
                            <div class="row" >
                                <div class="container-fluid" >
                                    <h3>Intent Flow</h3>
                                    <div id="chart"></div>
                                </div>
                            </div>
                            <!-- End Second Row-->
                            
                        </div>	
        	        </div>
                </div>
                <!-- End Sessions Pane-->
                
            </div>
        </div>
    </body>
    <script>

var margin = {top: 1, right: 1, bottom: 6, left: 1},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var formatNumber = d3.format(",.0f"),
    format = function(d) { return formatNumber(d) + " hits"; },
    color = d3.scale.category20();

var sankey = d3.sankey()
    .nodeWidth(15)
    .nodePadding(10)
    .size([width, height]);



var svg = d3.select("#chart").append("svg")
  .attr( "preserveAspectRatio", "xMinYMid meet" )
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom);

var rootGraphic = svg
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


var path = sankey.link();

function createChart( energy ) {
  sankey
      .nodes(energy.nodes)
      .links(energy.links)
      .layout(32);

  var allgraphics = svg.append("g").attr("id", "node-and-link-container" );

  var link = allgraphics.append("g").attr("id", "link-container")
      .selectAll(".link")
      .data(energy.links)
    .enter().append("path")
      .attr("class", function(d) { return (d.causesCycle ? "cycleLink" : "link") })
      .attr("d", path)
	  .sort(function(a, b) { return b.dy - a.dy; })
      ;

  link.filter( function(d) { return !d.causesCycle} )
	.style("stroke-width", function(d) { return Math.max(1, d.dy); })

  link.append("title")
      .text(function(d) { return d.source.name + " -> " + d.target.name + "\n" + format(d.value); });

  var node = allgraphics.append("g").attr("id", "node-container")
      .selectAll(".node")
      .data(energy.nodes)
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
    .call(d3.behavior.drag()
      .origin(function(d) { return d; })
      .on("dragstart", function() { this.parentNode.appendChild(this); })
      .on("drag", dragmove));

  node.append("rect")
      .attr("height", function(d) { return d.dy; })
      .attr("width", sankey.nodeWidth())
      .style("fill", "#FFA841")
      .style("stroke", "#FFA841")
    .append("title")
      .text(function(d) { return d.name + "\n" + format(d.value); });

  node.append("text")
      .attr("x", -6)
      .attr("y", function(d) { return d.dy / 2; })
      .attr("dy", ".35em")
      .attr("text-anchor", "end")
      .attr("transform", null)
      .text(function(d) { return d.name; })
    .filter(function(d) { return d.x < width / 2; })
      .attr("x", 6 + sankey.nodeWidth())
      .attr("text-anchor", "start");

  function dragmove(d) {
    d3.select(this).attr("transform", "translate(" + (d.x = Math.max(0, Math.min(width - d.dx, d3.event.x))) + "," + (d.y = Math.max(0, Math.min(height - d.dy, d3.event.y))) + ")");
    sankey.relayout();
    link.attr("d", path);
  }

  // I need to learn javascript
  var numCycles = 0;
  for( var i = 0; i< sankey.links().length; i++ ) {
    if( sankey.links()[i].causesCycle ) {
      numCycles++;
    }
  }

  var cycleTopMarginSize = (sankey.cycleLaneDistFromFwdPaths() -
	    ( (sankey.cycleLaneNarrowWidth() + sankey.cycleSmallWidthBuffer() ) * numCycles ) )
  var horizontalMarginSize = ( sankey.cycleDistFromNode() + sankey.cycleControlPointDist() );

  svg = d3.select("#chart").select("svg")
    .attr( "viewBox",
	  "" + (0 - horizontalMarginSize ) + " "         // left
	  + cycleTopMarginSize + " "                     // top
	  + (960 + horizontalMarginSize * 2 ) + " "     // width
	  + (500 + (-1 * cycleTopMarginSize)) + " " );  // height
};





var energyData  = {
    'nodes': [
      {name: "Launch Request"},
      {name: "Preferencies"},
      {name: "Nb_Push_UP"},
      {name: "Ready"},
      {name: "Yes"},
      {name: "No"},
      {name: "Give_Up"},
      {name: "Help"},
      {name: "Repeat"},
      {name: "Stop"}
      
     
      
    ],
    'links': [
      {source: 0, target: 3, value: 70},
      {source: 0, target: 1, value: 10},
      {source: 1, target: 2, value: 30},
      {source: 3, target: 1, value: 10},
      {source: 2, target: 3, value: 30},
      {source: 3, target: 4, value: 35},
      {source: 3, target: 5, value: 20},
      {source: 3, target: 6, value: 30},
      {source: 6, target: 1, value: 15},
      {source: 1, target: 7, value: 10},
      {source: 6, target: 7, value: 5},
      {source: 3, target: 7, value: 5},
      {source: 6, target: 9, value: 10},
      {source: 1, target: 8, value: 10}
      
    ]
  };

createChart( energyData );

</script>
	<script>
	
    window.onload = function(){
         
        //nombre de sessions sur semaine
       /* $.ajax({
			url: 'dasboard_bdd.php',
			type: 'POST',
			data : 'session_this_week=test',	/////////////////////////
			dataType: 'json',	
			success: function(json) {
				
				var nb_sessions = json.nb_sessions;	
				
                //console.log(json.nb_sessions);
                
				setDataNumber("session_number",nb_sessions);
				//setTriangelDirection("session_number_triangle","up");
               
			}
		});           
	   
        //graphe nombre de sessions par jour sur une semaine
        $.ajax({
		        url: 'dasboard_bdd.php',
		        type: 'POST',
		        data : 'graphe_session_week=test2',
		        dataType: 'json',
                success: function(json) {
                    var sessions = json.sessions;
                    var dates = json.dates;
                                        
                    setSessionLine(dates, sessions);                                        
                }
		});
        
        //tendance de sessions entre deux semaines
        $.ajax({
			url: 'dasboard_bdd.php',
			type: 'POST',
			data : 'tendance_session=test',	
			dataType: 'json',	
			success: function(json) {
				
				var tendance = json.tendance;					
                
				setDataNumber("session_evolution_number",Math.abs(tendance));
                if(tendance >= 0){
				    setDataSign("session_evolution_sign","+");
                    setTriangelDirection("session_number_triangle","up");
                }
                else{
                    setDataSign("session_evolution_sign","-");
                    setTriangelDirection("session_number_triangle","down");
                }
               
			}
		});*/
        
        
        //Nombre de sessions par jour/semaine, tendance
        $.ajax({
			url: 'dasboard_bdd.php',
			type: 'POST',
			data : 'analytics_page_2=test',	
			dataType: 'json',	
			success: function(json) {
				
				var nb_sessions = json.nb_sessions;					                				              
                var sessions = json.sessions;
                var dates = json.dates;                                                            
				var tendance = json.tendance;					
                
                setDataNumber("session_number",nb_sessions);                  
                setSessionLine(dates, sessions);                
				setDataNumber("session_evolution_number",Math.abs(tendance));
                
                if(tendance >= 0){
				    setDataSign("session_evolution_sign","+");
                    setTriangelDirection("session_number_triangle","up");
                }
                else{
                    setDataSign("session_evolution_sign","-");
                    setTriangelDirection("session_number_triangle","down");
                }               
			}
		});
    
   
	}
		
				
	</script>
		<!-- end: JavaScript-->
</html>
