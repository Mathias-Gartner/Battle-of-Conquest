const returnTimeLabel = "<div class=\"tiny\">until troop returns</div>";
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
  if (!current)   // only show loading when changing displays
    showLoading();

	current = true;
	ajaxRequest("index.php?action=attacks&list=current");
}

function showPast()
{
  if (current)   // only show loading when changing displays
    showLoading();

	current = false;
	ajaxRequest("index.php?action=attacks&list=past");
}

function showLoading()
{
  var loadingDiv = document.getElementById("loadingDiv");
	var noAttacksDiv = document.getElementById("noAttacksDiv");
  var attackListDiv = document.getElementById("attackListDiv");
  noAttacksDiv.style.display = "none";
  attackListDiv.innerHTML = "";
  loadingDiv.style.display = "block";
}

function showReport(event)
{
	var id = event.target.id.replace("reportButton_", "");
	if (isNaN(id) || id < 0)
		return false;

	window.location.href = "index.php?action=battlereport&attackId=" + id;
}

function cancelAttack(event)
{
  var id = event.target.id.replace("cancelButton_", "");
  if (isNaN(id) || id < 0)
    return false;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "index.php?action=attacks&cancelId="+id, true);
  xmlhttp.send();

  setTimeout(function(){ refresh() }, 1000);
  return false;
}

function showMouseOverPopup(event)
{
  var id = event.target.id.replace("cancelButton_", "");
  if (isNaN(id) || id < 0)
    return false;

  var popup = document.getElementById("returnTimeDiv_"+id);
  if (popup != null)
    popup.style.display = "block";

  return false;
}

function hideMouseOverPopup(event)
{
  event.target.style.display = "none";
}

function resultFunction(response)
{
  var displayedAttacks = 0;
  var loadingDiv = document.getElementById("loadingDiv");
	var noAttacksDiv = document.getElementById("noAttacksDiv");
  var attackListDiv = document.getElementById("attackListDiv");
  attackIds = new Array();

	// prepare in new element for seamless updates
	var listDiv = document.createElement("div");

  for (var i=0; i<response.attacks.length; i++)
  {
		var lineDiv = document.createElement("div");
		if (current)
		{
			if (response.attacks[i].completed)
				continue;

			var stateSpan = document.createElement("span");
			stateSpan.className = "stateLabel";
			stateSpan.innerHTML = response.attacks[i].returning ? "Returning" : "Engaging";
			lineDiv.appendChild(stateSpan);
		}
		else
		{
			if (!response.attacks[i].completed)
				continue;

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
			secondsLeftSpan.className = "secondsLeftLabel";
			secondsLeftSpan.setAttribute("secondsLeft", response.attacks[i].secondsLeft);
			secondsLeftSpan.innerHTML = formattedTime(response.attacks[i].secondsLeft);

			attackIds.push(response.attacks[i].id);

			if (response.attacks[i].returning)
			{
				lineDiv.appendChild(secondsLeftSpan);
			}
			else
			{
				var cancelButton = document.createElement("a");
				cancelButton.className = "cancelButton bigbutton";
				cancelButton.id = "cancelButton_" + response.attacks[i].id;
				cancelButton.innerHTML = "Cancel";
				cancelButton.href = "#";
				cancelButton.onclick = cancelAttack;
				cancelButton.onmouseover = showMouseOverPopup;
				lineDiv.appendChild(cancelButton);
				lineDiv.appendChild(secondsLeftSpan);

				var returnTimePopup = document.createElement("div");
				returnTimePopup.id = "returnTimeDiv_" + response.attacks[i].id;
				returnTimePopup.className = "mouseOverPopup";
				returnTimePopup.onmouseout = hideMouseOverPopup;
				returnTimePopup.innerHTML = "<span>" + formattedTime((new Date() - response.attacks[i].startTime)/1000);
				returnTimePopup.innerHTML += "</span>" + returnTimeLabel;
				returnTimePopup.style.display = "none";
				returnTimePopup.startTime = response.attacks[i].startTime;
				lineDiv.appendChild(returnTimePopup);
			}
		}
		else if (response.attacks[i].attackerWon != undefined)
		{
			var attackerWonSpan = document.createElement("span");
			if (response.attacks[i].attackerWon)
				attackerWonSpan.innerHTML = "The attacker won";
			else
				attackerWonSpan.innerHTML = "The attacker lost";

			lineDiv.appendChild(attackerWonSpan);

			var cancelButton = document.createElement("a");
			cancelButton.className = "cancelButton bigbutton";
			cancelButton.id = "reportButton_" + response.attacks[i].id;
			cancelButton.innerHTML = "Report";
			cancelButton.href = "#";
			cancelButton.onclick = showReport;
			lineDiv.appendChild(cancelButton);
		}

	  displayedAttacks++;
		listDiv.appendChild(lineDiv);
	}

  if (displayedAttacks < 1)
  {
  	noAttacksDiv.style.display = "block";
  	attackListDiv.innerHTML = "";
  	loadingDiv.style.display = "none";
  	return;
  }
  else
  	noAttacksDiv.style.display = "none";

	loadingDiv.style.display = "none";
	attackListDiv.innerHTML = "";
	attackListDiv.appendChild(listDiv);
}

function updateSecondsLeft(id)
{
	for (var i=0; i<attackIds.length; i++)
	{
		var secondsLeftSpan = document.getElementById("secondsLeft_" + attackIds[i]);
		if (secondsLeftSpan != null)
		{
			var secondsLeft = secondsLeftSpan.getAttribute("secondsLeft");
			if (secondsLeft > 0)
			{
				secondsLeftSpan.innerHTML = formattedTime(secondsLeft);
				secondsLeftSpan.setAttribute("secondsLeft", secondsLeft-1);
			}
			else
			{
				secondsLeftSpan.innerHTML = "0:00:00";
				refresh();
			}
		}

		var returnTimePopup = document.getElementById("returnTimeDiv_" + attackIds[i]);
		if (returnTimePopup)
		{
			returnTimePopup.innerHTML = "<span>" + formattedTime((new Date() - returnTimePopup.startTime)/1000);
			returnTimePopup.innerHTML += "</span>" + returnTimeLabel;
		}
	}

	setTimeout(function () { updateSecondsLeft(id); }, 1000);
}

function ajaxRequest(url)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = readyStateChangeProxy(xmlhttp, resultFunction);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send();
}
