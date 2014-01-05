<?php include 'header.php' ?>
<img src="" alt="">
    <div class='content middle' align='center'>
<?php
		if (isset($_GET['foot']))
		{
			switch($_GET['foot']) {
			case "fh":
				echo "<div class='tit'>FH Techikum</div>
      		<p>The FH Technikum is a education center for several categories, this project was created in informatics</p>
      		<p>In the bachelor year of informatics there is a ITP, the so called project-work. There you have to get a full team of 3-5 to start a project you like and you have to finish it during one semester. Every teams gets a private teacher that will give you the mark in the end as well as he has to help you during the semester.</p>
      		<p>Our team choose to create a project that is a game, a strategy-game because we wanted to have something to have fun and to have to think while playing it. Therefore BOC was born and all members wanted to do that</p>
      		<p>If you need more information about the FH, you can take this <a href='http://www.technikum-wien.at/'>link</a> here</p>";
				break;
			case "team":
				echo "<div id='team'><img src='res/foto/teamfoto2.jpg' alt='team'></div>";
				break;
			case "help":
				echo "<div class='tit'>The Help</div>
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
				echo " <div >
      		<div class='tit'>Impressum</div>
    		 <p>Ersteller der Inhalte und Verantwortliche: Markus Krammer</p>
				<p>FH Technikum<br />
				2013/2014</p>
			<h3>Urheberrecht</h3>
			<p>Die durch den Betreiber dieser Seite erstellten Inhalte und Werke auf diesen Webseiten unterliegen dem deutschen Urheberrecht. S&auml;mtliche Beitr&auml;ge Dritter sind als solche gekennzeichnet. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechts bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Kopien von diesen Seiten sind nur f&uuml;r den privaten Bereich gestattet, nicht jedoch f&uuml;r kommerzielle Zwecke.</p>
		
			<p>Einer Nutzung der im Impressum ver&ouml;ffentlichten Kontaktdaten durch Dritte zu Werbezwecken wird hiermit ausdr&uuml;cklich widersprochen. Der Betreiber beh&auml;lt sich f&uuml;r den Fall unverlangt zugesandter Werbe- oder Informationsmaterialien ausdr&uuml;cklich rechtliche Schritte vor.</p>
			<h3>Rechtswirksamkeit dieses Haftungsausschlusses</h3>
			<p>Sollten einzelne Regelungen oder Formulierungen dieses Haftungsausschlusses unwirksam sein oder werden, bleiben die &uuml;brigen Regelungen in ihrem Inhalt und ihrer G&uuml;ltigkeit hiervon unber&uuml;hrt.</p>
    		</div> ";
				break;
			default:
				break;
			}
		}
		?>
</div>
<?php include 'footer.php' ?>