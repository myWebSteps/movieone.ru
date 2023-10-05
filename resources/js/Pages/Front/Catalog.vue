<template>
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
                                <option value="">Кино и сериалы</option>
                                <option value="2">Кино</option>
                                <option value="3">Сериалы</option>
                                <option value="4">Мини сериалы</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-sm-8 d-inline">
                            <label for="genres">Жанр:</label>
                            <select @change="send()" v-model="form.genre" id="genres" class="form-select mb-1" aria-label="Default select example">
                                <option value="">Все жанры</option>
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
                                    <Link :href="this.route('single.index', {movie: movie.data.id})">
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

                    <nav v-if="movies.last_page > 1" aria-label="Page navigation example" class="d-grid justify-content-md-center">
                        <ul class="pagination">

                            <li v-for="page in movies.links" class="page-item">
                                <template v-if="Number(page.label)">
                                    <a @click="changePage(page.label)" :class="page.label == this.route().params.page ? 'active' : ''" class="page-link" href="#">{{page.label}}</a>
                                </template>
                            </li>


                        </ul>
                    </nav>
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
        props: ['genres', 'movies', 'category'],
        components: {Head, Link, FrontLayout},

        data(){
            return{
                form: {
                    category: this.route().params.category,
                    type: this.route().params.type,
                    genre: this.route().params.genre,
                    order: this.route().params.order,
                    page: this.route().params.page,
                }
            }
        },

        methods:{
            send(){
                router.get('/movies', this.form);
            },

            changePage(page){
                form.page = page
                this.send();
            }


        }


    }
</script>


