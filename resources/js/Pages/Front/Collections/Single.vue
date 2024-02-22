<template>

    <Head>
        <title>{{data.meta_title}}</title>
        <meta name="keywords" :content="data.meta_keywords"/>
        <meta name="description" :content="data.meta_description"/>
    </Head>

    <FrontLayout ref="front_layout">
        <!-- Begin Page Content -->
        <div class="container-fluid mobile-container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                        <div v-if="data.rating > 0"
                            class="position-absolute bg-white shadow-sm rounded text-center p-2 custom-rating-position love-box min-width">
                            <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> {{data.rating}}
                            </h6>
                        </div>
                    <div class="bg-white info-header shadow rounded mb-4">
                        <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">

                            <div class="col-lg-7 m-b-4">
                                <h1 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{data.collection_title}}</h1>
<!--                                <p class="mb-0"><small class="text-muted"><i class="fas fa-map-marker-alt fa-fw fa-sm mr-1"></i> Vancouver, Canada</small></p>-->
                            </div>
                            <div class="col-lg-5 text-right">
                                <a @click.prevent="copyUrl()" href="#"
                                   class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-share-alt"></i></a>

                                <template v-if="!bookmarksItems">
                                    <a @click.prevent="toggleBookmarks(data.id)" href="#"
                                       class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> В закладки <i
                                        class="fa-solid fa-square-plus"></i></a>
                                </template>
                                <template v-if="bookmarksItems">
                                    <a @click.prevent="toggleBookmarks(data.id)" href="#"
                                       class="d-sm-inline-block btn btn-danger shadow-sm ml-2"> Убрать <i
                                        class="fa-solid fa-square-minus"></i></a>
                                </template>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 px-4">
                            <div>
                                <p class="mb-0 text-gray-900"><i class="fas fa-calendar-alt fa-sm fa-fw mr-1"></i> {{data.date}}</p>
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
                </div>

            </div>
            <div class="d-grid custom-collections-row">
                <div id="titles">
                    <div class="bg-white p-3 widget shadow rounded">
                        <h6 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Содержание</h6>
                        <div class="artist-list mt-3">
                                <ul class="pl-3">
                                    <li v-for="article in data.articles" class="mt-3">
                                            <a :href="`#article${article.article_id}`" class="articles text-truncate text-wrap text-gray-600">{{article.article_title}}</a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div id="content">
                    <div class="bg-white p-3 widget shadow rounded mb-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Содержание</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="commects-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="profile" aria-selected="false">Комментарии
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <article>
                                    <h2 class="h4 mt-0 mb-3 text-gray-800">{{data.collection_title}}</h2>
                                    <p class ="text-gray-800 font-size-1" v-html="data.description"></p>
                                    <hr>
                                </article>

                                <article v-for="article in data.articles">
                                    <h3 :id="`article${article.article_id}`" class="h4 mt-0 mb-3 text-gray-800">{{article.article_title}}</h3>
                                    <div>
                                        <img class="img-fluid" v-lazy="article.image" :alt="article.article_title">
                                    </div>
                                    <p class ="text-gray-800 font-size-1 mt-2" v-html="article.description"></p>
                                    <div class="row">
                                        <p class ="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Сюжет: {{article.movies.plot}}</p>
                                        <p class ="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Игра актеров: {{article.movies.actors_game}}</p>
                                        <p class ="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Атмосфера: {{article.movies.atmosphere}}</p>
                                        <p class ="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Рейтинг: {{article.movies.rating}}</p>
                                    </div>
                                    <Link class="mt-2" :href="`/movies/${article.movies.slug}`">Перейти к видео &#8594</Link>
                                    <hr>
                                </article>

                            </div>

                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                                <comments-collections-component :comments="data" :id="data.id" type="collections" :message.sync = "message"></comments-collections-component>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="related_collections">
                <div class="bg-white p-3 widget shadow rounded mb-4">

                        <h6 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Другие коллекции</h6>
                        <div class="card p-card border-0 mt-2"  v-for="collection in relativeCollections">
                            <Link :href="`/collections/${collection.slug}`">
                                <div class="row no-gutters">
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <div class="col-10 col-sm-12 ">
                                        <img v-lazy="collection.poster" class="card-img" alt="...">

                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body h-100 d-grid">
                                            <h5 class="text-gray-900 font-size-1">{{collection.collection_title}}</h5>
                                            <small><p class="mb-0 text-gray-900"><i class="fas fa-calendar-alt fa-sm fa-fw mr-1"></i> {{collection.updated_at}}</p></small>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <message :message.sync = "message"></message>

        <!-- /.container-fluid -->
    </FrontLayout>

</template>

<script>
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import Message from "@/Components/Message.vue";
    import {Head} from "@inertiajs/vue3";
    import {Link} from "@inertiajs/vue3";
    import {router} from '@inertiajs/vue3';
    import CommentsCollectionsComponent from "@/Components/CommentsCollectionsComponent.vue";



    export default {
        name: "Collections_single",
        props: ['data', 'relativeCollections'],
        components: {CommentsCollectionsComponent, Head, Link, FrontLayout, Message},

        data() {
            return {
                bookmarksRes: [],
                bookmarksItems: null,
                message: {
                    body: [],
                    type: '',
                    show: false,
                },
            }
        },

        mounted() {

            ym(94438576, 'hit', `/collections/${this.data.slug}`);

            // Smooth scrolling using jQuery easing
            $(document).on('click', 'a.articles', function(e) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: ($($anchor.attr('href')).offset().top)
                }, 1000, 'easeInOutExpo');
                e.preventDefault();
            });
        },

        methods: {

            copyUrl() {
                navigator.clipboard.writeText(window.location.href)
                this.message.body = ['ссылка успешно скопирована']
                this.message.type = 'success'
                this.message.show = true

            },

            togglePlaylistButton() {
                if (localStorage.getItem('playlist')) {
                    this.bookmarksRes = localStorage.getItem('playlist').split(',')
                    if (this.bookmarksRes.includes(String(this.data.id))) {
                        this.bookmarksItems = true;
                    } else {
                        this.bookmarksItems = false;
                    }
                }
            },

            toggleBookmarks(id) {
                if (!localStorage.getItem('bookmarks')) {
                    this.bookmarksRes.push(id)
                    localStorage.setItem('bookmarks', this.bookmarksRes)
                    this.$refs.front_layout.bookmarksCountFunc()
                    this.$refs.front_layout.makeBookmarks()
                    this.bookmarksItems = true;
                } else {
                    this.bookmarksRes = localStorage.getItem('bookmarks').split(',')
                    if (this.bookmarksRes.includes(String(id))) {
                        this.bookmarksRes = this.bookmarksRes.filter(elem => {
                            if (elem != id) {
                                return elem
                            }
                        })
                        if (this.bookmarksRes == '') {
                            localStorage.removeItem('bookmarks', '')
                            this.$refs.front_layout.bookmarksCountFunc()
                            this.$refs.front_layout.makeBookmarks()
                            this.bookmarksItems = false;
                        } else {
                            localStorage.setItem('bookmarks', this.bookmarksRes)
                            this.$refs.front_layout.bookmarksCountFunc()
                            this.$refs.front_layout.makeBookmarks()
                            this.bookmarksItems = false;
                        }


                    } else {
                        this.bookmarksRes.push(id)
                        localStorage.setItem('bookmarks', this.bookmarksRes)
                        this.$refs.front_layout.bookmarksCountFunc()
                        this.$refs.front_layout.makeBookmarks()
                        this.bookmarksItems = true;
                    }
                }
            },
        },


    }
</script>
<style scoped>
    .custom-collections-row{
        grid-auto-flow: column;
        grid-auto-columns: 25% 1fr 1fr 1fr;
        grid-auto-rows: max-content 1fr;
        grid-template-areas:
            "titles content content content"
            "related_collections content content content";
        grid-gap: 0.75rem;
    }
    #titles {
        grid-area: titles;
    }
    #content {
        grid-area: content;
    }
    #related_collections {
        grid-area: related_collections;
    }
    .artist-list .rounded-circle {
        width: 50px;
        height: 50px;
    }
    @media(max-width: 576px)
    {
        .custom-collections-row{
            grid-auto-columns: 1fr;
            grid-template-areas:
                "titles"
                "content"
                "related_collections";
        }
    }
    @media (max-width: 992px) {
        .info-header, .info-header .text-right {
            text-align: center !important;
        }
    }
</style>
