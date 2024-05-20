<template>

    <div class="main-wrapper">
        <header class="bg-[#333545] grid z-40">
            <div class="pr-8 grid grid-cols-[max-content,_max-content,_1fr,_max-content] content-center gap-4">

                <div @click.prevent="show.menu = !show.menu" class="justify-self-start grid content-center self-center
                cursor-pointer py-2 px-6"
                     :class="show.menu ? '' : 'space-y-1'"
                >
                    <span class="block w-4 h-0.5 bg-gray-400"
                          :class="show.menu ? 'rotate-45 translate-y-1/2 duration-500': 'duration-500'"
                    ></span>
                    <span class="block w-4 h-0.5 bg-gray-400"
                          :class="show.menu ? 'hidden' : ''"
                    ></span>
                    <span class="block w-4 h-0.5 bg-gray-400"
                          :class="show.menu ? '-rotate-45 -translate-y-1/2 duration-500': 'duration-500'"
                    >
                    </span>
                </div>

                <Dropdown :closeOnClick=false class="md:hidden z-50 cursor-pointer" align="middle" width="half">
                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-400 hover:text-gray-200 focus:outline-none transition ease-in-out duration-150"                                          >
                                                <i class="icon-search text-xl"></i>
                                            </button>
                                        </span>
                    </template>
                    <template #content>
                        <div class="inline-grid grid-flow-col grid-cols-[max-content,_30px] px-4 py-2">
                            <input v-model="searchKey" type="text" class="rounded-md"
                                   placeholder="Искать фильмы по названию..."
                                   >
                            <button @click.prevent="commenceSearch()" class="text-gray-400 hover:text-[#333545]"
                                    type="button">
                                <i class="icon-search text-xl"></i>
                            </button>
                        </div>
                    </template>
                </Dropdown>


                <form class="max-md:hidden inline-grid grid-flow-col grid-cols-[minmax(250px,_300px),_50px]
                max-sm:grid-cols-1
                "
                >
                    <input @keypress.enter.prevent="commenceSearch()" v-model="searchKey" type="text"
                           class="max-sm:hidden rounded-md" placeholder="Искать фильмы по названию..."
                           aria-label="Search" aria-describedby="basic-addon2">
                    <button @click.prevent="commenceSearch()" class="text-gray-400 hover:text-white" type="button">
                        <i class="icon-search text-xl"></i>
                    </button>
                </form>

                <ul class="justify-self-start grid items-center grid-flow-col gap-4 auto-cols-max">
                    <li class="hidden lg:block">
                        <Link href="/collections"
                        :class="$page.url.startsWith('/collections') ? 'text-white' : ''"
                              class="text-gray-400 hover:text-white
                              "
                        >
                            <i class="icon-video_library pr-2"></i>
                            <span>Подборки</span>
                        </Link>
                    </li>

                    <li class="hidden
                              lg:block">
                        <Link href="/random_movies"
                        :class="$page.url.startsWith('/random_movies') ? 'text-white' : ''"
                              class="text-gray-400 hover:text-white
                              hidden
                              lg:block"
                        >
                            <i class="icon-shuffle pr-2"></i>
                            <span class="text-nowrap"
                            >Случайное видео</span>
                        </Link>
                    </li>

                </ul>


                <div class="z-50 justify-self-end self-center grid grid-flow-col gap-4">
                <Dropdown :closeOnClick=false align="right" width="half" class="self-center cursor-pointer">
                    <template #trigger>
                         <span class="grid self-end text-gray-400 hover:text-white text-2xl">
                                            <i class="icon-favorite"></i>
                        <span v-if="playCount != null" class="absolute -top-1 right-2">
                                        <span
                                            :class="trigger.playlist ? 'ping-once' : 'ping-once-two'"
                                            class="absolute inline-flex h-4 w-4 rounded-full bg-white opacity-75"
                                        ></span>
                                        <span class="absolute grid
                                        rounded-full
                                        h-4 w-4 bg-rose-500
                                        justify-center content-center
                                        text-xs text-white"
                                        >{{playCount}}</span>
                        </span>
                        </span>
                    </template>
                    <template #content>
                        <template v-if="playlist !== null">
                        <h6 class="text-sm font-semibold p-2">Избранные видео:</h6>
                        <template v-for="item in playlist">
                        <DropdownLink :href="`/movies/${item.slug}`"
                        class="grid grid-flow-col grid-cols-[1fr,_2fr] min-w-72 gap-2"
                        >
                            <img :src="item.posterUrl" alt="...">
                            <div class="grid grid-flow-row text-wrap">
                            <span class="font-semibold">{{item.nameRu}}</span>
                            <span class="font-light">{{item.nameEn}}</span>
                            <div class="grid grid-flow-col grid-cols-[repeat(2,_max-content)]
                             items-center font-light">
                                <i class="icon-today text-xl text-rose-700"></i>&nbsp
                                {{item.year}}
                            </div>
                                <div class="font-light p-1">
                            <i class="icon-camera_roll text-rose-700"></i>&nbsp
                            <template v-for="genre in item.genres">
                                {{genre.title}}&nbsp
                            </template>
                                </div>

                            </div>

                        </DropdownLink>
                        </template>
                        </template>
                        <template v-else>
                                <div class="min-w-[200px] p-2">
                                    <span class="text-sm font-light p-2">У Вас пока нет избранных видео</span>
                                </div>
                        </template>
                    </template>
                </Dropdown>

                <Dropdown :closeOnClick=false align="right" width="half" class="self-center cursor-pointer">
                    <template #trigger>
                                <span class="grid self-end text-gray-400 hover:text-white text-2xl">
                        <i class="icon-bookmark"></i>
                        <span v-if="bookmarksCount != null" class="absolute -top-1 right-2">
                                        <span
                                            :class="trigger.bookmark ? 'ping-once' : 'ping-once-two'"
                                            class="absolute inline-flex h-4 w-4 rounded-full bg-white opacity-75"
                                        ></span>
                                        <span class="absolute
                                        grid
                                        rounded-full
                                        h-4 w-4 bg-rose-500
                                        justify-center content-center
                                        text-xs text-white"
                                        >{{bookmarksCount}}</span>
                        </span>
                        </span>
                    </template>
                    <template #content>
                        <template v-if="bookmarks !== null">
                        <h6 class="text-sm font-light p-2">Избранные коллекции:</h6>
                        <template v-for="item in bookmarks">
                            <DropdownLink :href="`/collections/${item.slug}`"
                                          class="grid grid-flow-col grid-cols-[1fr,_2fr] min-w-72 gap-2"
                            >
                                <img :src="item.poster" alt="...">
                                <div class="grid grid-flow-row">
                                    <span class="font-semibold whitespace-nowrap text-nowrap overflow-hidden text-ellipsis">{{item.collection_title}}</span>
                                    <span class="font-light whitespace-nowrap text-nowrap overflow-hidden text-ellipsis">{{item.description_min}}</span>
                                    <span class="inline-grid grid-flow-col auto-cols-max gap-1 items-center">
                                        <span class="text-rose-700 text-xl"><i class="icon-today"></i></span>&nbsp
                                        {{item.updated_at}}</span>
                                </div>

                            </DropdownLink>
                        </template>
                        </template>
                        <template v-else>
                            <div class="min-w-[200px] p-2">
                            <span class="text-sm font-light p-2">У Вас пока нет избранных коллекций</span>
                            </div>
                        </template>
                    </template>
                </Dropdown>
                </div>

            </div>
        </header>


        <div v-if="$page.component === 'Front/Movies/Index'" @click="show.filter = !show.filter"
             class="z-50 fixed  right-2 w-[40px] h-[40px] grid text-center content-center border-2 border-green-600 rounded-full
             lg:hidden"
             :class="show.filter ? 'bg-white text-green-600 top-2 ' : 'bg-green-600 text-white top-[6rem]'">
            <template v-if="show.filter">
                <i class="icon-close text-2xl"></i>
            </template>
            <template v-else>
                <i class="icon-filter_alt text-2xl"></i>
            </template>
        </div>

        <div v-if="show.filter"
        class="absolute top-0 bottom-0 right-0 left-0
        z-30
        "
        @click="show.filter = !show.filter"
        >
        </div>


        <nav class="bg-[#1f2533]"
             :class="show.menu ? '' : 'hidden'"
        >
            <div class="sticky top-0">
                <div class="bg-[#333545]">
                    <Link href="/" class="h-[3.7rem] mx-4 grid items-center justify-items-center
                         sm:gap-1"
                          :class="show.menu ? 'sm:grid-cols-[max-content,_max-content]' : 'grid-cols-1'"
                    >
                        <img src="/img/logo-icon.webp" class="w-[50px] px-1" alt="...">
                        <p class="uppercase text-white text-base font-bold hidden
                        sm:block
                        "
                           :class="show.menu ? '' : 'sm:hidden'"
                        >MovieOne</p>
                    </Link>
                </div>
                <ul class="m-2 grid grid-flow-row gap-4 pt-2 self-stretch">
                    <li class="lg:hidden">
                        <Link href="/collections"
                        :class="$page.url.startsWith('/collections') ? 'text-white' : ''"
                              class="text-gray-400 hover:text-white grid-flow-row gap-1 justify-items-center items-center
                              grid
                              "
                        >
                            <i class="icon-video_library text-2xl"></i>
                            <span class="text-sm md:text-md">Подборки</span>
                        </Link>
                    </li>
                    <li class="lg:hidden">
                        <Link href="/random_movies"
                        :class="$page.url.startsWith('/random_movies') ? 'text-white' : ''"
                              class="text-gray-400 hover:text-white grid-flow-row gap-1 justify-items-center items-center
                              grid
                              "
                        >
                            <i class="icon-shuffle text-2xl"></i>
                            <span class="text-sm md:text-md">Случайное<br> видео</span>
                        </Link>
                    </li>
                    <li v-for="category in $page.props.categories">
                        <Link class="text-gray-400 hover:text-white grid grid-flow-row gap-1 justify-items-center items-center
                        text-2xl
                        "
                        :class="$page.url.startsWith(`/movies?category=${category.slug}`) ? 'text-white' : ''"
                            :href="`/movies?category=${category.slug}&order=year&page=1`">
                            <i :class="`icon-${category.logo}`"></i>
                            <span class="text-sm md:text-md">{{ category.title }}</span>
                        </Link>
                    </li>
                </ul>

                <div
                     @click="show.menu = !show.menu"
                     class="px-1 w-full text-center text-gray-300 hover:text-white cursor-pointer text-2xl pt-8
                     ">
                        <i v-if="show.menu" class="icon-switch_right"></i>
                        <i v-if="!show.menu" class="icon-switch_left"></i>
                </div>


            </div>

        </nav>
        <main
            :class="$page.component === 'Front/Movies/Index' ? 'lg:grid lg:grid-cols-[max-content,_1fr]' : ''">

            <aside v-if="$page.component === 'Front/Movies/Index'"
                   class="fixed right-0 top-0 z-40 duration-500 lg:relative lg:translate-x-0 lg:my-2 lg:ml-2"
                   :class="show.filter ? 'translate-x-0 m-0' : 'translate-x-full'"
            >
                <filter-component ref="filter"
                >
                </filter-component>
            </aside>

            <slot></slot>
        </main>

        <footer class="bg-white self-bottom">
            <div class="p-8 grid grid-flow-col justify-between">
                <div>MovieOne.ru</div>
                <Socials></Socials>
            </div>
        </footer>

    </div>
    <message :message.sync="message"></message>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import {router} from '@inertiajs/vue3';
import Message from "@/Components/Message.vue";
import FilterComponent from "@/Components/FilterComponent.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Socials from "@/Components/Socials.vue";


export default {
    name: "FrontLayout",

    components: {DropdownLink, Dropdown, Link, Message, FilterComponent, Socials},

    data() {
        return {
            trigger:{
                playlist: false,
                bookmark: false,
            },
            show: {
                menu: this.$page.props.showMenu,
                filter: false,
            },
            searchKey: '',
            playCount: null,
            playlist: null,
            bookmarksCount: null,
            bookmarks: null,

            form: {
                categories: null
            },
            message: {
                body: [],
                type: '',
                show: false,
            },
        }
    },

    mounted() {
        this.makePlaylist()
        this.makeBookmarks()
        this.playListCount()
        this.bookmarksCountFunc()
    },


    methods: {
        commenceSearch() {
            if (this.searchKey.length >= 3) {
                router.get(`/search?key=${this.searchKey}`)
            } else {
                this.message.body = ['Поиск должен содержать минимум 3 символа']
                this.message.type = 'error'
                this.message.show = true
            }

        },
        playListCount() {
            if (localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != '') {
                this.playCount = localStorage.getItem('playlist').split(',')
                this.playCount = this.playCount.filter(function (el) {
                    return el != '';
                });
                this.trigger.playlist = !this.trigger.playlist
                this.playCount = this.playCount.length
            } else {
                this.playCount = null
            }
        },

        makePlaylist() {
            if (localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != '') {
                axios.post('/playlist', {id: localStorage.getItem('playlist')})
                    .then(response => {
                        this.playlist = response.data.data
                    })

            } else {
                this.playlist = null
            }
        },

        bookmarksCountFunc() {
            if (localStorage.hasOwnProperty('bookmarks') && localStorage.getItem('bookmarks') != '') {
                this.bookmarksCount = localStorage.getItem('bookmarks').split(',')

                this.bookmarksCount = this.bookmarksCount.filter(function (el) {
                    return el != '';
                });
                this.trigger.bookmark = !this.trigger.bookmark
                this.bookmarksCount = this.bookmarksCount.length

            } else {
                this.bookmarksCount = null
            }
        },

        makeBookmarks() {
            if (localStorage.hasOwnProperty('bookmarks') && localStorage.getItem('bookmarks') != '') {
                axios.post('/bookmarks', {id: localStorage.getItem('bookmarks')})
                    .then(response => {
                        this.bookmarks = response.data.data
                    })

            } else {
                this.bookmarks = null
            }
        },


    },


}
</script>
