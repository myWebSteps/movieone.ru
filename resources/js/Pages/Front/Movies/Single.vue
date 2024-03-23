<template>


    <Head>
        <title>{{movie.nameRu}}/{{movie.nameEn}} {{movie.meta_title}}</title>
        <meta name="keywords" :content="movie.meta_keywords"/>
        <meta name="description" :content="movie.meta_description"/>
    </Head>
    <section class="grid items-top
    lg:sticky
    max-h-[50vh]
    overflow-hidden
    top-0
    h-fit
    min-h-[200px]
    z-10 overflow-y-hidden"
    >
        <img v-if="coverImg !== null" class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" :src="coverImg"
             alt="...">

        <span class="row-start-1 row-end-1 col-start-1 col-end-1
        w-3/4
        text-end
        text-wrap
        justify-self-end
        pt-[5%]
        pr-[10%]
        text-gray-300 opacity-75 font-bold
        text-xl
        sm:text-2xl
        md:text-3xl">
            {{ movie.nameRu }} <br>
            <span class="font-light">{{ movie.nameEn }}</span>
        </span>

        <div class="row-start-1 row-end-1 col-start-1 col-end-1
        justify-self-start self-start bg-white shadow-sm rounded-sm p-2 m-4 text-sm">
            <h6 class="text-gray-900 grid grid-flow-col auto-cols-max gap-0.5 items-center">
                <span class="material-symbols-sharp text-rose-600">star_half</span>
                <span>{{ movie.rating }}</span>
            </h6>
        </div>

    </section>

    <section class="relative z-20 bg-slate-100">

    <!-- Begin Page Content -->
    <div class="container mx-auto
    grid grid-flow-row gap-4
    ">
        <div class="grid relative grid-flow-row grid-cols-1 mx-2 gap-2 -top-[2.1rem]
        lg:grid-flow-col lg:grid-cols-[1fr,_4fr]
        ">
            <!--Movie Poster Widget-->
            <div class="grid p-2 bg-white shadow-md justify-items-center gap-2
            grid-flow-row
            sm:grid-flow-col
            lg:grid-flow-row lg:self-start
            ">
                <img :src="movie.posterUrl" class="rounded-md" :alt="movie.nameEn">
                <div class="grid grid-flow-row gap-1 justify-self-start auto-rows-max">
                    <h6 class="font-semibold">Продолжительность:</h6>
                    <p class="font-light">{{ movie.filmLength }} мин</p>
                    <h6 class="font-semibold">Год окончания:</h6>
                    <p class="font-light">{{ movie.endYear }}</p>
                    <label class="font-semibold grid grid-flow-col items-center">Ограничения:
                        <p class="font-light text-white bg-rose-600 px-2 py-1 rounded-md justify-self-end">
                            {{ movie.age_limits }} + </p>
                    </label>
                    <label class="font-semibold">Страны:
                        <span class="font-light" v-for="country in movie.countries">
                        {{ country.title }}&nbsp
                        </span>
                    </label>

                    <article v-if="relatedCollections.length > 0">
                        <h6 class="font-semibold">Коллекции с видео:</h6>
                        <template v-for="collection in relatedCollections">
                            <div class="grid grid-flow-col grid-cols-[repeat(2,_max-content)] gap-2">
                                <span class="material-symbols-sharp text-green-500">task_alt</span>
                                <Link :href="`/collections/${collection.slug}`"
                                      class="justify-self-start grid grid-flow-col content-center"
                                >
                                    {{ collection.collection_title }}
                                    <span class="material-symbols-sharp">arrow_forward</span>
                                </Link>
                            </div>
                        </template>
                    </article>

                </div>
            </div>
            <!-- Main Block -->
            <div class="grid grid-flow-row grid-rows-[max-content]
            gap-4
            ">
                <div class="grid grid-rows-[max-content] gap-1 bg-white shadow-md px-4 py-4
                grid-cols-1
                sm:grid-cols-[minmax(20%,_75%),_max-content]
                ">
                    <div class="max-sm:order-1">
                        <h1 class="text-gray-900 text-xl font-semibold text-wrap">
                            {{ movie.nameRu }}</h1>
                        <h2 class="text-gray-900 text-lg font-light text-wrap">
                            {{ movie.nameEn }}</h2>
                        <h5 class="text-rose-700 text-lg font-light grid grid-flow-col grid-cols-[repeat(2,_max-content)]
                                 content-center items-center">
                            <span class="material-symbols-sharp">today</span>&nbsp
                            <span class="text-gray-900">{{ movie.endYear }}</span>
                        </h5>
                        <h5 class="text-rose-700 text-lg font-light">
                            <span class="material-symbols-sharp">camera_roll</span>&nbsp
                            <span class="text-gray-900 text-sm text-wrap">
                                <template v-for="genre in movie.genres" class="text-wrap">
                                {{ genre.title}}&thinsp;
                                </template>
                                </span>

                        </h5>
                    </div>

                    <div class="grid auto-cols-max gap-2 self-start
                    sm:grid-flow-col
                    justify-self-center
                    sm:justify-self-end
                    max-sm:order-3
                    "
                         :class="$parent.show.menu ? 'grid-flow-row' : 'grid-flow-col'"
                    >
                        <a @click.prevent="copyUrl()" href="#"
                           class="inline-grid content-center bg-blue-900 shadow-sm border-2
                           justify-self-center
                         border-blue-900 text-white
                         hover:bg-white hover:text-blue-900
                         px-2 py-1
                        rounded-md
                        "
                        >
                            <span class="material-symbols-sharp">share</span>
                        </a>

                        <a @click.prevent="togglePlaylist(movie.id)" href="#"
                           class="inline w-full text-center
                                  border-2 border-rose-700 text-white bg-rose-700 px-2 py-1 rounded-md shadow-md
                               hover:text-rose-700 hover:bg-white
                                "
                        >
                            <template v-if="!playlistItems">
                                <div class="grid grid-flow-col items-center">
                                    <span class="font-light">В избранное</span>
                                    <span class="material-symbols-sharp">heart_plus</span>
                                </div>
                            </template>
                            <template v-if="playlistItems">
                                <div class="grid grid-flow-col items-center">
                                    <span class="font-light">Убрать</span>
                                    <span class="material-symbols-sharp">heart_minus</span>
                                </div>
                            </template>
                        </a>

                    </div>

                    <div class="max-sm:order-2
                    ">
                        <div v-if="movie.budget">
                            <h5 class="text-rose-700 text-lg font-light grid grid-flow-col auto-cols-max
                                 items-center">
                                <span class="material-symbols-sharp">payments</span>&nbsp
                                <span class="text-gray-900">{{ movie.budget }}</span>
                            </h5>
                        </div>
                    </div>

                    <div class="
                    max-sm:order-4
                    grid grid-flow-col grid-cols-[repeat(3,_max-content)] auto-rows-[32px] items-center
                        justify-self-end
                        sm:justify-self-center
                        ">
                        <a href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA=="
                           target="_blank">
                            <img src="/img/social/vero.svg" alt="...">
                        </a>
                        <a href="https://dzen.ru/movieone"
                           target="_blank">
                            <img src="/img/social/telegram.svg" alt="...">
                        </a>
                        <a href="https://t.me/kino_movieone"
                           target="_blank">
                            <img src="/img/social/dzen.svg" alt="...">
                        </a>
                    </div>
                </div>

                <section class="grid grid-flow-row grid-cols-1 bg-white shadow-md py-2 gap-4">

                    <ul class="px-4 grid grid-cols-[repeat(auto-fit,minmax(max-content,_80px))]
                    text-gray-900 auto-rows-[minmax(30px,_max-content)] gap-4
                    ">
                        <li :class="accordion === 'general' ? 'border-b-2 border-b-pink-900' : ''"
                            class="w-fit cursor-pointer"
                            @click.prevent="accordion = 'general'">
                            Описание
                        </li>
                        <li v-if="movie.trailers.videos_count > 0"
                            :class="accordion === 'trailers' ? 'border-b-2 border-b-pink-900' : ''"
                            @click.prevent="[accordion = 'trailers', loadTrailers = true]"
                            class="w-fit relative cursor-pointer"
                        >
                            Трейлеры <span
                            class="block absolute -top-0.5 -right-4 bg-rose-400 rounded-full w-[18px] h-[18px] text-xs text-center text-white">
                            {{ movie.trailers.videos_count }}
                        </span>
                        </li>
                        <li :class="accordion === 'comments' ? 'border-b-2 border-b-pink-900' : ''"
                            @click.prevent="accordion = 'comments'"
                            class="w-fit cursor-pointer"
                        >
                            Комментарии
                        </li>
                        <li v-if="reviews.total"
                            :class="accordion === 'reviews' ? 'border-b-2 border-b-pink-900' : ''"
                            @click.prevent="[accordion = 'reviews']"
                            class="w-fit cursor-pointer relative"
                        >
                            Рецензии
                            <span v-if="reviews.total < 99"
                                  class="block absolute -top-0.5 -right-4 bg-rose-400 rounded-full w-[18px] h-[18px] text-xs text-center text-white">
                            {{ reviews.total }}
                            </span>
                            <span v-else
                                  class="material-symbols-sharp block absolute -top-0.5 -right-4 bg-rose-400 rounded-full w-[18px] h-[18px] text-xs text-center text-white">
                                all_inclusive
                            </span>
                        </li>
                        <li :class="accordion === 'actors' ? 'border-b-2 border-b-pink-900' : ''"
                            @click.prevent="[accordion = 'actors', getStaff(movie.kinopoisk_id)]"
                            class="w-fit cursor-pointer"
                        >
                            Актеры
                        </li>
                    </ul>

                    <div :class="accordion === 'general' ? '' : 'hidden' "
                         class="grid grid-flow-row gap-4"
                    >
                        <div v-if="movie.video_allowed == 1" class="kinobox_player"></div>

                        <article class="px-4">
                            <h3 class="text-xl">{{ movie.slogan }}</h3>
                            <p class="font-light" v-html="movie.description"></p>
                        </article>
                    </div>

                    <div :class="accordion === 'trailers' ? '' : 'hidden'"
                         class="px-4 grid gap-4 grid-cols-[repeat(auto-fit,_minmax(200px,_300px))]"
                    >
                        <template v-if="movie.trailers.videos_count > 0 && loadTrailers == true"
                                  v-for="trailer in movie.trailers.videos">
                            <div v-if="trailer.site == 'dzen'" class="">
                                <iframe width="100%" height="215"
                                        :src="`${trailer.url}?from_block=partner&from=zen&mute=0&autoplay=0&tv=0`"
                                        allow="autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture; encrypted-media"
                                        frameborder="0" scrolling="no" allowfullscreen>
                                </iframe>
                                <figcaption>{{ trailer.name }}</figcaption>
                            </div>
                            <div v-else-if="trailer.site == 'youtube'" class="">
                                <iframe width="100%" height="215" :src="trailer.url" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                <figcaption>{{ trailer.name }}</figcaption>
                            </div>
                        </template>

                    </div>

                    <div :class="accordion === 'comments' ? '' : 'hidden'"
                         class="px-4 grid gap-4 grid-flow-row"
                    >
                        <comments-component :comments="comments" :id="movie.id" type="movies"
                                            :message.sync="message"></comments-component>

                    </div>

                    <div :class="accordion === 'reviews' ? '' : 'hidden'"
                         class="px-4 grid gap-4 grid-flow-row"
                    >
                        <template v-for="review in reviews.items">
                            <article class="grid grid-flow-row gap-1">
                                <span class="text-gray-500 font-light">{{ review.author }}</span>
                                <h5>{{ review.title }}
                                    <span v-if="review.type === 'POSITIVE'"
                                          class="material-symbols-sharp text-green-500 font-bold">
                                sentiment_very_satisfied
                                </span>
                                    <span v-if="review.type === 'NEGATIVE'"
                                          class="material-symbols-sharp text-rose-500 font-bold">
                                sentiment_dissatisfied
                                </span>
                                </h5>

                                <p class="text-gray-900 font-light" v-html="review.description"></p>

                            </article>
                        </template>


                        <ul v-if="reviews.totalPages > 1"
                            class="justify-self-center w-fit rounded-sm overflow-x-hidden
                            grid grid-flow-col auto-cols-fr items-center
                            bg-gray-300
                            ">
                            <li v-if="currentPage != 1" class="py-2 px-4">
                                <a @click.prevent="getReviews(String(currentPage - 1))"
                                   href="#">
                                    &laquo;
                                </a>
                            </li>
                            <template v-for="page in reviews.totalPages">
                                <li v-if="(page - currentPage < 3 && page - currentPage > -3) || page == 1 || page == reviews.totalPages"
                                    class="py-2 px-4"
                                    :class="page == currentPage? 'bg-[#333454] text-white' : ''">
                                    <a @click.prevent="getReviews(page)" href="#"
                                       :value="page">{{ page }}</a>
                                </li>
                                <li v-if="(currentPage - page == 3 && currentPage != 4) || (currentPage - page == -3 && currentPage != reviews.totalPages - 3)"
                                    class="py-2 px-4"
                                >
                                    <div>...</div>
                                </li>
                            </template>


                            <li class="py-2 px-4">
                                <a v-if="currentPage != reviews.totalPages"
                                   @click.prevent="getReviews(String(currentPage + 1))"
                                   href="#">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div :class="accordion === 'actors' ? '' : 'hidden'"
                         class="px-4 grid gap-2 grid-cols-[repeat(auto-fit,_minmax(50px,_250px))] items-start"
                    >
                        <section class="grid grid-flow-row gap-2">
                            <h6>Режиссеры:</h6>
                            <div v-for="person in staff.directors"
                                 class="grid grid-flow-col grid-cols-[1fr,_2fr]"
                            >
                                <img :src="person.posterUrl">

                                <div class="font-weight-bold">
                                    <div class="text-gray-900">{{ person.nameRu }}</div>
                                    <div class="text-gray-500">{{ person.professionText }}</div>
                                </div>
                            </div>
                        </section>

                        <section class="grid grid-flow-row gap-2">
                            <h6>Актеры:</h6>
                            <div v-for="person in staff.actors"
                                 class="grid grid-flow-col grid-cols-[1fr,_2fr]"
                            >
                                <img :src="person.posterUrl">

                                <div class="font-weight-bold">
                                    <div class="text-gray-900">{{ person.nameRu }}</div>
                                    <div class="text-gray-500">{{ person.professionText }}</div>
                                </div>
                            </div>
                        </section>

                        <section class="grid grid-flow-row gap-2">
                            <h6>Другие:</h6>
                            <div v-for="person in staff.support"
                                 class="grid grid-flow-col grid-cols-[1fr,_2fr]"
                            >
                                <img :src="person.posterUrl">

                                <div class="font-weight-bold">
                                    <div class="text-gray-900">{{ person.nameRu }}</div>
                                    <div class="text-gray-500">{{ person.professionText }}</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>

                <!--Related Movies -->
                <section v-if="relatedMovies.length > 0"
                         class="grid grid-flow-row grid-cols-1 bg-white shadow-md  py-2 gap-1">
                    <h6 class="justify-self-start px-4">Похожие фильмы:</h6>
                    <movies-card :data="relatedMovies"
                                 :config="{classes: ''}"></movies-card>
                </section>

            </div>
        </div>
    </div>
    </section>

    <message :message.sync="message"></message>
</template>

<script>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import MoviesCard from "@/Components/MoviesCard.vue";
import Message from "@/Components/Message.vue"
import {Head} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import {router} from '@inertiajs/vue3';
import CommentsComponent from "@/Components/CommentsComponent.vue";

export default {
    name: "Single",
    layout: FrontLayout,
    props: ['movie', 'comments', 'commentsCount', 'relatedMovies', 'relatedCollections'],
    components: {CommentsComponent, Head, Link, FrontLayout, MoviesCard, Message},

    data() {
        return {
            coverImg: null,
            loadTrailers: false,
            accordion: 'general',
            comment_errors: '',
            staff: {},
            reviews: {},
            playlist: [],
            playlistItems: null,
            playlistRes: [],
            newFilter: [],
            currentPage: 1,
            message: {
                body: [],
                type: '',
                show: false,
            },

        }
    },
    updated() {
        console.log([this.loadTrailers, this.accordion])
    },

    mounted() {
        this.getReviews()
        this.togglePlaylistButton()

        this.coverImg = this.movie.backdropUrl

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

    },

    beforeUnmount() {
        ym(94438576, 'hit', `/movies/${this.movie.slug}`);
    },

    methods: {

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
                this.$parent.playListCount()
                this.$parent.makePlaylist()
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
                        localStorage.removeItem('playlist')
                        this.$parent.playListCount()
                        this.$parent.makePlaylist()
                        this.playlistItems = false;
                    } else {
                        localStorage.setItem('playlist', this.playlistRes)
                        this.$parent.playListCount()
                        this.$parent.makePlaylist()
                        this.playlistItems = false;
                    }


                } else {
                    this.playlistRes.push(id)
                    localStorage.setItem('playlist', this.playlistRes)
                    this.$parent.playListCount()
                    this.$parent.makePlaylist()
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

            this.message.body = ['ссылка успешно скопирована']
            this.message.type = 'error'
            this.message.show = true
        },

    },


}
</script>
