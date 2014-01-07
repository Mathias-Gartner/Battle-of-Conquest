<?php include 'header.php' ?>
<!--<img src="" alt="">-->

<div class='flex_vert' id='footerstuff'>
<?php
	if (isset($_GET['foot']))
	{
		switch($_GET['foot']) {
		case "fh":
			echo "<div class='title flex_centered'>FH Technikum</div>
			<p>The FH Technikum is a education center for several categories, this project was created as part of the Computer Science degree.</p>
			<p>Part of the bachelor's degree in CS at the FH is the couse ITP, or project-management-excercise. There you have to get a full team of 3-5 to start a project you like and you have to work on it for one semester. Each team gets a counselor who will also grade the team according to their project-management efforts..</p>
			<p>Our team chose a strategy-game as the goal of the project because we wanted to have something to have fun and to have to think while playing it. Therefore BOC was born and all members wanted to do that.</p>
			<p>If you need more information about the FH, you can take this link here: <a href='http://www.technikum-wien.at/'>Technikum Wien</a></p>";
			break;
		case "team":
			echo "<div class='title flex_centered'>The team</div>
				  <div class='flex_centered' id='team'><img src='res/foto/teamfoto2.jpg' alt='team'></div>";
			break;
		case "help":
			echo "<div class='title flex_centered'>The Manual</div>
			<p>If you dont know what to do, just dont panic and read...</p>
			<p>First of all, you need to know that the game is still in beta and there might be the one or two bugs that influence your gameplay. But there is a implementation that should provide the basic gameplay.</p>
			<p> When you first start, you will get a city randomly somewhere on the map. That city is your main one so protect it at all costs because if you lose that, you will lose the game and have to restart from the beginning. To get your city you just need to register and login! And just saying, every city has its own characteristics and ressources. </p>
			<p>You probably saw the maps, there are two kind of maps: worldmap and part of the world maps. Simple clicks will bring you to your city or to an other players city, there you can see some information about it. Of course, in your own city, you can build new buildings which will help you to raise your army and provide helpfull effects. There will be a list with what buildings are allowed in the future.</p>
			<p>Next to the city, you can create your own armee, at the moment there are not many kind of units though but more will be in the future! To create a unit you need first ressouces and people to recruit, then simple press on the units-menu and start making your very own private army! </p>
			<p>You will need the army to attack other cities or you defend yourself. On the map you can choose your next victim and press the attack button, or be a piecefull player and keep defending yourself! It is your city, you are the ruler! But be careful, more cities means more reponsabilites.</p>
			<p>Last but not least, we have a class-sytem for the cities and due to that we do not allow strong cities with a great army to attack weaker ones</p>
			<p>Have fun!</p>";
			break;
		case "imp":
			echo "<div class='title flex_centered'>Legal notice</div>
			<p>Create of content and person in charge: Markus Krammer<br />
			   FH Technikum<br />
			2013/2014
			</p>
			<div class='title flex_centered'>License</div>
			<p>This site and the source code behind it are licensed under the General Public License, version 3.
			   The license the can be found <a href='LICENSE'>here</a>. The source code is on <a href='https://github.com/Mathias-Gartner/Battle-of-Conquest'>github</a>.
			</p>
			<div class='title flex_centered'>Third party content</div>
			</div>";
			break;
		default:
			break;
		}
	}
	?>
</div>
<?php include 'footer.php' ?>
