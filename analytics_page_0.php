<?php
	include('bdd.php');

        $name_skill = "music_quiz_official_v1.81936";
	$date = '2016-04-18  00:00:00.000000';
	$semaine = 7;
        $best_intent = get_best_intent_alexa($name_skill,$date, $semaine);
	//var_dump($best_intent);	

	

?>

<html lang="fr">

    <head>
    	<meta charset="utf-8">
    	<title>Alexa Designer</title>
    	
    	<!-- Chart.js Library -->
    	<script src="controller/Chart.js-master/Chart.js"></script>
	<script src="controller/bootstrap/js/jquery-2.1.0.min.js"></script>
    	<!-- Bootstrap -->
        <link href="controller/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="controller/bootstrap/js/bootstrap.js"></script>
        <!-- Controller Henri -->
        <script src="controller/dashboard-controller.js"></script>
        <!-- CSS Henri -->
        <link href="style/dashboard.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.vocal-apps.com/community/dashboard/img/favicon.ico" type="image/x-icon">
    </head>		
	<body>
    	<div class="row" style="position:fixed; z-index: 1; background-color: #272D33; padding-bottom: 100%; width:100px ; ">
    	    <div  class="container-fluid"align="center">
    	        <div class="col-sm-6" >
        		    <br>
        	        <br>
        	        <br>
        	        <a href="analytics_page_0.html" data-toggle="tooltip" data-placement="right" title="Over View">
        	            <img  src="dashboard_1.svg" height="50" width="50">
        	            </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_1.html" data-toggle="tooltip" data-placement="right" title="Users">
        	            <img src="active_users.svg" onmouseover="this.src='active_users_1.svg'" onmouseout="this.src='active_users.svg'" height="50" width="50"/>
        	        </a>
        	        <br>
        	        <br>
        	        <a href="analytics_page_2.html" data-toggle="tooltip" data-placement="right" title="Sessions">
        	            <img  src="conversation.svg" onmouseover="this.src='conversation_1.svg'" onmouseout="this.src='conversation.svg'" height="50" width="50">
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
                    <a href="#" data-toggle="tooltip" data-placement="right" title="API Key">
                        <img  src="key.svg" onmouseover="this.src='key_1.svg'" onmouseout="this.src='key.svg'" height="50" width="50">
                    </a>
                    <br>
    	        </div>
    	    </div>
        </div>
        <div class="row" style="padding-top: 50px; padding-bottom: 100%;padding-left: 150px;padding-right: 5%; background-color: #F0F2F1;">
    	    <div class="container-fluid centered">
    	        
    	        <!-- Cards-->
    	        <div class="row" style="max-width:1020px">	
        	        <div class="col-sm-3" >
        	            <div class="panel panel-default" style="background-color: #3B4E67;">
                            <div class="panel-body" style="min-height:91px">
                                <div class="media">
                                  <div class="media-body">
                                    <h3 name="Returning_user_number" class="media-heading" style="color:white;">0</h3>
                                    <p style="color:white;">Returning Users</p>
                                  </div>
                                  <div class="media-right">
                                    <img class="media-object" src="user.svg" height="50" width="50">
                                  </div>
                                </div>
                            </div>
                        </div>
        	        </div>
        	        <div class="col-sm-3" >
        	            <div class="panel panel-default" style="background-color: #289A9F;">
                            <div class="panel-body" style="min-height:91px">
                                <div class="media">
                                  <div class="media-body">
                                    <div class="in-line">
                                        <h3 class="media-heading" style="color:white;">+ </h3>
                                        <h3 class="media-heading" name="new_user_number"style="color:white;">0</h3>
                                    </div>
                                    <p style="color:white;">New Users</p>
                                  </div>
                                  <div class="media-right">
                                      <img class="media-object" src="new_user.svg" height="50" width="50">
                                  </div>
                                </div>
                            </div>
                        </div>
        	        </div>
        	        <div class="col-sm-3" >
        	            <div class="panel panel-default" style="background-color: #FFA841;">
                            <div class="panel-body" style="min-height:91px">
                                <div class="media">
                                  
                                  <div class="media-body">
                                    <h3 name="session_number" class="media-heading" style="color:white;">0</h3>
                                    <p style="color:white;">Sessions</p>
                                  </div>
                                  <div class="media-right">
                                      <img class="media-object" src="conversation.svg" height="50" width="50">
                                  </div>
                                </div>
                            </div>
                        </div>
        	        </div>
        	        <div class="col-sm-3" >
        	            <div class="panel panel-default" style="background-color: #C91F4E;">
                            <div class="panel-body" style="min-height:91px">
                                <div class="media">
                                  <div class="media-body">
                                   <h3 class="media-heading" name="intent_number" style="color:white;">0</h4>
                                    <p style="color:white;">Intent Triggered</p>
                                  </div>
                                  <div class="media-right">
                                      <img class="media-object" src="radar.svg" height="50" width="50">
                                  </div>
                                </div>
                            </div>
                        </div>
        	        </div>
    	        </div>
    	        <!-- End Cards-->
    	        
    	        <!-- Users Pane-->
        		<div class="row" >				
            		<div class="panel panel-default" style="max-width:1020px; padding-bottom : 20px;">
                        <div class="panel-body">
                            <!-- Pane Title-->
            			    <div class="in-line">
        			            <h2>Users </h2>
            					<h6 style="color:#E93122;" name="active_user_number_triangle" ><span class="glyphicon glyphicon-triangle-right" ></span></h6>
            				    <h4 name="active_user_number" style="color:#E93122;">0</h4>
            				    <h4> this week</h4>
        				    </div>
            			    <!-- Pane Content Left-->
            				<div class="col-sm-8">
            				    <br>
            				    <div>
                                    <canvas id="Users-Line-Chart" class="col-sm-12" style="height:200px"></canvas>
                		    	</div>
            				</div>
            				<!-- Pane Content Right-->
            				<div class="col-sm-4">			
            				<h4 align="center">Users repartition</h4>
            				    <div>
                                    <canvas id="User-Repartition-Pie" />
                                </div>
                                <div id="User-Repartition-Pie-Legend" class="chart-legend"></div>
                            </div>
                        </div>	
        	        </div>
                </div>
                <!-- End Users Pane-->
                
        	    <!-- Sessions Pane-->
        		<div class="row">				
            		<div class="panel panel-default" style="max-width:1020px; padding-bottom : 20px;">
                        <div class="panel-body">
                            <!-- Pane Title-->
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
                </div>
                <!-- End sessions Pane-->
                
                <!-- Intents Pane-->
        		<div class="row">				
            		<div class="panel panel-default" style="max-width:1020px; padding-bottom : 20px;">
                        <div class="panel-body">
                            <!-- Pane Title-->
            			    <div class="in-line">
        			            <h2>Intents </h2>
            					<h6 style="color:#E93122;" name="intent_number_triangle"><span class="glyphicon glyphicon-triangle-right" ></span></h6>
            				    <h4 name="intent_number" style="color:#E93122;">0</h4>
            				    <h4> this week</h4>
        				    </div>
            			    <!-- Pane Content Left-->
            				<div class="col-sm-6">
            					<br>
            				    <div id="Intent-Hits-Table"></div>
            				    <a href="analytics_page_3.html">
        	                    <button type="button" class="btn btn-intent">show more</button></a>
            				</div>
            				<!-- Pane Content Right-->
            				<div class="col-sm-6">
            				    <h4 align="center">Intents proportion</h4>	
            				    <br>
            				    <div>
                                    <canvas id="Intent-Hits-Radar" />
                                </div>
                            </div>	
                        </div>	
        	        </div>
                </div>
                <!-- End Intents Pane-->
                
            </div>
        </div>
    </body>
    
	<script>
	
        window.onload = function(){
            
            
	        
	        

	        
	        setDataNumber("session_number",2876);
            setTriangelDirection("session_number_triangle","up");
	        setDataNumber("session_evolution_number",17);
	        setDataSign("session_evolution_sign","-");
	        
            
           
            
        	
        	//Line session
        	setSessionLine(
        	    ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], //Lables
        	    [320,223,312,334,224,323,426]   //Number of Sessions
        	);
        	
           
        	   

		var tableBody;

		$.ajax({
		        url: 'bdd.php',
		        type: 'POST',
		        data : 'best_intent=test',
		        dataType: 'json',
			success: function(json) {
				var intents = json.intents;
				var nbrs = json.nbrs;
				var count = json.count;
				var activations = json.activations;
				var arr;
				var intentR = new Array(), nbrR = new Array();

				  var tableName = "Intent-Hits-Table";  
		  		  var tableHead = new Array("Intent Name","Hits","Evolution");
				  var tableBody = new Array();
				  var fleche = "up";

				  for (var i = 0; i < (intents.length-1); i++) {
					if(intents[i] != "NEW_DIALOG_SESSION"){
						if(i<7){
						     	arr = [(intents[i].replace('"','')).replace('"',''),nbrs[i],activations[i]+"%"];
						  	tableBody.push(arr);
							intentR.push((intents[i].replace('"','')).replace('"',''));
							nbrR.push(nbrs[i]);
						}
					}
				  }
				
				  setTable(tableName,tableHead,tableBody); 
				  setIntentRadar(intentR,nbrR);
				  if(json.count<json.count1){
					fleche = "down";
			 	  }else{
					fleche = "up";
				  }
				  setDataNumber("intent_number",parseInt(count));
            	  setTriangelDirection("intent_number_triangle",fleche);
				  setUserLine(json.dates_users,json.nb_new_users,json.nb_returning_users);
                  setDataNumber("Returning_user_number",json.returning_users);
                  setDataNumber("new_user_number",json.new_users);
                  //User Pane Left Pie
			      setUserRepartitionPie(json.new_users,json.returning_users); // (Number of New Users, Number of Returning Users)
                  var n_user = json.new_users+json.returning_users;
                  if(n_user<json.old_user){
					fleche = "down";
			 	  }else{
					fleche = "up";
				  }
                  setDataNumber("active_user_number",n_user);
                  setTriangelDirection("active_user_number_triangle",fleche);
                console.log(n_user);
                console.log(json.old_user);
                
                
			}
		});
	
            //Intent Table
         

        	
		}

	</script>
		<!-- end: JavaScript-->
</html>
