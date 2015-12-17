<?php require("wrapper_head.php"); ?>

	<header id="header">
		<div id="navigation">
	        <ul>
	            <li>
	                <a href="/app.php" data-action="replace" target="mainframe" class="active">App</a>
	            </li>
	            <li>
	                <a href="/map.php" data-action="replace" target="mainframe">Map</a>
	            </li>
	            <li>
	                <a href="/gallery.php" data-action="replace" target="mainframe">Gallery</a>
	            </li>
	            <li>
	            	<a href="/videos.php" data-action="replace" target="mainframe">Videos</a>
				</li>
	            <li>
	            	<a href="/info.php" data-action="replace" target="mainframe">Info</a>
				</li>
	            <li>
	            	<a class="facebook" href="https://www.facebook.com/criticalmaps" target="_blank"><img alt="Facebook" src="/assets/images/social-facebook.svg" width="32" height="32" /></a>
				</li>
	            <li>
	            	<a class="twitter" href="https://twitter.com/CriticalMaps" target="_blank"><img alt="Twitter" src="/assets/images/social-twitter.svg" width="32" height="32" /></a>
				</li>
	        </ul>
		</div>
	</header>

	<iframe id="mainframe" name="mainframe" src="/app.php" scrolling="no" frameborder="0"></iframe>

	<div class="imageoverlaycontainer">
		<div class="imagepopup"></div>
	</div>

<?php require("wrapper_footer.php"); ?>