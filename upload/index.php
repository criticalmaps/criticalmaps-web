<?php require("partials/wrapper_head.php"); ?>

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
	
	<script>
	    $().ready( function () {
	
	        function openSection( sectionName ) {
	            criticalMapsMain.saveSectionState( sectionName );
	            $( "#mainframe" ).attr( 'src', "/" + sectionName + ".php/#" + criticalMapsMain.locationHash );
	        }
	
	        if ( location.hash ) {
	            var hash = location.hash;
	            criticalMapsMain.saveMapState( hash.split( "/" ).splice( 1, 999 ).join( "/" ) );
	            openSection( hash.split( "/" )[0].replace( "#", "" ) );
	            location.hash.split( "/" )
	        } else {
	            openSection( "app" );
	        }
	
	        $( "#navigation ul a" ).click( function ( event ) {
		        if( this.getAttribute('data-action') == 'replace' ) {
		            event.preventDefault()
		            $( "#navigation ul a" ).removeClass( "active" );
		            $( event.target ).addClass( "active" );
		
		            var sectionToOpen = $( event.target ).text();
		            openSection( sectionToOpen );
	            }
	        } )
	
	    } );
	
	</script>

	<iframe id="mainframe" name="mainframe" src="/app.php" scrolling="no" frameborder="0"></iframe>
	<div class="imageoverlaycontainer">
		<div class="imagepopup"></div>
	</div>

    <script>
        criticalMapsMain = {
            locationHash: "",
            sectionHash: "",
            saveMapState: function ( locationHash ) {
                this.locationHash = locationHash.replace( '#', '' );
                this.updateHash();
            },
            saveSectionState: function ( sectionHash ) {
                this.sectionHash = sectionHash.replace( '#', '' );
                this.updateHash();
            },
            updateHash: function () {
                location.hash = this.sectionHash + "/" + this.locationHash;
            }
        }
    </script>

<?php require("partials/wrapper_footer.php"); ?>