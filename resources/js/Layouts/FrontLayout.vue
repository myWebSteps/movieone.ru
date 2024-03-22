<template>

    <div class="main-wrapper">
        <header class="bg-[#333545] grid z-40">
            <div class="px-4 grid grid-cols-[max-content,_repeat(2,_1fr)] content-center gap-4">

                <div @click.prevent="show.menu = !show.menu" class="justify-self-start grid content-center self-center
                cursor-pointer"
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
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-400 hover:text-gray-200 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                <span class="material-symbols-sharp">search</span>
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
                                <span class="material-symbols-sharp">search</span>
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
                        <span class="material-symbols-sharp">search</span>
                    </button>
                </form>


                <div class="z-50 justify-self-end self-center grid grid-flow-col gap-4">
                <Dropdown :closeOnClick=false align="right" width="half" class="self-center cursor-pointer">
                    <template #trigger>
                         <span class="grid self-end text-gray-400 hover:text-white">
                                            <span class="material-symbols-sharp ">favorite</span>
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
                        <h6 class="text-sm font-semibold p-2">Избранные видео:</h6>
                        <template v-for="item in playlist">
                        <DropdownLink :href="`/movies/${item.slug}`"
                        class="grid grid-flow-col grid-cols-[1fr,_2fr] min-w-72 gap-2"
                        >
                            <img :src="item.posterUrl" alt="...">
                            <div class="grid grid-flow-row text-wrap">
                            <span class="font-semibold">{{item.nameRu}}</span>
                            <span class="font-light">{{item.nameEn}}</span>
                            <span class="grid grid-flow-col grid-cols-[repeat(2,_max-content)]
                             items-center">
                                <i class="lni lni-calendar text-rose-700"></i>&nbsp
                                {{item.year}}
                            </span>
                                <div>
                            <span class="material-symbols-sharp text-rose-500">camera_roll</span>&nbsp
                            <template v-for="genre in item.genres">
                                {{genre.title}}&nbsp
                            </template>
                                </div>

                            </div>

                        </DropdownLink>
                        </template>




                    </template>
                </Dropdown>

                <Dropdown :closeOnClick=false align="right" width="half" class="self-center cursor-pointer">
                    <template #trigger>
                                <span class="grid self-end text-gray-400 hover:text-white">
                        <span class="material-symbols-sharp">bookmark</span>
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
                        <h6 class="text-sm font-semibold p-2">Избранные коллекции:</h6>
                        <template v-for="item in bookmarks">
                            <DropdownLink :href="`/movies/${item.slug}`"
                                          class="grid grid-flow-col grid-cols-[1fr,_2fr] min-w-72 gap-2"
                            >
                                <img :src="item.poster" alt="...">
                                <div class="grid grid-flow-row text-wrap">
                                    <span class="font-semibold">{{item.collection_title}}</span>
                                    <span class="font-semibold">{{item.description_min}}</span>
                                    <span><i class="lni lni-tag"></i>&nbsp
                            <template v-for="genre in item.genres">
                                <span>{{genre.title}}&nbsp</span>
                            </template>
                            </span>
                                </div>

                            </DropdownLink>
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
                <span class="material-symbols-sharp">close</span>
            </template>
            <template v-else>
                <span class="material-symbols-sharp">filter_alt</span>
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
             :class="show.menu ? '' : 'hidden sm:block'"
        >
            <div class="sticky top-0">
                <div class="bg-[#333545]">
                    <Link href="/" class="h-[3.7rem] mx-4 grid items-center justify-items-center
                         sm:gap-2"
                          :class="show.menu ? 'sm:grid-cols-[max-content,_max-content]' : 'grid-cols-1'"
                    >
                        <img src="/img/logo-icon.png" class="w-[60px] px-1" alt="...">
                        <p class="uppercase text-white text-base font-bold hidden
                        sm:block
                        "
                           :class="show.menu ? '' : 'sm:hidden'"
                        >MovieOne</p>
                    </Link>
                </div>
                <ul class="m-4 grid grid-flow-row sm:justify-content-start gap-4"
                    :class="$page.url.startsWith('/collections') ? 'text-white' : ''"
                >
                    <li>
                        <Link :class="show.menu ? 'sm:grid-flow-col sm:grid-cols-[repeat(2,_max-content)]' : ''"
                              href="/collections"
                              class="text-gray-500 hover:text-white grid grid-flow-row gap-1 justify-items-center items-center"
                        ><span class="material-symbols-sharp">video_library</span>
                            <span class="text-xs sm:text-sm ">Подборки</span>
                        </Link>
                    </li>
                    <li :class="$page.url === '/random_movies' ? 'text-white' : ''">
                        <Link :class="show.menu ? 'sm:grid-flow-col sm:grid-cols-[repeat(2,_max-content)]' : ''"
                              href="/random_movies"
                              class="text-gray-500 hover:text-white grid grid-flow-row gap-1 justify-items-center items-center"
                        >
                            <span class="material-symbols-sharp">shuffle</span>
                            <span class="text-xs sm:text-sm text-wrap"
                            >Случайное<br> видео</span>
                        </Link>
                    </li>
                    <li class="w-full">
                        <div class="py-1 text-gray-500">Кинотеатр</div>
                        <!-- Divider -->
                        <hr class="text-gray-500">
                        <!-- Nav Item  -->
                    </li>
                    <li v-for="category in $page.props.categories"
                        :class="$page.url.startsWith(`/movies?category=${category.slug}`) ? 'text-white' : ''">
                        <Link
                            :class="show.menu ? 'sm:grid-flow-col sm:grid-cols-[repeat(2,_max-content)]' : ''"
                            class="text-gray-500 hover:text-white grid grid-flow-row gap-1 justify-items-center items-center"
                            :href="`/movies?category=${category.slug}&order=year&page=1`">
                            <span class="material-symbols-sharp">{{category.logo}}</span>
                            <span class="text-xs sm:text-sm">{{ category.title }}</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>

        <main
            :class="$page.component === 'Front/Movies/Index' ? 'lg:grid lg:grid-cols-[max-content,_1fr]' : 'overflow-x-hidden'">

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
            <div class="p-8 grid justify-start">
                MovieOne.ru
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


export default {
    name: "FrontLayout",

    components: {DropdownLink, Dropdown, Link, Message, FilterComponent},

    data() {
        return {
            trigger:{
                playlist: false,
                bookmark: false,
            },
            show: {
                menu: false,
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
    beforeMount() {
        this.playListCount()
        this.bookmarksCountFunc()
        },

    mounted() {
        this.makePlaylist()
        this.makeBookmarks()
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
