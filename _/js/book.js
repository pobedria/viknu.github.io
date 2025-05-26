import {initLazyYoutubePlayers} from "/_/js/lazy-youtube-player-main/examples/yt-player.min.js";

$(function() {

    let $mybook = $('#mybook'),
        width = 1200,
        height = 780;

    if (screen.width < 500) {
        width = 350;
        height = 400;
    }

    //single book
    $mybook.booklet({
        pageNumbers: false
        ,width: width
        ,height: height
        // ,width: 350
        // ,height: 460
        ,speed: 1000
        ,arrows: true
        ,start: function(event, data) {
            // reinitializing the values of the src attribute of every iframe to stop the YouTube video.
            $('.NexosYt').each(function () {
                $(this).empty();
            });

            initLazyYoutubePlayers();



            // for (let i = 0; i < iframes.length; i++) {
            //     if (iframes[i] !== null) {
            //         var temp = iframes[i].src;
            //         iframes[i].src = temp;
            //     }
            // }
        }
    });
});