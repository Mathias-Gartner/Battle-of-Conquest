<?php include 'header.php' ?>

<article id="welcome" class="panel" >
      <header>
        <h2>
	<?php echo 'Prepare the attack on '.$PAGEDATA['targetCityName'].'!'; ?>
        </h2>
      </header>

<div class='flex_vert' id='sladi_prepare_attack'>
	<?php if (count($PAGEDATA['units']) == 0) { ?>
		<p>This city has no units! We are unable to attack, commander!</p>
		<a href='javascript:history.back();'>Back</a>
	<?php } else { ?>
		<p><span class='quote'>How many units will you send to battle, commander?</span></p>

		<form class='flex_vert' action='?action=startAttack' method='POST'>
			<input type='hidden' id='sourceId' name='sourceId' value='<?php echo $PAGEDATA['sourceId']; ?>' />
			<input type='hidden' id='targetId' name='targetId' value='<?php echo $PAGEDATA['targetId']; ?>' />
			<input type='hidden' id='distanceSeconds' name='distanceSeconds' value='<?php echo $PAGEDATA['distanceSeconds']; ?>' />

			<?php foreach ($PAGEDATA['units'] as $unit) { ?>
			<p>
				<span><?php echo $unit['name'].' ' ?>: </span>
				<input type='number' class='unitNumber' onchange='unitNumberChanged()' name='unit_<?php echo $unit['id']; ?>' value='0' min='0' max='<?php echo $unit['max']; ?>' />
				<span> of <?php echo $unit['max']; ?></span>
			</p>
			<?php } ?>

      <p id='distanceParagraph' style='visibility: hidden;'>Estimated time until our troops reach the battle: <span id='distanceLabel'></span></p>

			<input type='submit' value='Attack now!' />
		</form>
	<?php } ?>
</div>
</article>
<script type='application/javascript'>

var speeds = ([
  <?php $first = true;
   foreach($PAGEDATA['units'] as $unit) {
    if ($first)
      $first = false;
    else
      echo ',';
  ?>
  {
    "unitId": <?php echo $unit['id']; ?>,
    "speed": <?php echo $unit['speed']; ?>
  }
  <?php } ?>
]);

function unitNumberChanged()
{
  var distanceSeconds = document.getElementById('distanceSeconds').value * 1;
  var p = document.getElementById('distanceParagraph');
  var span = document.getElementById('distanceLabel');
  var numberFields = document.getElementsByClassName('unitNumber');
  var speed = -1;

  for (var i=0; i<numberFields.length; i++)
  {
    var numberField = numberFields[i];
    var id = numberField.name.replace('unit_', '') * 1;
    if (isNaN(numberField.value) || numberField.value < 1)
      continue;

    for (var j=0; j<speeds.length; j++)
    {
      if (speeds[j].unitId == id)
      {
        if (speed == -1 || speed > speeds[j].speed)
        {
          speed = speeds[j].speed;
        }
        break;
      }
    }
  }

  if (speed == -1)
  {
    p.style = 'visibility: hidden;';
  }
  else
  {
    p.style = '';
    span.innerHTML = formattedTime(distanceSeconds / speed);
  }
}

</script>

<?php include 'footer.php' ?>
