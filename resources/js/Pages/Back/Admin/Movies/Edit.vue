<template>

    <Head title="Редактировать видео"/>

    <h2 class="bg-white p-4 shadow-md">Редактирование видео {{ movie.id }} / {{ movie.nameRu }}</h2>

        <section class="container mx-auto p-4">
            <div class="grid grid-flow-row grid-rows-[max-content_max-content_100px] gap-4">
                <div
                    class="grid grid-cols-[repeat(auto-fill,_minmax(max-content,_150px))] gap-4 items-center">
                <span class="cursor-pointer" @click="accordion = 'general'"
                      :class="accordion === 'general' ? 'border-b-2 border-red-400' : ''"
                >
                    Информация
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
                                    <option :value="0">Запрещено</option>
                                </select>
                            </label>

                            <label> Год: <br>
                                <input class="w-full" v-model="form.year" type="text" placeholder="Выберите год">
                            </label>

                            <label> Русское название: <br>
                                <input class="w-full" v-model="form.nameRu" type="text" placeholder="Введите русское название">
                            </label>

                            <label>Английское название: <br>
                                <input class="w-full" v-model="form.nameEn" type="text" placeholder="Введите английское название">
                            </label>

                            <label>Slug: <br>
                                <input class="w-full" v-model="form.slug" type="text" placeholder="Введите слаг">
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
                            </label>

                            <label>Категория: <br>
                                <select class="w-full" @change="renderGenres()" v-model="form.category_id">
                                    <option disabled value="" selected>Выберите категорию</option>
                                    <template v-for="category in categories">
                                        <option :value="category.id">{{ category.title }}</option>
                                    </template>
                                </select>
                            </label>

                            <label v-if="genres != null">Жанры: <br>
                                <select class="w-full" v-model="form.genres" multiple placeholder="Можно выбрать несколько">
                                    <template v-for="genre in genresList">
                                        <option :value="genre.id">{{ genre.title }}</option>
                                    </template>
                                </select>
                            </label>

                            <label>Страны: <br>
                                <select class="w-full" v-model="form.countries" multiple>
                                    <option disabled value="null">Выберите страны</option>
                                    <template v-for="country in countries">
                                        <option :value="country.id">{{ country.title }}</option>
                                    </template>
                                </select>
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
                                           :class="form.default_plot === null ? 'bg-sky-950 text-white': ''"
                                    >
                                        <i class="icon-star_half text-[#333545]"></i>
                                        <input v-model="form.default_plot" :value=null type="radio"
                                               name="rate_plot"
                                               checked disabled
                                               class="hidden"
                                        >
                                    </label>
                                    <template v-for="item in 5">
                                        <label class="px-4 py-2 block bg-inherit justify-self-center"
                                               :class="form.default_plot === item ? 'bg-sky-950 text-white': ''"
                                        >{{ item }}
                                            <input v-model="form.default_plot"
                                                   @input.prevent="countScore(item, form.default_actors_game, form.default_atmosphere)"
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
                                           :class="form.default_actors_game === null ? 'bg-sky-950 text-white': ''"
                                    >
                                        <i class="icon-star_half text-[#333545]"></i>
                                        <input v-model="form.default_actors_game" :value=null type="radio"
                                               name="rate_actors_game"
                                               checked disabled
                                               class="hidden"
                                        >
                                    </label>
                                    <template v-for="item in 5">
                                        <label class="px-4 py-2 block bg-inherit justify-self-center"
                                               :class="form.default_actors_game === item ? 'bg-sky-950 text-white': ''"
                                        >{{ item }}
                                            <input v-model="form.default_actors_game"
                                                   @input.prevent="countScore(form.default_plot, item, form.default_atmosphere)"
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
                                           :class="form.default_atmosphere === null ? 'bg-sky-950 text-white': ''"
                                    >
                                        <i class="icon-star_half text-[#333545]"></i>
                                        <input v-model="form.default_atmosphere" :value=null type="radio"
                                               name="rate_atmosphere"
                                               checked disabled
                                               class="hidden"
                                        >
                                    </label>
                                    <template v-for="item in 5">
                                        <label class="px-4 py-2 block bg-inherit justify-self-center"
                                               :class="form.default_atmosphere === item ? 'bg-sky-950 text-white': ''"
                                        >{{ item }}
                                            <input v-model="form.default_atmosphere"
                                                   @input.prevent="countScore(form.default_plot, form.default_actors_game, item)"
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
                        <textarea class="w-full" v-model="form.description"
                                  id="description" rows="10" placeholder="Вставьте описание"></textarea>
                    </div>

                </section>
                <section v-if="accordion === 'spin_off'">

                    <div class="grid grid-flow-row gap-4">
                        <div>Сиквелы: <br>
                            <div v-for="spin_off in spinOff.parsed" class="grid grid-flow-col auto-cols-max items-center gap-4">
                                <i class="icon-check_circle text-green-500"></i>
                                <span >{{spin_off.nameRu}} / {{spin_off.year}}</span>
                                <i @click.prevent="deleteSpinOff(spin_off)" class="icon-delete text-red-500 cursor-pointer"></i>
                            </div>

                            <template v-if="spinOff.selected.length > 0">
                                <div v-for="selected_movie in spinOff.selected" class="grid grid-flow-col auto-cols-max items-center gap-4">
                                    <i class="icon-check_circle text-green-500"></i>
                                    <span >{{selected_movie.nameRu}} / {{selected_movie.year}}</span>
                                </div>
                            </template>

                        </div>

                        <div>
                            <label for="spin_off_movies">Выберите другие спин-оффы, Сиквели или приквелы</label>
                            <select v-model="spinOff.selected" id="spin_off_movies" class="w-full" multiple>

                                <option v-for="movie in list.movies" :value="movie">{{movie.nameRu}}</option>

                            </select>
                        </div>

                    </div>

                </section>
                <section v-if="accordion === 'posters'" class="grid gap-4
                grid-flow-row
                md:grid-cols-[1fr_3fr]
                ">
                    <div class="grid gap-4">
                        <img class="block w-1/2 justify-self-center" :src="previews.poster" alt="Превью постера">
                        <label class="self-end">Постер:<br>
                            <input @input="handleImg('poster', $event)"
                                   type="file" accept="jpg, jpeg">
                        </label>
                        <figcaption class="text-sm text-gray-500 my-1">*Размер: 250 X 404. Формат *jpg, *jpeg</figcaption>    
                    </div>
                    <div class="grid gap-4 grid-flow-row">
                        <template v-if="previews.backdrop">
                        <img class="block justify-self-center" :src="previews.backdrop" alt="Превью фоновой картинки">
                        </template>
                        <template v-else>
                            <span class="justify-self-center">Фоновая картинка отсутствует</span>
                        </template>
                        <label class="self-end">Загрузите фоновую картинку:<br>
                            <input @input="handleImg('backdrop', $event)"
                                   type="file" accept="jpg, jpeg">
                        </label>
                        <figcaption class="text-sm text-gray-500 my-1">*Размер: 1200 X 450. Формат *jpg, *jpeg</figcaption> 
                    </div>


                </section>
                <section v-if="accordion === 'trailers'">
                    <form class="grid grid-flow-row gap-2">
                        <div class="grid grid-flow-col items-center">
                            <span>Трейлеры</span>
                            <div class="justify-self-end">
                                <button @click="addTrailer()" type="button"
                                        class="bg-green-600 text-white box-border px-4 py-2 rounded-md justify-self-end
                             hover:text-green-600 hover:border-green-600 border-2 hover:bg-white">
                                    Add
                                </button>
                            </div>
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
                                Delete
                            </button>
                        </div>
                    </form>

                </section>
                <section v-if="accordion === 'seo'">
                    <div class="grid grid-flow-row gap-4">
                        <label>Заголовок: <br>
                            <select v-model="form.title_id" class="w-full">
                                <option value="undefined" disabled>Выберите строку заголовка</option>
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
                <button @click.prevent="updateMovie()"
                        type="submit"
                        class="bg-[#333545] justify-self-end px-4 py-2 rounded-md text-white
                        hover: border-2 hover:border-[#333545] hover:text-[#333545] hover:bg-white"

                >Submit</button>
                </div>

            </div>
        </section>

        <message :message.sync="message"></message>

    </template>

<script>
import {Head, Link, router,} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Message from "@/Components/Message.vue";

export default {
    name: "Admin",
    layout: AuthenticatedLayout,
    components: {Head, Link, Message},
    props: ['movie', 'categories', 'genres', 'countries', 'titles', 'movies_list'],

    data() {
        return {
            accordion: 'general',
            list:{
                movies: this.movies_list,
            },
            spinOff:{
                parsed: this.movie.spin_off,
                selected: [],
                final:[],
            },
            form: {
                id: this.movie.id,
                kinopoisk_id: this.movie.kinopoisk_id,
                nameRu: this.movie.nameRu,
                nameEn: this.movie.nameEn,
                trailers: this.movie.trailers,
                age_limits: this.movie.age_limits,
                slug: this.movie.slug,
                year: this.movie.year,
                poster: null,
                backdrop: null,
                countries: this.movie.countries,
                category_id: this.movie.category_id,
                genres: this.movie.genres,
                type: this.movie.type,
                duration: this.movie.duration,
                default_plot: this.movie.default_plot,
                default_actors_game: this.movie.default_actors_game,
                default_atmosphere: this.movie.default_atmosphere,
                rate: this.movie.rate,
                budget: this.movie.budget,
                slogan: this.movie.slogan,
                description: this.movie.description,
                trailer: this.movie.trailer,
                video_allowed: this.movie.video_allowed,
                title_id: this.movie.title_id,
                meta_keywords: this.movie.meta_keywords,
                meta_description: this.movie.meta_description,
                spin_off: [],
            },
            previews: {
                poster: this.movie.poster,
                backdrop: this.movie.backdrop,
            },
            genresList: this.genres,
            message: {
                body: [],
                type: '',
                show: false,
            }
        }
    },


    methods: {
        deleteSpinOff(spinOff){
            this.spinOff.parsed = this.spinOff.parsed.filter((elem, index)=>{
                console.log(spinOff.kinopoisk_id);
                return elem.kinopoisk_id !== spinOff.kinopoisk_id
            })

        },

        handleImg(type, event) {
            this.form[type] = event.target.files[0];
            this.previews[type] = URL.createObjectURL(event.target.files[0])
        },
        countScore(plot, actors, atmosphere) {
            if (plot !== null && actors !== null && atmosphere !== null) {
                this.form.rate = Math.round((plot + actors + atmosphere) / 3 * 10) / 10
            }
        },

        deleteTrailer(id) {
            this.form.trailers = this.form.trailers.filter((elem, index) => {
                return index != id
            })
        },

        addTrailer() {
            this.form.trailers.unshift({
                url: '',
                name: '',
                site: 'youtube',
            })
        },

        renderGenres() {
            this.form.genres = []
            axios.get(`/get_genres?category=${this.form.category_id}`)
                .then(response => {
                    this.genresList = response.data
                })
        },

        updateMovie() {
            this.spinOff.final = this.spinOff.parsed.concat(this.spinOff.selected)
            this.form.spin_off = this.spinOff.final.map(elem=> elem.kinopoisk_id);

            this.form.trailers = this.form.trailers.filter((elem) => {
                if (elem.url != '' && elem.name != '') {
                    return elem
                }
            })
            router.post(`/admin/movies/${this.form.id}`, {
                _method: 'patch',
                id: this.form.id,
                kinopoisk_id: this.form.kinopoisk_id,
                slug: this.form.slug,
                nameRu: this.form.nameRu,
                nameEn: this.form.nameEn,
                trailers: this.form.trailers,
                age_limits: this.form.age_limits,
                countries: this.form.countries,
                category_id: this.form.category_id,
                genres: this.form.genres,
                year: this.form.year,
                duration: this.form.duration,
                default_plot: this.form.default_plot,
                default_actors_game: this.form.default_actors_game,
                default_atmosphere: this.form.default_atmosphere,
                budget: this.form.budget,
                slogan: this.form.slogan,
                description: this.form.description,
                poster: this.form.poster,
                backdrop: this.form.backdrop,
                type: this.form.type,
                video_allowed: this.form.video_allowed,
                title_id: this.form.title_id,
                meta_keywords: this.form.meta_keywords,
                meta_description: this.form.meta_description,
                spin_off: this.form.spin_off
            },
                {forceFormData: true,}
            )
            router.on('error', (errors) => {
                this.message.body = errors.detail.errors
                this.message.type = 'error'
                this.message.show = true
            })
        },

    },
}
</script>

<style scoped>

</style>
