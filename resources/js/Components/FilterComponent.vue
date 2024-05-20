<template>

    <div class="grid grid-flow-row gap-4 p-3 bg-white shadow-sm h-[100vh] overflow-y-auto
        sm:h-auto
        ">
        <h6>Фильтр</h6>
        <!--types-->
        <div class="grid grid-flow-row gap-1">
            <h6 class="text-gray-500">Тип</h6>
            <div class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()"
                       v-model="form.type" type="radio"
                       name="types_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       :value=null
                       id="all_types_mobile">
                <label for="all_types_mobile">Кино и Сериалы
                    <small class="text-xs text-gray-600">{{ $page.props.totalCount }}</small></label>
            </div>
            <div v-if="$page.props.typesCount.feature > 0"
                 class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()" v-model="form.type" type="radio"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       value="feature"
                       name="types_filter" id="feature">
                <label for="feature">Полнометражные <small
                    class="text-xs text-gray-600">{{ $page.props.typesCount.feature }}</small></label>
            </div>
            <div v-if="$page.props.typesCount.serial > 0"
                 class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()" v-model="form.type" type="radio"
                       value="serial"
                       name="types_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       id="serial">
                <label for="serial">Сериалы
                    <small class="text-xs text-gray-600">{{ $page.props.typesCount.serial }}</small></label>
            </div>
            <div v-if="$page.props.typesCount.mini_serial > 0"
                 class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()" v-model="form.type" type="radio"
                       value="mini_serial"
                       name="types_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       id="mini_serial">
                <label class="custom-control-label" for="mini_serial">Мини сериалы
                    <small class="text-xs text-gray-600">{{ $page.props.typesCount.mini_serial }}</small></label>
            </div>
        </div>
        <!--genres-->
        <div class="grid grid-flow-row gap-1">
            <h6 class="text-gray-500">Жанры</h6>

            <form>
                <div class="grid grid-flow-col gap-1">
                    <input @keypress.enter.prevent="send()"
                           class="rounded-md h-8"
                           v-model="form.genres_filter"
                           type="search" placeholder="Поиск жанра..."
                    >
                    <button @click.prevent="send()">
                        <i class="icon-search"></i>
                    </button>
                </div>
            </form>

            <div class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input v-model="form.genre" type="radio"
                       @change.prevent="send()"
                       name="genres_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       :value=null
                       id="all_genres">
                <label for="all_genres">Все жанры
                    <small class="text-xs text-gray-600">{{ $page.props.totalCount }}</small></label>
            </div>
            <div v-for="genre in $page.props.genres"
                 class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <template v-if="genre.genresCount > 0">
                <input @change.prevent="send()" v-model="form.genre" type="radio"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       :value="genre.genre.slug"
                       name="genres_filter" :id="genre.genre.slug">
                <label :for="genre.genre.slug">{{ genre.genre.title }}
                    <small class="text-xs text-gray-600">{{ genre.genresCount }}</small></label>
                </template>
            </div>

        </div>
        <!--countries-->
        <div class="grid grid-flow-row gap-1">
            <h6 class="text-gray-500">Страны</h6>
            <form>
                <div class="grid grid-flow-col gap-1">
                    <input @keypress.enter.prevent="send()"
                           class="rounded-md h-8"
                           v-model="form.countries_filter"
                           type="search" placeholder="Поиск стран..."
                    >
                    <button @click.prevent="send()">
                        <i class="icon-search"></i>
                    </button>
                </div>
            </form>

            <div class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input v-model="form.country" type="radio"
                       @change.prevent="send()"
                       name="countries_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       :value=null
                       id="all_countries">
                <label for="all_countries">Все страны
                    <small class="text-xs text-gray-600">{{ $page.props.totalCount }}</small></label>
            </div>
            <div v-for="country in $page.props.countries"
                 class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <template v-if="country.count > 0">
                <input @change.prevent="send()" v-model="form.country" type="radio"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       :value="country.slug"
                       name="countries_filter" :id="country.slug">
                <label :for="country.slug">{{ country.title }}
                    <small class="text-xs text-gray-600">{{ country.count }}</small></label>
                </template>
            </div>
        </div>
        <!--Year-->
        <div class="grid grid-flow-row gap-2">
            <h6 class="text-gray-500">По годам:</h6>

                <input type="number"
                       :min="$page.props.originalYearFrom"
                       :max="$page.props.originalYearTo"
                       step="1"
                       v-model="form.yearFrom">

                <input type="number"
                       :min="$page.props.originalYearFrom"
                       :max="$page.props.originalYearTo"
                       step="1"
                       v-model="form.yearTo">


            <div class="justify-self-end mt-4">
                <button @click="send()"
                        class="bg-[#333545] justify-self-end px-2 py-1 rounded-md text-white text-sm border-2 border-[#333545]
                        hover:text-[#333545] hover:bg-white"
                >Применить
                </button>
            </div>
        </div>
        <!--sort by-->
        <div class="grid grid-flow-row gap-1">
            <h6 class="text-gray-500">Сортировать по:</h6>
            <div class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()" v-model="form.order" type="radio"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       value="year"
                       name="order_filter"
                       id="year_filter"
                >
                <label for="year_filter">По году</label>
            </div>
            <div class="grid grid-flow-col justify-self-start items-center justify-items-center gap-1">
                <input @change.prevent="send()" v-model="form.order" type="radio"
                       name="order_filter"
                       class="focus:ring-white text-gray-500 w-3 h-3 self-center"
                       value="rate"
                       id="rate_filter">
                <label for="rate_filter">Рейтинг</label>
            </div>
        </div>

        <Link @click.prevent="flush()" href="#"
              class="justify-self-end md:hidden grid grid-flow-col items-center auto-cols-max">
            <span>Сбросить фильтр</span>
            <i class="icon-filter_alt_off"></i>
        </Link>

    </div>

</template>

<script>

import {Link, router} from "@inertiajs/vue3";

export default {
    name: "FilterComponent",
    components: {Link},
    data() {
        return {
            queryArr: {},
            form: {
                type: this.$page.props.data.type,
                genre: this.$page.props.data.genre,
                country: this.$page.props.data.country,
                order: this.$page.props.data.order,
                page: this.$page.props.data.page,
                genres_filter: this.$page.props.data.genres_filter,
                countries_filter: this.$page.props.data.countries_filter,
                yearFrom: this.$page.props.data.yearFrom,
                yearTo: this.$page.props.data.yearTo,
            },
        }
    },
    methods: {

        makeQueryArr() {
            for (let key in this.form) {
                if (this.form[key] !== null && this.form[key] !== '') {
                    this.queryArr[key] = this.form[key]
                }
            }
        },

        send(page = 1) {
            this.makeQueryArr()
            router.get(`/movies`,
                {
                    category: this.$page.props.category.slug,
                    type: this.queryArr.type,
                    genre: this.queryArr.genre,
                    country: this.queryArr.country,
                    order: this.queryArr.order,
                    page: page,
                    genres_filter: this.queryArr.genres_filter,
                    countries_filter: this.queryArr.countries_filter,
                    yearFrom: this.queryArr.yearFrom,
                    yearTo: this.queryArr.yearTo,
                },
                {preserveScroll: true}
            );
            this.queryArr = {}
        },

        flush(){
            this.makeQueryArr()
            router.get(`/movies?category=${this.$page.props.category.slug}&order=year&page=1`,
                {},
                {preserveScroll: true,
                        onSuccess: params => {
                                this.form.category = this.$page.props.data.category,
                                this.form.type = this.$page.props.data.type,
                                this.form.genre = this.$page.props.data.genre,
                                this.form.country = this.$page.props.data.country,
                                this.form.order = this.$page.props.data.order,
                                this.form.page = this.$page.props.data.page,
                                this.form.genres_filter = this.$page.props.data.genres_filter,
                                this.form.countries_filter = this.$page.props.data.countries_filter,
                                this.form.yearFrom = this.$page.props.data.yearFrom,
                                this.form.yearTo = this.$page.props.data.yearTo
                        }}
            );
            this.queryArr = {}
        },
    },
}

</script>
