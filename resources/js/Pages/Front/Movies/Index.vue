<template>

    <Head>
        <title>MovieOne.ru | Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>

    <FrontLayout>

        <div class="container-fluid">
        <!-- Begin Page Content -->
        <!-- Page Heading -->
        <section class="d-flex w-100 align-items-center justify-content-between mt-4 mb-3">
            <h1 class="h5 d-inline-block mb-0 text-gray-900">{{category.title}}</h1>
            <Link :href="`/movies?category=${data.category}&order=year&page=1`"
                  class="d-inline-block btn btn-sm btn-primary shadow-sm">
                Сбросить фильтр <i class="fas fa-times fa-sm text-white-50"></i>
            </Link>
        </section>

        <!-- Filter Row -->
        <section class="row">

            <div class="col-xl-3 col-lg-4">

                <filter-component
                    :form="form"
                    :genres="genres"
                    :totalCount="totalCount"
                    :typesCount="typesCount"
                    :category="category"
                    :data="data"
                    :originalYearFrom="originalYearFrom"
                    :originalYearTo="originalYearTo"
                    :countries="countries"
                    @interface="send()"
                >
                </filter-component>

            </div>

            <!-- Movies -->
            <div class="col-xl-9 col-lg-8">
                <div class="row">

                    <movies-card
                        :data="movies.data"
                        :config = "{classes: 'col-xxl-3 col-xl-4 col-md-4 mb-4'}"
                    >
                    </movies-card>

                    <div v-if="movies.length === 0" class="text-muted"><i class="fas fa-search fa-sm"></i> Не нашел
                        фильмов по заданным критериям. Попробуйте облегчить мне задачу
                    </div>
                </div>
            </div>
            <!-- End Movies -->
        </section>


        <!-- Pagination Row -->
            <pagination-component
                :data="movies"
                :form="form"
                @interface="send()"
            >
            </pagination-component>
        <!-- End Pagination Row -->

        </div>

    </FrontLayout>
</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import MoviesCard from "@/Components/MoviesCard.vue";
    import FilterComponent from "@/Components/FilterComponent.vue";
    import PaginationComponent from "@/Components/PaginationComponent.vue";


    export default {
        name: "Index",
        props: ['genres', 'totalCount', 'typesCount', 'movies', 'category', 'data', 'originalYearFrom', 'originalYearTo', 'countries'],
        components: {Head, Link, FrontLayout, MoviesCard, FilterComponent, PaginationComponent},

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

        methods: {

            makeQueryArr() {
                for (let key in this.form) {
                    if (this.form[key] !== null && this.form[key] !== '') {
                        this.queryArr[key] = this.form[key]
                    }
                }
            },

            send() {

                this.makeQueryArr()
                router.get('/movies',
                    {
                        category: this.queryArr.category,
                        type: this.queryArr.type,
                        genre: this.queryArr.genre,
                        country: this.queryArr.country,
                        order: this.queryArr.order,
                        page: this.queryArr.page,
                        genres_filter: this.queryArr.genres_filter,
                        countries_filter: this.queryArr.countries_filter,
                        yearFrom: this.queryArr.yearFrom,
                        yearTo: this.queryArr.yearTo,
                    },
                    {preserveScroll: true});
            },



        }


    }
</script>


