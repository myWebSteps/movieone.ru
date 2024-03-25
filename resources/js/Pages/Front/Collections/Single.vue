<template>

    <Head>
        <title>{{data.meta_title}}</title>
        <meta name="keywords" :content="data.meta_keywords"/>
        <meta name="description" :content="data.meta_description"/>
    </Head>
    <div class="m-2 grid grid-flow-row grid-cols-1 lg:grid-flow-col lg:grid-cols-[3fr,_1fr] gap-2">
        <section class="grid grid-flow-row gap-2 relative self-start">

            <div class="grid bg-white p-2 gap-2">
                <div class="grid grid-flow-row grid-cols-1 sm:grid-flow-col justify-items-center sm:justify-between items-center">
                    <h1 class="text-lg font-semibold justify-self-start">{{ data.collection_title }}</h1>
                    <div class="grid grid-flow-col gap-2">
                        <a @click.prevent="copyUrl()" href="#"
                           class="inline-grid content-center bg-blue-900 shadow-sm border-2
                         border-blue-900 text-white
                         hover:bg-white hover:text-blue-900
                         px-2 py-1
                        rounded-md">
                            <span class="material-symbols-sharp">share</span>
                        </a>

                        <a @click.prevent="toggleBookmarks(data.id)" href="#"
                           class="inline w-full text-center
                                  border-2 border-rose-700 text-white bg-rose-700 px-2 py-1 rounded-md shadow-md
                               hover:text-rose-700 hover:bg-white
                                "
                        >
                            <template v-if="!bookmarksItems">
                                <div class="grid grid-flow-col items-center">
                                    <span class="font-light">В избранное</span>
                                    <span class="material-symbols-sharp">heart_plus</span>
                                </div>
                            </template>
                            <template v-if="bookmarksItems">
                                <div class="grid grid-flow-col items-center">
                                    <span class="font-light">Убрать</span>
                                    <span class="material-symbols-sharp">heart_minus</span>
                                </div>
                            </template>
                        </a>


                    </div>
                </div>

                <div class="grid grid-flow-col justify-between">

                    <div class="grid items-center grid-flow-col auto-cols-max">
                        <span class="material-symbols-sharp text-rose-500">today</span>&nbsp
                        <span class="text-gray-900 font-light text-sm">{{ data.date }}</span>
                    </div>
                    <div class="grid grid-flow-col grid-cols-[repeat(3,_max-content)] auto-rows-[32px] items-center
                        justify-self-center
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

                <div v-if="data.rating > 0" class="grid items-center grid-flow-col auto-cols-max">
                    <span class="material-symbols-sharp text-rose-600">star_half</span>
                    <span>{{ data.rating }}</span>
                </div>

                <article>
                    <p class="text-gray-800 font-light" v-html="data.description"></p>
                </article>

            </div>

            <div class="grid grid-flow-row bg-white p-2">
                <h6 class="font-semibold text-gray-900 text-sm">Статьи:</h6>
                <ul class="grid grid-cols-[repeat(auto-fit,_minmax(20px,_200px))]">
                    <li v-for="article in data.articles"
                        class="grid gap-2"
                    >
                        <a :href="`#article${article.article_id}`"
                           class="text-wrap text-gray-600 font-light">{{
                                article.article_title
                            }}
                            <span class="material-symbols-sharp">arrow_right_alt</span>
                        </a>
                    </li>
                </ul>
            </div>


            <article v-for="article in data.articles"
                     class="bg-white grid grid-flow-row gap-2"
                     :id="`article${article.article_id}`"
            >
                <h3 class="text-gray-800 text-xl font-semibold p-2">
                    {{ article.article_title }}</h3>
                <img v-lazy="article.image" :alt="article.article_title">
                <div class="p-2 grid grid-flow-row gap-4">
                    <p class="text-gray-800 text-sm " v-html="article.description"></p>
                    <div class="grid grid-cols-[repeat(auto-fit,_minmax(150px,_200px))]">
                        <p class="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Сюжет:
                            {{ article.movies.plot }}</p>
                        <p class="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Игра актеров:
                            {{ article.movies.actors_game }}</p>
                        <p class="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Атмосфера:
                            {{ article.movies.atmosphere }}</p>
                        <p class="text-gray-600 font-size-1 mt-2 col-xl-3 col-lg-6 col-sm-6 col-12">Рейтинг:
                            {{ article.movies.rating }}</p>
                    </div>
                </div>
                <Link :href="`/movies/${article.movies.slug}`"
                      class="px-2 py-1 m-2 justify-self-start border-2 border-red-700 rounded-md text-rose-700 hover:bg-rose-700 hover:text-white"
                >Перейти к видео &#8594
                </Link>
            </article>


        </section>
        <section class="grid self-start gap-2">
            <div class="bg-white p-2">
            <h6 class="font-semibold ">Другие коллекции</h6>
            <div v-for="collection in relativeCollections"
                 class="grid grid-cols-[repeat(auto-fit,_minmax(150px,_250px))]"
            >
                <Link :href="`/collections/${collection.slug}`"
                      class="grid grid-cols-[1fr,_3fr] gap-2"
                >
                    <img v-lazy="collection.poster" class="card-img" alt="...">
                    <div class="grid items-stretch">
                        <h5 class="text-gray-900 text-md">{{ collection.collection_title }}</h5>
                        <p class="font-light whitespace-nowrap text-nowrap overflow-hidden text-ellipsis">
                            {{collection.description_min}}
                        </p>


                        <span class="inline-grid grid-flow-col auto-cols-max gap-1 items-center"><span
                            class="material-symbols-sharp text-rose-500">today</span>&nbsp{{
                                collection.updated_at
                            }}</span>
                    </div>

                </Link>
            </div>
            </div>

            <div class="bg-white p-2">
                <comments-collections-component :comments="data.comments" :id="data.id" type="collections"
                                                :message.sync="message">
                </comments-collections-component>

            </div>

        </section>

    </div>
    <message :message.sync="message"></message>

    <!-- /.container-fluid -->

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
    layout: FrontLayout,
    props: ['data', 'relativeCollections'],
    components: {CommentsCollectionsComponent, Head, Link, Message},

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

    beforeUnmount() {
        ym(94438576, 'hit', `/collections/${this.data.slug}`);
    },

    mounted() {
        this.togglePlaylistButton()
    },

    methods: {
        getBackground(elem, background) {
            console.log(elem)
        },

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
                this.$parent.bookmarksCountFunc()
                this.$parent.makeBookmarks()
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
                        this.$parent.bookmarksCountFunc()
                        this.$parent.makeBookmarks()
                        this.bookmarksItems = false;
                    } else {
                        localStorage.setItem('bookmarks', this.bookmarksRes)
                        this.$parent.bookmarksCountFunc()
                        this.$parent.makeBookmarks()
                        this.bookmarksItems = false;
                    }


                } else {
                    this.bookmarksRes.push(id)
                    localStorage.setItem('bookmarks', this.bookmarksRes)
                    this.$parent.bookmarksCountFunc()
                    this.$parent.makeBookmarks()
                    this.bookmarksItems = true;
                }
            }
        },
    },


}
</script>
<style scoped>
.custom-collections-row {
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

@media (max-width: 576px) {
    .custom-collections-row {
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
