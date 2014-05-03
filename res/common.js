function formattedTime(totalseconds)
{
	var hours = Math.floor(totalseconds/3600);
	var minutes = Math.floor((totalseconds/60)%60) + "";
	var seconds = Math.floor(totalseconds%60) + "";
	if (minutes.length == 1)
		minutes = "0" + minutes;
	if (seconds.length == 1)
		seconds = "0" + seconds;
	return hours + ":" + minutes + ":" + seconds;
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
