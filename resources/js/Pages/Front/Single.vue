<template>

    <Head>
        <title>{{movie.nameRu}}/{{movie.nameEn}} Смотреть бесплатно без регистрации</title>
        <meta name="description" :content="movie.description"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>

    <FrontLayout ref="front_layout">
        <!-- Begin Page Content -->
        <div class="container-fluid mobile-container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="cover-pic">
                        <div v-if="comments.total_count >= 3"
                             class="position-absolute bg-white shadow-sm rounded text-center p-2 m-4 love-box min-width">
                            <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i>{{comments.total_count}}
                            </h6>
                            <small class="text-muted">{{comments.score}}</small>
                        </div>
                        <img ref="cover_pic" src="" class="img-fluid w-100"
                             alt="cover picture">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="bg-white p-3 widget shadow rounded mb-4">
                        <div class="d-inline-flex justify-content-center col-xs-12 col-sm-6 col-md-6 col-lg-12 p-0">
                            <img :src="movie.posterUrl" class="img-fluid rounded" :alt="movie.nameEn">
                        </div>
                        <div class="d-inline-block col-xs-12 col-sm-6 col-md-6 col-lg-12 vertical-align-top">
                            <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Продолжительность:</h1>
                            <p>{{movie.filmLength}} мин</p>
                            <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год окончания:</h1>
                            <p>{{movie.endYear}}</p>
                            <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Рейтинг:</h1>
                            <p>{{movie.rate}}</p>
                            <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Ограничения по возрасту:</h1>
                            <p class="mb-0">{{movie.age_limits}}</p>
                            <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">
                                Страны:</h5>
                            <p>
                        <span v-for="country in movie.countries">
                        {{country.title}}&nbsp
                        </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="bg-white info-header shadow rounded mb-4">
                        <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                            <div class="col-lg-7 m-b-4">
                                <h3 v-if="movie.nameRu != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">
                                    {{movie.nameRu}}</h3>
                                <h3 v-if="movie.nameEn != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">
                                    {{movie.nameEn}}</h3>
                                <h3 v-if="movie.nameEn != null" class="text-gray-900 mb-0 mt-0 font-weight-bold mb-1">
                                    <small>2019</small></h3>
                                <p class="mb-0 text-gray-800">
                                    <span class="text-muted"><i class="fa-solid fa-tape mr-2"></i>
                                        <span v-for="genre in movie.genres">
                                        {{genre.title}}&nbsp
                                    </span>
                                    </span></p>
                            </div>
                            <div class="col-lg-5 text-right">
                                <a @click.prevent="copyUrl()" href="#"
                                   class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-share-alt"></i></a>
                                <template v-if="!playlistItems">
                                    <a @click.prevent="togglePlaylist(movie.id)" href="#"
                                       class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> В избранное <i
                                        class="fa-solid fa-square-plus"></i></a>
                                </template>
                                <template v-if="playlistItems">
                                    <a @click.prevent="togglePlaylist(movie.id)" href="#"
                                       class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> Убрать <i
                                        class="fa-solid fa-square-minus"></i></a>
                                </template>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-between py-3 px-4">
                            <div class="col-lg-6 m-b-4">
                                <p v-if="movie.budget" class="mb-0 text-gray-900"><i
                                    class="fas fa-money-bill fa-sm fa-fw mr-1"></i> Бюджет - <span
                                    class="text-white rounded px-2 py-1 bg-info">{{movie.budget}}</span></p>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA=="
                                   class="btn btn-sm btn-danger btn-circle d-inline-flex ml-2">
                                    <i style="font-size: 15px" class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://dzen.ru/movieone"
                                   class="btn btn-sm btn-warning btn-circle d-inline-flex ml-2" target="_blank">
                                    <img class="h-100" src="/img/zen-grey.svg" alt="zen_image">
                                </a>
                                <a href="https://t.me/kino_movieone"
                                   class="btn btn-sm btn-info btn-circle d-inline-flex ml-2">
                                    <i style="font-size: 15px" class="fa-brands fa-telegram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-3 widget shadow rounded mb-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- Home -->
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">Описание</a>
                            </li>
                            <!-- Trailers -->
                            <li @click.prevent="loadTrailers = true" class="nav-item" v-if="movie.trailers.videos_count > 0">
                                <a class="nav-link" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab"
                                   aria-controls="trailer" aria-selected="false">Трейлеры <span
                                    class="badge badge-danger badge-counter">{{movie.trailers.videos_count}}</span></a>
                            </li>
                            <!--Comments-->
                            <li class="nav-item">
                                <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                                   aria-controls="comments" aria-selected="false">Комментарии <span
                                    v-if="comments.total_count > 0" class="badge badge-danger badge-counter">{{comments.total_count}}</span></a>
                            </li>
                            <!-- Reviews -->
                            <li v-if="reviews.total > 0" class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                                   aria-controls="reviews" aria-selected="false">Рецензии <span
                                    class="badge badge-danger badge-counter">{{reviews.total}}</span></a>
                            </li>
                            <!-- Actors -->
                            <li @click="getStaff(movie.kinopoisk_id)" class="nav-item">
                                <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab"
                                   aria-controls="actors" aria-selected="false">Актеры
                                </a>
                            </li>


                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <!-- Home Tab -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div v-if="movie.video_allowed == 1" class="kinobox_player"></div>
                                <article class="mt-2">
                                    <h1 class="text-gray-800">{{movie.slogan}}</h1>
                                    <p class="text-gray-800" v-html="movie.description"></p>
                                </article>
                            </div>

                            <!-- Trailers Tab -->
                            <div v-if="movie.trailers.videos_count > 0" class="tab-pane fade" id="trailer"
                                 role="tabpanel" aria-labelledby="trailer-tab">

                                <div class="row">
                                    <template v-if="movie.trailers.videos_count > 0 && loadTrailers == true"
                                              v-for="trailer in movie.trailers.videos">
                                        <div v-if="trailer.site == 'dzen'" class="mb-4 col-xl-6 col-lg-6">
                                            <iframe width="100%" height="215"
                                                    :src="`${trailer.url}?from_block=partner&from=zen&mute=0&autoplay=0&tv=0`"
                                                    allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media"
                                                    frameborder="0" scrolling="no" allowfullscreen>
                                            </iframe>
                                            <p class="mb-0">{{trailer.name}}</p>
                                        </div>
                                        <div v-else-if="trailer.site == 'youtube'" class="mb-4 col-xl-6 col-lg-6">
                                            <iframe width="100%" height="215" :src="trailer.url" frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            <p class="mb-0">{{trailer.name}}</p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <!-- Trailers Tab -->

                            <!--Comments Tab-->
                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                                <div class="card-body p-0 reviews-card">
                                    <div v-if="comments.comments.length > 0" v-for="comment in comments.comments"
                                         class="media mb-4">
                                        <img class="d-flex mr-3 rounded-circle" src="/img/comment.webp" alt="">
                                        <div class="media-body">
                                            <div class="mt-0 mb-1">
                                                <p class="h6 mr-2 font-weight-bold text-gray-900 d-inline-block">
                                                    {{comment.name}}</p>
                                                <p class="d-inline-block"><i class="fa fa-calendar"></i>
                                                    {{comment.updated_at}}</p>
                                                <p class="stars-rating float-right d-inline-block">
                                                    <template v-for="(item, index) in 5">
                                                        <i :class="comment.rating > index ? 'text-danger' : ''"
                                                           class="fa fa-heart pl-1 fs-6"></i>
                                                    </template>
                                                    <span class="rounded bg-danger text-dark ml-1 pl-1 pr-1 fs-6">{{comment.rating}}/5</span>
                                                </p>
                                            </div>
                                            <p>{{comment.description}}</p>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="d-flex justify-content-center bg-gray-200 no-comments">
                                            <p class="align-self-center p-0 m-0">У этого кино пока нет комментариев.
                                                Будьте первым!</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="p-4 bg-light rounded mt-4">
                                    <h5 class="card-title mb-4">Оставьте комментарий</h5>
                                    <form name="sentMessage" @submit.prevent="leaveComment()">
                                        <div class="row">
                                            <div class="control-group form-group col-lg-4 col-md-4">
                                                <div class="controls">
                                                    <label>Имя: <span class="text-danger">*</span></label>
                                                    <input v-model="commentsForm.name" type="text" class="form-control"
                                                           required="" placeholder="Введите имя">
                                                </div>
                                            </div>
                                            <div class="control-group form-group col-lg-4 col-md-4">
                                                <div class="controls">
                                                    <label>Оценка <span class="text-danger">*</span></label>
                                                    <select required="" v-model="commentsForm.rating"
                                                            class="form-control custom-select">
                                                        <option :value=null disabled selected>Оцените фильм</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Комментарий <span class="text-danger">*</span></label>
                                                <textarea required="" v-model="commentsForm.description" rows="3"
                                                          cols="100" class="form-control"
                                                          placeholder="Напишите комментарий"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--End Comments Tab -->

                            <!-- Actors Tab -->
                            <div class="tab-pane fade" id="actors" role="tabpanel" aria-labelledby="actors-tab">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Режиссеры:</h5>
                                        <div v-for="person in staff.directors" class="artist-list mb-3">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image mr-3">
                                                    <img style="width: 50px; height: 70px" :src="person.posterUrl"
                                                         alt="">
                                                    <div class="status-indicator bg-success"></div>
                                                </div>
                                                <div class="font-weight-bold">
                                                    <div class="text-truncate text-gray-900">{{person.nameRu}}</div>
                                                    <div class="small text-gray-500">{{person.professionText}}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Актеры:</h5>
                                        <div v-for="person in staff.actors" class="artist-list mb-3">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image mr-3">
                                                    <img style="width: 50px; height: 70px" :src="person.posterUrl"
                                                         alt="">
                                                    <div class="status-indicator bg-success"></div>
                                                </div>
                                                <div class="font-weight-bold">
                                                    <div class="text-truncate text-gray-900">{{person.nameRu}}</div>
                                                    <div class="small text-gray-500">{{person.professionText}}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Другие:</h5>
                                        <div v-for="person in staff.support" class="artist-list mb-3">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image mr-3">
                                                    <img style="width: 50px; height: 70px" :src="person.posterUrl"
                                                         alt="">
                                                    <div class="status-indicator bg-success"></div>
                                                </div>
                                                <div class="font-weight-bold">
                                                    <div class="text-truncate text-gray-900">{{person.nameRu}}</div>
                                                    <div class="small text-gray-500">{{person.professionText}}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Actors Tab End -->

                            <!-- Reviews Tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="card-body p-0 reviews-card">

                                    <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                        <ul class="pagination">
                                            <li v-if="currentPage != 1" class="page-item">
                                                <a @click.prevent="getReviews(String(currentPage - 1))"
                                                   class="page-link" href="#" aria-label="Previous">
                                                    <div aria-hidden="true">&laquo;</div>
                                                </a>
                                            </li>
                                            <li v-for="page in reviews.totalPages" class="page-item"
                                                :class="page == currentPage? 'active' : ''">
                                                <template
                                                    v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                                    <a @click.prevent="getReviews(page)"
                                                       :class="page == currentPage? 'active' : ''" class="page-link"
                                                       href="#" :value="page">{{page}}</a>
                                                </template>
                                                <template
                                                    v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                    <div class="page-link">...</div>
                                                </template>
                                            </li>

                                            <li class="page-item">
                                                <a v-if="currentPage != reviews.totalPages"
                                                   @click.prevent="getReviews(String(currentPage + 1))"
                                                   class="page-link" href="#" aria-label="Next">
                                                    <div aria-hidden="true">&raquo;</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>

                                    <div v-for="review in reviews.items" class="media mb-4">
                                        <div class="media-body">
                                            <div class="mt-0 mb-2">
                                                <div class="h6 mr-2 text-muted text-gray-500">{{review.author}}</div>
                                            </div>
                                            <div class="mt-0 mb-2 d-inline">
                                                <div class="h6 mr-2 font-weight-bold text-gray-900 d-inline">
                                                    {{review.title}}
                                                </div>
                                            </div>
                                            <div v-if="review.type == 'POSITIVE'" class="mt-0 mb-2 d-inline">
                                                <div class="h6 mr-2 font-weight-bold text-success d-inline"><i
                                                    class="fa fa-thumbs-up" aria-hidden="true"></i></div>
                                            </div>
                                            <div v-if="review.type == 'NEGATIVE'" class="mt-0 mb-2 d-inline">
                                                <div class="h6 mr-2 font-weight-bold text-danger d-inline"><i
                                                    class="fa fa-thumbs-down" aria-hidden="true"></i></div>
                                            </div>
                                            <div class="mt-2 mb-2">
                                                <p v-html="review.description"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                        <ul class="pagination">
                                            <li v-if="currentPage != 1" class="page-item">
                                                <a @click.prevent="getReviews(String(currentPage - 1))"
                                                   class="page-link" href="#" aria-label="Previous">
                                                    <div aria-hidden="true">&laquo;</div>
                                                </a>
                                            </li>
                                            <li v-for="page in reviews.totalPages" class="page-item"
                                                :class="page == currentPage? 'active' : ''">
                                                <template
                                                    v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                                    <a @click.prevent="getReviews(page)" class="page-link" href="#"
                                                       :value="page">{{page}}</a>
                                                </template>
                                                <template
                                                    v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                    <div class="page-link">...</div>
                                                </template>
                                            </li>

                                            <li class="page-item">
                                                <a v-if="currentPage != reviews.totalPages"
                                                   @click.prevent="getReviews(String(currentPage + 1))"
                                                   class="page-link" href="#" aria-label="Next">
                                                    <div aria-hidden="true">&raquo;</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Related Movies -->
            <template v-if="relatedMovies.length > 0">
                <div class="bg-white info-header shadow rounded mb-4">
                    <div class="row d-flex align-content-center-start justify-content-start p-3 border-bottom">
                        <h6 class="text-gray-900 m-2 font-weight-bold">Похожие фильмы:</h6>
                    </div>
                    <div class="row col-12 mt-3 d-flex justify-content-center row-gap-3">
                        <div v-for="relatedMovie in relatedMovies" class="col-xl-3 col-md-3 col-sm-4 col-9 col-6 mb-3">

                            <div class="card m-card shadow border-0">
                                <Link :href="`/movies/${relatedMovie.slug}`">
                                    <div class="m-card-cover">
                                        <img v-lazy="relatedMovie.poster" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body p-3">
                                        <h5 class="card-title text-gray-900 mb-1">{{relatedMovie.nameRu}}</h5>
                                        <h5 class="card-title text-gray-900 mb-1">{{relatedMovie.nameEn}}</h5>
                                        <p class="card-text mb-0">
                                            <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                            <span v-for="genre in relatedMovie.genres" class="text-muted">
                                                {{genre.title}} &nbsp
                                            </span></p>
                                        <p class="card-text text-danger"><i
                                            class="fas fa-calendar-alt fa-sm text-gray-400"></i>
                                            {{relatedMovie.year}}</p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

        </div>
        <!-- /.container-fluid -->

    </FrontLayout>

</template>

<script>
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import {Head} from "@inertiajs/vue3";
    import {Link} from "@inertiajs/vue3";
    import {router} from '@inertiajs/vue3';
    import Swal from 'sweetalert2';


    export default {
        name: "Single",
        props: ['movie', 'comments', 'relatedMovies'],
        components: {Head, Link, FrontLayout},

        data() {
            return {
                loadTrailers: false,
                comment_errors: '',
                staff: {},
                reviews: {},
                playlist: [],
                playlistItems: null,
                playlistRes: [],
                newFilter: [],
                currentPage: 1,
                commentsForm: {
                    name: null,
                    rating: null,
                    description: null,
                }
            }
        },

        mounted() {
            this.getReviews()
            this.togglePlaylistButton()
            this.loadCover()



            if (this.movie.video_allowed == 1) {
                new Kinobox('.kinobox_player', {
                    'X-Settings': {
                        "Alloha": {
                            "enable": true,
                            "position": 1,
                            "token": "",
                        },
                        "Ashdi": {
                            "enable": true,
                            "position": 2,
                            "token": "",
                        },
                        "Bazon": {
                            "enable": true,
                            "position": 3,
                            "token": "",
                        },
                        "Cdnmovies": {
                            "enable": true,
                            "position": 4,
                            "token": "",
                        },
                        "Collaps": {
                            "enable": true,
                            "position": 5,
                            "token": "",
                        },
                        "Hdvb": {
                            "enable": true,
                            "position": 6,
                            "token": "",
                        },
                        "Iframe": {
                            "enable": true,
                            "position": 7,
                            "token": "",
                        },
                        "Kodik": {
                            "enable": true,
                            "position": 8,
                            "token": "",
                        },
                        "Videocdn": {
                            "enable": true,
                            "position": 9,
                            "token": "",
                        },
                        "Voidboost": {
                            "enable": true,
                            "position": 10,
                            "token": "",
                        },

                    },
                    search: {
                        kinopoisk: this.movie.kinopoisk_id,
                        title: this.movie.nameEn
                    }
                }).init();
            }

            ym(94438576, 'hit', `/movies/${this.movie.slug}`);
        },

        methods: {
            loadCover(){
                if(this.movie.backdropUrl == null)
                {
                    this.movie.backdropUrl = "/img/poster.webp"
                }
                this.$refs.cover_pic.src = this.movie.backdropUrl
            },

            leaveComment() {
                router.post('/add_comment', {
                    movie_id: this.movie.id,
                    name: this.commentsForm.name,
                    rating: this.commentsForm.rating,
                    description: this.commentsForm.description,
                }, {
                    preserveScroll: true,
                })
                router.on('error', (error) => {
                    for(let key in error.detail.errors){
                        this.comment_errors += `<div>${error.detail.errors[key]}</div>`
                    }
                    Swal.fire({
                        title: `Возникли ошибки`,
                        icon: "info",
                        html: `${this.comment_errors}`,
                        showCloseButton: true,
                    });
                })
                router.on('success', () => {

                    Swal.fire({
                        icon: "success",
                        title: "Отзыв отослан",
                        text: "Он появится после модерации",
                    });

                    setTimeout(this.flushSuccess, 2500)
                    this.commentsForm.name = null
                    this.commentsForm.rating = null
                    this.commentsForm.description = null
                })

            },

            togglePlaylistButton() {
                if (localStorage.getItem('playlist')) {
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if (this.playlistRes.includes(String(this.movie.id))) {
                        this.playlistItems = true;
                    } else {
                        this.playlistItems = false;
                    }
                }
            },

            togglePlaylist(id) {
                if (!localStorage.getItem('playlist')) {
                    this.playlistRes.push(id)
                    localStorage.setItem('playlist', this.playlistRes)
                    this.$refs.front_layout.playListCount()
                    this.$refs.front_layout.makePlaylist()
                    this.playlistItems = true;
                } else {
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if (this.playlistRes.includes(String(id))) {
                        this.playlistRes = this.playlistRes.filter(elem => {
                            if (elem != id) {
                                return elem
                            }
                        })
                        if (this.playlistRes == '') {
                            localStorage.removeItem('playlist', '')
                            this.$refs.front_layout.playListCount()
                            this.$refs.front_layout.makePlaylist()
                            this.playlistItems = false;
                        } else {
                            localStorage.setItem('playlist', this.playlistRes)
                            this.$refs.front_layout.playListCount()
                            this.$refs.front_layout.makePlaylist()
                            this.playlistItems = false;
                        }


                    } else {
                        this.playlistRes.push(id)
                        localStorage.setItem('playlist', this.playlistRes)
                        this.$refs.front_layout.playListCount()
                        this.$refs.front_layout.makePlaylist()
                        this.playlistItems = true;
                    }
                }
            },

            getStaff() {
                axios.get(`https://kinopoiskapiunofficial.tech/api/v1/staff?filmId=${this.movie.kinopoisk_id}`,
                    {
                        headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }
                    }
                ).then(resp => {

                    this.staff.directors = resp.data.filter((elem, index) => {
                        return elem.professionKey == 'DIRECTOR'
                    })
                    this.staff.actors = resp.data.filter((elem, index) => {
                        return elem.professionKey == 'ACTOR'
                    })
                    this.staff.support = resp.data.filter((elem, index) => {
                        return elem.professionKey !== 'DIRECTOR' && elem.professionKey !== 'ACTOR'
                    })

                })
            },

            getReviews(page = 1) {

                axios.get(`https://kinopoiskapiunofficial.tech/api/v2.2/films/${this.movie.kinopoisk_id}/reviews?page=${page}&order=DATE_DESC`,
                    {
                        headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }

                    })
                    .then(r => {
                        this.reviews = r.data
                        this.currentPage = page
                    })
            },

            copyUrl() {
                navigator.clipboard.writeText(window.location.href)
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Ссылка на видео успешно скопирована",
                    showConfirmButton: false,
                    timer: 1500
                });

            },


        },


    }
</script>
