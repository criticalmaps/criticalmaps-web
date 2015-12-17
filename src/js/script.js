$().ready( function () {

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
    } );

} );