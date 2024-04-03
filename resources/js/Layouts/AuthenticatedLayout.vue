<template>

    <div class="main-wrapper">
        <header class="bg-[#333545] grid items-center z-20">
            <div class="px-4 grid grid-cols-2 content-center">
                <div @click="show.menu = !show.menu" class="justify-self-start grid content-center self-center
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


                <!-- Settings Dropdown -->
                <div class="justify-self-end">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-400 hover:text-gray-200 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                 <i class="icon-keyboard_arrow_down"></i>
                                            </button>
                                        </span>
                        </template>
                        <template #content>
                            <DropdownLink href="/profile"> Profile</DropdownLink>
                            <DropdownLink href="/logout" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>


            </div>
        </header>
        <nav class="bg-[#1f2533]"
             :class="show.menu ? '' : 'hidden'"
        >
            <div class="sticky top-0">
                <div class="bg-[#333545]">
                    <Link href="/" class=" h-[3.7rem] mx-4 grid grid-flow-col items-center max-lg:grid-cols-1">
                        <div class="justify-self-center">
                            <img src="/img/logo-icon.webp" class="w-[60px] px-1" alt="...">
                        </div>
                        <div class="justify-self-center px-2 max-lg:hidden">
                            <p class="uppercase text-white text-base font-bold
                    ">MovieOne</p>
                        </div>
                    </Link>
                </div>
                <ul class="my-4 mx-2 grid grid-flow-row">
                    <li class="py-2 text-gray-500 hover:text-white">
                        <Link :class="{ 'text-white': $page.url === '/admin' }"
                              href="/admin"
                        >
                            Главная
                        </Link>
                    </li>

                    <li class="py-2 text-gray-500 hover:text-white">
                        <Link :class="{ 'text-white': $page.url.startsWith('/admin/movies')}"
                              href="/admin/movies"
                        >
                            Видео
                        </Link>
                    </li>

                    <li class="py-2 text-gray-500 hover:text-white">
                        <Link :class="{ 'text-white': $page.url.startsWith('/admin/collections')}"
                              href="/admin/collections"
                        >
                            Коллекции
                        </Link>
                    </li>

                    <li class="py-2 text-gray-500">

                        <div
                            class="hover:text-white cursor-pointer relative grid grid-flow-col justify-items-start auto-cols-max"
                            href="#"
                            @click.prevent="show.comments = !show.comments"
                        >
                            <div class="hover:text-white cursor-pointer grid grid-flow-col auto-cols-max items-center">
                                <span>Комментарии</span>
                                  <i class="icon-keyboard_arrow_down"
                                        :class="show.comments ? 'rotate-180' : ''"
                                  ></i>
                            </div>
                            <span v-if="comments.total > 0" class="relative flex h-3 w-3 mx-1">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                            </span>
                        </div>

                        <div v-if="show.comments" class="grid grid-flow-row my-2 mx-1 bg-white rounded-md">
                            <ul>
                                <li :class="{'bg-gray-200 rounded-md': $page.url.startsWith('/admin/comments/movies')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/comments/movies"
                                        preserve-state
                                    >
                                        К фильмам <span><small>{{comments.movies}}</small></span>
                                    </Link>
                                </li>
                                <li :class="{'bg-gray-200 rounded-md': $page.url.startsWith('/admin/comments/collections')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/comments/collections"
                                        preserve-state
                                    >
                                        К коллекциям <span><small>{{comments.collections}}</small></span>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="py-2 text-gray-500">

                        <div class="hover:text-white cursor-pointer grid grid-flow-col auto-cols-max items-center"
                             href="#"
                             @click.prevent="show.options = !show.options"
                        >
                            <span>Настройки</span>
                            <i class="icon-keyboard_arrow_down"
                            :class="show.options ? 'rotate-180' : ''"
                            ></i>
                        </div>

                        <div v-if="show.options" class="grid grid-flow-row my-2 mx-1 bg-white rounded-md">
                            <ul>
                                <li :class="{'bg-gray-200 rounded-md': $page.url.startsWith('/admin/categories')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/categories"
                                        preserve-state
                                    >
                                        Категории
                                    </Link>
                                </li>
                                <li :class="{'bg-gray-200 rounded-md': $page.url.startsWith('/admin/genres')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/genres"
                                        preserve-state
                                    >
                                        Жанры
                                    </Link>
                                </li>
                                <li :class="{ 'bg-gray-200 rounded-md': $page.url.startsWith('/admin/countries')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/countries"
                                        preserve-state
                                    >
                                        Страны
                                    </Link>
                                </li>
                                <li :class="{ 'bg-gray-200 rounded-md': $page.url.startsWith('/admin/titles')}"
                                    class="py-2 px-4 text-black hover:font-semibold"
                                >
                                    <Link
                                        href="/admin/titles"
                                        preserve-state
                                    >
                                        Seo Заголовки
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>


            </div>

        </nav>
        <main>
            <slot></slot>
        </main>
        <footer class="bg-white self-bottom">
            <div class="p-8 grid justify-start">
                AdminPanel
            </div>
        </footer>

    </div>

</template>

<script>
import {Link} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

export default {
    name: "AuthenticatedLayout",
    components: {Link, Dropdown, DropdownLink},
    data() {
        return {
            show: {
                options: false,
                menu: true,
                comments: false,
            },
            comments:
                {
                    movies: '',
                    collections: '',
                    total: '',
                }
        }
    },
    mounted() {
        this.getCommentsCount()
    },
    methods: {
        getCommentsCount() {
            axios.post('/get_comments_count', {})
                .then(resp => {
                    this.comments.movies = resp.data.movies
                    this.comments.collections = resp.data.collections
                    this.comments.total = resp.data.total
                })
        }
    },
}
</script>
