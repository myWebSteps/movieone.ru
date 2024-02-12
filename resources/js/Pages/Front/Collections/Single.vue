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

            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="bg-white p-3 widget shadow rounded mb-4">
                        <h6 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Содержание</h6>
                        <div class="artist-list mt-3">
                                <ul>
                                    <li v-for="article in data.articles" class="mt-3">
                                            <a :href="`#article${article.article_id}`" class="articles text-truncate text-wrap font-weight-bold">{{article.article_title}}</a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9">
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
                                    <h2 class="mt-0 mb-3">{{data.collection_title}}</h2>
                                    <p class ="text-gray-900 font-size-1" v-html="data.description"></p>
                                    <hr>
                                </article>

                                <article v-for="article in data.articles">
                                    <h3 :id="`article${article.article_id}`" class="mt-0 mb-3">{{article.article_title}}</h3>
                                    <div>
                                        <img class="img-fluid" v-lazy="article.image" :alt="article.article_title">
                                    </div>
                                    <p class ="text-gray-900 font-size-1 mt-2" v-html="article.description"></p>
                                    <Link :href="`/movies/${article.movies.slug}`">Перейти к видео &#8594</Link>
                                    <hr>
                                </article>

                            </div>

                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                                <comments-component :comments="data" :id="data.id" type="collections" :message.sync = "message"></comments-component>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="col-xl-3 col-lg-3">-->
<!--                    &lt;!&ndash; Рекламный блок &ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="bg-white p-3 widget shadow rounded mb-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <h1 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Наши соцсети:</h1>&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-gray-900">&ndash;&gt;-->
<!--&lt;!&ndash;                            <b>Boston Harborwalk</b>&ndash;&gt;-->
<!--&lt;!&ndash;                            <br>Christopher Columbus Park<br>Boston, MA 02109<br>United States</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        <p>&ndash;&gt;-->
<!--&lt;!&ndash;                            <i class="fas fa-mobile fa-fw">&ndash;&gt;-->
<!--&lt;!&ndash;                                &ndash;&gt;-->
<!--&lt;!&ndash;                            </i> +00 12354 89564</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="mb-0"><i class="fas fa-envelope-open fa-fw"></i> youremail@gmail.com</p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                    <div class="bg-white p-3 widget shadow rounded mb-4">-->
<!--                        <h1 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Map</h1>-->
<!--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501889.1723543713!2d73.1567129962395!3d31.003573085499188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391964aa569e7355%3A0x8fbd263103a38861!2sPunjab!5e0!3m2!1sen!2sin!4v1570105072228!5m2!1sen!2sin" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
<!--                    </div>-->
<!--                </div>-->
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
    import CommentsComponent from "@/Components/CommentsComponent.vue";



    export default {
        name: "Collections_single",
        props: ['data'],
        components: {CommentsComponent, Head, Link, FrontLayout, Message},

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
