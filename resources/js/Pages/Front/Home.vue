<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>
       <!-- Content Header (Page header) -->
    <FrontLayout>

            <div class="osahan-slider">
                <div class="osahan-slider-item"><img src="img/slider1.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider2.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider3.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider4.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider5.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider6.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider7.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider8.webp" class="img-fluid rounded" alt="..."></div>
                <div class="osahan-slider-item"><img src="img/slider9.webp" class="img-fluid rounded" alt="..."></div>
            </div>

        <div class="page-header">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <template v-for="item in data">

                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
                        <h1 class="h5 mb-0 text-gray-900">{{item.category}}</h1>
                        <Link :href="`/movies?category=${item.category_id}&order=year&page=1&genre=&type=`" class="text-xs">
                            Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                        </Link>
                    </div>

                    <!-- Content Row -->
                    <div class="row ml-0 mr-0">
                        <div v-for="movie in item.movies" class="col-xl-3 col-md-6 mb-4">
                            <div  class="card m-card shadow border-0">
                                <Link :href="`/movies/${movie.slug}`">
                                    <div class="m-card-cover">
                                        <img v-lazy="movie.poster" class="card-img-top" :alt="movie.nameEn">
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-2 auto py-3 pl-3">
                                                <div class="bg-white rounded text-center">
                                                    <h6 class="text-danger mb-0 font-weight-bold">{{movie.year}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-10 p-3">
                                                <p v-if="movie.nameRu != null" class="card-text text-gray-900 mb-1">{{movie.nameRu}}</p>
                                                <p v-if="movie.nameEn != null" class="card-text text-gray-900 mb-1">{{movie.nameEn}}</p>
                                                <p class="card-text">
                                                    <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                                    <small v-for="genre in movie.genres" class="text-muted">
                                                        {{genre.title}} &nbsp
                                                    </small></p>
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </div>

                    </div>
                    <!-- Page Heading -->
                </template>



            </div><!--/. row -->
            </div><!--/. container-fluid -->
        </section>
<!--         /.content -->
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
        mounted() {
            ym(94438576, 'hit', '/');


            // Osahan Slider
            $('.osahan-slider').slick({
                centerMode: true,
                centerPadding: '100px',
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            centerMode: true,
                            centerPadding: '100px',
                            slidesToShow: 2
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
        },

    }
</script>
