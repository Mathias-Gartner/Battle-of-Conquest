<?php include 'header.php' ?>

<article id="home" class="panel">
	<header>
		<h2 class='flex_centered'>Battle Report</h2>
	</header>

  <div class="reportHeader">
    <?php
    if ($PAGEDATA['isSpy'])
      echo "Espoinage attempt";
    else
      echo "Attack";
    ?>
    from
    <?php echo $PAGEDATA['sourceDistrict']; ?>
    to
    <?php echo $PAGEDATA['targetDistrict']; ?>
  </div>

	<section id="formationsSection">
	  <div class="sectionHeader">Formations</div>

	  <div class="attacker">
	    <?php
			if (!isset($PAGEDATA['attackUnits']) || count($PAGEDATA['attackUnits']) < 1)
			{
				?><span>The attacker has no units.</span><?php
			}
			else
			{
		    foreach ($PAGEDATA['attackUnits'] as $unit)
		    { ?>
		      <div>
		        <span><?php echo $unit['name']; ?></span>
		        <span><?php echo $unit['count']; ?></span>
		      </div>
		    <?php }
			} ?>
	  </div>
	  <div class="defender">
	    <?php
			if (!isset($PAGEDATA['defendUnits']) || count($PAGEDATA['defendUnits']) < 1)
			{
				?><span>The defender has no units.</span><?php
			}
			else
			{
		    foreach ($PAGEDATA['defendUnits'] as $unit)
		    { ?>
		      <div>
		        <span><?php echo $unit['name']; ?></span>
		        <span><?php echo $unit['count']; ?></span>
		      </div>
		    <?php }
			} ?>
	  </div>
  </section>

	<section id="killsSection">
		<div class="sectionHeader">Kills</div>

		<div class="attacker"><?php echo $PAGEDATA['killedAttackers']; ?></div>
		<div class="defender"><?php echo $PAGEDATA['killedDefenders']; ?></div>
	</section>

	<section id="resultSection">
		<div class="sectionHeader">Result</div>

		<div class="attacker">
			<?php
			if (!isset($PAGEDATA['resultAttackUnits']) || count($PAGEDATA['resultAttackUnits']) < 1)
			{
				?><span>The attacker has no units left.</span><?php
			}
			else
			{
				foreach ($PAGEDATA['resultAttackUnits'] as $unit)
				{ ?>
					<div>
						<span><?php echo $unit['name']; ?></span>
						<span><?php echo $unit['count']; ?></span>
					</div>
				<?php }
			} ?>
		</div>
		<div class="defender">
			<?php
			if (!isset($PAGEDATA['resultDefendUnits']) || count($PAGEDATA['resultDefendUnits']) < 1)
			{
				?><span>The defender has no units left.</span><?php
			}
			else
			{
				foreach ($PAGEDATA['resultDefendUnits'] as $unit)
				{ ?>
					<div>
						<span><?php echo $unit['name']; ?></span>
						<span><?php echo $unit['count']; ?></span>
					</div>
				<?php }
			} ?>
		</div>
	</section>

	<div class='flex_hor linkbar'>
		<div class='flex_centered'>
			<a href='javascript:history.back();' class='bigbutton'><span>Back</span></a>
		</div>
	</div>
</article>

<?php include 'footer.php' ?>
