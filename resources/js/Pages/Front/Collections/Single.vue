<template>

<!--    <Head>-->
<!--        <title>{{movie.nameRu}}/{{movie.nameEn}} {{movie.meta_title}}</title>-->
<!--        <meta name="keywords" :content="movie.meta_keywords"/>-->
<!--        <meta name="description" :content="movie.meta_description"/>-->
<!--    </Head>-->

    <FrontLayout ref="front_layout">
        <!-- Begin Page Content -->
        <div class="container-fluid mobile-container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="bg-white info-header shadow rounded mb-4">
                        <div class="d-flex align-items-center justify-content-between py-3 px-4 border-bottom">
                            <div>
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
                        <h1 class="h6 mb-3 mt-0 font-weight-bold text-gray-900">Содержание</h1>
                        <div class="artist-list mt-3">
                                <ul>
                                    <li v-for="article in data.articles" class="mt-3">
                                            <Link :href="`#article${article.article_id}`" class="articles text-truncate text-wrap font-weight-bold">{{article.article_title}}</Link>
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

                                <article v-for="article in data.articles" :id="`article${article.article_id}`">
                                    <h3 class="mt-0 mb-3">{{article.article_title}}</h3>
                                    <div>
                                        <img class="img-fluid" v-lazy="article.image" :alt="article.article_title">
                                    </div>
                                    <p class ="text-gray-900 font-size-1 mt-2">{{article.description}}</p>
                                    <Link :href="`/movies/${article.movies.slug}`">Перейти к видео &#8594</Link>
                                    <hr>
                                </article>

                            </div>

                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">

                                    <div class="card-body p-0 reviews-card">
                                        <div v-if="data.comments.length > 0" v-for="comment in data.comments"
                                             class="media mb-4">
                                            <img class="d-flex mr-3 rounded-circle" src="/img/comment.webp" alt="">
                                            <div class="media-body">
                                                <div class="mt-0 mb-1">
                                                    <p class="h6 mr-2 font-weight-bold text-gray-900 d-inline-block">
                                                        {{comment.name}}</p>
                                                    <p class="d-inline-block"><i class="fa fa-calendar"></i>
                                                        {{comment.created_at}}</p>
                                                    <p class="stars-rating float-right d-inline-block">
                                                        <template v-for="(item, index) in 5">
                                                            <i :class="comment.rate > index ? 'text-danger' : ''"
                                                               class="fa fa-heart pl-1 fs-6"></i>
                                                        </template>
                                                        <span class="rounded bg-danger text-dark ml-1 pl-1 pr-1 fs-6">{{comment.rate}}/5</span>
                                                    </p>
                                                </div>
                                                <p>{{comment.comment}}</p>
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
                                        <form name="sentMessage">
                                            <div class="row">
                                                <div class="control-group form-group col-lg-4 col-md-4">
                                                    <div class="controls">
                                                        <label>Имя: <span class="text-danger">*</span></label>
                                                        <input v-model="comment.name" type="text" class="form-control"
                                                               required="" placeholder="Введите имя">
                                                    </div>
                                                </div>
                                                <div class="control-group form-group col-lg-4 col-md-4">
                                                    <div class="controls">
                                                        <label>Оценка <span class="text-danger">*</span></label>
                                                        <select required="" v-model="comment.rate"
                                                                class="form-control custom-select">
                                                            <option :value=null disabled selected>Оцените подборку</option>
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
                                                    <textarea required="" v-model="comment.comment" rows="3"
                                                              cols="100" class="form-control"
                                                              placeholder="Напишите комментарий"></textarea>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button @click.prevent="leaveComment()" type="submit" class="btn btn-primary">Отправить</button>
                                            </div>
                                        </form>
                                    </div>
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


        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end my-z-index" role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
        </div>

        <div v-if="success" class="alert alert-success alert-dismissible fade show position-fixed-bottom-end my-z-index" role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
            <div>
                <span>{{success}}</span>
            </div>
        </div>

        <!-- /.container-fluid -->
    </FrontLayout>

</template>

<script>
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import {Head} from "@inertiajs/vue3";
    import {Link} from "@inertiajs/vue3";
    import {router} from '@inertiajs/vue3';



    export default {
        name: "Collections_single",
        props: ['data'],
        components: {Head, Link, FrontLayout},

        data() {
            return {
                bookmarksRes: [],
                bookmarksItems: null,
                comment:{
                    name: '',
                    rate: null,
                    comment: '',
                },
                errors: null,
                success: null,
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

            leaveComment() {
                router.post('/collection/add_comment', {
                    collection_id: this.data.id,
                    name: this.comment.name,
                    rate: this.comment.rate,
                    comment: this.comment.comment,
                }, {
                    preserveScroll: true,
                })
                router.on('error', (error) => {

                    this.errors = error.detail.errors

                    setTimeout(this.flushMessages, 2500)
                })
                router.on('success', () => {

                    this.success = 'Отзыв успешно отослан, он появится после модерации'


                    setTimeout(this.flushMessages, 2500)

                    this.commentsForm.name = null
                    this.commentsForm.rating = null
                    this.commentsForm.description = null
                })

            },

            flushMessages(){
                this.success = null
                this.errors = null
            },

            copyUrl() {
                navigator.clipboard.writeText(window.location.href)
                this.success = 'ссылка успешно скопирована'
                setTimeout(this.flushMessages, 2500)
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
