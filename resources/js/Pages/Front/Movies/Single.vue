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
    z-10 overflow-y-hidden
    min-h-36
    lg:min-h-52
    "
    >

        <img v-if="backdrop != null" class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" :src="backdrop"
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
                <i class="icon-star_half text-rose-700 text-2xl"></i>
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
            <div class="grid bg-white shadow-md justify-items-center gap-2
            grid-flow-row
            sm:grid-flow-col
            lg:grid-flow-row lg:self-start
            pt-2 pb-4 px-2
            ">
                <img :src="movie.posterUrl" class="rounded-md" :alt="movie.nameEn">
                <div class="grid grid-flow-row gap-2 justify-self-start auto-rows-max">
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

                    <article v-if="relatedCollections.length > 0" class="grid gap-1">
                        <h6 class="font-semibold">Коллекции с видео:</h6>
                        <template v-for="collection in relatedCollections">
                            <div class="grid grid-flow-col grid-cols-[repeat(2,_max-content)] gap-2">
                                <i class="icon-task_alt text-green-500"></i>
                                <Link :href="`/collections/${collection.slug}`"
                                      class="justify-self-start grid grid-flow-col content-center text-wrap max-w-40"
                                >
                                    {{ collection.collection_title }}
                                    <i class="icon-arrow_right_alt"></i>
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
                            <i class="icon-today"></i>&nbsp
                            <span class="text-gray-900">{{ movie.endYear }}</span>
                        </h5>
                        <h5 class="text-rose-700 text-lg font-light grid grid-flow-col grid-cols-[20px,_1fr] gap-1 items-center">
                            <i class="icon-camera_roll"></i>
                            <span class="text-gray-900 text-sm text-wrap max-w-[90%]">
                                <template v-for="genre in movie.genres" >
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
                            <i class="icon-share"></i>
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
                                    <i class="icon-heart_plus"></i>
                                </div>
                            </template>
                            <template v-if="playlistItems">
                                <div class="grid grid-flow-col items-center">
                                    <span class="font-light">Убрать</span>
                                    <i class="icon-heart_minus"></i>
                                </div>
                            </template>
                        </a>

                    </div>

                    <div class="max-sm:order-2
                    ">
                        <div v-if="movie.budget">
                            <h5 class="text-rose-700 text-lg font-light grid grid-flow-col auto-cols-max
                                 items-center">
                                <i class="icon-attach_money text-xl"></i>&nbsp
                                <span class="text-gray-900">{{ movie.budget }}</span>
                            </h5>
                        </div>
                    </div>

                    <Socials></Socials>

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
                                  class="icon-all_inclusive block absolute -top-0.5 -right-4 bg-rose-400 rounded-full w-[18px] h-[18px] text-xs text-center text-white">
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
                         class="grid grid-flow-row gap-4 pt-2 pb-4"
                    >

                    <div class="work-space"></div>

                        <article class="px-4">
                            <h3 class="text-gray-900 text-xl font-medium">{{ movie.slogan }}</h3>
                            <p class="text-gray-700" v-html="movie.description"></p>
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
                                <span class="text-gray-500 font-medium">{{ review.author }}</span>
                                <h5 class="font-semibold">{{ review.title }}
                                    <i v-if="review.type === 'POSITIVE'"
                                          class="icon-sentiment_very_satisfied text-green-500 font-bold text-2xl">
                                </i>
                                    <i v-if="review.type === 'NEGATIVE'"
                                          class="icon-sentiment_dissatisfied text-rose-500 font-bold text-2xl">
                                </i>
                                </h5>

                                <p class="text-gray-900 pt-1" v-html="review.description"></p>

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

                                <div class="font-weight-bold pl-1">
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

                                <div class="font-weight-bold pl-1">
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

                                <div class="font-weight-bold pl-1">
                                    <div class="text-gray-900">{{ person.nameRu }}</div>
                                    <div class="text-gray-500">{{ person.professionText }}</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>

                <section v-if="spinMovies.length > 0"
                         class="grid grid-flow-row grid-cols-1 bg-white shadow-md pt-2 pb-4 gap-2">
                    <h6 class="justify-self-start px-4">Сиквелы и приквелы:</h6>
                    <movies-card :data="spinMovies"
                                 :config="{classes: ''}"></movies-card>
                </section>

                <!--Related Movies -->
                <section v-if="relatedMovies.length > 0"
                         class="grid grid-flow-row grid-cols-1 bg-white shadow-md pt-2 pb-4 gap-2">
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
import CommentsComponent from "@/Components/CommentsComponent.vue";
import Socials from "@/Components/Socials.vue";


export default {
    name: "Single",
    layout: FrontLayout,
    props: ['movie', 'comments', 'commentsCount', 'relatedMovies', 'spinMovies', 'relatedCollections', 'location'],
    components: {CommentsComponent, Head, Link, FrontLayout, MoviesCard, Message, Socials},

    data() {
        return {
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
            backdrop: null,

        }
    },

    mounted() {
        this.getReviews()
        this.togglePlaylistButton()
        ym(94438576, 'hit', `/movies/${this.movie.slug}`)
        this.startPlayer()

        if(window.screen.width <= 430)
        {
            this.backdrop = this.movie.backdropUrl_min
        }else{
            this.backdrop = this.movie.backdropUrl
        }


    },

    methods: {

        startPlayer(){
            if(this.movie.video_allowed == 0 && this.location.countryName == 'Russia'){
                setTimeout(()=> {
                   document.querySelector('.work-space').appendChild(document.createElement("div")).classList.add('kinobox_player')
                   this.initPlayer()
                }, 
                5000)
            }else{
                document.querySelector('.work-space').appendChild(document.createElement("div")).classList.add('kinobox_player')            
                this.initPlayer()
            }
        }, 

        initPlayer(){
            
        try {
            "use strict";

            function Kinobox(n, t) {
                function r(n) {
                    const t = {
                        menu: {
                            enable: !0,
                            "default": "menu_list",
                            mobile: "menu_button",
                            format: "{N} :: {T} ({Q})",
                            limit: null,
                            open: !1
                        },
                        players: {},
                        params: {},
                        translations: {
                            "не требуется": 1,
                            "оригинальная дорожка": 1,
                            "русская": 1,
                            "русский": 1,
                            "дублирование": 2,
                            "дублированный": 2,
                            "дубляж": 2,
                            "полное дублирование": 2,
                            "hdrezka studio": 7,
                            "проф.": 8,
                            "профессиональный": 8,
                            "многоголосый": 9,
                            "любительский": 20,
                            "двухголосый": 21,
                            "звук с ts": 1100,
                            "оригинальная": 1111,
                            portugues: 1234,
                            "белорус": 1234,
                            "субтитры": 1234,
                            "украин": 1234
                        }
                    };
                    return n.menu && Object.assign(t.menu, n.menu), n.players && (t.players = n.players), n.params && (t.params = n.params), t
                }

                try {
                    this.version = "20240404";
                    this.container = n instanceof Object ? n : document.querySelector(n);
                    this.box = {};
                    this.baseUrl = new URL(t.baseUrl || "https://kinobox.tv/");
                    this.state = {container: n, args: t, isMenuOpen: !1, players: []};
                    this.search = t.search;
                    this.settings = r(t)
                } catch (i) {
                    this.container.innerHTML = "";
                    this.container.textContent = i + " " + i.stack;
                    throw i;
                }
                this.log = function (n, t) {
                    if (t) for (let i in t) n = n.replace("{" + i + "}", t[i]);
                    console.info("[Kinobox] " + n)
                };
                this.isMobile = function () {
                    return "ontouchstart" in document.documentElement || window.screen.width < 500
                };
                this.isSearchBot = function () {
                    const n = window.navigator.userAgent.toLowerCase();
                    return ["Googlebot", "http://yandex.com/bots", "YandexRenderResourcesBot", "bingbot", "AhrefsBot"].some(function (t) {
                        return n.includes(t.toLowerCase())
                    })
                };
                this.getSearchUrl = function () {
                    const n = new URLSearchParams;
                    this.container.dataset.kinopoisk && n.set("kinopoisk", this.container.dataset.kinopoisk);
                    this.container.dataset.imdb && n.set("imdb", this.container.dataset.imdb);
                    this.container.dataset.title && n.set("title", this.container.dataset.title);
                    this.container.dataset.query && n.set("query", this.container.dataset.query);
                    this.search && (this.search.kinopoisk && n.set("kinopoisk", this.search.kinopoisk), this.search.imdb && n.set("imdb", this.search.imdb), this.search.title && n.set("title", this.search.title), this.search.query && n.set("query", this.search.query));
                    const i = Object.keys(this.settings.players);
                    if (i.length > 0) {
                        const t = i.join(",").toLowerCase();
                        n.set("sources", t)
                    }
                    const t = this.baseUrl;
                    return t.pathname = "api/players", t.search = n.toString(), t.toString()
                };
                this.getConfiguredPlayers = function () {
                    let n = this.state.players;
                    Object.keys(this.settings.players).length > 0 && (n = n.filter(function (n) {
                        const t = this.settings.players.findByKeyCase(n.source);
                        return !(t.hasOwnProperty("enable") && t.enable === !1)
                    }.bind(this)));
                    const t = {};
                    return Object.keys(this.settings.players).forEach(function (n) {
                        t[n.toLowerCase()] = this.settings.players[n].position
                    }.bind(this)), n = n.sort(function (n, i) {
                        const r = n.source.toLowerCase(), u = i.source.toLowerCase();
                        return t[r] - t[u]
                    }.bind(this)), n = n.filter(function (n) {
                        return n.success
                    }), n = n.filter(function (n) {
                        return n.iframeUrl !== null
                    }), this.settings.menu.limit && this.settings.menu.limit > 0 && (n = n.slice(0, this.settings.menu.limit)), n
                };
                this.sortTranslations = function (n) {
                    function t(n, t) {
                        const r = t.name.toLowerCase();
                        let i = 0, u = !1;
                        for (const t in n) if (n.hasOwnProperty(t)) {
                            const f = n[t];
                            if (t.toLowerCase() === r) return f;
                            r.indexOf(t.toLowerCase()) !== -1 && (u = !0, f > i && (i = f))
                        }
                        return u ? i : 1e3
                    }

                    const i = this.settings.translations;
                    return n.reduce(function (n, r) {
                        return t(i, r) < t(i, n) ? r : n
                    })
                };
                this.getIframeUrl = function (n, t) {
                    const f = this.settings.players.findByKeyCase(t);
                    if (f) {
                        let i = f.findByKeyCase("domain");
                        const r = t.toLowerCase();
                        i && (r === "alloha" ? n = n.replace(/^(https?:\/\/)[^\/]+/, i) : r === "cdnmovies" ? n = n.replace(/^(https?:\/\/)[^\/]+/, i) : r === "videocdn" && (i.startsWith("//") && (i = "https:" + i), n = n.replace(/^(https?:\/\/[^\/]+\/[^\/]+)/, i)))
                    }
                    n = new URL(n);
                    t = t.toLowerCase();
                    const i = new URLSearchParams(n.search), r = this.settings.params.findByKeyCase("all");
                    if (r) for (const n in r) i.set(n, r[n]);
                    const u = this.settings.params.findByKeyCase(t);
                    if (u) for (const n in u) i.set(n, u[n]);
                    return n.search = i.toString(), n.toString()
                }
            }

            function kbox(n, t) {
                new Kinobox(n, t).init()
            }

            Object.defineProperty(Object.prototype, "findByKeyCase", {
                enumerable: !1,
                configurable: !0,
                value: function (n) {
                    n = n.toLowerCase();
                    for (let t in this) if (this.hasOwnProperty(t) && t.toLowerCase() === n) return this[t];
                    return undefined
                }
            });
            Kinobox.prototype.appendStyles = function () {
                const n = document.createElement("link");
                n.rel = "stylesheet";
                const t = this.baseUrl;
                t.pathname = "kinobox.min.css";
                t.searchParams.append("v", this.version);
                n.href = t.toString();
                document.head.appendChild(n);
                typeof CSS != "undefined" && CSS.supports("aspect-ratio", "1/1") || (this.container.style.height = this.container.offsetWidth / 1.777777 + "px", this.container.style.maxHeight = this.container.offsetHeight + "px")
            };
            Kinobox.prototype.bindHotkeys = function () {
                document.addEventListener("keypress", function (n) {
                    const t = n.target.parentNode.firstElementChild.tagName;
                    if (t !== "INPUT" && t !== "TEXTAREA") {
                        const i = parseInt(n.key);
                        i ? this.selectPlayer(i) : (n.key === "x" || n.key === "0") && this.showMenu(!this.state.isMenuOpen)
                    }
                }.bind(this))
            };
            Kinobox.prototype.fetch = function (n, t) {
                const r = {success: !1, data: null}, i = new XMLHttpRequest;
                i.onload = function () {
                    if (i.status === 200) r.success = !0; else i.onerror(null)
                };
                i.onerror = function () {
                    r.success = !1;
                    console.error("Error " + i.status + ": " + i.statusText + "\n", i.response);
                    t(r)
                };
                i.onloadend = function () {
                    r.data = i.response;
                    t(r)
                };
                i.open("GET", n);
                i.responseType = "json";
                i.send()
            };
            Kinobox.prototype.showLoader = function (n) {
                n ? this.box.loader.classList.remove("kinobox_hidden") : this.box.loader.classList.add("kinobox_hidden")
            };
            Kinobox.prototype.showMessage = function (n) {
                n ? (this.box.message.textContent = n, this.box.message.classList.remove("kinobox_hidden")) : (this.box.message.textContent = "", this.box.message.classList.add("kinobox_hidden"));
                this.showLoader(!1)
            };
            Kinobox.prototype.showNavigation = function (n) {
                this.settings.menu.enable !== !1 && (n ? (this.box.nav.removeAttribute("disabled"), this.box.nav.setAttribute("active", "true")) : (this.box.nav.removeAttribute("active"), this.box.nav.setAttribute("disabled", "true")))
            };
            Kinobox.prototype.showMenu = function (n) {
                this.state.isMenuOpen = n;
                this.box.ul.setAttribute("active", n);
                n ? this.box.ul.setAttribute("active", "true") : this.box.ul.removeAttribute("active")
            };
            Kinobox.prototype.showIframe = function (n) {
                this.log("Loading iframe: {url}", {url: n});
                this.showLoader(!0);
                const t = document.createElement("iframe");
                t.className = "kinobox_iframe";
                t.allowFullscreen = !0;
                t.frameBorder = "0";
                t.src = n;
                this.box.iframeWrapper.innerHTML = "";
                this.box.iframeWrapper.appendChild(t);
                const i = Date.now();
                t.addEventListener("load", function () {
                    this.log("Iframe loaded in {time} ms: {url}", {time: Date.now() - i, url: t.src});
                    this.showLoader(!1)
                }.bind(this))
            };
            Kinobox.prototype.selectPlayer = function (n) {
                if (this.box.ul) {
                    const i = '[data-number="{id}"]'.replace("{id}", n), t = this.box.ul.querySelector(i);
                    t && t.click()
                }
            };
            Kinobox.prototype.createRefreshButton = function () {
                const n = document.createElement("button");
                n.className = "kinobox_button_refresh";
                n.textContent = "Обновить";
                this.box.message.appendChild(n);
                n.addEventListener("click", function () {
                    n.disabled = !0;
                    this.init()
                }.bind(this))
            };
            Kinobox.prototype.buildContainer = function () {
                this.container.innerHTML = "";
                this.box.wrapper = document.createElement("div");
                this.box.wrapper.className = "kinobox_wrapper";
                this.container.appendChild(this.box.wrapper);
                this.box.loader = document.createElement("div");
                this.box.loader.className = "kinobox_loader";
                this.box.wrapper.appendChild(this.box.loader);
                this.box.message = document.createElement("div");
                this.box.message.className = "kinobox_message kinobox_hidden";
                this.box.wrapper.appendChild(this.box.message);
                this.box.iframeWrapper = document.createElement("div");
                this.box.iframeWrapper.className = "kinobox_iframe_wrapper";
                this.box.wrapper.appendChild(this.box.iframeWrapper);
                this.box.nav = document.createElement("nav");
                this.box.nav.className = "kinobox_nav";
                this.box.nav.style.display = "none";
                this.box.wrapper.appendChild(this.box.nav);
                this.box.ul = document.createElement("ul");
                this.box.ul.className = "kinobox_nav_ul";
                this.box.nav.appendChild(this.box.ul);
                this.box.buttonMenu = document.createElement("button");
                this.box.buttonMenu.className = "kinobox_nav_button";
                this.box.nav.appendChild(this.box.buttonMenu);
                this.settings.menu.enable === !1 && this.showNavigation(!1);
                this.isMobile() ? (this.box.nav.classList.add(this.settings.menu.mobile), this.box.buttonMenu.setAttribute("enabled", "true")) : (this.box.nav.classList.add(this.settings.menu.default), this.settings.menu.default === "menu_button" && this.box.buttonMenu.setAttribute("enabled", "true"));
                this.box.ul.addEventListener("mouseenter", function () {
                    this.box.nav.classList.contains("menu_list") && this.showMenu(!0)
                }.bind(this));
                this.box.ul.addEventListener("mouseleave", function () {
                    this.box.nav.classList.contains("menu_list") && this.showMenu(!1)
                }.bind(this));
                this.box.buttonMenu.addEventListener("click", function () {
                    this.showMenu(!this.state.isMenuOpen)
                }.bind(this))
            };
            Kinobox.prototype.buildMenu = function () {
                this.settings.menu.open && this.showMenu(!0);
                const n = this.getConfiguredPlayers();
                n.length === 0 && this.showMessage("Видео не найдено.");
                n.forEach(function (n, t) {
                    if (n.success !== !1) {
                        const r = this.sortTranslations(n.translations), u = (t + 1).toString(),
                            i = document.createElement("li");
                        i.dataset.number = u;
                        i.dataset.url = this.getIframeUrl(r.iframeUrl, n.source);
                        i.title = "{N}. {T} ({Q}) [{S}]".replace("{N}", u).replace("{S}", n.source).replace("{T}", r.name || "Не указано").replace("{Q}", r.quality || "-");
                        i.innerHTML = this.settings.menu.format.replace("{N}", u).replace("{S}", n.source).replace("{T}", r.name || "Не указано").replace("{Q}", r.quality || "-");
                        this.box.ul.appendChild(i);
                        i.addEventListener("click", function () {
                            this.log("Switch to player: {number}, {source}", {
                                number: i.dataset.number,
                                source: n.source
                            });
                            [].forEach.call(this.box.ul.querySelectorAll("li"), function (n) {
                                n.removeAttribute("active")
                            });
                            i.setAttribute("active", "");
                            this.showIframe(i.dataset.url)
                        }.bind(this))
                    }
                }.bind(this))
            };
            Kinobox.prototype.init = function () {
                if (this.isSearchBot()) {
                    this.buildContainer();
                    this.showMessage("Disabled.");
                    this.log("Disabled.");
                    return
                }
                this.log("Initializing");
                this.appendStyles();
                this.buildContainer();
                this.bindHotkeys();
                this.log("Searching");
                const n = this.getSearchUrl(), t = function (n) {
                    try {
                        n.data ? n.data.message ? this.showMessage(n.data.message) : n.data.detail ? this.showMessage(n.data.detail) : n.data.error ? this.showMessage(n.data.error.message) : (this.state.players = n.data, this.buildMenu(), this.showNavigation(!0), this.selectPlayer(1)) : (this.showMessage("Ошибка загрузки данных."), this.createRefreshButton())
                    } catch (t) {
                        console.error(t);
                        this.showMessage("Ошибка загрузки данных.");
                        this.createRefreshButton()
                    }
                }.bind(this);
                this.fetch(n, t)
            };
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll('[data-kinobox="auto"]').forEach(function (n) {
                    new Kinobox(n, {}).init()
                })
            });

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
        }catch(error){console.log(error)};
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
