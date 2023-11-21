<template>
    <FrontLayout>

        <Head>
            <title>Поиск фильмов MovieOne.ru</title>
            <meta name="description" content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации" />
            <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
        </Head>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Content Row -->
                <div class="row">
                    <!-- Page Heading -->
                    <div class="ml-3 d-sm-flex align-items-center justify-content-between pt-4 mb-4">
                        <h1 class="h5 mb-0 text-gray-900">Результаты запроса: {{data.key}}</h1>
                    </div>

                    <div class="col-xl-12 col-lg-8 mt-4">

                        <div class="row">
                            <div v-for="movie in movies" class="col-xl-3 col-md-6 mb-4 col-sm-6">
                                <div  class="card m-card shadow border-0">
                                    <Link :href="`/movies/${movie.slug}`">
                                        <div class="m-card-cover">
                                            <img v-lazy="movie.posterUrl" class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">
                                                    <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.nameRu}}</h5>
                                                    <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.nameEn}}</h5>
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

                        </div>

                    </div>

                </div>


                </div>

        </section>
        </FrontLayout>
</template>


<script>
    import {Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";


    export default {
        name: "Catalog",
        props: ['movies', 'data'],
        components: {Head, Link, FrontLayout},
        mounted() {
            ym(94438576, 'hit', '/search');
        },


    }
</script>



