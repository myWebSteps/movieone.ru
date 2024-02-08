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

                            <movies-card :data="movies" :config = "{classes: 'col-xxl-2 col-xl-3 col-md-4 mb-4'}"></movies-card>

                            <div v-if="movies.length === 0" class="text-muted"><i class="fas fa-search fa-sm"></i> Не нашел
                                фильмов по заданным критериям. Попробуйте облегчить мне задачу
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
    import MoviesCard from "@/Components/MoviesCard.vue";


    export default {
        name: "Catalog",
        props: ['movies', 'data'],
        components: {Head, Link, FrontLayout, MoviesCard},
        mounted() {
            ym(94438576, 'hit', '/search');
        },


    }
</script>



