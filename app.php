<div id="app">
    <div class="wrapper">
        <a href="https://www.facebook.com/criticalmaps">
            <img src="/img/logo.png" alt="logo" class="logo"/>
        </a>
        <div class="links">
            <a href="https://itunes.apple.com/de/app/critical-mass-berlin/id918669647" target="_blank"><img
                    src="/img/apple-store.svg"
                    alt="itunes"/></a>
            <a href="https://play.google.com/store/apps/details?id=de.stephanlindauer.criticalmaps" target="_blank"><img
                    src="/img/google-play.svg" alt="play"/></a>
        </div>
    </div>
</div>

<style>
    #app {
        background: url(/img/background.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    #app .wrapper {
        position: absolute;
        top: 30%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        width: 100%;
        top: 50%
    }

    #app .wrapper .logo {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        width: 200px;
        height: 200px
    }

    #app .wrapper .links {
        position: absolute;
        display: block;
        top: 180px;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }

    #app .wrapper .links img {
        margin: 10px;
        height: 50px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 10px
    }
</style>
