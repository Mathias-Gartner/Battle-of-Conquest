<?php
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

$GLOBALS['DEBUG_MODE'] = 0;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT

$GLOBALS['ct_recipient']   = 'krammer.markus@hotmail.com'; // Change to your email address!
$GLOBALS['ct_msg_subject'] = 'Reservierung bei planetsporty.com';

if(!isset($_SESSION['beschreibung'])){
	$_SESSION['beschreibung'] = $_POST['beschreibung'];
	$_SESSION['stunde'] = $_POST["stunde"];
	$_SESSION['stundeWann'] = $_POST["stundeWann"];
	$_SESSION['id'] = $_POST["hiddenid"];
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Reservieren</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript">
   			function init(){
				var el = document.getElementById('contact_form');

el.addEventListener('submit', function(){
showLoadingF();
}, false);
				hideLoadingF();
			}
			
			function hideLoadingF(){
				document.getElementById('loading').style.visibility="hidden";
			}
			
			function showLoadingF(){
				document.getElementById('loading').style.visibility="visible";
			}
		</script>
	</head>
	<body onload="init();">
<div id="reservierung_main">
<h2>Reservierung:</h2>

<?php

process_si_contact_form(); // Process the form, if it was submitted

if (isset($_SESSION['ctform']['error']) &&  $_SESSION['ctform']['error'] == true): /* The last form submission had 1 or more errors */ ?>

<?php elseif (isset($_SESSION['ctform']['success']) && $_SESSION['ctform']['success'] == true): /* form was processed successfully */ ?>
<span class="success">Es wurde eine Best&auml;tigungsmail an Sie geschickt.<br /> Bitte best&auml;tigen Sie diese um endg&uuml;ltig zu reservieren.</span><br /><br />
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>" id="contact_form">
  <input type="hidden" name="do" value="contact" />
<h3 class="justifyleft">Schritt 1:</h3>
<p class="justifyleft">Geben Sie Ihre persönlichen Daten ein:</p>
<table class="form_table">
<tbody>
<tr>
<td>Vorname:*</td>
<td><input type="text" name="ct_name" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_name']) ?>" /></td>
<td>
<div id="error_firstname" class="error"><?php echo @$_SESSION['ctform']['name_error'] ?><br /></div>
</td>
</tr>
<tr>
<td>Nachname:*</td>
<td><input type="text" name="ct_lastname" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_lastname']) ?>" /></td>
<td>
<div id="error_lastname" class="error"><?php echo @$_SESSION['ctform']['lastname_error'] ?><br /></div>
</td>
</tr>
<tr>
<td>Tel.:*</td>
<td><input type="tel" name="ct_tel" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_tel']) ?>" /></td>
<td>
<div id="error_phonenumber" class="error"><?php echo @$_SESSION['ctform']['tel_error'] ?></div>
</td>
</tr>
<tr>
<td>E-Mail:*</td>
<td><input type="text" name="ct_email" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email']) ?>" /></td>
<td>
<div id="error_email" class="error"><?php echo @$_SESSION['ctform']['email_error'] ?><br /></div>
</td>
</tr>
</tbody>
</table>
<h3 class="justifyleft">Schritt 2:</h3>
<p class="justifyleft">Wie sind Sie auf uns aufmerksam geworden?</p>
<textarea name="aufmerksam" rows="3" cols="30"></textarea><br />
<p class="justifyleft">Bemerkung:</p>
<textarea name="bemerkung" rows="3" cols="30"></textarea>
<h3 class="justifyleft">Schritt 3:</h3>
<p class="justifyleft">Bitte geben Sie zum Schluss noch diesen Sicherheitscode ein:</p>

<img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="./securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />

<object type="application/x-shockwave-flash" data="./securimage_play.swf?bgcol=#ffffff&amp;icon_file=./images/audio_icon.png&amp;audio_file=./securimage_play.php" height="32" width="32">
    <param name="movie" value="./securimage_play.swf?bgcol=#ffffff&amp;icon_file=./images/audio_icon.png&amp;audio_file=./securimage_play.php" />
    </object>
    &nbsp;<br />
    <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = './securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="./images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
<br />
<?php echo @$_SESSION['ctform']['captcha_error'] ?>
*Code: <input type="text" name="ct_captcha" size="30" maxlength="16" />

<h3 class="justifyleft">Schritt 4:</h3>
<p class="justifyleft">Hiermit best&auml;tigen Sie die Reservierung:
        <input type="submit" value="Reservieren" /> <img src="loader.gif" id="loading" alt="loading" />
        </p>
<span style="font-size: 12px;">* sind Pflichtfelder.</span>
                    
    </form>
</div>
	</body>
</html>

<?php

// The form processor PHP code
function process_si_contact_form()
{
  $_SESSION['ctform'] = array(); // re-initialize the form session data

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
  	// if the form has been submitted

    foreach($_POST as $key => $value) {
      if (!is_array($key)) {
      	// sanitize the input data
        if ($key != 'ct_message') $value = strip_tags($value);
        $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
      }
    }

    $name    = @$_POST['ct_name'];
	$lastname = @$_POST['ct_lastname'];    // name from the form
    $email   = @$_POST['ct_email'];
	$aufmerksam     = @$_POST['aufmerksam'];
	$bemerkung     = @$_POST['bemerkung'];   // email from the form
    $tel     = @$_POST['ct_tel'];     // url from the form
    $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
    $name    = substr($name, 0, 64);  // limit name to 64 characters
	$lastname    = substr($lastname, 0, 64);

    $errors = array();  // initialize empty error array

    if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
      // only check for errors if the form is not in debug mode

      if (strlen($name) < 3) {
        // name too short, add error
        $errors['name_error'] = 'Vorname zu kurz';
      }
	  
	  if (strlen($lastname) < 2) {
        // name too short, add error
        $errors['lastname_error'] = 'Nachname zu kurz.';
      }

      if (strlen($email) == 0) {
        // no email address given
        $errors['email_error'] = 'Email fehlt.';
      } else if ( !preg_match('/^(?:[\w\d]+\.?)+@(?:(?:[\w\d]\-?)+\.)+\w{2,4}$/i', $email)) {
        // invalid email format
        $errors['email_error'] = 'Ung&uuml;ltige EMail.';
      }

      if (!preg_match('/\d{9,13}/',$tel)) {
        $errors['tel_error'] = 'Ung&uuml;ltige Telefonnummer.';
      }
    }

    // Only try to validate the captcha if the form has no errors
    // This is especially important for ajax calls
    if (sizeof($errors) == 0) {
      require_once dirname(__FILE__) . '/./securimage.php';
      $securimage = new Securimage();

      if ($securimage->check($captcha) == false) {
        $errors['captcha_error'] = 'Falscher Sicherheitscode<br />';
      }
    }

    if (sizeof($errors) == 0) {
      // no errors, send the form
      $time       = date('r');
	  $time = substr($time,0,-6);
      $message = "Sehr geehrte/r Frau/Herr $lastname,<br /><br />"
	  .  "Sie haben am $time eine Stunde bei uns reserviert. Wenn Sie das nicht haben, ignorieren Sie diese EMail einfach.<br /><br />"
	  . "Ihre eingegebenen Daten: (falls diese nicht korrekt sind, reservieren Sie bitte einfach nochmal)<br />"
                    . "Name: $lastname $name<br />"
                    . "Email: $email<br />"
                    . "Bemerkung:<br />"
                    . "<pre>$bemerkung</pre>"
					. "Reservierte Stunde:<br />"
					. "-Wann: {$_SESSION['stundeWann']}<br />"
					. "-Stunde: {$_SESSION['stunde']}<br />"
					. "-Beschreibung: {$_SESSION['beschreibung']}<br /> <br />"
					. "Um endg&uuml;tig zu reservieren best&auml;tigen Sie bitte mit folgendem Link: <b><a href='http://localhost/planetsporty/reserve_finish.php"
					. "?id={$_SESSION['id']}&lastname=$lastname&name=$name&email=$email&bemerkung=$bemerkung&aufmerksam=$aufmerksam}'>RESERVIEREN</a></b><br /><br />"
					. "Herzliche Gr&uuml;&szlig;e,<br />Ihr Sporty-Team.";
					
      $message = wordwrap($message, 70);

      if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
      	// send the message with mail()
        mail($GLOBALS['ct_recipient'], $GLOBALS['ct_msg_subject'], $message, "From: {$GLOBALS['ct_recipient']}\r\nReply-To: {$email}\r\nContent-type: text/html; charset=ISO-8859-1\r\nMIME-Version: 1.0");
      }

      $_SESSION['ctform']['error'] = false;  // no error with form
      $_SESSION['ctform']['success'] = true; // message sent
    } else {
      // save the entries, this is to re-populate the form
      $_SESSION['ctform']['ct_name'] = $name;
	  $_SESSION['ctform']['ct_lastname'] = $lastname;       // save name from the form submission
      $_SESSION['ctform']['ct_email'] = $email;     // save email
      $_SESSION['ctform']['ct_tel'] = $tel; // save message

      foreach($errors as $key => $error) {
      	// set up error messages to display with each field
        $_SESSION['ctform'][$key] = "<span style=\"font-weight: bold; color: #f00\">$error</span>";
      }

      $_SESSION['ctform']['error'] = true; // set error floag
    }
  } // POST
}

$_SESSION['ctform']['success'] = false; // clear success value after running

