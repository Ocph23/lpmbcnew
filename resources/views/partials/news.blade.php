<div class="mainx">
    <div>
        <h1>Berita Terkini</h1>
        <hr>
    </div>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($news as $item)
                <div class="swiper-slide itemslide" style="background-image: url('/storage/{{ $item->thumbnail_path }}')">
                    <div class="itembg">
                        <h5 class="itemtitle">{{ $item->title }}</h5>
                        <a href="/berita/{{ $item->slug }}">explore</a>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <img src="https://cdn.pixabay.com/photo/2021/11/04/19/39/jellyfish-6769173_960_720.png" alt=""
        class="bg">
    <img src="https://cdn.pixabay.com/photo/2012/04/13/13/57/scallop-32506_960_720.png" alt="" class="bg2">
</div>



<script>
    setTimeout(() => {

        var swiper = new Swiper(".swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 3,
                slideShadows: true
            },
            keyboard: {
                enabled: true
            },
            mousewheel: {
                thresholdDelta: 70
            },
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 2
                },
                1560: {
                    slidesPerView: 3
                }
            }
        });
    }, 1000);
</script>


<style lang="css">
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@300;400;500;900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }


    .itemslide {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 5px;
        border-radius: 10px;
    }

    .itembg {
        height: 100%;
        width: 100%;
        display: flex !important;
        flex-direction: column;
        justify-content: end;
        align-items: end;
    }

    .itemtitle {
        background-color: #db9225ee;
        border-radius: 10px;
        margin: 15px
    }

    .mainx {
        position: relative;
        width: calc(min(90rem, 90%));
        margin: 0 auto;
        min-height: 65vh;
        column-gap: 3rem;
        padding-block: min(20vh, 3rem);
    }

    .bg {
        position: fixed;
        top: -4rem;
        left: -12rem;
        z-index: -1;
        opacity: 0;
    }

    .bg2 {
        position: fixed;
        bottom: -2rem;
        right: -3rem;
        z-index: -1;
        width: 9.375rem;
        opacity: 0;
    }

    .mainx>div span {
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 1rem;
        color: #717171;
    }

    .mainx>div h1 {
        text-transform: capitalize;
        letter-spacing: 0.8px;
        font-family: "Roboto", sans-serif;
        font-weight: 900;
        font-size: clamp(3.4375rem, 3.25rem + 0.75vw, 4rem);
        background-color: #005baa;
        background-image: linear-gradient(45deg, #005baa, #000000);
        background-size: 100%;
        background-repeat: repeat;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-background-clip: text;
        -moz-text-fill-color: transparent;
    }

    .mainx>div hr {
        display: block;
        background: #005baa;
        height: 0.25rem;
        width: 6.25rem;
        border: none;
        margin: 1.125rem 0 1.875rem 0;
    }

    .mainx>div p {
        line-height: 1.6;
    }

    .mainx a {
        display: inline-block;
        text-decoration: none;
        text-transform: uppercase;
        color: #717171;
        font-weight: 500;
        background: #fff;
        border-radius: 3.125rem;
        transition: 0.3s ease-in-out;
        z-index: 1000;
    }

    .mainx>div>a {
        border: 2px solid #c2c2c2;
        margin-top: 2.188rem;
        padding: 0.625rem 1.875rem;
    }

    .mainx>div>a:hover {
        border: 0.125rem solid #005baa;
        color: #005baa;
    }

    .swiper {
        width: 100%;
        padding-top: 3.125rem;
    }

    .swiper-pagination-bullet,
    .swiper-pagination-bullet-active {
        background: #fff;
    }

    .swiper-pagination {
        bottom: 1.25rem !important;
    }

    .swiper-slide {
        width: 18.75rem;
        height: 28.125rem;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: self-start;
    }

    .swiper-slide h5 {
        color: #fff;
        font-weight: 400;
        line-height: 1.4;
        margin-bottom: 0.625rem;
        padding: 1rem;
        text-transform: uppercase;
    }

    .swiper-slide p {
        color: #dadada;
        font-family: "Roboto", sans-serif;
        font-weight: 300;
        padding: 0 1.563rem;
        line-height: 1.6;
        font-size: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .swiper-slide a {
        margin: 1rem;
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding: 0.438em 1.875rem;
        font-size: 0.9rem;
        z-index: 1000;
    }

    .swiper-slide a:hover {
        color: #005baa;
    }

    .swiper-slide div {
        display: none;
        opacity: 0;
        padding-bottom: 0.625rem;
    }

    .swiper-slide-active div {
        display: block;
        opacity: 1;
    }


    .swiper-3d .swiper-slide-shadow-left,
    .swiper-3d .swiper-slide-shadow-right {
        background-image: none;
    }

    @media screen and (min-width: 48rem) {
        .mainx {
            display: flex;
            align-items: center;
        }

        .bg,
        .bg2 {
            opacity: 0.1;
        }
    }

    @media screen and (min-width: 93.75rem) {
        .swiper {
            width: 85%;
        }
    }
</style>
