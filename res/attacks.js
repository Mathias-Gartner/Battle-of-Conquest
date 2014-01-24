var current = true;
var attackIds = new Array();

document.body.onload = function() {
		setTimeout("updateSecondsLeft();", 500);
		refresh();
	}

function refresh()
{
	if (current)
		showCurrent();
	else
		showPast();
		
	setTimeout(refresh, 30000);
}

function showCurrent()
{
	current = true;
	ajaxRequest("index.php?action=attacks&list=current");
}

function showPast()
{
	current = false;
	ajaxRequest("index.php?action=attacks&list=past");
}


function resultFunction(response)
{
		var noAttacksDiv = document.getElementById("noAttacksDiv");
    var attackListDiv = document.getElementById("attackListDiv");
    attackIds = new Array();
		
		// prepare in new element for seamless updates
		var listDiv = document.createElement("div");
    
    if (response.attacks.length < 1)
    {
    	noAttacksDiv.style.display = "block";
    	attackListDiv.innerHTML = "";
    	return;
    }
    else
    	noAttacksDiv.style.display = "none";
    
    for (var i=0; i<response.attacks.length; i++)
    {
			var lineDiv = document.createElement("div");
			if (!current)
			{
				var timeSpan = document.createElement("span");
				timeSpan.innerHTML = response.attacks[i].time;
				lineDiv.appendChild(timeSpan);
			}
			var sourceSpan = document.createElement("span");
			sourceSpan.innerHTML = response.attacks[i].source.name;
			lineDiv.appendChild(sourceSpan);
			var arrowSpan = document.createElement("span");
			arrowSpan.innerHTML = "->";
			lineDiv.appendChild(arrowSpan);
			var targetSpan = document.createElement("span");
			targetSpan.innerHTML = response.attacks[i].target.name;
			lineDiv.appendChild(targetSpan);
			if (response.attacks[i].secondsLeft != undefined)
			{
				var secondsLeftSpan = document.createElement("span");
				secondsLeftSpan.id = "secondsLeft_" + response.attacks[i].id;
				secondsLeftSpan.setAttribute("secondsLeft", response.attacks[i].secondsLeft);
				secondsLeftSpan.innerHTML = formattedTime(response.attacks[i].secondsLeft);
				
				lineDiv.appendChild(secondsLeftSpan);
				attackIds.push(response.attacks[i].id);
			}
			else if (response.attacks[i].attackerWon != undefined)
			{
				var attackerWonSpan = document.createElement("span");
				if (response.attacks[i].attackerWon)
					attackerWonSpan.innerHTML = "The attacker won";
				else
					attackerWonSpan.innerHTML = "The attacker lost";
					
				lineDiv.appendChild(attackerWonSpan);
			}
			
		  
			listDiv.appendChild(lineDiv);
		}
		
		attackListDiv.innerHTML = "";
		attackListDiv.appendChild(listDiv);
}

function updateSecondsLeft(id)
{
	for (var i=0; i<attackIds.length; i++)
	{
		var secondsLeftSpan = document.getElementById("secondsLeft_" + attackIds[i]);
		if (secondsLeftSpan == null)
			continue;
	
		var secondsLeft = secondsLeftSpan.getAttribute("secondsLeft");
		if (secondsLeft > 0)
		{
			secondsLeftSpan.innerHTML = formattedTime(secondsLeft);
			secondsLeftSpan.setAttribute("secondsLeft", secondsLeft-1);
		}
		else
			secondsLeftSpan.innerHTML = "0:00:00";
	}
	setTimeout(function () { updateSecondsLeft(id); }, 1000);
}

function formattedTime(totalseconds)
{
	var hours = Math.floor(totalseconds/3600);
	var minutes = Math.floor((totalseconds/60)%60) + "";
	var seconds = totalseconds%60 + "";
	if (minutes.length == 1)
		minutes = "0" + minutes;
	if (seconds.length == 1)
		seconds = "0" + seconds;
	return hours + ":" + minutes + ":" + seconds;
}

function ajaxRequest(url)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = readyStateChangeProxy(xmlhttp, resultFunction);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send();
}

function readyStateChangeProxy(ajaxObject, resultFunction)
{
    return function()
    {
        if (ajaxObject.readyState == 4 && ajaxObject.status == 200)
        {
            var result;
            if (ajaxObject.responseText.length > 0)
                result = eval("(" + ajaxObject.responseText + ")");
            resultFunction(result);
        }
        else if (ajaxObject.readyState == 4 && ajaxObject.status != 200)
        {
            alert("HTTP error " + ajaxObject.status + ": " + ajaxObject.responseText);
        }
    }
}
