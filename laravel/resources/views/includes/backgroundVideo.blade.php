<style>
video#bgvid {
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    -ms-transform: translateX(-50%) translateY(-50%);
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    /*background: url(polina.jpg) no-repeat;*/
    background-size: cover;

    transition: 1s opacity;
    opacity: .6;
}

video { display: block; }

@media screen and (max-device-width: 800px) {
    html {
        /*background: url(polina.jpg) #000 no-repeat center center fixed;*/
    }
    #bgvid {
        display: none;
    }
}
</style>
<!--[if lt IE 9]>
<script>
document.createElement('video');
</script>
<![endif]-->