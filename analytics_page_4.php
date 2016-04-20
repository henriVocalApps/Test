<html lang="fr">
    <head>
    	<meta charset="utf-8">
    	<title>Alexa Designer</title>
    	
    	<!-- Chart.js Library -->
    	<script src="controller/Chart.js-master/Chart.js"></script>
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
         <div  class="container-fluid">
            <nav class="navbar navbar-default navbar-fixed-top" style="box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.3);">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Dasboard - Music Quiz v1.8</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Apps <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Add new App</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Music Quiz v1.8</a></li>
                        <li><a href="#">My Push Up Workout</a></li>
                      </ul>
                    </li>
                  </ul>
                  <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                  </form>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        	<div class="row" style="position:fixed; z-index: 1; background-color: #272D33; padding-bottom: 100%; width: 85px ;box-shadow: -1px 2px 5px 5px rgba(0, 0, 0, 0.3); ">
        	    <div  class="container-fluid" >
        	        <div >
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
            	            <img  src="log_1.svg"  height="50" width="50">
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
            <div class="row" style=" padding-bottom: 100%;padding-left: 85px; padding-top: 30px; padding-right: 400;background-color: #F0F2F1;">

        	    <div class="container-fluid centered" style="padding: 50px">
        	        
        	        
        	        
        	        <!-- Users Pane-->
            		<div class="row" >				
                		<div class="panel panel-default" style=" padding-bottom : 20px;">
                            <div class="panel-body">
                                <!-- Pane Title-->
                			    <div class="in-line">
            			            <h2>Coming Soon</h2>            					
            				    </div>
                			    <?php include('../demo/index_henri_custom.php'); ?>

                            </div>	
            	        </div>
                    </div>
                    <!-- End Users Pane-->
                    
                    
                </div>
            </div>
            <div class="row" style="position:fixed; z-index: 1;  right: 0; 
        top: 0;background-color: #979797   ; padding-bottom: 100%; width:400px ; box-shadow: -1px 2px 10px 3px rgba(0, 0, 0, 0.3) inset;">
                <div  class="container-fluid"align="center">
                    <div >
                        <h2 style="color: #AABCDE"></h2>
                    </div>
                </div>
            </div>
         </div>
    </body>
    
	
		<!-- end: JavaScript-->
</html>