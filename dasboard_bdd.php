<?php 


$bdd_server = 'localhost';
$bdd_user = 'robot';
$bdd_password = 'xYU9xF65MNwNQ8aB';



function bdd_connect_pdo($bdd_name)
{
	global $bdd_server;
	global $bdd_user;
	global $bdd_password;

	try
	{
		$bdd = new PDO('mysql:host='.$bdd_server.';dbname='.$bdd_name, $bdd_user, $bdd_password);
		$bdd->exec("set names utf8");
		return $bdd;
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

function bdd_connect($bdd_name)
{
	global $bdd_server;
	global $bdd_user;
	global $bdd_password;
	

	// connecting to the database
	$db = mysqli_connect($bdd_server, $bdd_user, $bdd_password, $bdd_name);
	// set utf8 charset
	mysqli_set_charset($db, "utf8");
	
	return $db;
	

};

function bdd_close($link)
{
	mysqli_close ($link);
}

//Transformer une date en jour
function getWeekDay($date){

     $dayOfWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
     $dayNumber = date('w', strtotime($date));

     return  $dayOfWeek[$dayNumber];

    }

function get_total_conversation($date, $interval, $skill){
		
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT COUNT(DISTINCT(session_id)) as session FROM new_logs WHERE date between (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ? AND skill_name=?";        
	
	$req = $bdd->prepare($sql);
	$req->execute(array($date,$interval,$date,$skill));
    $tab = array();
	
	while($data =  $req->fetch())
    {
       $tab[]=$data;
    }
    $req->closeCursor();
    
    return $tab;
}
//nombre de session par semaine/mois
function get_week_month_conversation($date, $interval, $skill){
		
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT COUNT(DISTINCT(session_id)) as session, DATE(date) as month FROM new_logs WHERE date between (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ? AND skill_name=? group by DATE(date)" ;        //EXTRACT(WEEK FROM date)
	
	$req = $bdd->prepare($sql);
	$req->execute(array($date,$interval,$date,$skill));
    $tab = array();
	
	while($data =  $req->fetch())
    {
       $tab[]=$data;
    }
    $req->closeCursor();
    
    return $tab;
}

//nombre de session par heure pour un jour
function get_day_conversation($date,$skill){
		
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT COUNT(DISTINCT(session_id)) as session, date as date FROM new_logs WHERE date between (SELECT DATE_SUB(?, INTERVAL 24 HOUR)) AND ? AND skill_name= ? ";	
	
	$req = $bdd->prepare($sql);
	$req->execute(array($date,$date,$skill));
    $tab = array();
	
	while($data =  $req->fetch())
    {
       $tab[]=$data;
    }
    $req->closeCursor();
    
    return $tab;
}

//Calcul du nombre total de sessions pendant une semaine
function get_day_tendance_conversation($date, $interval, $skill){
		
	$bdd = bdd_connect_pdo('robots');	
	$sql = "SELECT COUNT(DISTINCT(session_id)) as session FROM  new_logs WHERE date between (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ? AND skill_name=?";
						
	$req = $bdd->prepare($sql);
	$req->execute(array($date,$interval,$date,$skill));
    $tab = array();
	
	while($data =  $req->fetch())
    {
       $tab[]=$data;
    }
    $req->closeCursor();
    
    return $tab;
}

//calcul la tendance sur deux intervalles différents (Exemple : semaine du 11 et semaine du 18)
function get_tendance($va, $vd){
		
	$res = (($va - $vd)/$vd)*100;
    
    return $res;
}

///////////////////////////////////////////////////////////////
//nombre total de sessions sur une semaine
if (isset($_POST["session_this_week"])) 
    {
		
		$skill = "music_quiz_official_v1.81936";
		$date = '2016-04-20  00:00:00.000000';
		$interval = 7;
		$session_this_week = get_day_tendance_conversation($date, $interval, $skill);                                             
		$nb_session = $session_this_week[0]['session'];
						
		echo json_encode(['nb_sessions'=>$nb_session]);
		exit();
    }


//graphe nombre de sessions par jour sur une semaine
if (isset($_POST["graphe_session_week"])) 
    {
		
		$skill = "music_quiz_official_v1.81936";
		$date = '2016-04-20  00:00:00.000000';
		$interval = 7;
		$graphe_session_week = get_week_month_conversation($date, $interval, $skill);    
		$sessions =array(); $dates = array();
		
        //$nbr = array();

        foreach ($graphe_session_week as $value) {
            array_push($sessions, $value['session']); 
            array_push($dates, $value['month']); 				
        }        
				
		echo json_encode(['sessions'=>$sessions, 'dates'=>$dates]);
						
		exit();
    }     

//Tendance des sessions entre deux semaines
if (isset($_POST["tendance_session"])) 
    {
		
		$skill = "music_quiz_official_v1.81936";
		$date_now    = '2016-04-20  00:00:00.000000';
        $date_before = '2016-04-13  00:00:00.000000';
		$interval = 7;
    
        $session_this_week = get_day_tendance_conversation($date_now, $interval, $skill);
        $session_now = $session_this_week[0]['session'];
        
        $session_last_week = get_day_tendance_conversation($date_before, $interval, $skill);
        $session_before = $session_last_week[0]['session'];
    
	    $tendance = get_tendance($session_now, $session_before);
        //$tendance = get_tendance(50, 173);
    
		echo json_encode(['tendance'=>$tendance]);
						
		exit();
    }    

//Nombre de sessions par jour/semaine, tendance
if (isset($_POST["analytics_page_2"])) 
    {
		
		$skill = "music_quiz_official_v1.81936";
		$date    = '2016-04-20  00:00:00.000000';
        $date_before = '2016-04-13  00:00:00.000000';
		$interval = 7;    
        
        //nombre total de sessions sur une semaine 
        $session_days_week = get_day_tendance_conversation($date, $interval, $skill);                                     
		$nb_session = $session_days_week[0]['session'];						
		
        //graphe nombre de sessions par jour sur une semaine
        $graphe_session_week = get_week_month_conversation($date, $interval, $skill);    
		$sessions =array(); $dates = array();		        
        foreach ($graphe_session_week as $value) {
            array_push($sessions, $value['session']); 
            array_push($dates, getWeekDay($value['month'])); 				
        }            
        //var_dump($dates);
		
        //Tendance des sessions entre deux semaines
        $session_this_week = get_day_tendance_conversation($date, $interval, $skill);
        $session_now = $session_this_week[0]['session'];
        
        $session_last_week = get_day_tendance_conversation($date_before, $interval, $skill);
        $session_before = $session_last_week[0]['session'];
    
	    $tendance = get_tendance($session_now, $session_before);
    
		echo json_encode(['nb_sessions'=>$nb_session, 'sessions'=>$sessions, 'dates'=>$dates, 'tendance'=>$tendance]);	
		exit();
    }

//graphe rapport entre le nombre de sessions et les users
if (isset($_POST["analytics_page_2_html"])) 
    {
	
		$skill = "music_quiz_official_v1.81936";
		$date = '2016-04-20  00:00:00.000000';
        $date_before = '2016-04-13  00:00:00.000000';
		$interval = 7;
		$graphe_session_week = get_week_month_conversation($date, $interval, $skill);    
		$sessions =array(); $dates = array();	
        
        foreach ($graphe_session_week as $value) {
            array_push($sessions, $value['session']); 
            array_push($dates, getWeekDay($value['month'])); 				
        }        
        
        $nb_total_sessions = get_nb_total_session($sessions);
        
    
        $session_last_week = get_day_tendance_conversation($date_before, $interval, $skill);
        $session_before = $session_last_week[0]['session'];        
        //nb_total_sessions_old =     
    
		echo json_encode(['sessions'=>$sessions, 'dates'=>$dates, 'nb_total_sessions'=>$nb_total_sessions, 'nb_total_sessions_old'=>$session_before]);
						
		exit();
    }

//calcul la somme des elements d'un tableau
function get_nb_total_session($tab){
    $nb_total = 0;
    foreach($tab as $key=>$value)
    {
        $nb_total += $value;
    }
        return $nb_total;
}

//**********************************************


?>
