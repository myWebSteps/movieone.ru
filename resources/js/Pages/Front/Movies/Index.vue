<template>

    <Head>
        <title>MovieOne.ru | Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>


        <section class="mx-2 grid grid-rows-[70px,_calc(100%-140px),_70px]">
        <!-- Begin Page Content -->
        <!-- Page Heading -->
        <div class="grid grid-flow-col content-center">
            <h1 class="justify-self-start text-gray-900">{{category.title}}</h1>
            <Link @click.prevent="$parent.$refs.filter.flush()" :href="`/movies?category=${data.category}&order=year&page=1`"
                  class="justify-self-end hidden md:block">
                <p class="grid pr-4 grid-flow-col items-center
                hover:text-rose-500
                ">
                    <span>Сбросить фильтр</span>
                    <i class="icon-filter_alt_off font-bold hover:text-rose-500"></i>
                </p>
            </Link>
        </div>

        <div v-if="movies.data.length > 0">
                <movies-card
                    :data="movies.data"
                    :config = "{classes: ''}">
                </movies-card>
            </div>
        <div v-else class="grid grid-flow-col auto-cols-[max-content,_minmax(50,_200px)] justify-self-center items-start gap-2">
                <i class="icon-troubleshoot"></i>
                <span class="font-light">Не нашел фильмов по заданным критериям. Попробуйте облегчить мне задачу</span>
            </div>


        <!-- Pagination Row -->
            <pagination-component
                class="self-center justify-self-center"
                :data="movies"
                :form.sync="form"
                @interface="$parent.$refs.filter.send(form.page)"
            >
            </pagination-component>
        <!-- End Pagination Row -->

        </section>

</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import MoviesCard from "@/Components/MoviesCard.vue";
    import FilterComponent from "@/Components/FilterComponent.vue";
    import PaginationComponent from "@/Components/PaginationComponent.vue";
    import FrontLayout from "@/Layouts/FrontLayout.vue"


    export default {
        name: "Index",
        layout: FrontLayout,
        props: ['genres', 'totalCount', 'typesCount', 'movies', 'category', 'data', 'originalYearFrom', 'originalYearTo', 'countries'],
        components: {Head, Link, MoviesCard, FilterComponent, PaginationComponent},

        data() {
            return {
                queryArr: {},
                form: {
                    category: this.data.category,
                    type: this.data.type,
                    genre: this.data.genre,
                    country: this.data.country,
                    order: this.data.order,
                    page: this.data.page,
                    genres_filter: this.data.genres_filter,
                    countries_filter: this.data.countries_filter,
                    yearFrom: this.data.yearFrom,
                    yearTo: this.data.yearTo,
                },
            }
        },

        mounted() {
            ym(94438576, 'hit', '/movies');
        },

    }
</script>


