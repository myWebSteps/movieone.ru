<template>

    <Head title="Редактировать видео"/>

    <AuthenticatedLayout>

        <template #header>
            <h2 class="display-6">Редактирование видео {{movie.id}} / {{movie.nameRu}}</h2>
        </template>

        <section class="content">
            <div class="container-fluid">

                <div class="bg-white p-3 widget shadow rounded mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <!-- Posters & Trailers-->
                        <li class="nav-item">
                            <a class="nav-link active" id="posters_trailers-tab" data-toggle="tab"
                               href="#posters_trailers" role="tab" aria-controls="posters_trailers"
                               aria-selected="true">Постеры и трейлеры</a>
                        </li>
                        <!-- General Info-->
                        <li class="nav-item">
                            <a class="nav-link" id="general_info-tab" data-toggle="tab" href="#general_info" role="tab"
                               aria-controls="general_info" aria-selected="false">Информация</a>
                        </li>
                        <!-- SEO -->
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                               aria-controls="seo" aria-selected="false">SEO</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <!--Posters_trailers Tab-->
                        <div class="tab-pane fade show active" id="posters_trailers" role="tabpanel"
                             aria-labelledby="posters_trailers-tab">

                            <div class="row pl-2 pr-2">
                                <!-- Video allowed -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="pr-3">Показ видео:</label>
                                        <select v-model="form.video_allowed" class="cform cform-custom-input">
                                            <option :value="1">Разрешено</option>
                                            <option :value="0">Запрещено</option>
                                        </select>
                                    </div>
                                </div>

                                <!--poster Upload -->
                                <div class="col-sm-6 d-flex align-items-center column-gap-2">
                                    <div class="preview w-25 d-inline-flex mr-2">
                                        <img :src="examples.poster" alt="Превью постера" class="img-fluid">
                                    </div>
                                    <div class="form-group d-block">
                                        <label for="PosterUpload">Постер:</label>
                                        <div class="mb-3" id="PosterUpload">
                                            <input @input="form.poster = $event.target.files[0]"
                                                   class="cform cform-custom-file" style="" type="file">
                                        </div>
                                    </div>

                                </div>

                                <!--backdrop Upload -->
                                <div class="col-sm-6">
                                    <div v-if="examples.backdrop != 'http://127.0.0.1:8000/storage'"
                                         class="preview w-50 d-inline-flex">
                                        <img :src="examples.backdrop" alt="Превью фоновой картинки" class="img-fluid">
                                    </div>
                                    <div class="form-group">
                                        <label for="BackdropUpload">Фоновая картинка:</label>
                                        <div class="mb-3" id="BackdropUpload">
                                            <input @input="form.backdrop = $event.target.files[0]"
                                                   class="cform cform-custom-file"
                                                   type="file">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <form>
                                            <label>Трейлеры:</label>
                                            <div v-if="form.trailers.length > 0"
                                                 v-for="(trailer,index) in form.trailers"
                                                 class="form-group input-group">
                                                <input type="text" v-model="trailer.url"
                                                       class="cform cform-custom-input col-6 custom-first-element"
                                                       placeholder="Идентификатор dzen или ссылка youtube">
                                                <input type="text" v-model="trailer.name"
                                                       class="cform cform-custom-input col-3 custom-middle-element"
                                                       placeholder="Название">
                                                <select v-model="trailer.site"
                                                        class="cform cform-custom-select col-2 custom-middle-element">
                                                    <option value="dzen">dzen</option>
                                                    <option value="youtube">youtube</option>
                                                </select>
                                                <button @click.prevent="deleteTrailer(index)" type="button"
                                                        class="btn btn-danger col-1 custom-last-element">-
                                                </button>
                                            </div>
                                            <span class="input-group-btn">
                                        <button @click="addTrailer()" type="button" class="btn btn-success">Добавить трейлер</button>
                                    </span>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--General info Tab-->
                        <div class="tab-pane fade" id="general_info" role="tabpanel" aria-labelledby="general_info-tab">

                            <div class="row">
                                <div class="row col-lg-9 col-12">
                                    <!-- Year -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Год:</label>
                                            <input v-model="form.year" type="text" placeholder="Выберите год"
                                                   class="d-block cform cform-custom-input w-100"
                                                   aria-label="Sizing example input"
                                                   aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>


                                    <!-- NameRu -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="nameRu">Русское название:</label>
                                            <input v-model="form.nameRu" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="nameRu" placeholder="Введите русское название">
                                        </div>
                                    </div>

                                    <!-- NameEn -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="nameOriginal">Английское название:</label>
                                            <input v-model="form.nameEn" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="nameOriginal" placeholder="Введите английское название">
                                        </div>
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="Slug">Slug:</label>
                                            <input v-model="form.slug" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="slug" placeholder="Введите слаг">
                                        </div>
                                    </div>

                                    <!-- ageLimits -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="ageLimits">Ограничения по возрасту:</label>
                                            <input v-model="form.age_limits" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="ageLimits" placeholder="Введите ограничения по возрасту">
                                        </div>
                                    </div>

                                    <!-- Duration Parse -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="filmLength">Продолжительность:</label>
                                            <input v-model="form.duration" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="filmLength" placeholder="В минутах">
                                        </div>
                                    </div>

                                    <!-- Budget Parse -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="budget">Бюджет:</label>
                                            <input v-model="form.budget" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   id="budget" placeholder="Бюджет">
                                        </div>
                                    </div>

                                    <!-- Cat Select -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Категория</label>
                                            <select @change="renderGenres()" v-model="form.category_id"
                                                    class="d-block cform cform-custom-input w-100">
                                                <option disabled value="" selected>Выберите категорию</option>
                                                <template v-for="category in categories">
                                                    <option :value="category.id">{{category.title}}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>

                                    <!--Type Select -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Тип:</label>
                                            <select v-model="form.type" style="width: 100%"
                                                    class="d-block cform cform-custom-input w-100">
                                                <option value="" disabled>Выберите Тип</option>
                                                <option value="2">Полнометражные</option>
                                                <option value="3">Сериалы</option>
                                                <option value="4">Мини сериалы</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--SubCat Select -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group" v-if="genres != null">
                                            <label>Жанры</label>
                                            <select v-model="form.genres" multiple placeholder="Можно выбрать несколько"
                                                    style="width: 100%"
                                                    class="d-block cform cform-custom-input w-100">
                                                <option v-for="genre in genresList" :value="genre.id">{{genre.title}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Country Select -->
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Страны</label>
                                            <select v-model="form.countries"
                                                    class="d-block cform cform-custom-input w-100" multiple>
                                                <option disabled value="null">Выберите страны</option>
                                                <template v-for="country in countries">
                                                    <option :value="country.id">{{country.title}}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- Rate Parse -->
                                <div class="col-lg-3 col-12">
                                    <label>Оценка видео: </label>
                                    <form name="leaveComment">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="d-block mt-2">Сюжет:</label>
                                                <div class="radio-group radio-group-small">
                                                    <input v-model="form.default_plot" :value=null type="radio"
                                                           id="rate_plot_null" name="rate_plot"
                                                           checked disabled>
                                                    <label class="m-0" for="rate_plot_null"><i
                                                        class="fa-solid fa-not-equal"></i></label>
                                                    <template v-for="item in 5">
                                                        <input v-model="form.default_plot"
                                                               @input.prevent="countScore(item, form.default_actors_game, form.default_atmosphere)"
                                                               :value="item" type="radio" :id="`rate_plot_${item}`"
                                                               name="rate_plot">
                                                        <label class="m-0" :for="`rate_plot_${item}`">{{item}}</label>
                                                    </template>

                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label class="d-block pt-2">Игра актеров:</label>
                                                <div class="radio-group radio-group-small">
                                                    <input v-model="form.default_actors_game" :value=null type="radio"
                                                           id="rate_actors_game_null" name="rate_actors_game"
                                                           checked disabled>
                                                    <label class="m-0" for="rate_actors_game_null"><i
                                                        class="fa-solid fa-not-equal"></i></label>
                                                    <template v-for="item in 5">
                                                        <input
                                                            @input.prevent="countScore(form.default_plot, item, form.default_atmosphere)"
                                                            v-model="form.default_actors_game" :value="item" type="radio"
                                                            :id="`rate_actors_game_${item}`" name="rate_actors_game">
                                                        <label class="m-0"
                                                               :for="`rate_actors_game_${item}`">{{item}}</label>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label class="d-block pt-2">Атмосфера:</label>
                                                <div class="radio-group radio-group-small">
                                                    <input v-model="form.default_atmosphere" :value=null type="radio"
                                                           id="rate_atmosphere_null" name="rate_atmosphere"
                                                           checked disabled>
                                                    <label class="m-0" for="rate_atmosphere_null"><i
                                                        class="fa-solid fa-not-equal"></i></label>
                                                    <template v-for="item in 5">
                                                        <input
                                                            @input.prevent="countScore(form.default_plot, form.default_actors_game, item)"
                                                            v-model="form.default_atmosphere" :value="item" type="radio"
                                                            :id="`rate_atmosphere_${item}`" name="rate_atmosphere">
                                                        <label class="m-0"
                                                               :for="`rate_atmosphere_${item}`">{{item}}</label>
                                                    </template>
                                                </div>
                                            </div>
                                            <div v-if="form.rate" class="col-12 mt-2">
                                                <p class="text-muted">Общая оценка: {{form.rate}}</p>
                                            </div>

                                        </div>
                                    </form>
                                    <div v-if="examples.rate"> Рейтинг по Кинопоиску:
                                        <div>
                                            {{examples.rate}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="slogan">Слоган:
                                        <small :class="form.slogan.length > 255 ? 'text-danger' : ''">
                                            &nbsp{{form.slogan.length}}
                                            / 255</small>
                                    </label>
                                    <input v-model="form.slogan" type="text"
                                           class="d-block cform cform-custom-input w-100" id="slogan"
                                           placeholder="Слоган">
                                </div>


                                <div class="col-12">
                                    <label class="d-block" for="description">Описание:
                                        <small :class="form.description.length > 16300 ? 'text-danger' : ''">
                                            &nbsp{{form.description.length}}
                                            / 16300</small>
                                    </label>
                                    <textarea class="w-100 d-block cform cform-custom-input" v-model="form.description"
                                              id="description" rows="10" placeholder="Вставьте описание"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--SEO Tab-->
                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">

                            <div class="row">

                                <!--Title Select -->
                                <div class="col-8 col-xs-12">
                                    <div class="form-group">
                                        <label>Заголовок:</label>
                                        <select v-model="form.title_id" style="width: 100%"
                                                class="d-block cform cform-custom-input">
                                            <option value="undefined" disabled>Выберите строку заголовка</option>
                                            <option v-for="title in titles" :value="title.id">{{title.description}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta keywords:
                                            <small :class="form.meta_keywords.length > 255 ? 'text-danger' : ''">
                                                &nbsp{{form.meta_keywords.length}}
                                                / 255</small>
                                        </label>
                                        <input v-model="form.meta_keywords" type="text"
                                               class="d-block cform cform-custom-input w-100" id="meta_keywords"
                                               placeholder="Meta keywords">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="d-block" for="meta_description">Meta description:
                                            <small :class="form.meta_description.length > 16383 ? 'text-danger' : ''">
                                                &nbsp{{form.meta_description.length}}
                                                / 16383</small>
                                        </label>
                                        <textarea class="w-100 d-block cform cform-custom-input"
                                                  v-model="form.meta_description" id="meta_description" rows="4"
                                                  placeholder="meta description"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button @click.prevent="updateMovie()" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </section>

        <message :message.sync="message"></message>

    </AuthenticatedLayout>
</template>

<script>
    import {Head, Link, router,} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Message from "@/Components/Message.vue";

    export default {
        name: "Admin",
        components: {Head, Link, AuthenticatedLayout, Message},
        props: ['movie', 'categories', 'genres', 'countries', 'titles'],

        data() {
            return {
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
                },
                array: {},
                examples: {
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
                })
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
