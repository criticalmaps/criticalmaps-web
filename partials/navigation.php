<div id="navigation">
    <div id="wrapper">
        <img alt="logo" src="/img/logo-nav.png"/>
        <ul>
            <li>
                <a href="/app.php" target="mainframe" class="active">app</a>
            </li>
            <li>
                <a href="/map.php" target="mainframe">map</a>
            </li>
            <li>
                <a href="/gallery.php" target="mainframe">gallery</a>
            </li>
            <!--            <li>-->
            <!--                <a href="/gallery.php" target="mainframe">timelapses</a>-->
            <!--            </li>-->

        </ul>
    </div>
</div>

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

        $( "#navigation #wrapper ul a" ).click( function ( event ) {
            event.preventDefault()
            $( "#navigation #wrapper ul a" ).removeClass( "active" );
            $( event.target ).addClass( "active" );

            var sectionToOpen = $( event.target ).text();
            openSection( sectionToOpen );
        } )

    } );

</script>


<style>
    #navigation {
        position: absolute;
        height: 80px;
        width: 100%;
        background-color: rgba(20, 20, 20, 0.8);
        overflow: hidden;
        border-bottom: 1px solid #FAFAFA;
    }

    #navigation #wrapper {
        position: relative;
        width: 952px;
        margin: 0 auto;
        height: 100%;
    }

    #navigation #wrapper img {
        height: 180px;
        margin-top: -20px;
        position: absolute;
    }

    #navigation #wrapper ul {
        position: absolute;
        left: 200px;
        bottom: 8px;
        margin: 0;
    }

    #navigation #wrapper ul li {
        display: inline;
        color: #ffffff;
    }

    #navigation #wrapper ul a {
        padding: 14px;
        text-decoration: none;
        color: #fff;
        background: rgba(160, 160, 160, 0.6);
        font-weight: bold;
    }

    #navigation #wrapper ul a:hover {
        background-color: #005f5f;
        color: #000000;
        transition: background-color .3s, color .3s;

    }

    #navigation #wrapper ul a.active {
        background-color: #FAFAFA;
        color: #000;
        transition: background-color .3s, color .3s;

    }
</style>