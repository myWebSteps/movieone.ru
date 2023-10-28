<template>

    <Head>
        <title>{{movie.nameRu}}/{{movie.nameEn}} Смотреть бесплатно без регистрации</title>
        <meta name="description" :content="movie.description" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>

    <FrontLayout ref="front_layout">
    <!-- Begin Page Content -->

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12 bg-white shadow mb-4">
                <a href="https://t.me/kino_movieone" target="_blank">
                <!--Постер Рекламы-->
                    <img src="/img/poster.webp" class="img-fluid w-100" alt="promo poster">
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-12">
                <div class="bg-white p-3 widget shadow- rounded mb-4">
                    <div class="row">

                    <div class="col-sm-6 col-xl-12 col-lg-12">

                        <img :src="movie.posterUrl" class="img-fluid rounded" :alt="movie.nameEn">
                    </div>
                    <div class="col-sm-6 col-xl-12 col-lg-12">
                        <h5 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Продолжительность:</h5>
                        <p>{{movie.filmLength}} мин</p>
                        <!--                    <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год выпуска:</h1>-->
                        <!--                    <p>{{movie.year}}</p>-->
                        <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год окончания:</h5>
                        <p>{{movie.endYear}}</p>
                        <h5 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Рейтинг:</h5>
                        <p>{{movie.rate}}</p>
                        <h5 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Ограничения по возрасту:</h5>
                        <p>{{movie.age_limits}}</p>
                        <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Страны:</h5>
                        <p>
                        <span v-for="country in movie.countries">
                        {{country.title}}&nbsp
                        </span>
                        </p>
                    </div>

                    </div>


                </div>
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="bg-white info-header shadow rounded mb-4">
                    <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                        <div class="col-lg-7 m-b-4">
                            <h3 v-if="movie.nameRu != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameRu}}</h3>
                            <h3 v-if="movie.nameEn != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameEn}}</h3>
                            <h5 class="mt-0 mb-3 mt-2">{{movie.slogan}}</h5>

                            <p class="mb-0 text-gray-800">
                                <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i>
                                    <span v-for="genre in movie.genres">
                                        {{genre.title}}&nbsp
                                    </span>
                                </small></p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <a @click.prevent="copyUrl()" href="#" class="d-sm-inline-block btn btn-primary shadow-sm mr-2"><i class="fa-regular fa-copy"></i></a>

                            <template v-if="!playlistItems">
                                <a @click.prevent="togglePlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm"> В избранное <i class="fa-solid fa-square-plus"></i></a>
                            </template>
                            <template v-if="playlistItems">
                                <a @click.prevent="togglePlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm"> Убрать <i class="fa-solid fa-square-minus"></i></a>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 widget shadow rounded mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Описание</a>
                        </li>
                        <!-- Trailers -->
                        <li class="nav-item" v-if="movie.trailer">
                            <a class="nav-link" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer" aria-selected="false">Трейлеры</a>
                        </li>
                        <!-- Actors -->
                        <li @click="getStaff(movie.kinopoisk_id)" class="nav-item">
                            <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab" aria-controls="actors" aria-selected="false">Актеры
                            </a>
                        </li>
                        <!-- Reviews -->
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Рецензии<span class="badge badge-danger badge-counter ml-1">{{reviews.total}}</span></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Home Tab -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div v-if="movie.video_allowed == 1" class="kinobox_player"></div>

                            <article class="mt-2">
                                <h1 class="text-gray-800">{{movie.nameRu}} / {{movie.nameEn}}</h1>
                                <p class="text-gray-800" v-html="movie.description"></p>
                            </article>

                            <!-- Trailers Tab -->


                            <!--Actors Tab-->
                        </div>
                        <!-- Trailers Tab -->
                        <div v-if="movie.trailer" class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">

                            <div class="col-lg-8 col-md-9 col-sm-10 col-xs-12">
                            <iframe width="100%" height="270" :src="`${movie.trailer}?from_block=partner&from=zen&mute=0&autoplay=0&tv=0`"
                                    allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media"
                                    frameborder="0" scrolling="no" allowfullscreen>

                            </iframe>
                            </div>
                            <!-- Trailers Tab -->


                            <!--Actors Tab-->
                        </div>
                        <!-- Actors Tab -->
                        <div class="tab-pane fade" id="actors" role="tabpanel" aria-labelledby="actors-tab">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Режиссеры:</h5>
                                    <div v-for="person in staff.directors" class="artist-list mb-3">
                                       <a class="d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
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
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
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
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
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
                        <!-- Reviews Tab-->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="card-body p-0 reviews-card">

                                <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                   <ul class="pagination">
                                        <li v-if="currentPage != 1" class="page-item">
                                            <a @click.prevent="getReviews(String(currentPage - 1))" class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li v-for="page in reviews.totalPages" class="page-item">
                                            <template v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                            <a @click.prevent="getReviews(page)" :class="page == currentPage? 'active' : ''" class="page-link" href="#" :value="page">{{page}}</a>
                                            </template>
                                            <template v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                <span class="page-link">...</span>
                                            </template>
                                        </li>

                                        <li class="page-item">
                                            <a v-if="currentPage != reviews.totalPages" @click.prevent="getReviews(String(currentPage + 1))" class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <div v-for="review in reviews.items" class="media mb-4">
                                    <div class="media-body">
                                        <div class="mt-0 mb-2">
                                            <span class="h6 mr-2 text-muted text-gray-500">{{review.author}}</span>
                                        </div>
                                        <div class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-gray-900">{{review.title}}</span>
                                        </div>
                                        <div v-if="review.type == 'POSITIVE'" class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-success">+</span>
                                        </div>
                                        <div v-if="review.type == 'NEGATIVE'" class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-danger">-</span>
                                        </div>
                                        <p v-html="review.description"></p>
                                    </div>
                                </div>


                                <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                    <ul class="pagination">
                                        <li v-if="currentPage != 1" class="page-item">
                                            <a @click.prevent="getReviews(String(currentPage - 1))" class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li v-for="page in reviews.totalPages" class="page-item">
                                            <template v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                                <a @click.prevent="getReviews(page)" :class="page == currentPage? 'active' : ''" class="page-link" href="#" :value="page">{{page}}</a>
                                            </template>
                                            <template v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                <span class="page-link">...</span>
                                            </template>
                                        </li>

                                        <li class="page-item">
                                            <a v-if="currentPage != reviews.totalPages" @click.prevent="getReviews(String(currentPage + 1))" class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                            </div>


                            <!--Comment Form-->
<!--                            <div class="p-4 bg-light rounded mt-4">-->
<!--                                <h5 class="card-title mb-4">Leave a Review</h5>-->
<!--                                <form name="sentMessage">-->
<!--                                    <div class="row">-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Your Name <span class="text-danger">*</span></label>-->
<!--                                                <input type="text" class="form-control" required="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Your Email <span class="text-danger">*</span></label>-->
<!--                                                <input type="email" class="form-control" required="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Rating <span class="text-danger">*</span></label>-->
<!--                                                <select class="form-control custom-select">-->
<!--                                                    <option>1 Star</option>-->
<!--                                                    <option>2 Star</option>-->
<!--                                                    <option>3 Star</option>-->
<!--                                                    <option>4 Star</option>-->
<!--                                                    <option>5 Star</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="control-group form-group">-->
<!--                                        <div class="controls">-->
<!--                                            <label>Review <span class="text-danger">*</span></label>-->
<!--                                            <textarea rows="3" cols="100" class="form-control"></textarea>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="text-right">-->
<!--                                        <button type="submit" class="btn btn-primary">Send Message</button>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <template v-if="relatedMovies.length > 0">
            <div class="bg-white info-header shadow rounded mb-4">
                <div class="row d-flex align-content-center-start justify-content-start p-3 border-bottom mb-3">
                        <h6 class="text-gray-900 m-2 font-weight-bold">Похожие фильмы:</h6>
                </div>
                    <div class="row col-12 d-flex justify-content-center">
                    <div v-for="relatedMovie in relatedMovies" class="col-xl-3 col-md-3 col-sm-4 col-9 col-6">
                        <div  class="card e-card shadow border-0">
                            <Link :href="`/movies/${relatedMovie.slug}`" class=""><div class="m-card-cover">
                                <img v-lazy="relatedMovie.poster" class="card-img-top" alt="...">
                            </div>
                                <div class="card-body p-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-2 auto py-3 pl-3">
                                            <div class="bg-white rounded text-center">
                                                <h6 class="text-danger mb-0 font-weight-bold">{{relatedMovie.year}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-10 p-3">
                                            <p class="card-text text-gray-900 mb-1">{{relatedMovie.nameRu}}</p>
                                            <p class="card-text text-gray-900 mb-1">{{relatedMovie.nameEn}}</p>
                                            <p class="card-text">
                                                <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i></small>
                                                <small v-for="genre in relatedMovie.genres" class="text-muted">
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
            </template>

                </div>
            </div>

    <!-- /.container-fluid -->
    </FrontLayout>
</template>

<script>
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";


    export default {
        name: "Single",
        props: ['movie', 'relatedMovies'],
        components:{Head, Link, FrontLayout},

        data(){
            return{
                staff: {},
                reviews: {},
                playlist: [],
                playlistItems: null,
                playlistRes: [],
                newFilter: [],
                currentPage: 1,
            }
        },

        mounted() {
        this.getReviews()
        this.togglePlaylistButton()

            if(this.movie.video_allowed == 1){
                new Kinobox('.kinobox_player', {
                    'X-Settings': {
                        "Alloha" : {
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
                        "Collaps":{
                            "enable": true,
                            "position": 5,
                            "token": "",
                        },
                        "Hdvb":{
                            "enable": true,
                            "position": 6,
                            "token": "",
                        },
                        "Iframe":{
                            "enable": true,
                            "position": 7,
                            "token": "",
                        },
                        "Kodik":{
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

        methods:{

            togglePlaylistButton(){
                if(localStorage.getItem('playlist')){
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if(this.playlistRes.includes(String(this.movie.id))){
                        this.playlistItems = true;
                    }else{
                        this.playlistItems = false;
                    }
                }
            },

            togglePlaylist(id){
                if(!localStorage.getItem('playlist')){
                    this.playlistRes.push(id)
                    localStorage.setItem('playlist', this.playlistRes)
                    this.$refs.front_layout.playListCount()
                    this.$refs.front_layout.makePlaylist()
                    this.playlistItems = true;
                }else{
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if(this.playlistRes.includes(String(id))){
                        this.playlistRes = this.playlistRes.filter(elem=>{
                            if(elem != id){
                                return elem
                            }
                        })
                        if(this.playlistRes == ''){
                            localStorage.removeItem('playlist', '')
                            this.$refs.front_layout.playListCount()
                            this.$refs.front_layout.makePlaylist()
                            this.playlistItems = false;
                        }else{
                            localStorage.setItem('playlist', this.playlistRes)
                            this.$refs.front_layout.playListCount()
                            this.$refs.front_layout.makePlaylist()
                            this.playlistItems = false;
                        }


                    }else{
                        this.playlistRes.push(id)
                        localStorage.setItem('playlist', this.playlistRes)
                        this.$refs.front_layout.playListCount()
                        this.$refs.front_layout.makePlaylist()
                        this.playlistItems = true;
                    }
                }
            },

            getStaff(){
                axios.get(`https://kinopoiskapiunofficial.tech/api/v1/staff?filmId=${this.movie.kinopoisk_id}`,
                    {headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }}
                ).then(resp=>{

                    this.staff.directors = resp.data.filter((elem, index)=>{
                        return elem.professionKey == 'DIRECTOR'
                    })
                    this.staff.actors = resp.data.filter((elem, index)=>{
                        return elem.professionKey == 'ACTOR'
                    })
                    this.staff.support = resp.data.filter((elem, index)=>{
                        return elem.professionKey !== 'DIRECTOR' && elem.professionKey !== 'ACTOR'
                    })

                })
            },

            getReviews(page = 1){
                axios.get(`https://kinopoiskapiunofficial.tech/api/v2.2/films/${this.movie.kinopoisk_id}/reviews?page=${page}&order=DATE_DESC`,
                    {
                        headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }

                    })
                    .then(r=>{
                        this.reviews = r.data
                        this.currentPage = page
                    })
            },

            copyUrl(){
                navigator.clipboard.writeText(window.location.href)

                $(document).Toasts('create', {
                    class: 'bg-info',
                    title: 'MovieOne.ru',
                    subtitle: 'Закрыть',
                    body: 'Ссылка успешно скопирована'
                })

            }

        },


    }
</script>
