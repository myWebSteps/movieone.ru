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
                        <h1 class="h5 mb-0 text-gray-900">Результаты запроса: {{this.route().params.key}}</h1>
                    </div>

                    <div class="col-xl-12 col-lg-8 mt-4">

                        <div class="row">
                            <div v-for="movie in movies" class="col-xl-3 col-md-6 mb-4 col-sm-6">
                                <div  class="card e-card shadow border-0">
                                    <Link :href="this.route('single.index', {movie: movie.id})">
                                        <div class="m-card-cover">
                                            <img :src="movie.posterUrl" class="card-img-top" alt="...">
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
        props: ['movies'],
        components: {Head, Link, FrontLayout},



    }
</script>



