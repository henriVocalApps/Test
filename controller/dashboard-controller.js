Array.prototype.SumArray = function (arr) {
    var sum = [];
    if (arr != null && this.length == arr.length) {
        for (var i = 0; i < arr.length; i++) {
            sum.push(this[i] + arr[i]);
        }
    }

    return sum;
}



 
var setUserRepartitionPie = function(newUsers,returningUsers){

    var pie_user_repartition_Data = [
		{
			value: returningUsers,
			color:"#3B4E67",
			label: "Returning"
		},
		{
			value: newUsers,
			color: "#289A9F",
			label: "New"
		}
	];
	
	var pie_user_repartition_options = {
        segmentShowStroke: false,
        animateRotate: true,
        tooltipTemplate: "<%= value %> <%= label %> users",
        responsive : true
    }
    
    var ctx = document.getElementById("User-Repartition-Pie").getContext("2d");
		var myPie = new Chart(ctx).Pie(pie_user_repartition_Data,pie_user_repartition_options);
        document.getElementById('User-Repartition-Pie-Legend').innerHTML = myPie.generateLegend();
        
     
}


var setIntentRadar = function(intentName,intentHits){
    
    var radarChartData = {
        labels: intentName,
        datasets: [
            {
                label: "Intent Hits",
                fillColor: "#C91F4E",
                data: intentHits
            }
        ]
    };

    var options = {
        responsive: true,
        pointLabelFontFamily : "'Helvetica'",
        pointLabelFontSize : 12,
        pointLabelFontColor : "#666",        
        tooltipTemplate: "<%= label %>:  <%= value %>  hits",
        scaleBeginAtZero : true,
        pointDot : false

    }

    var ctx = document.getElementById("Intent-Hits-Radar").getContext("2d");	   
    myRadar = new Chart(ctx).Radar(radarChartData, options);
    
}


var setUserLine = function(labelsName,newUsers,returningUsers){
    
    function stackedLabel(label, NBnewUsers, NBreturningUsers) {
        this.label = label;
        this["Returning users"] = 'Returning users : ' + NBreturningUsers;
        this["New users"] = 'New users : ' + NBnewUsers;
    }
    
    stackedLabel.prototype.toString = function () {
      return this.label;
    }
    
    var stackedLabelData = new Array();
    
    for (i = 0; i < labelsName.length; i++) { 
        stackedLabelData.push( new stackedLabel(labelsName[i], newUsers[i], returningUsers[i]) );
    }
    
    var totalUsers = newUsers.SumArray(returningUsers);
    
    var lineChartData = {
        labels: stackedLabelData,
        datasets: [
        {
            label: "Returning users",
            fillColor: "#3B4E67",
            pointColor: "#3B4E67",
            data: totalUsers
        },{
            label: "New users",
            fillColor: "#289A9F",
            pointColor: "#289A9F",
            data: newUsers
        }]
    };
    
    var options = {
        responsive : true,
        scaleBeginAtZero: true,
        pointDot: false,
        pointHitDetectionRadius: (250/labelsName.length),
        multiTooltipTemplate: function (self) {
            return self.label[self.datasetLabel];
        }
    };
    var ctx = document.getElementById("Users-Line-Chart").getContext("2d");	        
    myLine = new Chart(ctx).Line(lineChartData,options);
}


var setSessionLine = function(labelsName,coversations){
    
    var lineChartData = {
        labels: labelsName,
        datasets: [
        {
            label: "Sessions",
            fillColor: "#FFA841",
            pointColor: "#FFA841",
            data: coversations
        }]
    };
    
    var options = {
        responsive : true,
        scaleBeginAtZero: true,
        tooltipTemplate: "<%= label %>:  <%= value %>  sessions",
        pointHitDetectionRadius: (250/coversations.length),
        pointDot: false
    };
    
    var ctx = document.getElementById("Sessions-Line-Chart").getContext("2d");	        
    myLine = new Chart(ctx).Line(lineChartData,options);
    
}

var setSessionPerUserLine = function(labelsName,sessionPerUser){
    
    var lineChartData = {
        labels: labelsName,
        datasets: [
        {
            label: "Sessions",
            fillColor: "#FFA841",
            pointColor: "#FFA841",
            data: sessionPerUser
        }]
    };
    
    var options = {
        responsive : true,
        scaleBeginAtZero: true,
        tooltipTemplate: "<%= label %>:  about <%= value %>  Sessions per User",        
        pointHitDetectionRadius: (250/sessionPerUser.length),
        pointDot: false
    };
    
    
    var ctx = document.getElementById("Session-Per-User-Line").getContext("2d");          
    myLine = new Chart(ctx).Line(lineChartData,options);
    
}

var setItentDistributionPerSessionBar = function(intentNumber,sessionNumber){
    
    var barChartData = {
        labels: intentNumber,
        datasets: [
        {
            label: "nb sessions",
            fillColor: "#C91F4E",
            data: sessionNumber
        }]
    };
    
    var options = {
        responsive : true,
        scaleBeginAtZero: true,
        tooltipTemplate: "There is <%= value %> Sessions with <%= label %> Intents",
        pointDot: false
    };
    
    
    var ctx = document.getElementById("Itent-Distribution-Per-Session-Bar").getContext("2d");          
    myLine = new Chart(ctx).Bar(barChartData,options);
}

var setItentDistributionPerUserBar = function(intentNumber,sessionNumber){
    
    var barChartData = {
        labels: intentNumber,
        datasets: [
        {
            label: "nb users",
            fillColor: "#C91F4E",
            data: sessionNumber
        }]
    };
    
    var options = {
        responsive : true,
        scaleBeginAtZero: true,
        tooltipTemplate: "There is <%= value %> Users that use <%= label %> Intents",
        pointDot: false
    };
    
    
    var ctx = document.getElementById("Itent-Distribution-Per-User-Bar").getContext("2d");          
    myLine = new Chart(ctx).Bar(barChartData,options);
}

var setTable = function(tableName,tableHead,tableBody){
        	     
	var tableData = '<table class="table table-striped"><thead><tr>';
	 
	for (i = 0; i < tableHead.length; i++) { 
        if(i>0){
             tableData+= '<th style="text-align: center;">'+tableHead[i]+'</th>';
        }else{
                 tableData+= '<th>'+tableHead[i]+'</th>';
        }       
    }
    
    tableData+= '</tr></thead><tbody>';
    
    for (i = 0; i < tableBody.length; i++) { 
        tableData+='<tr>';

        for (j = 0; j < tableBody[i].length; j++) {
            if(j>0){
                tableData+= '<td style="text-align: center;">'+tableBody[i][j]+'</td>';
            }else{
                tableData+= '<td>'+tableBody[i][j]+'</td>';
            }            
        }
         tableData+='</tr>';
    }
    
    tableData+='</tbody></table>';
    
	var TextElement = document.getElementById(tableName);
    TextElement.innerHTML = tableData;
    
    
}
        
var setDataNumber = function(name,data){

    var dataNumber = parseInt(data)

    var up = true;
    var value = 0;
    var increment = dataNumber/100;
    var ceiling = dataNumber;
    
    function animationCount(){
        if (up == true && value <= ceiling){
            
            value += increment
            
            if (value == ceiling){
                up = false;
            }
             
            var TextElements = document.getElementsByName(name);
            
            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].innerHTML = value.toFixed(0).replace(/./g, function(c, i, a) {
                return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
                });
            }
        
        }else{
            
            var TextElements = document.getElementsByName(name);
        
            for (var i = 0, max = TextElements.length; i < max; i++) {
                    TextElements[i].innerHTML = ceiling.toFixed(0).replace(/./g, function(c, i, a) {
                    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
                });;
            }
        }
    }
    
    setInterval(animationCount, 10);
    
}


var setDataSign = function(name,dataSign){

    var TextElements = document.getElementsByName(name);

    for (var i = 0, max = TextElements.length; i < max; i++) {
        TextElements[i].innerHTML = dataSign;
    }
     
    
}
   
var setTriangelDirection = function(name,triangleDirection){
    
    if(triangleDirection == "up"){
        var triangle = '<span class="glyphicon glyphicon-triangle-top" >';
    }else if(triangleDirection=="down"){
        var triangle = '<span class="glyphicon glyphicon-triangle-bottom" >';
    }else{
        var triangle = '<span class="glyphicon glyphicon-triangle-right" >';
    }
    
    var TextElements = document.getElementsByName(name);

    for (var i = 0, max = TextElements.length; i < max; i++) {
        TextElements[i].innerHTML = triangle;
    }
     
}
        



	    