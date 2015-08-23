<?php require("partials/wrapper_head.php"); ?>

    <iframe id="mainframe" name="mainframe" src="/app.php" scrolling="no" frameborder="0"></iframe>
    <div class="imageoverlaycontainer">
        <div class="imagepopup">
            <img src="img/background.jpg">
        </div>
    </div>


    <script>
        criticalMapsMain = {
            locationHash: "",
            sectionHash: "",
            saveMapState: function ( locationHash ) {
                this.locationHash = locationHash.replace( '#', '' );
                ;
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

    <style>
        #mainframe {
            background-color: #c8c8c8;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .imageoverlaycontainer {
            display: none;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            padding-top: 80px;;
            padding-bottom: 40px;;
            height: auto;
            width: 100%;
            position: absolute;
            overflow: hidden;
        }

        .imageoverlaycontainer .imagepopup {
            background-color: rgba(20, 20, 20, 0.4);
            width: 100%;
            height: 100%;
        }

        .imageoverlaycontainer .imagepopup img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
            vertical-align: middle;
        }


    </style>




<?php require("partials/navigation.php"); ?>
<?php require("partials/footer.php"); ?>
<?php require("partials/social.php"); ?>

<?php require("partials/wrapper_footer.php"); ?>