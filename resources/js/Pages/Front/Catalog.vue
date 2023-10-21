<template>

    <Head>
        <title>MovieOne.ru | Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="Каталог фильмов, мультфильмов, анимэ онлайн бесплатно без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>

    <FrontLayout>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Content Row -->
                <div class="row">
                    <div class="row w-100 mb-3 pl-3 pr-3">

                        <!-- Page Heading -->
                        <div class="ml-3 d-sm-flex align-items-center justify-content-between pt-4 mb-4">
                            <h1 class="h5 mb-0 text-gray-900">{{category.title}}</h1>
                        </div>

                        <div class="col-xl-3 col-sm-8 d-inline">
                            <label>Тип:</label>
                            <select @change="send()" v-model="form.type" style="width: 100%" class="form-select">
                                <option :value=null>Кино и сериалы</option>
                                <option value="2">Кино</option>
                                <option value="3">Сериалы</option>
                                <option value="4">Мини сериалы</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-sm-8 d-inline">
                            <label for="genres">Жанр:</label>
                            <select @change="send()" v-model="form.genre" id="genres" class="form-select mb-1" aria-label="Default select example">
                                <option :value=null>Все жанры</option>
                                <option v-for="genre in genres" :value="genre.id">{{genre.title}}</option>

                            </select>
                        </div>

                        <div class="col-xl-3 col-sm-8 d-inline">
                            <label for="order">Сортировать по:</label>
                            <select @change="send()" v-model="form.order" id="order" class="form-select mb-1" aria-label="Default select example">
                                <option value="year">Год</option>
                                <option value="rate">Рейтинг</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-8">
                        <div class="row">
                            <div v-for="movie in movies.data" class="col-xl-3 col-md-6 mb-4 col-sm-6">

                                <div  class="card e-card shadow border-0">
                                    <Link :href="`/movies/${movie.data.slug}`">
                                        <div class="m-card-cover">
                                            <img :src="movie.data.posterUrl" class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2 auto py-3 pl-3">
                                                    <div class="bg-white rounded text-center">
                                                        <h6 class="text-danger mb-0 font-weight-bold">{{movie.data.year}}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-10 p-3">
                                                    <p v-if="movie.data.nameRu != null" class="card-text text-gray-900 mb-1">{{movie.data.nameRu}}</p>
                                                    <p v-if="movie.data.nameEn != null" class="card-text text-gray-900 mb-1">{{movie.data.nameEn}}</p>
                                                    <p class="card-text">
                                                        <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                                        <small v-for="genre in movie.data.genres" class="text-muted">
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

                    <div class="row d-grid justify-content-end">
                    <nav v-if="movies.last_page > 1" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a @click.prevent="changePage(movies.current_page - 1)" class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li v-for="link in movies.links" class="page-item">
                            <template v-if="Number(link.label) &&
                            (movies.current_page - link.label < 3 &&
                            movies.current_page - link.label > -3) ||
                            Number(link.label) === 1 || Number(link.label) === movies.last_page
                            ">
                                <a @click.prevent="changePage(link.label)" :class="link.active? 'active' : ''" class="page-link" href="#">{{link.label}}</a>
                            </template>
                            <template v-if="Number(link.label) &&
                            movies.current_page != 4 &&
                            (movies.current_page - link.label === 3) ||
                            Number(link.label) &&
                            movies.current_page != movies.last_page - 3 &&
                            (movies.current_page - link.label === -3)">
                                <span class="page-link">...</span>
                            </template>
                            </li>
                            <li v-if="movies.current_page != movies.last_page" class="page-item">
                                <a @click.prevent="changePage(movies.current_page + 1)" class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    </div>
                </div>


                </div>

        </section>

    </FrontLayout>
</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";


    export default {
        name: "Catalog",
        props: ['genres', 'movies', 'category', 'data'],
        components: {Head, Link, FrontLayout},

        data(){
            return{
                form: {
                    category: this.data.category,
                    type: this.data.type,
                    genre: this.data.genre,
                    order: this.data.order,
                    page: this.data.page,
                }
            }
        },

        mounted() {

            ym(94438576, 'hit', '/movies');
        },

        methods:{
            send(){
                router.get('/movies', this.form);
            },

            changePage(page){
                this.form.page = page
                this.send();
            }


        }


    }
</script>


