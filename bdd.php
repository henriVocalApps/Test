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



function get_all_users($type)
{
	
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT distinct(login),id,date FROM `login` WHERE `type` LIKE ? group by login";

        $req = $bdd->prepare($sql);
        $req->execute(array($type));
	$tab = array();

    while($data =  $req->fetch())
	{
		$tab[]=$data;
	}
	$req->closeCursor();
	return $tab;

}

function get_logs_skill($skill,$user=null)
{
	
	$bdd = bdd_connect_pdo('robots');
	if($user == null) {
        $sql = "SELECT * FROM new_logs WHERE `skill_name`= '".$skill."' AND lambdaResponse!='' AND lambdaRequest != '' ORDER BY date DESC LIMIT 50";
	}else{
		$sql = "SELECT * FROM new_logs WHERE `skill_name`= '".$skill."'  AND lambdaResponse!='' AND lambdaRequest != '' AND `user_id`= '".$user."'  ORDER BY date DESC LIMIT 50";
	}

        $req = $bdd->prepare($sql);
        $req->execute(array($type));
	$tab = array();

    while($data =  $req->fetch())
	{
		$intent = get_one_public_intent(str_replace("\"","",$data['input']));
		$intentArray = explode("|",$intent->sample_sentences);
		$data['sentences'] = $intentArray[rand(0, count($intentArray)-1)];
		$tab[]=$data;
	}
	$req->closeCursor();
	return $tab;

}

function get_logs_session_id($skill,$session_id)
{
	
	$bdd = bdd_connect_pdo('robots');
	
		$sql = "SELECT * FROM new_logs WHERE `skill_name`= '".$skill."' AND lambdaResponse!='' AND lambdaRequest != '' AND `session_id`= '".$session_id."'  ORDER BY date DESC LIMIT 50";
	
        $req = $bdd->prepare($sql);
        $req->execute(array());
	$tab = array();

    while($data =  $req->fetch())
	{
	        $intent = get_one_public_intent(str_replace("\"","",$data['input']));
		$intentArray = explode("|",$intent->sample_sentences);
		$data['sentences'] = $intentArray[rand(0, count($intentArray)-1)];
		$tab[]=$data;
	}
	$req->closeCursor();
	return $tab;

}

function get_one_public_intent($name)
{

	$bdd = bdd_connect_pdo('robots');
	// request creation
	$sql = "SELECT * FROM intents WHERE name = ? LIMIT 1";
	
	$req = $bdd->prepare($sql);
	$req->execute(array($name));	
	
	$result =  $req->fetchObject();
	$req->closeCursor();
	return $result;
	
}

function get_logs_user($user_id)
{
	$bdd = bdd_connect_pdo('robots');
        $sql = "SELECT * FROM new_logs WHERE `id`=? AND lambdaResponse!='' AND lambdaRequest != ''";
	
        $req = $bdd->prepare($sql);
        $req->execute(array($user_id));
	

    if($data =  $req->fetch())
	{
		return $data;
	}
	$req->closeCursor();
	return null;

}

function get_users_skill($skill)
{
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT user_id, id, session_id, skill_name FROM new_logs WHERE `skill_name`= '".$skill."' AND lambdaResponse!='' AND lambdaRequest != '' ORDER BY date DESC LIMIT 50";

        $req = $bdd->prepare($sql);
        $req->execute(array($type));
	$tab = array();

    while($data =  $req->fetch())
	{
		$tab[]=$data;
	}
	$req->closeCursor();
	return $tab;

}

function get_all_user_alexa($skill)
{
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT DISTINCT(user_id) FROM new_logs WHERE `skill_name`= ? AND lambdaResponse!='' AND lambdaRequest != '' ORDER BY date DESC";

        $req = $bdd->prepare($sql);
        $req->execute(array($skill));
	$tab = array();
    $i=0;
    while($data =  $req->fetch())
	{
        $sql1 = "SELECT * FROM new_logs WHERE `user_id`= '".$data['user_id']."' AND lambdaResponse!='' AND lambdaRequest != '' AND `skill_name`= '".$skill."' ORDER BY date DESC LIMIT 50";
        $req1 = $bdd->prepare($sql1);
        $req1->execute();
        while($data1 =  $req1->fetch())
        {
            $tab[$data['user_id']][]=$data1;
        }
        $req1->closeCursor();
        if ($i==14)
                break;
        $i++;
	}
	$req->closeCursor();
	return $tab;

}

function get_data_from_skills($skill_code_name)
{	
	$bdd = bdd_connect('robots');
	

	$sql1 = "SELECT * FROM skills WHERE skill_code_name = '$skill_code_name'" ;	
	$req = mysqli_query($bdd, $sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysqli_error($bdd));
	$data = mysqli_fetch_assoc($req) ;
	mysqli_free_result($req);
	// close the connection
	bdd_close($bdd);

	return 	$data;
}





//********************* STATISTIQUE ************************

//Best intents
function get_best_intent_alexa($skill,$date, $interval)
{
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT input as intent, COUNT(input) AS nbr FROM `new_logs` WHERE `skill_name`=? AND date between (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ? GROUP BY input ORDER BY nbr DESC";

        $req = $bdd->prepare($sql);
        $req->execute(array($skill,$date,$interval,$date));
	    $tab = array();
    while($data =  $req->fetch())
	{
        $tab[]=$data;
	}
	$req->closeCursor();
	return $tab;

}

//COUNT intents
function get_count_intent_alexa($skill,$date, $interval)
{
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT COUNT(input) AS nbr FROM `new_logs` WHERE `skill_name`=? AND date between (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ?";

        $req = $bdd->prepare($sql);
        $req->execute(array($skill,$date,$interval,$date));
	$data =  $req->fetch();
	$req->closeCursor();	
	return $data["nbr"];

}

function get_day_interval($date, $interval)
{
	$bdd = bdd_connect_pdo('robots');
	$sql = "SELECT DATE_SUB(?, INTERVAL ? DAY) as y";

        $req = $bdd->prepare($sql);
        $req->execute(array($date,$interval));
	$data =  $req->fetch();
	$req->closeCursor();	
	return $data["y"];

}

// New users per month
function get_new_user_alexa_day($skill, $date, $interval)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id` FROM `new_logs` WHERE `skill_name`= ? AND date < (SELECT DATE_SUB(?, INTERVAL ? DAY))";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date, $interval));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
        $tab[]=$data;
        $tab_id[]=$data['user_id'];
	}    
    $req->closeCursor();
    
    $sql1 = "SELECT DISTINCT `user_id`, DATE(date) as d FROM `new_logs` WHERE `skill_name`= ? AND date >= (SELECT DATE_SUB(?, INTERVAL ? DAY)) ORDER BY d ASC";
    $req1 = $bdd->prepare($sql1);
    $req1->execute(array($skill, $date,$interval));
	$tab1 = array();
    
    while($data1 =  $req1->fetch()){
        $id = $data1['user_id'];
        if (!(in_array($id, $tab_id))){
                $tab1[]=$data1;
                //$tab_id[]=$data1['user_id'];
                array_push($tab_id, $data1['user_id']);
        }
	}
	$req1->closeCursor();
	return $tab1;

}

// New users per day
function get_new_user_alexa_hour($skill, $date)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id` FROM `new_logs` WHERE `skill_name`= ? AND date < ? ";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
        $tab[]=$data;
        $tab_id[]=$data['user_id'];
	}    
    $req->closeCursor();
    
    $sql1 = "SELECT DISTINCT `user_id`, hour(date) as h FROM `new_logs` WHERE `skill_name`= ? AND date LIKE ? ORDER BY h ASC";
    $req1 = $bdd->prepare($sql1);
    $req1->execute(array($skill, $date.'%'));
	$tab1 = array();
    
    while($data1 =  $req1->fetch()){
        $id = $data1['user_id'];
        if (!(in_array($id, $tab_id))){
                $tab1[]=$data1;
                $tab_id[]=$data1['user_id'];
        }
	}
	$req1->closeCursor();
	return $tab1;

}

// Retunrning users per month or week
function get_retunrning_users_alexa_day($skill, $date, $interval)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id` FROM `new_logs` WHERE `skill_name`= ? AND date < (SELECT DATE_SUB(?, INTERVAL ? DAY))";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date, $interval));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
        $tab[]=$data;
        $tab_id[]=$data['user_id'];
	}    
    $req->closeCursor();
    
    $sql1 = "SELECT DISTINCT `user_id`, DATE(date) as d FROM `new_logs` WHERE `skill_name`= ? AND date >= (SELECT DATE_SUB(?, INTERVAL ? DAY)) order BY d ASC";
    $req1 = $bdd->prepare($sql1);
    $req1->execute(array($skill, $date,$interval));
	$tab1 = array(); $tab_id1 = array();
    
    while($data1 =  $req1->fetch()){
        $id = $data1['user_id'];
        if (in_array($id, $tab_id)){
            if (!(in_array($id, $tab_id1))){
                $tab1[]=$data1;
                $tab_id1[]=$data1['user_id'];
            }
        }
	}
	$req1->closeCursor();
	return $tab1;

}

// Retunrning users per day
function get_retunrning_users_alexa_hour($skill, $date)
{

    $bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id` FROM `new_logs` WHERE `skill_name`= ? AND date < ?";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
        $tab[]=$data;
        $tab_id[]=$data['user_id'];
	}    
    $req->closeCursor();
    
    $sql1 = "SELECT DISTINCT `user_id`, hour(date) as h FROM `new_logs` WHERE `skill_name`= ? AND date LIKE ? ORDER BY h ASC";
    $req1 = $bdd->prepare($sql1);
    $req1->execute(array($skill, $date.'%'));
	$tab1 = array();
    
    while($data1 =  $req1->fetch()){
        $id = $data1['user_id'];
        if (in_array($id, $tab_id)){
            $tab1[]=$data1;
        }
	}
    
	$req1->closeCursor();
	return $tab1;

}

// users actif per month
function get_actif_user_alexa_day($skill, $date, $interval)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id`, DATE(date) as d FROM `new_logs` WHERE skill_name = ? AND date BETWEEN (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ? ORDER BY d ASC";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date, $interval, $date));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
       $id = $data['user_id'];
        if (!in_array($id, $tab_id)){
            $tab[]=$data;
            $tab_id[]=$data['user_id'];
        }
	}    
    
    $req->closeCursor();
	return $tab;
}

// users actif per day
function get_actif_user_alexa_hour($skill, $date, $interval)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT DISTINCT `user_id`, hour(date) as h FROM `new_logs` WHERE skill_name = ? AND date LIKE ? ORDER BY h ASC";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date.'%'));
	$tab = array(); $tab_id = array();

    while($data =  $req->fetch()){
       $id = $data['user_id'];
        if (!in_array($id, $tab_id)){
            $tab[]=$data;
            $tab_id[]=$data['user_id'];
        }
	}    
    
    $req->closeCursor();
	return $tab;
}

// all users distinct per month
function get_all_user_alexa_month($skill, $date, $interval)
{

	$bdd = bdd_connect_pdo('robots');
    $sql = "SELECT COUNT(DISTINCT `user_id`) as y FROM `new_logs` WHERE skill_name = ? AND date BETWEEN (SELECT DATE_SUB(?, INTERVAL ? DAY)) AND ?";
    $req = $bdd->prepare($sql);
    $req->execute(array($skill, $date, $interval, $date));
	$data =  $req->fetch();
	$req->closeCursor();	
	return $data["y"];
}

/*function insert_instant_gagnant($date,$heure)
{


	$bdd = bdd_connect_pdo('robots');
	$sql = "INSERT INTO facebook_bot (id,client_id,game_date,game_hour,is_win,win_date,keyword) VALUES ('',?,?,?,?,?,?)";
	$req = $bdd->prepare($sql);
	$seccess = $req->execute(array('',$date,$heure,0,'',''));
		
	return "";

}
*/

//******************* END STAT *****************************




if (isset($_POST["select_skills_id"])) 
	    {
			$data = get_logs_session_id($_POST["select_skills_id"],$_POST["session_id"]);
		
	    $logs='';	
        $first = true; $first_date = true; $req =array(); $res = array(); $id = array(); $date = array(); $slot = array(); $sentences = array(); 
		foreach ($data as $value) {
		     	if($value["input"] == "NEW_DIALOG_SESSION"){
		            $invocation_name = get_data_from_skills($value['skill_name'])['skill_invocation_name'];
		             $value["input"] = "Launch ".$invocation_name;
		        }else {
		            $value["input"] = 'Intent name : '.$value["input"];
		        }
		        if($value["slots"] == "[]"){
		            $value['slots'] = '';
		            $invocation_name = get_data_from_skills($value['skill_name'])['skill_invocation_name'];
		            if(ereg("AMAZON.",$value["input"])){
		               $int = str_replace('"','',str_replace("Intent name : ","",str_replace("AMAZON.","",$value["input"])));
		                $intent = get_one_public_intent($int);
		                $intentArray = explode("|",$intent->sample_sentences);
		                $value['sentences'] = $intentArray[0];
		            }else if($value["input"] == "Launch ".$invocation_name){
		                $value['sentences'] = "Launch ".$invocation_name;
		            }
            }else{
                    $json = json_decode($value["slots"]);
                    foreach($json as $key => $val)
                    {
                        preg_match_all("/({.*?})/", $value["sentences"], $output_array);
                        $value["sentences"] = str_replace($output_array[0][0],'<b value="'.$value['id'].'">'.$val.'</b>',$value["sentences"]);
                    }
                    $value['slots'] = 'Slot : '.$value['slots'].'<br>';
            }

            array_push($req, $value['input']);
            array_push($res, $value['output']);
            array_push($id, $value['id']);
            array_push($date, $value['date']);
            array_push($slot, $value['slots']);
            array_push($sentences, $value['sentences']);
            
		}
                for ($x = (count($req)-1); $x >= 0; $x--){
                    $logs .='<span id="hover_slot"><div class="answer left">
                                <div class="avatar">
                                  <img src="../../../manager/assets/img/profil.png" alt="You">
                                </div>
                                <div class="text" id="lambda_Request" value="'.$id[$x].'" onClick="getLambda_request('.$id[$x].')" style="cursor:pointer">'.$sentences[$x].'</div>
                                <div class="time" style="font-size:x-small;"><br></div>
                              </div><span id="aaz" class="aaz">'.$req[$x].'<br>'.$slot[$x].''.$date[$x].'</span></span>
                              <div class="answer right">
                                <div class="avatar">
                                  <img src="../../../manager/assets/img/alexaEcho.jpg" alt="Alexa">
                                </div>
                                <div class="text" id="lambda_Response" value="'.$id[$x].'" style="cursor:pointer" onClick="getLambda_response('.$id[$x].')">'.htmlspecialchars(strip_tags(str_replace('’','\'',$res[$x]))).'</div>
                                <div class="time"><br></div>
                              </div>';
                 }
        
		echo json_encode(['logs'=>$logs]);

		exit();
	    }


//**********************************************

if (isset($_POST["best_intent"])) 
    {
		
		$name_skill = "music_quiz_official_v1.81936";
		$date = '2016-04-20  00:00:00.000000';
		$interval = 7;
        $date2 = get_day_interval($date, $interval);
    
		$best_intent = get_best_intent_alexa($name_skill,$date, $interval);
		$count = get_count_intent_alexa($name_skill,$date, $interval);
		$intent =array();
		$nbr = array();
		$activations = array();
		
		$best_intent1 = get_best_intent_alexa($name_skill,$date2, $interval);
		$count1 = get_count_intent_alexa($name_skill,$date2, $interval);
		$intent1 =array();
		$nbr1 = array();

			foreach ($best_intent1 as $value) {
				array_push($intent1, $value['intent']);
				array_push($nbr1, $value['nbr']);
			}

			foreach ($best_intent as $value) {
				$activation = "No data";
				if(in_array($value['intent'],$intent1)){
					foreach ($best_intent1 as $v) {
						if($value['intent']==$v['intent']){
						    if($value['nbr']<$v['nbr']){
							    //$activation = "-".number_format(100-(($value['nbr']*100)/$v['nbr']));
                                $activation = number_format(100*(($value['nbr']-$v['nbr'])/$v['nbr']));
						    }else if($value['nbr']==$v['nbr']){
								$activation = "+0";
							}else {
								//$activation = "+".number_format(+(100-(($v['nbr']*100)/$value['nbr'])));
                                 $activation = "+".number_format(100*(($value['nbr']-$v['nbr'])/$v['nbr']));
						    	}
						}	
					}
				}
				array_push($activations, $activation);
				array_push($intent, $value['intent']);
				array_push($nbr, $value['nbr']);
			}
    
    //**** DAY OF WEEK *****//
        $days = ["2016-04-14", "2016-04-15", "2016-04-16", "2016-04-17", "2016-04-18", "2016-04-19", "2016-04-20"];
        $days_week = array();
        foreach($days as $d){
            array_push($days_week,getWeekDay($d));
        }
    // **** RETURNING USERS ****//
		$returnging_users = get_retunrning_users_alexa_day($name_skill, $date, $interval);

        $compteur=0; $dates_returning_users = array(); $nb_returning_users = array(); $nb_returning_user = array();
        array_push($dates_returning_users, '-');
        foreach ($returnging_users as $value) {
            if(!(in_array($value['d'],$dates_returning_users))){
                array_push($dates_returning_users, $value['d']);
                $compteur++;
                array_push($nb_returning_users, $compteur);
                $compteur=0;
            }else{
                $compteur++;
            } 
        }
        array_push($nb_returning_users, $compteur+1);
        foreach($days as $day){
            if(!(in_array($day,$dates_returning_users))){
                array_push($nb_returning_user,0);
            }else{
                $key = array_search($day, $dates_returning_users); 
                array_push($nb_returning_user,$nb_returning_users[$key]);
            } 
        }
        $returning_users = array_sum($nb_returning_user);
    
    
    // **** NEW USERS ****//
        $new_users = get_new_user_alexa_day($name_skill, $date, $interval);    
    
        $compteur=0; $dates_new_users = array(); $nb_new_users = array(); $nb_new_user = array();
        array_push($dates_new_users, '-');
        foreach ($new_users as $value) {
            if(!(in_array($value['d'],$dates_new_users))){
                array_push($dates_new_users, $value['d']);
                $compteur++;
                array_push($nb_new_users, $compteur);
                $compteur=0;
            }else{
                $compteur++;
            } 
        }
        array_push($nb_new_users, $compteur+1);
        foreach($days as $day){
            if(!(in_array($day,$dates_new_users))){
                array_push($nb_new_user,0);
            }else{
                $key = array_search($day, $dates_new_users); 
                array_push($nb_new_user,$nb_new_users[$key]);
            } 
        }
        $new_users = array_sum($nb_new_user);

    
    // ***************************  LAST WEEK **************************************//
    
    // ***** All users last week ****//
        $old_user = get_all_user_alexa_month($name_skill, $date2, $interval);  
    
    // **** RETURNING USERS ****//
		$returnging_users_last = get_retunrning_users_alexa_day($name_skill, $date2, $interval);
        $compteur=0; $dates_returning_users_last = array(); $nb_returning_users_last = array();
        array_push($dates_returning_users_last, '-');
        foreach ($returnging_users_last as $value) {
            if(!(in_array($value['d'],$dates_returning_users_last))){
                array_push($dates_returning_users_last, $value['d']);
                $compteur++;
                array_push($nb_returning_users_last, $compteur);
                $compteur=0;
            }else{
                $compteur++;
            } 
        }
        array_push($nb_returning_users_last, $compteur+1);
        $returning_users_last = array_sum($nb_returning_users_last);
        $returning_users_last = $returning_users_last-1;
        
        //var_dump($returnging_users_last);
    

//$fichier="follow"; 
$fichier="instant_gagnant"; 
$tabfich=file($fichier); 
    $array_g = array();
for( $i = 0 ; $i < count($tabfich) ; $i++ )
{
    $jour = substr($tabfich[$i],0,2);
    $ddate = substr($tabfich[$i],11,2).".".substr($tabfich[$i],14,2);
    array_push($array_g, " 2016-04-".$jour." ".$ddate);
    //echo $tabfich[$i];
}
    sort($array_g);
    //var_dump($array_g);
    foreach ($array_g as $value) {
        $datte = substr($value,0,11);
        $heure = substr($value,12,5);
        
    }

    


		echo json_encode(['intents'=>$intent, 'nbrs'=>$nbr, 'count'=>$count,'intents1'=>$intent1, 'nbrs1'=>$nbr1, 'count1'=>$count1, 'activations'=>$activations, 'dates_users'=>$days_week, 'nb_returning_users'=>$nb_returning_user, 'returning_users'=>$returning_users,'nb_new_users'=>$nb_new_user,'new_users'=>$new_users, 'old_user'=>$old_user, 'returning_users_last'=>$returning_users_last]);
			
			
		exit();
    }


 function getWeekDay($date){
    
        $dayOfWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        $dayNumber = date('w', strtotime($date));
        
        return  $dayOfWeek[$dayNumber];
    }
    
        



if (isset($_POST["lambdaRequest_id"])) 
    {
	    $lambdaReq = get_logs_user($_POST["lambdaRequest_id"]);
            echo json_encode(['lambdaReq'=>str_replace(":"," : ",$lambdaReq['lambdaRequest'])]);
		exit();
    }

if (isset($_POST["lambdaResponse_id"])) 
    {
			$lambdaRes = get_logs_user($_POST["lambdaResponse_id"]);
		    echo json_encode(['lambdaRes'=>$lambdaRes['lambdaResponse']]);
		exit();
    }



if (isset($_POST["select_skills"])) 
	    {    
  
		if (isset($_POST["user_skill"])){
			$data = get_logs_skill($_POST["select_skills"],$_POST["user_skill"]);
		}else{
            $donnees = get_logs_skill($_POST["select_skills"]);
            $First_user = $donnees[0]['user_id'];
			$data = get_logs_skill($_POST["select_skills"], $First_user);
		}
    
        $logs='';	$users='';
        $first = true; $first_date = true; $req =array(); $res = array(); $id = array(); $date = array(); $slot = array(); $sentences = array(); 
		foreach ($data as $value) {
            		if($value["input"] == "NEW_DIALOG_SESSION"){
		            $invocation_name = get_data_from_skills($value['skill_name'])['skill_invocation_name'];
		             $value["input"] = "Launch ".$invocation_name;
		        }else {
		            $value["input"] = 'Intent name : '.$value["input"];
		        }
		        if($value["slots"] == "[]"){
		            $value['slots'] = '';
		            $invocation_name = get_data_from_skills($value['skill_name'])['skill_invocation_name'];
		            if(ereg("AMAZON.",$value["input"])){
		               $int = str_replace('"','',str_replace("Intent name : ","",str_replace("AMAZON.","",$value["input"])));
		                $intent = get_one_public_intent($int);
		                $intentArray = explode("|",$intent->sample_sentences);
		                $value['sentences'] = $intentArray[0];
		            }else if($value["input"] == "Launch ".$invocation_name){
		                $value['sentences'] = "Launch ".$invocation_name;
		       }
            }else{
                    $json = json_decode($value["slots"]);
                    foreach($json as $key => $val)
                    {
                        preg_match_all("/({.*?})/", $value["sentences"], $output_array);
                        $value["sentences"] = str_replace($output_array[0][0],'<b value="'.$value['id'].'">'.$val.'</b>',$value["sentences"]);
                    }
                    $value['slots'] = 'Slot : '.$value['slots'].'<br>';
            }

            array_push($req, $value['input']);
            array_push($res, $value['output']);
            array_push($id, $value['id']);
            array_push($date, $value['date']);
            array_push($slot, $value['slots']);
            array_push($sentences, $value['sentences']);
            
		}
                for ($x = (count($req)-1); $x >= 0; $x--){
                    $logs .='<span id="hover_slot"><div class="answer left">
                                <div class="avatar">
                                  <img src="../../../manager/assets/img/profil.png" alt="You">
                                </div>
                                <div class="text" id="lambda_Request" value="'.$id[$x].'" onClick="getLambda_request('.$id[$x].')" style="cursor:pointer">'.$sentences[$x].'</div>
                                <div class="time" style="font-size:x-small;"><br></div>
                              </div><span id="aaz" class="aaz">'.$req[$x].'<br>'.$slot[$x].''.$date[$x].'</span></span>
                              <div class="answer right">
                                <div class="avatar">
                                  <img src="../../../manager/assets/img/alexaEcho.jpg" alt="Alexa">
                                </div>
                                <div class="text" id="lambda_Response" value="'.$id[$x].'" style="cursor:pointer" onClick="getLambda_response('.$id[$x].')">'.htmlspecialchars(strip_tags(str_replace('’','\'',$res[$x]))).'</div>
                                <div class="time"><br></div>
                              </div>';
                 }

    // ****** USER AND SESSIONS *******
        $all_user = get_all_user_alexa($_POST["select_skills"]);
         
         $m=0;
        $array_session = array();
        $array_name = array();
        foreach($all_user as $key => $value){

      
            //LIST OF USERS AND SESSIONS
            $m++;
            $tab_users .='<a href="#'.$m.'" class="list-group-item" data-toggle="collapse">
                            <i class="glyphicon fa fa-plus"></i> User '.$m.'</a>
                          <div class="list-group collapse" id="'.$m.'">';
                            $array_session = array();
                            $array_name = array();
                            //$first = true;
                            
                            foreach($value as $v){
                                if (!in_array($v['session_id'], $array_session)){
                                    array_push($array_session, $v['session_id']);
                                    array_push($array_name, $v['date']);
                                }

                            
                            }
                             $j=count($array_session);
                            for($x = 0; $x <=(count($array_session)-1); $x++){
                               
                                 $tab_users .='<a class="list-group-item" style="cursor:pointer"   onClick="getSession_id(\''.$array_session[$x].'\',\''.$_POST["select_skills"].'\')">'.str_replace("-","/",substr($array_name[$x],2,-3)).'</a>';
                                 $j--;
                             }
            $tab_users .='</div>';
            
		}
    
        
		echo json_encode(['logs'=>$logs, 'users'=>$tab_users]);

		exit();
	    }

?>
