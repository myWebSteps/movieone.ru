<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>
       <!-- Content Header (Page header) -->
    <FrontLayout>
        <div class="container-fluid">
        <div class="page-header">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="d-flex w-100 align-items-center justify-content-between mt-4 mb-3">
                    <h1 class="h5 mb-0 text-gray-900">Случайные видео с сайта</h1>
                    <Link :href="`/random_movies`" class="text-sm">
                        <button class="btn btn-success">Перемешать
                            <i class="fa-solid fa-shuffle"></i>
                        </button>
                    </Link>
                </div>
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
                        <div v-for="movie in item.movies" class="col-xl-3 col-md-6 mb-4">
                            <div  class="card m-card shadow border-0">
                                <Link :href="`/movies/${movie.slug}`">
                                    <div class="m-card-cover">
                                        <img v-lazy="movie.poster" class="card-img-top" :alt="movie.nameEn">
                                    </div>

                                        <div class="card-body">
                                            <h3 class="h5 card-title text-gray-900 mb-1 text-wrap">{{movie.nameRu}}</h3>
                                            <h3 class="h5 card-title text-gray-900 mb-1 text-wrap">{{movie.nameEn}}</h3>
                                            <p class="card-text mb-0">
                                                <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                                <span v-for="genre in movie.genres" class="text-muted">
                                                    {{genre.title}} &nbsp
                                                </span></p>
                                            <p class="card-text text-danger pt-0"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> {{movie.year}}</p>
                                        </div>

                                </Link>
                            </div>
                        </div>

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
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";


    export default {
        name: "Home",
        props: ['data'],
        components: {FrontLayout, Head, Link},


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
