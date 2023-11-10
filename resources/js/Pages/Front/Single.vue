<template>

    <Head>
        <title>{{movie.nameRu}}/{{movie.nameEn}} Смотреть бесплатно без регистрации</title>
        <meta name="description" :content="movie.description" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>

    <FrontLayout ref="front_layout">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="cover-pic">
<!--                        <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-4 love-box">-->
<!--                            <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> {{movie.rate}}</h6>-->
<!--                            <small class="text-muted">8,784</small>-->
<!--                        </div>-->
                        <img src="/img/poster.webp" class="img-fluid w-100" alt="promo poster">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="bg-white p-3 widget shadow rounded mb-4">
                        <img :src="movie.posterUrl" class="img-fluid rounded" :alt="movie.nameEn">
                        <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Продолжительность:</h1>
                        <p>{{movie.filmLength}} мин</p>
                        <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год окончания:</h1>
                        <p>{{movie.endYear}}</p>
                        <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Рейтинг:</h1>
                        <p>{{movie.rate}}</p>
                        <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Ограничения по возрасту:</h1>
                        <p class="mb-0">{{movie.age_limits}}</p>
                        <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Страны:</h5>
                        <p>
                        <span v-for="country in movie.countries">
                        {{country.title}}&nbsp
                        </span>
                        </p>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="bg-white info-header shadow rounded mb-4">
                        <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                            <div class="col-lg-7 m-b-4">
                                <h3 v-if="movie.nameRu != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameRu}}</h3>
                                <h3 v-if="movie.nameEn != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameEn}}</h3>
                                <h3 v-if="movie.nameEn != null" class="text-gray-900 mb-0 mt-0 font-weight-bold mb-1"><small>2019</small></h3>
                                <p class="mb-0 text-gray-800">
                                    <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i>
                                        <span v-for="genre in movie.genres">
                                        {{genre.title}}&nbsp
                                    </span>
                                    </small></p>
                            </div>
                            <div class="col-lg-5 text-right">
                                <a @click.prevent="copyUrl()" href="#" class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-share-alt"></i></a>
                                <template v-if="!playlistItems">
                                    <a @click.prevent="togglePlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> В избранное <i class="fa-solid fa-square-plus"></i></a>
                                </template>
                                <template v-if="playlistItems">
                                    <a @click.prevent="togglePlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> Убрать <i class="fa-solid fa-square-minus"></i></a>
                                </template>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-between py-3 px-4">
                            <div class="col-lg-6 m-b-4">
                                <p class="mb-0 text-gray-900"><i class="fas fa-money-bill fa-sm fa-fw mr-1"></i> BUDGET - <span class="text-white rounded px-2 py-1 bg-info">{{movie.budget}}</span></p>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a  href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA==" class="btn btn-sm btn-danger btn-circle d-inline-flex ml-2">
                                    <i style="font-size: 15px" class ="fa-brands fa-instagram"></i>
                                </a>
                                <a  href="https://dzen.ru/movieone" class="btn btn-sm btn-warning btn-circle d-inline-flex ml-2" target="_blank">
                                    <img style="padding-bottom: 2px" class="h-100" src="/img/zen-grey.svg" alt="zen_image">
                                </a>
                                <a href="https://t.me/kino_movieone" class="btn btn-sm btn-info btn-circle d-inline-flex ml-2">
                                    <i style="font-size: 15px" class="fa-brands fa-telegram"></i>
                                </a>
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
                            <li class="nav-item" v-if="movie.trailers.videos_count > 0" >
                                <a class="nav-link" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer" aria-selected="false">Трейлеры<span class="badge badge-danger badge-counter ml-1">{{movie.trailers.videos_count}}</span></a>
                            </li>
                            <!-- Actors -->
                            <li @click="getStaff(movie.kinopoisk_id)" class="nav-item">
                                <a class="nav-link" id="actors-tab" data-toggle="tab" href="#actors" role="tab" aria-controls="actors" aria-selected="false">Актеры
                                </a>
                            </li>
                            <!-- Reviews -->
                            <li v-if="reviews.total > 0" class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Рецензии<span class="badge badge-danger badge-counter ml-1">{{reviews.total}}</span></a>
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
                            <div v-if="movie.trailers.videos_count > 0" class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">

                                  <div class="row">
                                    <template v-if="movie.trailers.videos_count > 0" v-for="trailer in movie.trailers.videos">
                                        <div v-if="trailer.site == 'dzen'" class="mb-4 col-xl-6 col-lg-6">
                                            <iframe width="100%" height="270" :src="`${trailer.url}?from_block=partner&from=zen&mute=0&autoplay=0&tv=0`"
                                                    allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media"
                                                    frameborder="0" scrolling="no" allowfullscreen>
                                            </iframe>
                                            <p class="mb-0">{{trailer.name}}</p>
                                        </div>
                                        <div v-else-if="trailer.site == 'youtube'" class="mb-4 col-xl-6 col-lg-6">
                                            <iframe width="100%" height="215" :src="trailer.url" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            <p class="mb-0">{{trailer.name}}</p>
                                        </div>
                                    </template>
                            </div>
                            </div>
                            <!-- Trailers Tab -->

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
                            <!-- Actors Tab End -->

                            <!-- Reviews Tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="card-body p-0 reviews-card">

                                    <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                        <ul class="pagination">
                                            <li v-if="currentPage != 1" class="page-item">
                                                <a @click.prevent="getReviews(String(currentPage - 1))" class="page-link" href="#" aria-label="Previous">
                                                    <div aria-hidden="true">&laquo;</div>
                                                </a>
                                            </li>
                                            <li v-for="page in reviews.totalPages" class="page-item">
                                                <template v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                                    <a @click.prevent="getReviews(page)" :class="page == currentPage? 'active' : ''" class="page-link" href="#" :value="page">{{page}}</a>
                                                </template>
                                                <template v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                    <div class="page-link">...</div>
                                                </template>
                                            </li>

                                            <li class="page-item">
                                                <a v-if="currentPage != reviews.totalPages" @click.prevent="getReviews(String(currentPage + 1))" class="page-link" href="#" aria-label="Next">
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
                                                <div class="h6 mr-2 font-weight-bold text-gray-900 d-inline">{{review.title}}</div>
                                            </div>
                                            <div v-if="review.type == 'POSITIVE'" class="mt-0 mb-2 d-inline">
                                                <div class="h6 mr-2 font-weight-bold text-success d-inline"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>
                                            </div>
                                            <div v-if="review.type == 'NEGATIVE'" class="mt-0 mb-2 d-inline">
                                                <div class="h6 mr-2 font-weight-bold text-danger d-inline"><i class="fa fa-thumbs-down" aria-hidden="true"></i></div>
                                            </div>
                                            <div class="mt-2 mb-2">
                                                <p v-html="review.description"></p>
                                            </div>
                                       </div>
                                    </div>


                                    <nav v-if="reviews.totalPages > 1" aria-label="reviews pagination">
                                        <ul class="pagination">
                                            <li v-if="currentPage != 1" class="page-item">
                                                <a @click.prevent="getReviews(String(currentPage - 1))" class="page-link" href="#" aria-label="Previous">
                                                    <div aria-hidden="true">&laquo;</div>
                                                </a>
                                            </li>
                                            <li v-for="page in reviews.totalPages" class="page-item">
                                                <template v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages">
                                                    <a @click.prevent="getReviews(page)" :class="page == currentPage? 'active' : ''" class="page-link" href="#" :value="page">{{page}}</a>
                                                </template>
                                                <template v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)">
                                                    <div class="page-link">...</div>
                                                </template>
                                            </li>

                                            <li class="page-item">
                                                <a v-if="currentPage != reviews.totalPages" @click.prevent="getReviews(String(currentPage + 1))" class="page-link" href="#" aria-label="Next">
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
                <div class="bg-white info-header shadow rounded mb-4 pb-3">
                    <div class="row d-flex align-content-center-start justify-content-start p-3 border-bottom">
                        <h6 class="text-gray-900 m-2 font-weight-bold">Похожие фильмы:</h6>
                    </div>
                    <div class="row col-12 mt-3 d-flex justify-content-center row-gap-3">
                        <div v-for="relatedMovie in relatedMovies" class="col-xl-3 col-md-3 col-sm-4 col-9 col-6">
                            <div  class="card e-card shadow border-0">
                                <Link :href="`/movies/${relatedMovie.slug}`" class="">
                                    <div class="m-card-cover">
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
        <!-- /.container-fluid -->

        <!-- Copy URL Popup -->
        <div v-if="popup" class="alert alert-warning alert-dismissible fade show position-absolute top-0 start-50 translate-middle-x z-3" role="alert">
            <span>Ссылка скопирована</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
                popup: false,
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
                this.popup = true
                setTimeout(this.resetPopup, 1500)

            },

            resetPopup(){
                this.popup = false
            },

        },


    }
</script>
