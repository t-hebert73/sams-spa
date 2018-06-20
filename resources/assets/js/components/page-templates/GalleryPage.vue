<template>
    <div class="container">
        <div class="row justify-content-center main-area">
            <div class="col-md-12">

                <div class="mt-5">
                    <h1 class="page-title">Gallery</h1>

                    <div class="page-content left-bar mt-3 mb-5">
                        <p>At Alesco, our mission to provide exceptional gallerys to our guests while maintaining our beliefs for wellness, beauty and
                            the environment. We are committed to the mission and beliefs of Aveda and are proud to honour and uphold their
                            guidelines.</p>
                    </div>

                    <div class="gallery-container">
                        <b-carousel id="gallery"
                                    controls
                                    indicators
                                    background="#ababab"
                                    :interval="4000"
                                    img-width="1024"
                                    img-height="480">

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery1.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery1.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery2.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery2.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery3.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery3.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery4.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery4.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery5.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery5.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery6.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery6.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                            <b-carousel-slide>
                                <a slot="img" :class="'lightbox-image'"
                                   :href="'images/gallery/gallery7.jpg'"
                                   :data-lightbox="'gallery-photos'">

                                    <div class="slider-photo cover" style="background-image: url('images/gallery/gallery7.jpg');"></div>
                                </a>
                            </b-carousel-slide>

                        </b-carousel>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "gallery-page",

        mounted() {

            let lightbox = require('lightbox2')

            lightbox.option({
                fadeDuration: 200,
                imageFadeDuration: 200,
                resizeDuration: 300,
                fitImagesInViewport: true
            })
        }
    }
</script>

<style lang="scss" scoped>

    @import "../../../sass/responsive.scss";

    .gallery-container{
        margin-bottom: 330px;
        position: relative;
        z-index: 2;

        @media #{$small} {
            margin-bottom: 200px;
        }

        @media #{$mobile} {
            margin-bottom: 120px;
        }

        .cover{
            height: 650px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;

            @media #{$normal} {
                height: 550px;
            }

            @media #{$small} {
                height: 500px;
            }

            @media #{$mobile} {
                height: 250px;
            }
        }
    }
</style>