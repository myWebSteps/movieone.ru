<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>
       <!-- Content Header (Page header) -->
    <FrontLayout>
        <div class="container-fluid">

            <div class="osahan-slider d-none">
                <div class="osahan-slider-item"><img :src="slider.one" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img :src="slider.two" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img :src="slider.three" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img :src="slider.four" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img :src="slider.five" class="img-fluid rounded" alt="..."></div>
            </div>

        <div class="page-header">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="d-flex w-100 align-items-center justify-content-between mt-4 mb-3">
                    <h1 class="h5 mb-0 text-gray-900">Подборки фильмов и мультиков</h1>
                    <Link :href="`/collections`" class="text-sm">
                        Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                    </Link>
                </div>

                <collections-card :data="collections"></collections-card>

            </div>
                <div class="row">
                <template v-for="item in data">

                    <!-- Page Heading -->
                    <div class="d-flex w-100 align-items-center justify-content-between mt-4 mb-3">
                        <h2 class="h5 mb-0 text-gray-900">{{item.category}}</h2>
                        <Link :href="`/movies?category=${item.slug}&order=year&page=1`" class="text-sm">
                            Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                        </Link>
                    </div>

                    <!-- Content Row -->

                    <movies-card :data="item.movies" :config = "{classes: 'col-xxl-2 col-xl-3 col-md-4 mb-4'}"></movies-card>

                    <!-- Page Heading -->
                </template>



            </div><!--/. row -->
        </section>
<!--         /.content -->
        </div>
        </div>
    </FrontLayout>

</template>

<script>
    import '../../../css/Extensions/_slider.css'
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import CollectionsCard from "@/Components/CollectionsCard.vue";
    import MoviesCard from "@/Components/MoviesCard.vue";


    export default {
        name: "Home",
        props: ['data', 'collections'],
        components: {FrontLayout, CollectionsCard, MoviesCard, Head, Link},


        beforeMount() {
            this.sliderSizes()
        },

        data(){
            return{
                slider:{
                    one: "",
                    two: "",
                    three: "",
                    four: "",
                    five: "",
                }
            }

        },

        mounted() {
            ym(94438576, 'hit', '/');

           this.sliderSizes()

            window.addEventListener("resize", () => {
                this.sliderSizes()
            });

            // Osahan Slider

            jQuery(document).ready(function() {
                $('.osahan-slider').slick({
                    centerMode: true,
                    centerPadding: '100px',
                    slidesToShow: 1,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '100px',
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '50px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });
                $('.osahan-slider').removeClass( 'd-none' );
            })
        },

        methods:{
            sliderSizes(){
                if(window.innerWidth < 576){
                    this.slider.one = "img/slider_min_1.webp"
                    this.slider.two = "img/slider_min_2.webp"
                    this.slider.three = "img/slider_min_3.webp"
                    this.slider.four = "img/slider_min_4.webp"
                    this.slider.five = "img/slider_min_5.webp"
                }else{
                    this.slider.one = "img/slider1.webp"
                    this.slider.two = "img/slider2.webp"
                    this.slider.three = "img/slider3.webp"
                    this.slider.four = "img/slider4.webp"
                    this.slider.five = "img/slider5.webp"
                }
            },
        },

    }
</script>
