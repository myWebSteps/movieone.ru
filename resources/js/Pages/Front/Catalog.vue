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
                <!-- Mobile Filters -->
                <div class="filters mobile-filters shadow rounded bg-white mb-4 d-xs-block d-sm-none">
                    <div class="border-bottom">
                        <a class="h6 font-weight-bold text-dark d-block m-0 p-3" data-toggle="collapse" href="#mobile-filters" role="button" aria-expanded="false" aria-controls="mobile-filters">
                            Фильтр
                            <i class="fas fa-angle-down float-right mt-1"></i></a>
                    </div>
                    <div id="mobile-filters"
                         :class="form.type || form.genre || form.genres_filter != null ? 'show' : ''"
                         class="filters-body collapse multi-collapse">
                        <div id="accordion">
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOffer">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseSort" aria-expanded="true" aria-controls="collapseSort">
                                            Тип: <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseSort" :class="form.type != null ? 'show' : ''" class="collapse" aria-labelledby="headingOffer" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   name="types_filter_mobile" class="custom-control-input" :value=null
                                                   id="all_types_mobile">
                                            <label class="custom-control-label" for="all_types_mobile">Кино и Сериалы
                                                <small class="text-black-50">{{allTypesCount}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="feature"
                                                   name="types_filter_mobile" class="custom-control-input" id="feature">
                                            <label class="custom-control-label" for="feature">Полнометражные <small
                                                class="text-black-50">{{typesCount.feature}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="serial"
                                                   name="types_filter_mobile" class="custom-control-input" id="serial">
                                            <label class="custom-control-label" for="serial">Сериалы <small
                                                class="text-black-50">{{typesCount.serial}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="mini_serial"
                                                   name="types_filter_mobile"
                                                   class="custom-control-input" id="mini_serial">
                                            <label class="custom-control-label" for="mini_serial">Мини сериалы
                                                <small
                                                    class="text-black-50">{{typesCount.mini_serial}}</small></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                            Жанры:
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapsetwo" :class="form.genre || form.genres_filter != null ? 'show' : ''"
                                     class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <form class="mb-3">
                                            <div class="input-group rounded">
                                                <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                                       type="search" class="form-control" placeholder="Поиск жанра..."
                                                       aria-label="Search" aria-describedby="search-addon"/>
                                                <button @click.prevent="send()" class="btn btn-outline-primary"
                                                        id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <div>
                                            <div class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       name="genres_filter_mobile" class="custom-control-input" :value=null
                                                       id="all_genres_mobile">
                                                <label class="custom-control-label" for="all_genres">Все жанры <small
                                                    class="text-black-50">{{allGenresCount}}</small></label>
                                            </div>
                                            <div v-for="genre in genres" class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       :value="genre.genre.slug"
                                                       name="genres_filter_mobile"
                                                       class="custom-control-input" :id="genre.genre.slug">
                                                <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                                    <small class="text-black-50">{{genre.genresCount}}</small></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOne">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Сортировать по: <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne" :class="form.order != null? 'show': ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter_mobile" class="custom-control-input" value=year
                                                   id="year">
                                            <label class="custom-control-label" for="year">Год</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter_mobile" class="custom-control-input" value=rate
                                                   id="rate">
                                            <label class="custom-control-label" for="rate">Рейтинг</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Mobile Filters -->

                <!-- Pad Filter -->
                <div class="filters shadow rounded bg-white mb-3 d-none d-xs-none d-sm-block d-md-block d-lg-none">
                    <div class="filters-header border-bottom p-3">
                        <h6 class="m-0 text-dark">Фильтр</h6>
                    </div>
                    <div class="filters-body">
                        <div id="accordion">
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                            Тип:
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapsetwo" :class="form.type != null ? 'show' : ''" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   name="types_filter_pad" class="custom-control-input" :value=null
                                                   id="all_types_pad">
                                            <label class="custom-control-label" for="all_types_pad">Кино и Сериалы
                                                <small class="text-black-50">{{allTypesCount}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="feature"
                                                   name="types_filter_pad" class="custom-control-input" id="feature">
                                            <label class="custom-control-label" for="feature">Полнометражные <small
                                                class="text-black-50">{{typesCount.feature}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="serial"
                                                   name="types_filter_pad" class="custom-control-input" id="serial">
                                            <label class="custom-control-label" for="serial">Сериалы <small
                                                class="text-black-50">{{typesCount.serial}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="mini_serial"
                                                   name="types_filter_pad"
                                                   class="custom-control-input" id="mini_serial">
                                            <label class="custom-control-label" for="mini_serial">Мини сериалы
                                                <small
                                                    class="text-black-50">{{typesCount.mini_serial}}</small></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOne">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Жанры:
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne" :class="form.genres_filter || form.genre != null ? 'show' : ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <form class="mb-3">
                                            <div class="input-group rounded">
                                                <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                                       type="search" class="form-control" placeholder="Поиск жанра..."
                                                       aria-label="Search" aria-describedby="search-addon"/>
                                                <button @click.prevent="send()" class="btn btn-outline-primary"
                                                        id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <div>
                                            <div class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       name="genres_filter_pad" class="custom-control-input" :value=null
                                                       id="all_genres_pad">
                                                <label class="custom-control-label" for="all_genres_pad">Все жанры <small
                                                    class="text-black-50">{{allGenresCount}}</small></label>
                                            </div>
                                            <div v-for="genre in genres" class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       :value="genre.genre.slug" name="genres_filter_pad"
                                                       class="custom-control-input" :id="genre.genre.slug">
                                                <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                                    <small class="text-black-50">{{genre.genresCount}}</small></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOffer">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
                                            Сортировать по: <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOffer" class="collapse show" aria-labelledby="headingOffer" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter_pad" class="custom-control-input" value=year
                                                   id="year">
                                            <label class="custom-control-label" for="year">Год</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter_pad" class="custom-control-input" value=rate
                                                   id="rate">
                                            <label class="custom-control-label" for="rate">Рейтинг</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Pad Filter -->

                <!-- Laptop Filters -->
                <div class="filters shadow rounded bg-white mb-3 d-none d-xs-none d-sm-none d-md-none d-lg-block">
                    <div class="filters-header border-bottom p-3">
                        <h6 class="m-0 text-dark">Фильтр</h6>
                    </div>
                    <div class="filters-body">
                        <div id="accordion">
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                            Тип:
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapsetwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   name="types_filter" class="custom-control-input" :value=null
                                                   id="all_types_laptop">
                                            <label class="custom-control-label" for="all_types_laptop">Кино и Сериалы
                                                <small class="text-black-50">{{allTypesCount}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="feature"
                                                   name="types_filter" class="custom-control-input" id="feature">
                                            <label class="custom-control-label" for="feature">Полнометражные <small
                                                class="text-black-50">{{typesCount.feature}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="serial"
                                                   name="types_filter" class="custom-control-input" id="serial">
                                            <label class="custom-control-label" for="serial">Сериалы <small
                                                class="text-black-50">{{typesCount.serial}}</small></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.type" type="radio"
                                                   value="mini_serial" name="types_filter"
                                                   class="custom-control-input" id="mini_serial">
                                            <label class="custom-control-label" for="mini_serial">Мини сериалы
                                                <small
                                                    class="text-black-50">{{typesCount.mini_serial}}</small></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOne">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Жанры:
                                            <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <form class="mb-3">
                                            <div class="input-group rounded">
                                                <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                                       type="search" class="form-control" placeholder="Поиск жанра..."
                                                       aria-label="Search" aria-describedby="search-addon"/>
                                                <button @click.prevent="send()" class="btn btn-outline-primary"
                                                        id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <div>
                                            <div class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       name="genres_filter" class="custom-control-input" :value=null
                                                       id="all_genres">
                                                <label class="custom-control-label" for="all_genres">Все жанры <small
                                                    class="text-black-50">{{allGenresCount}}</small></label>
                                            </div>
                                            <div v-for="genre in genres" class="custom-control custom-radio">
                                                <input @change.prevent="send()" v-model="form.genre" type="radio"
                                                       :value="genre.genre.slug" name="genres_filter"
                                                       class="custom-control-input" :id="genre.genre.slug">
                                                <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                                    <small class="text-black-50">{{genre.genresCount}}</small></label>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-3">
                                <div class="filters-card-header" id="headingOffer">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
                                            Сортировать по: <i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOffer" class="collapse show" aria-labelledby="headingOffer" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter" class="custom-control-input" value=year
                                                   id="year">
                                            <label class="custom-control-label" for="year">Год</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input @change.prevent="send()" v-model="form.order" type="radio"
                                                   name="order_filter" class="custom-control-input" value=rate
                                                   id="rate">
                                            <label class="custom-control-label" for="rate">Рейтинг</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Laptop Filters -->

               </div>

            <!-- Movies -->
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <div v-if="movies.data.length > 0" v-for="movie in movies.data" class="col-xl-4 col-md-6 mb-4">
                        <div class="card m-card shadow border-0">
                            <Link :href="`/movies/${movie.data.slug}`">
                                <div class="m-card-cover">
                                    <img v-lazy="movie.data.posterUrl" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                            <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.data.nameRu}}</h5>
                                            <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.data.nameEn}}</h5>
                                            <p class="card-text mb-0">
                                                <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                                <span v-for="genre in movie.data.genres" class="text-muted">
                                                    {{genre.title}} &nbsp
                                                </span></p>
                                            <p class="card-text text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> {{movie.data.year}}</p>
                                </div>
                            </Link>
                        </div>
                    </div>
                    <div v-if="movies.data.length === 0" class="text-muted"><i class="fas fa-search fa-sm"></i> Не нашел
                        фильмов по заданным критериям. Попробуйте облегчить мне задачу
                    </div>
                </div>
            </div>
            <!-- End Movies -->
        </section>
        <!-- Pagination Row -->
        <section class="row d-flex justify-content-center">
                <nav v-if="movies.last_page > 1" aria-label="Page navigation example">
                    <ul class="pagination">
                        <template v-if="movies.current_page != 1">
                        <li v-if="movies.current_page != 1" class="page-item">
                            <a @click.prevent="changePage(movies.current_page - 1)" class="page-link" href="#"
                               aria-label="Previous">
                                <div aria-hidden="true">&laquo;</div>
                            </a>
                        </li>
                        </template>
                        <template v-for="link in movies.links" >
                           <li v-if="Number(link.label) &&
                            (movies.current_page - link.label < 3 &&
                            movies.current_page - link.label > -3) ||
                            Number(link.label) === 1 || Number(link.label) === movies.last_page
                            " class="page-item" :class="link.active? 'active' : ''">
                                <a @click.prevent="changePage(link.label)"
                                   class="page-link" href="#">{{link.label}}</a>
                            </li>
                            <li v-if="Number(link.label) &&
                            movies.current_page != 4 &&
                            (movies.current_page - link.label === 3) ||
                            Number(link.label) &&
                            movies.current_page != movies.last_page - 3 &&
                            (movies.current_page - link.label === -3)">
                                <div class="page-link">...</div>
                            </li>
                        </template>
                        <template v-if="movies.current_page != movies.last_page">
                        <li v-if="movies.current_page != movies.last_page" class="page-item">
                            <a @click.prevent="changePage(movies.current_page + 1)" class="page-link" href="#"
                               aria-label="Next">
                                <div aria-hidden="true">&raquo;</div>
                            </a>
                        </li>
                        </template>
                    </ul>
                </nav>
        </section>
        <!-- End Pagination Row -->

        </div>
    </FrontLayout>
</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";


    export default {
        name: "Catalog",
        props: ['genres', 'allGenresCount', 'allTypesCount', 'typesCount', 'movies', 'category', 'data'],
        components: {Head, Link, FrontLayout},

        data() {
            return {
                queryArr: {},
                form: {
                    category: this.data.category,
                    type: this.data.type,
                    genre: this.data.genre,
                    order: this.data.order,
                    page: this.data.page,
                    genres_filter: this.data.genres_filter,
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
                router.get('/movies', this.queryArr, {preserveScroll: true});
            },

            changePage(page) {
                this.form.page = page
                this.send();
            },

        }


    }
</script>


