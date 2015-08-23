<?php require("partials/wrapper_head.php"); ?>

    <iframe id="mainframe" name="mainframe" src="/app.php" scrolling="no" frameborder="0"></iframe>

    <script>
        criticalMapsMain = {
            locationHash: "",
            sectionHash: "",
            saveMapState: function ( locationHash ) {
                this.locationHash = locationHash.replace('#','');;
                this.updateHash();
            },
            saveSectionState: function ( sectionHash ) {
                this.sectionHash = sectionHash.replace('#','');
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
    </style>

<?php require("partials/navigation.php"); ?>
<?php require("partials/footer.php"); ?>
<?php require("partials/social.php"); ?>

<?php require("partials/wrapper_footer.php"); ?>