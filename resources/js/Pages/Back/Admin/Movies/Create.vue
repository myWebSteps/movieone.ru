<template>

    <Head title="Создать видео"/>

    <AuthenticatedLayout>

          <template #header>
            <h2 class="display-6">Создать видео</h2>
        </template>

        <section class="content">
            <div class="container-fluid">

        <div class="bg-white p-3 widget shadow rounded mb-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!-- Parse -->
                <li class="nav-item">
                    <a class="nav-link active" id="parser-tab" data-toggle="tab" href="#parser" role="tab" aria-controls="parser" aria-selected="true">Парсер</a>
                </li>
                <!-- Tests -->
                <li class="nav-item">
                    <a class="nav-link" id="tests-tab" data-toggle="tab" href="#tests" role="tab" aria-controls="tests" aria-selected="false">Тесты</a>
                </li>
                <!-- Posters & Trailers-->
                <li class="nav-item">
                    <a class="nav-link" id="posters_trailers-tab" data-toggle="tab" href="#posters_trailers" role="tab" aria-controls="posters_trailers" aria-selected="false">Постеры и трейлеры</a>
                </li>
                <!-- General Info-->
                <li class="nav-item">
                    <a class="nav-link" id="general_info-tab" data-toggle="tab" href="#general_info" role="tab" aria-controls="general_info" aria-selected="false">Информация</a>
                </li>

                <!-- SEO-->
                <li class="nav-item">
                    <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- Parse Tab -->
                <div class="tab-pane fade show active" id="parser" role="tabpanel" aria-labelledby="parser-tab">
                    <div class="mb-3 col-12">
                        <input v-model="form.kinopoiskId" type="number" class="w-75 d-inline cform cform-custom-input custom-first-element"
                               placeholder="Введите номер видео по Кинопоиску" aria-label="Recipient's username"
                               aria-describedby="basic-addon2" wfd-id="id1">
                        <span @click.prevent="parse()" type="button" class="cform-btn cform-custom-btn cform-btn-accent cform-btn-xl custom-last-element" id="basic-addon2">Parse</span>
                    </div>
                </div>

                <!-- Tests Tab -->
                <div class="tab-pane fade" id="tests" role="tabpanel" aria-labelledby="tests-tab">

                    <div class="row">
                        <div class="col-12">
                            <!-- Kinopoisk ID -->
                            <div class="form-group col-5">
                                <label for="testId">Наличие в БД:</label>
                                <button @click="checkInBD(form.kinopoiskId)" type="button" class="cform-btn cform-custom-btn cform-btn-accent"
                                        id="testId">Тест
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                        <div v-if="test.id != null" class="col-6">
                            <div v-if="test.id == 1" class="alert alert-danger col-6" role="alert">
                                Present in Database
                            </div>
                            <div v-if="test.id == 2" class="alert alert-info col-6" role="alert">
                                Absent in Database
                            </div>
                        </div>
                        </div>

                        <!-- Video Test -->
                        <div class="col-12">
                            <button v-if="form.kinopoiskId != null" @click.prevent="testVideo()" class="cform-btn cform-custom-btn cform-btn-accent mb-3">Тест Видео</button>
                            <div class="kinobox_player col-xl-6"></div>

                        </div>

                </div>
                </div>
                <!-- Trailers Tab -->

                <!--Posters_trailers Tab-->
                <div class="tab-pane fade" id="posters_trailers" role="tabpanel" aria-labelledby="posters_trailers-tab">

                    <div class="row pl-2 pr-2">

                        <!-- Video allowed -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Показ видео:</label>
                                <select v-model="form.video_allowed" class="cform cform-custom-input">
                                    <option :value="1">Разрешено</option>
                                    <option :value="0">Запрещено</option>
                                </select>
                            </div>
                        </div>

                        <!--poster Upload -->
                            <div class="col-6 d-flex align-items-center column-gap-2">
                                <div class="form-group">
                                    <label for="PosterUpload">Постер:</label>
                                    <div class="mb-3" id="PosterUpload">
                                        <input @input="form.poster = $event.target.files[0]" class="cform cform-custom-file"
                                               type="file">
                                    </div>
                                    <a v-if="examples.posterUrlPreview" :href="examples.posterUrlPreview" target="_blank">Перейти к постеру</a>

                                </div>

                            </div>

                            <!--backdrop Upload -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="BackdropUpload">Фоновая картинка:</label>
                                    <div class="mb-3" id="BackdropUpload">
                                        <input @input="form.backdrop = $event.target.files[0]" class="cform cform-custom-file"
                                               type="file">
                                    </div>
                                    <a v-if="examples.backdropUrl" :href="examples.backdropUrl" target="_blank">Перейти к фоновой картинке</a>

                                </div>

                            </div>


                        <!-- Трейлеры -->
                            <div class="col-12">
                                <div class="form-group">
                                    <form>
                                        <label>Трейлеры:</label>
                                        <div v-if="form.trailers.length > 0" v-for="(trailer, index) in form.trailers" class="form-group input-group">
                                            <input type="text" v-model="trailer.url" class="cform cform-custom-input col-6 custom-first-element"
                                                   placeholder="Идентификатор dzen или ссылка youtube">
                                            <input type="text" v-model="trailer.name" class="cform cform-custom-input col-3 custom-middle-element"
                                                   placeholder="Название">
                                            <select v-model="trailer.site" class="cform cform-custom-input col-2 custom-middle-element">
                                                <option value="dzen">dzen</option>
                                                <option value="youtube">youtube</option>
                                            </select>
                                            <button @click="deleteTrailer(index)" type="button" class="cform-btn cform-custom-btn cform-btn-error col-1 custom-last-element">-</button>
                                        </div>
                                        <div class="input-group-btn">
                                            <button @click="addTrailer()" type="button" class="cform-btn cform-custom-btn cform-btn-accent">Добавить трейлер</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
                <!--General info Tab-->
                <div class="tab-pane fade" id="general_info" role="tabpanel" aria-labelledby="general_info-tab">

                    <div class="row">
                        <!-- Kinopoisk ID -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="KinopoiskId">Кинопоиск ID:</label>
                                <input v-model="form.kinopoiskId" type="number" class="d-block cform cform-custom-input"
                                       id="KinopoiskId" placeholder="Введите Кинопоиск ID">
                            </div>
                        </div>

                        <!-- Year -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label>Год:</label>
                                <input v-model="form.year" type="text" placeholder="Выберите год"
                                       class="d-block cform cform-custom-input" aria-label="Sizing example input"
                                       aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                        <!-- NameRu -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="nameRu">Русское название:</label>
                                <input v-model="form.nameRu" type="text" class="d-block cform cform-custom-input" id="nameRu"
                                       placeholder="Введите русское название">
                            </div>
                        </div>

                        <!-- NameEn -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="nameOriginal">Английское название:</label>
                                <input v-model="form.nameEn" type="text" class="d-block cform cform-custom-input" id="nameOriginal"
                                       placeholder="Введите английское название">
                            </div>
                        </div>

                        <!-- AgeLimits -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="ageLimits">Возрастные ограничения:</label>
                                <input v-model="form.age_limits" type="text" class="d-block cform cform-custom-input" id="ageLimits"
                                       placeholder="Введите ограничение по возрасту">
                            </div>
                        </div>

                        <!-- Duration Parse -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="filmLength">Продолжительность:</label>
                                <input v-model="form.duration" type="text" class="d-block cform cform-custom-input" id="filmLength"
                                       placeholder="В минутах">
                            </div>
                        </div>

                        <!-- Rate Parse -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="ratingKinopoisk">Рейтинг:</label>
                                <input v-model="form.rate" type="text" class="d-block cform cform-custom-input" id="ratingKinopoisk"
                                       placeholder="Рейтинг">
                            </div>
                        </div>

                        <!-- Budget Parse -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label for="budget">Бюджет:</label>
                                <input v-model="form.budget" type="text" class="d-block cform cform-custom-input" id="budget"
                                       placeholder="Бюджет">
                            </div>
                        </div>

                        <!-- Country Select -->
                            <div class="col-3 col-xs-12">
                                <div class="form-group">
                                    <label>Страны</label>
                                    <select v-model="form.countries" class="d-block cform cform-custom-input" multiple>
                                        <option disabled value="null">Выберите страны</option>
                                        <template v-for="country in countries">
                                            <option :value="country.id">{{country.title}}</option>
                                        </template>
                                    </select>
                                    <div> Страны по Кинопоиску:
                                    <div>
                                        <ul>
                                        <li v-for="country in examples.countries">
                                            {{country.name}} &nbsp
                                    </li>
                                </ul>
                                </div>
                                    </div>
                                </div>
                            </div>

                        <!--Type Select -->
                        <div class="col-3 col-xs-12">
                            <div class="form-group">
                                <label>Тип:</label>
                                <select v-model="form.type" style="width: 100%" class="d-block cform cform-custom-input">
                                    <option value="" disabled>Выберите Тип</option>
                                    <option value="2">Полнометражные</option>
                                    <option value="3">Сериалы</option>
                                    <option value="4">Мини сериалы</option>
                                </select>
                                <p v-if="examples.type != null"> Сериал:
                                    {{examples.type}}
                                </p>
                            </div>
                        </div>


                        <!-- Cat Select -->
                            <div class="col-3 col-xs-12">
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select @change="getGenresList(form.category)" v-model="form.category"
                                            class="d-block cform cform-custom-input">
                                        <option disabled value="" selected>Выберите категорию</option>
                                        <template v-for="category in categories">
                                            <option :value="category.id">{{category.title}}</option>
                                        </template>
                                    </select>
                                    <p v-if="examples.type != null">
                                        Категория Кинопоиска: {{examples.category}}
                                    </p>
                                </div>
                            </div>



                            <!--SubCat Select -->
                            <div class="col-3 col-xs-12">
                                <div class="form-group" v-if="genres.list != null">
                                    <label>Жанры</label>
                                    <select v-model="form.genres" multiple placeholder="Можно выбрать несколько"
                                            style="width: 100%" class="d-block cform cform-custom-input">
                                        <option v-for="genre in genres.list" :value="genre.id">{{genre.title}}</option>
                                    </select>
                                    <div>
                                        Жанры по кинопоиску:
                                        <div>
                                            <ul>
                                        <li v-for="genre in examples.genres">
                                        {{genre.name}} &nbsp
                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="col-12">
                                <label for="slogan">Слоган:</label>
                                <input v-model="form.slogan" type="text" class="d-block cform cform-custom-input w-100" id="slogan"
                                       placeholder="Слоган">
                            </div>

                            <div class="col-12">
                                <label class="d-block" for="description">Описание:</label>

                                <textarea class="w-100 d-block cform cform-custom-input" v-model="form.description" id="description" rows="10"
                                          placeholder="Вставьте описание"></textarea>
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
                                <select v-model="form.title_id" style="width: 100%" class="w-100 d-block cform cform-custom-input">
                                    <option value="null" disabled selected>Выберите строку заголовка</option>
                                    <option v-for="title in titles" :value="title.id">{{title.description}}</option>
                                </select>
                            </div>
                        </div>

                            <div class="col-12">
                                <label for="meta_keywords">Meta keywords:</label>
                                <input v-model="form.meta_keywords" type="text" class="w-100 d-block cform cform-custom-input" id="meta_keywords"
                                       placeholder="Meta keywords">
                            </div>

                            <div class="col-12">
                                <label class="d-block" for="meta_description">Meta description:</label>

                                <textarea class="w-100 d-block cform cform-custom-input" v-model="form.meta_description" id="meta_description" rows="4"
                                          placeholder="meta description"></textarea>
                            </div>
                          </div>
                </div>

            </div>
            <div class="card-footer">
                <button @click.prevent="store()" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

            </div>
        </section>

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end" role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
    import {Head, Link, router,} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


    export default {
        name: "Create",
        props: ['categories', 'countries', 'titles'],
        components: {Head, Link, AuthenticatedLayout},

        data() {
            return {
                test: {
                    id: null,
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
                    rate: null,
                    slogan: null,
                    description: null,
                    genres: [],
                    trailers: [],
                    video_allowed: 1,
                    budget: "",
                    meta_keywords: "",
                    meta_description: "",
                    title_id: null,

                },
                errors: null,
            }
        },

        methods: {

            deleteTrailer(elemIndex){
                this.form.trailers = this.form.trailers.filter((elem, index)=>{
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

            parse() {
                axios.get(`https://api.kinopoisk.dev/v1.4/movie/${this.form.kinopoiskId}`,
                    {
                        headers: {
                            'X-API-KEY': 'E1J0H6V-27AMY5A-P3RYSY9-S4F1KM0',
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => {
                        console.log(response)
                        this.form.year = response.data.year
                        this.form.nameRu = response.data.name
                        this.form.nameEn = response.data.alternativeName
                        this.form.duration = response.data.movieLength
                        this.form.age_limits = response.data.ageRating
                        this.form.rate = response.data.rating.kp
                        this.form.budget = response.data.budget.value + ' ' + response.data.budget.currency
                        this.form.slogan = response.data.slogan
                        this.form.description = response.data.description
                        if(response.data.videos.trailers.length > 0){
                            this.form.trailers = response.data.videos.trailers
                        }
                        this.examples.genres = response.data.genres
                        this.examples.category = response.data.type
                        this.examples.type = response.data.isSeries
                        this.examples.posterUrlPreview = response.data.poster.previewUrl
                        this.examples.backdropUrl = response.data.backdrop.url
                        this.examples.countries = response.data.countries
                    })

            },

            testVideo() {
                new Kinobox('.kinobox_player', {
                    'X-Settings': {
                        "Alloha": {
                            "enable": true,
                            "position": 1,
                            "token": "",
                        },
                        "Ashdi": {
                            "enable": true,
                            "position": 2,
                            "token": "",
                        },
                        "Bazon": {
                            "enable": true,
                            "position": 3,
                            "token": "",
                        },
                        "Cdnmovies": {
                            "enable": true,
                            "position": 4,
                            "token": "",
                        },
                        "Collaps": {
                            "enable": true,
                            "position": 5,
                            "token": "",
                        },
                        "Hdvb": {
                            "enable": true,
                            "position": 6,
                            "token": "",
                        },
                        "Iframe": {
                            "enable": true,
                            "position": 7,
                            "token": "",
                        },
                        "Kodik": {
                            "enable": true,
                            "position": 8,
                            "token": "",
                        },
                        "Videocdn": {
                            "enable": true,
                            "position": 9,
                            "token": "",
                        },
                        "Voidboost": {
                            "enable": true,
                            "position": 10,
                            "token": "",
                        },

                    },
                    search: {
                        kinopoisk: this.form.kinopoiskId,
                        title: this.form.nameEn
                    }
                }).init();
            },

            getGenresList(category) {
                axios.get(`/get_genres?category=${category}`)
                    .then(response => {
                        this.genres.list = response.data
                    })
            },

            checkInBD(id) {
                axios.post('/admin/movies/test_in_bd', {kinopoisk_id: String(id)})
                    .then(response => {

                        if (response.data.length > 0) {
                            this.test.id = 1
                        } else {
                            this.test.id = 2
                        }
                    })
            },

            store() {
                this.form.trailers = this.form.trailers.filter((elem)=>{
                    if(elem.url != '' && elem.name != '')
                    {
                        return elem
                    }
                })
                router.post('/admin/movies/store', this.form)
                   router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })


            }
        },

    }
</script>

