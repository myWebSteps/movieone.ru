<template>

    <Head title="Создать видео"/>

    <h2 class="bg-white p-4 shadow-md">Создать видео</h2>

    <section class="container mx-auto p-4 relative overflow-hidden">

        <parser :form.sync="form"
                :examples.sync="examples"
                :message.sync="message"
                :show="show"
                :spinOff.sync="spinOff"
        >
        </parser>

        <div class="grid grid-flow-row grid-rows-[max-content_max-content_100px] gap-4">
            <div
                class="grid grid-cols-[repeat(auto-fill,_minmax(max-content,_150px))] gap-4 items-center">
                <span class="cursor-pointer" @click="accordion = 'general'"
                      :class="accordion === 'general' ? 'border-b-2 border-red-400' : ''"
                >
                    Информация
                </span>
                <span class="cursor-pointer" @click="accordion = 'facts'"
                      :class="accordion === 'facts' ? 'border-b-2 border-red-400' : ''"
                >
                    Факты
                </span>
                <span class="cursor-pointer" @click="accordion = 'spin_off'"
                      :class="accordion === 'spin_off' ? 'border-b-2 border-red-400' : ''"
                >
                    Сиквелы
                </span>
                <span class="cursor-pointer" @click="accordion = 'posters'"
                      :class="accordion === 'posters' ? 'border-b-2 border-red-400' : ''"
                >
                    Постеры
                </span>
                <span class="cursor-pointer" @click="accordion = 'trailers'"
                      :class="accordion === 'trailers' ? 'border-b-2 border-red-400' : ''"
                >
                    Трейлеры
                </span>
                <span class="cursor-pointer" @click="accordion = 'soundTracks'"
                      :class="accordion === 'soundTracks' ? 'border-b-2 border-red-400' : ''"
                >
                    Саундтреки
                </span>
                <span class="cursor-pointer" @click="accordion = 'seo'"
                      :class="accordion === 'seo' ? 'border-b-2 border-red-400' : ''"
                >
                    Seo
                </span>
            </div>

            <section v-if="accordion === 'general'"
                     class="grid grid-flow-row grid-rows-[max-content_max-content_max-content] gap-2"
            >
                <div class="grid
                    grid-flow-row
                    md:grid-flow-col md:grid-cols-[4fr_1fr]
                    ">

                    <div class="grid grid-cols-[repeat(auto-fill,_minmax(50px,_200px))] gap-4">

                        <label> Показ видео: <br>
                            <select class="w-full" v-model="form.video_allowed">
                                <option :value="1">Разрешено</option>
                                <option :value="0">Задержка</option>
                            </select>
                        </label>

                        <label> Год: <br>
                            <input class="w-full" v-model="form.year" type="text" placeholder="Выберите год">
                        </label>

                        <label> Русское название: <br>
                            <input class="w-full" v-model="form.nameRu" type="text"
                                   placeholder="Введите русское название">
                        </label>

                        <label>Английское название: <br>
                            <input class="w-full" v-model="form.nameEn" type="text"
                                   placeholder="Введите английское название">
                        </label>

                        <label>Возрастные ограничения: <br>
                            <input class="w-full" v-model="form.age_limits" type="text"
                                   placeholder="Введите ограничения по возрасту">
                        </label>

                        <label>Продолжительность: <br>
                            <input class="w-full" v-model="form.duration" type="text"
                                   placeholder="Введите ограничения по возрасту">
                        </label>

                        <label>Бюджет: <br>
                            <input class="w-full" v-model="form.budget" type="text" placeholder="Бюджет">
                        </label>

                        <label>Тип: <br>
                            <select class="w-full" v-model="form.type">
                                <option value="" disabled>Выберите Тип</option>
                                <option value="2">Полнометражные</option>
                                <option value="3">Сериалы</option>
                                <option value="4">Мини сериалы</option>
                            </select>
                            <div v-if="examples.type != null" class="text-gray-400">
                                <span class="text-green-600">Тип: </span>
                                <br>
                                <span v-if="examples.type == true">Сериал</span>
                                <span v-else>Полнометражный</span>
                            </div>
                        </label>

                        <label>Категория: <br>
                            <select class="w-full" @change="renderGenres()" v-model="form.category">
                                <option disabled value="" selected>Выберите категорию</option>
                                <template v-for="category in categories">
                                    <option :value="category.id">{{ category.title }}</option>
                                </template>
                            </select>
                            <div v-if="examples.category != null" class="text-gray-400">
                                <span class="text-green-600">Категория Кинопоиска: </span>
                                <br>
                                <span>{{ examples.category }}</span>
                            </div>
                        </label>

                        <label v-if="genres != null">Жанры: <br>
                            <select class="w-full" v-model="form.genres" multiple
                                    placeholder="Можно выбрать несколько">
                                <template v-for="genre in genres.list">
                                    <option :value="genre.id">{{ genre.title }}</option>
                                </template>
                            </select>
                            <div v-if="examples.genres != null" class="text-gray-400">
                                <span class="text-green-600">Жанры по Кинопоиску: </span>
                                <br>
                                <span v-for="genre in examples.genres">{{ genre.name }} &nbsp</span>
                            </div>
                        </label>

                        <label>Страны: <br>
                            <select class="w-full" v-model="form.countries" multiple>
                                <option disabled value="null">Выберите страны</option>
                                <template v-for="country in countries">
                                    <option :value="country.id">{{ country.title }}</option>
                                </template>
                            </select>
                            <div v-if="examples.countries != null" class="text-gray-400">
                                <span class="text-green-600">Страны по Кинопоиску: </span>
                                <br>
                                <span v-for="country in examples.countries">{{ country.name }} &nbsp</span>
                            </div>
                        </label>

                    </div>

                    <aside
                        class="w-2/3
                        md:w-full
                        "
                    >
                        <h3 class="pb-2">Оценка видео:</h3>
                        <label>Сюжет:
                            <div class="grid grid-flow-col grid-cols-[repeat(6,_1fr)] bg-gray-200">
                                <label class="px-4 py-2 block justify-self-center"
                                       :class="form.plot === null ? 'bg-sky-950 text-white': ''"
                                >
                                    <i class="icon-star_half"></i>
                                    <input v-model="form.plot" :value=null type="radio"
                                           name="rate_plot"
                                           checked disabled
                                           class="hidden"
                                    >
                                </label>
                                <template v-for="item in 5">
                                    <label class="px-4 py-2 block bg-inherit justify-self-center"
                                           :class="form.plot === item ? 'bg-sky-950 text-white': ''"
                                    >{{ item }}
                                        <input v-model="form.plot"
                                               @input.prevent="countScore(item, form.actors_game, form.atmosphere)"
                                               :value="item" type="radio"
                                               name="rate_plot"
                                               class="hidden"
                                        >
                                    </label>
                                </template>
                            </div>
                        </label>
                        <label>Игра актеров:
                            <div class="grid grid-flow-col grid-cols-[repeat(6,_1fr)] bg-gray-200">
                                <label class="px-4 py-2 block justify-self-center"
                                       :class="form.actors_game === null ? 'bg-sky-950 text-white': ''"
                                >
                                    <i class="icon-star_half"></i>
                                    <input v-model="form.actors_game" :value=null type="radio"
                                           name="rate_actors_game"
                                           checked disabled
                                           class="hidden"
                                    >
                                </label>
                                <template v-for="item in 5">
                                    <label class="px-4 py-2 block bg-inherit justify-self-center"
                                           :class="form.actors_game === item ? 'bg-sky-950 text-white': ''"
                                    >{{ item }}
                                        <input v-model="form.actors_game"
                                               @input.prevent="countScore(form.plot, item, form.atmosphere)"
                                               :value="item" type="radio"
                                               name="rate_actors_game"
                                               class="hidden"
                                        >
                                    </label>
                                </template>
                            </div>
                        </label>

                        <label>Атмосфера:
                            <div class="grid grid-flow-col grid-cols-[repeat(6,_1fr)] bg-gray-200">
                                <label class="px-4 py-2 block justify-self-center"
                                       :class="form.atmosphere === null ? 'bg-sky-950 text-white': ''"
                                >
                                    <i class="icon-star_half"></i>
                                    <input v-model="form.atmosphere" :value=null type="radio"
                                           name="rate_atmosphere"
                                           checked disabled
                                           class="hidden"
                                    >
                                </label>
                                <template v-for="item in 5">
                                    <label class="px-4 py-2 block bg-inherit justify-self-center"
                                           :class="form.atmosphere === item ? 'bg-sky-950 text-white': ''"
                                    >{{ item }}
                                        <input v-model="form.atmosphere"
                                               @input.prevent="countScore(form.plot, form.actors_game, item)"
                                               :value="item" type="radio"
                                               name="rate_atmosphere"
                                               class="hidden"
                                        >
                                    </label>
                                </template>
                            </div>
                        </label>
                        <div v-if="form.rate" class="col-12 mt-2">
                            <p class="text-muted">Общая оценка: {{ form.rate }}</p>
                        </div>
                        <div v-if="examples.rate != null" class="text-gray-400">
                            <span class="text-green-600">Рейтинг Кинопоиска: </span>
                            <br>{{ examples.rate }}
                        </div>
                    </aside>
                </div>

                <div>
                    <label>Слоган:
                        <small :class="form.slogan.length > 255 ? 'text-red-600' : ''">
                            &nbsp{{ form.slogan.length }}
                            / 255</small><br>
                    </label>
                    <input v-model="form.slogan" type="text"
                           class="w-full"
                           placeholder="Слоган">
                </div>

                <div>
                    <label>Описание:
                        <small :class="form.description.length > 16300 ? 'text-red-600' : ''">
                            &nbsp{{ form.description.length }}
                            / 16300</small>
                    </label>
                    <div v-if="examples.description != null" class="text-gray-400">
                        <span class="text-green-600">Пример Кинопоиска: </span>
                        <br>{{ examples.description }}
                    </div>
                    <textarea class="w-full" v-model="form.description"
                              id="description" rows="10" placeholder="Вставьте описание"></textarea>
                </div>

            </section>
            <section v-if="accordion === 'facts'" class="grid gap-4">
                <div v-for="(fact, index) in form.facts" class="grid gap-2 grid-flow-row
                        p-2
                        ">

                    <div class="grid gri-cols-3 gap-2">
                        <div class="grid-cols-subgrid col-span-3 bg-white p-2">
                            <label>Факт: <br>
                                <textarea class="w-full" v-model="fact.value">{{fact.value}}</textarea>
                            </label>
                        </div>


                        <div class="bg-white p-2">
                            <label>Тип: <br>
                                <select v-model="fact.type">
                                    <option value="FACT">Факт</option>
                                    <option value="BLOOPER">Киноляп</option>
                                </select>
                            </label>
                        </div>

                        <div class="bg-white p-2">
                            <label>Спойлер: <br>
                                <select v-model="fact.spoiler">
                                    <option :value=false>нет</option>
                                    <option :value=true>да</option>
                                </select>
                            </label>
                        </div>


                        <div class="bg-white p-2 grid items-center justify-center">
                            <button @click="deleteFact(index)"
                                    class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white">
                                <i class="icon-delete font-bold text-2xl"></i>Удалить
                            </button>
                        </div>

                    </div>
                </div>

                <div class="justify-self-start">
                    <button @click="addFact()" type="button"
                            class="bg-green-800 text-white box-border px-6 py-2 mr-6 rounded-md justify-self-end
                             hover:text-green-800 hover:border-green-800 border-2 hover:bg-white">
                        Add
                    </button>
                </div>

            </section>
            <section v-if="accordion === 'spin_off'" class="grid grid-flow-row gap-8">

                    <div class="grid grid-flow-row gap-4">Сиквелы: <br>
                        <div v-for="spin_off in spinOff.parsed"
                             class="grid grid-flow-col auto-cols-max items-center gap-4">
                            <i class="icon-check_circle text-green-500"></i>
                            <span>{{ spin_off.nameRu }} / {{ spin_off.year }}</span>
                            <i @click.prevent="deleteSpinOff(spin_off)"
                               class="icon-delete text-red-500 cursor-pointer"></i>
                        </div>

                        <template v-if="spinOff.selected.length > 0">
                            <div v-for="selected_movie in spinOff.selected"
                                 class="grid grid-flow-col auto-cols-max items-center gap-4">
                                <i class="icon-check_circle text-green-500"></i>
                                <span>{{ selected_movie.nameRu }} / {{ selected_movie.year }}</span>
                            </div>
                        </template>

                    </div>

                    <div>
                        <label for="spin_off_movies">Выберите другие спин-оффы, Сиквели или приквелы</label>

                        <div class="grid grid-flow-col grid-cols-[200px,_max-content] py-4">
                            <input @keypress.enter.prevent="getFilteredMovies()"
                                   v-model="movies_filter"
                                   type="search"
                                   class="w-full"
                                   placeholder="Фильтр по названию...">
                            <button @click.prevent="getFilteredMovies()"
                                    class="bg-green-600 text-white box-border border-[1px] border-green-600 px-4 py-2
                             hover:text-green-600 hover:border-green-600 hover:bg-white"
                            >
                                <i class="icon-search grid content-center"></i>
                            </button>
                        </div>

                        <select v-model="spinOff.selected" id="spin_off_movies" class="w-full min-h-52 max-h-96 overflow-auto" multiple>

                            <option v-for="movie in list.movies" :value="movie">{{ movie.nameRu }}</option>

                        </select>
                    </div>

            </section>
            <section v-if="accordion === 'posters'" class="grid gap-4
                grid-flow-row
                md:grid-cols-[1fr_3fr]
                ">
                <div class="grid gap-4">
                    <img v-if="previews.poster != null" class="w-1/2 justify-self-center" :src="previews.poster"
                         alt="Превью постера">
                    <label class="self-end">Постер:<br>
                        <input @input="handleImg('poster', $event)"
                               type="file" accept="jpg, jpeg">
                    </label>
                    <figcaption class="text-sm text-gray-500 my-1">*Размер: 267 X 400. Формат *jpg, *jpeg</figcaption>
                    <a v-if="examples.posterUrlPreview != null" :href="examples.posterUrlPreview" target="_blank"
                       class="text-green-600 cursor-pointer"
                    >
                        Ссылка на постер
                    </a>
                </div>
                <div class="grid gap-4">
                    <img v-if="previews.backdrop != null" class="w-3/4 justify-self-center" :src="previews.backdrop"
                         alt="Превью фоновой картинки">
                    <label class="self-end">Фоновая картинка:<br>
                        <input @input="handleImg('backdrop', $event)"
                               type="file" accept="jpg, jpeg">
                    </label>
                    <figcaption class="text-sm text-gray-500 my-1">*Размер: 1200 X 450. Формат *jpg, *jpeg</figcaption>
                    <a v-if="examples.backdropUrl != null" :href="examples.backdropUrl" target="_blank"
                       class="text-green-600 cursor-pointer self-end"
                    >
                        Ссылка на Backdrop
                    </a>
                </div>


            </section>
            <section v-if="accordion === 'trailers'">
                <form class="grid grid-flow-row gap-2">
                    <div class="grid grid-flow-col items-center">
                        <span>Трейлеры</span>
                    </div>
                    <div v-if="form.trailers.length > 0"
                         v-for="(trailer,index) in form.trailers"
                         class="grid gap-y-4
                             grid-flow-row
                             md:grid-flow-col md:grid-cols-[3fr,_2fr,_1fr,_1fr]">
                        <input type="text" v-model="trailer.url"
                               class="
                                   rounded mt-2
                                   md:mt-0 md:rounded-r-none md:border-r-0
                                   "
                               placeholder="Идентификатор dzen или ссылка youtube">
                        <input type="text" v-model="trailer.name"
                               class="
                                   rounded mt-2
                                   md:mt-0 md:border-r-0 md:rounded-none
                                   "
                               placeholder="Название">
                        <select v-model="trailer.site"
                                class="
                                rounded mt-2
                                md:mt-0 md:border-r-0 md:rounded-none
                                ">
                            <option value="dzen">dzen</option>
                            <option value="youtube">youtube</option>
                        </select>
                        <button @click.prevent="deleteTrailer(index)" type="button"
                                class="rounded-r bg-red-700 text-white h-full px-4 hover:bg-white hover:text-red-700 hover:border-red-700 hover:border-2
                                w-1/4 justify-self-end self-center
                                md:w-full
                                ">
                            <i class="icon-delete font-bold text-2xl"></i>Удалить
                        </button>
                    </div>
                    <div class="justify-self-start">
                        <button @click="addTrailer()" type="button"
                                class="bg-green-800 text-white box-border px-6 py-2 mr-6 rounded-md justify-self-end
                             hover:text-green-800 hover:border-green-800 border-2 hover:bg-white">
                            Add
                        </button>
                    </div>
                </form>

            </section>
            <section v-if="accordion === 'soundTracks'" class="grid gap-4">
                <form class="grid grid-cols-2 gap-2 bg-white p-4 justify-start"
                v-for="(elem, index) in form.sound_tracks"
                >
                    <h6 class="col-span-2">Саундтреки:</h6>
                    <label class="py-2"> Аудио файл: <br>
                    <input @input.prevent="handleFile(index, $event)" type="file" accept="audio/*">
                    </label>
                    <label>Заголовок: <br>
                    <input v-model="elem.title" type="text">
                    </label>
                    <button class="col-span-2 justify-self-end px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white" type="button" @click.prevent="deleteSoundTrack(index)">
                        <i class="icon-delete font-bold text-2xl"></i>Удалить
                    </button>
                </form>

                <button @click.prevent="addSoundTrack()" type="button" class="bg-green-800 text-white box-border px-6 py-2 mr-6 rounded-md justify-self-start
                        hover:text-green-800 hover:border-green-800 border-2 hover:bg-white mt-4">
                    Add
                </button>

            </section>
            <section v-if="accordion === 'seo'">

                <div class="grid grid-flow-row gap-4">
                    <label>Заголовок: <br>
                        <select v-model="form.title_id" class="w-full">
                            <option v-for="title in titles" :value="title.id">{{ title.description }}
                            </option>
                        </select>
                    </label>
                    <label>Meta keywords:
                        <small :class="form.meta_keywords.length > 255 ? 'text-red-600' : ''">
                            &nbsp{{ form.meta_keywords.length }}
                            / 255</small> <br>
                        <input v-model="form.meta_keywords" type="text"
                               class="w-full"
                               placeholder="Meta keywords">
                    </label>
                    <label>Meta description:
                        <small :class="form.meta_description.length > 16383 ? 'text-red-600' : ''">
                            &nbsp{{ form.meta_description.length }}
                            / 16383</small> <br>
                        <textarea class="w-full"
                                  v-model="form.meta_description" rows="5"
                                  placeholder="meta description"></textarea>
                    </label>
                </div>
            </section>

            <div class="grid justify-items-center items-center">
                <button @click.prevent="store()"
                        type="submit"
                        class="bg-[#333545] justify-self-end px-4 py-2 rounded-md text-white
                        hover: border-2 hover:border-[#333545] hover:text-[#333545] hover:bg-white"

                >Submit
                </button>
            </div>

        </div>
    </section>


    <message :message.sync="message"></message>

</template>

<script>
import {Head, Link, router,} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Message from '@/Components/Message.vue'
import Parser from "@/Components/Parser.vue";

export default {
    name: "Create",
    layout: AuthenticatedLayout,
    props: ['categories', 'countries', 'titles', 'movies_list'],
    components: {Head, Link, Message, Parser},

    data() {
        return {
            accordion: 'general',
            show: {
                parser: false,
            },
            previews: {
                poster: null,
                backdrop: null,
            },
            genres: {
                list: null,
            },
            examples: {
                genres: null,
                type: null,
                category: null,
                posterUrlPreview: null,
                backdropUrl: null,
                countries: null,
                rate: null,
                description: null,
                sequels: []
            },
            spinOff: {
                parsed: [],
                selected: [],
                final: [],
            },
            form: {
                kinopoiskId: null,
                year: null,
                nameRu: null,
                nameEn: null,
                poster: null,
                backdrop: null,
                category: "",
                countries: [],
                type: "",
                duration: null,
                age_limits: null,
                plot: null,
                actors_game: null,
                atmosphere: null,
                rate: null,
                slogan: '',
                description: '',
                genres: [],
                trailers: [],
                video_allowed: 1,
                budget: "",
                meta_keywords: '',
                meta_description: '',
                title_id: 1,
                spin_off: [],
                facts: [{
                    value: '',
                    type: "FACT",
                    spoiler: false,
                }],
                sound_tracks: [{
                    file: '',
                    title: '',
                }],
            },
            list: {
                movies: this.movies_list,
            },
            movies_filter: '',
            message: {
                body: [],
                type: '',
                show: false,
            }
        }
    },

    methods: {
        getFilteredMovies(){
            axios.post('/admin/get_filtered_movies', {
                query_filter: this.movies_filter
            })
                .then(res=>{
                    this.list.movies = res.data;
                })
        },


        deleteSpinOff(spinOff) {
            this.spinOff.parsed = this.spinOff.parsed.filter((elem, index) => {
                return elem.kinopoisk_id !== spinOff.kinopoisk_id
            })

        },

        handleImg(type, event) {
            this.form[type] = event.target.files[0];
            this.previews[type] = URL.createObjectURL(event.target.files[0])
        },

        handleFile(index, event){
            this.form.sound_tracks[index].file = event.target.files[0];
        },

        countScore(plot, actors, atmosphere) {
            if (plot !== null && actors !== null && atmosphere !== null) {
                this.form.rate = Math.round((plot + actors + atmosphere) / 3 * 10) / 10
            }
        },

        deleteTrailer(elemIndex) {
            this.form.trailers = this.form.trailers.filter((elem, index) => {
                return index != elemIndex
            })
        },

        addTrailer() {
            this.form.trailers.unshift({
                url: '',
                name: '',
                site: 'youtube',
            })
        },


        addFact() {
            this.form.facts.push({
                value: '',
                type: "FACT",
                spoiler: false,
            })
        },
        deleteFact(elemIndex) {
            this.form.facts = this.form.facts.filter((elem, index) => {
                return index != elemIndex
            })
        },
        addSoundTrack(){
            this.form.sound_tracks.push(
                {
                    file: '',
                    title: '',
                }
            )
        },
        deleteSoundTrack(elemIndex){
            this.form.sound_tracks = this.form.sound_tracks.filter((elem, index) => {
                return index != elemIndex
            })
        },


        renderGenres() {
            axios.get(`/get_genres?category=${this.form.category}`)
                .then(response => {
                    this.genres.list = response.data
                })
        },

        store() {
            this.spinOff.final = this.spinOff.parsed.concat(this.spinOff.selected)
            this.form.spin_off = this.spinOff.final.map(elem => elem.kinopoisk_id);
            this.form.trailers = this.form.trailers.filter((elem) => {
                if (elem.url != '' && elem.name != '') {
                    return elem
                }
            })
            if(this.form.facts !== null) {
                this.form.facts = this.form.facts.filter((elem) => {
                    if (elem.value != '') {
                        return elem
                    }
                })
            }
            this.form.sound_tracks = this.form.sound_tracks.filter((elem) => {
                if (elem.title !== '' && elem.file !== '') {
                    return elem
                }
            })
            router.post('/admin/movies/store', this.form, {
                forceFormData: true,
            })
            router.on('error', (errors) => {
                this.message.body = errors.detail.errors
                this.message.type = 'error'
                this.message.show = true
            })


        }
    },

}
</script>

