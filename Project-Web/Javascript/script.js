    $(".owl-carousel").owlCarousel({
        autoplay: true,
        autoplayhoverpause: true,
        auotplaytimeout: 100,
        items: 4,
        nav: true,
        loop: true,
        lazyLoad: true,
        margin: 5,
        padding: 5,
        stagepadding: 5,
        responsive: {
            400:{
                items: 1,
                dots: false
            },
            768 :{
                items: 2,
                dots: false
            },
            992 :{
                items: 3,
                dots: false
            },
            1200 :{
                items: 4,
                dots: true
            }
        }
    });