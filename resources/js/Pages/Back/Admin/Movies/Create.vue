<template>

    <Head title="Создать видео"/>

    <AuthenticatedLayout>
        <div class="row m-3">
            <div class="accordion accordion-flush col-sm-6 m-3">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            Parser
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="input-group mb-3">
                                <input v-model="form.kinopoiskId" type="number" class="form-control"
                                       placeholder="Введите номер видео по Кинопоиску" aria-label="Recipient's username"
                                       aria-describedby="basic-addon2" wfd-id="id1">
                                <span @click.prevent="parse()" type="button" class="input-group-text" id="basic-addon2">Parse</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Проверки видео</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-sm-4 col-6">
                        <!-- Kinopoisk ID -->
                        <div class="form-group">
                            <label for="testId">Наличие в БД:</label>
                            <button @click="checkInBD(form.kinopoiskId)" type="button" class="btn btn-block btn-info"
                                    id="testId">Тест
                            </button>
                        </div>
                    </div>
                    <div v-if="test.id != null">
                        <div v-if="test.id == 1" class="alert alert-danger" role="alert">
                            Present in Database
                        </div>
                        <div v-if="test.id == 2" class="alert alert-info" role="alert">
                            Absent in Database
                        </div>
                    </div>

                    <!-- Video Test -->
                    <div class="col-sm-6">
                        <div class="form-group mt-3" v-if="form.kinopoiskId != null">
                            <div class="accordion accordion-flush">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button @click.prevent="testVideo()" class="accordion-button collapsed"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                aria-controls="flush-collapseTwo">
                                            Тест Видео
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body alert alert-info">
                                            <div class="kinobox_player"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Добавление видео</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Kinopoisk ID -->
                                <div class="form-group">
                                    <label for="KinopoiskId">Кинопоиск ID:</label>
                                    <input v-model="form.kinopoiskId" type="number" class="form-control"
                                           id="KinopoiskId" placeholder="Введите Кинопоиск ID">
                                </div>
                            </div>

                            <div class="col-sm-6"></div>


                            <!-- Year -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Год:</label>
                                    <input v-model="form.year" type="text" placeholder="Выберите год"
                                           class="form-control" aria-label="Sizing example input"
                                           aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>

                            <!-- Video allowed -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Показ видео:</label>
                                    <select v-model="form.video_allowed" class="form-select">
                                        <option :value="1">Разрешено</option>
                                        <option :value="0">Запрещено</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <!-- NameRu -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameRu">Русское название:</label>
                                    <input v-model="form.nameRu" type="text" class="form-control" id="nameRu"
                                           placeholder="Введите русское название">
                                </div>
                            </div>

                            <!-- NameEn -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameOriginal">Английское название:</label>
                                    <input v-model="form.nameEn" type="text" class="form-control" id="nameOriginal"
                                           placeholder="Введите английское название">
                                </div>
                            </div>

                            <!-- AgeLimits -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ageLimits">Возрастные ограничения:</label>
                                    <input v-model="form.age_limits" type="text" class="form-control" id="ageLimits"
                                           placeholder="Введите ограничение по возрасту">
                                </div>
                            </div>

                            <!--poster Upload -->
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="PosterUpload">Постер:</label>
                                    <div class="mb-3" id="PosterUpload">
                                        <input @input="form.poster = $event.target.files[0]" class="form-control"
                                               type="file">
                                    </div>
                                    <a v-if="examples.posterUrlPreview" :href="examples.posterUrlPreview" target="_blank">Перейти к постеру</a>

                                </div>

                            </div>

                            <!--backdrop Upload -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="BackdropUpload">Фоновая картинка:</label>
                                    <div class="mb-3" id="BackdropUpload">
                                        <input @input="form.backdrop = $event.target.files[0]" class="form-control"
                                               type="file">
                                    </div>
                                    <a v-if="examples.backdropUrl" :href="examples.backdropUrl" target="_blank">Перейти к фоновой картинке</a>

                                </div>

                            </div>
                            </div>

                            <!-- Трейлеры -->
                            <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <form>
                                        <label>Трейлеры:</label>
                                        <div v-if="form.trailers.length > 0" v-for="(trailer, index) in form.trailers" class="form-group input-group">
                                            <input type="text" v-model="trailer.url" class="form-control col-8"
                                                   placeholder="Идентификатор dzen или ссылка youtube">
                                            <input type="text" v-model="trailer.name" class="form-control col-8"
                                                   placeholder="Название">
                                            <select v-model="trailer.site" class="form-select col-4">
                                                <option value="dzen">dzen</option>
                                                <option value="youtube">youtube</option>
                                            </select>
                                            <button @click="deleteTrailer(index)" type="button" class="btn btn-danger">-</button>
                                        </div>
                                        <div class="input-group-btn">
                                        <button @click="addTrailer()" type="button" class="btn btn-success">Добавить трейлер</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>

                            <!-- Country Select -->
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Страны</label>
                                    <select v-model="form.countries" class="form-select" multiple>
                                        <option disabled value="null">Выберите страны</option>
                                        <template v-for="country in countries">
                                            <option :value="country.id">{{country.title}}</option>
                                        </template>
                                    </select>
                                    <p> Страны по Кинопоиску:
                                        <span v-for="country in examples.countries">
                                            {{country.name}} &nbsp
                                    </span>
                                    </p>
                                </div>
                            </div>
                            </div>


                            <!-- Cat Select -->
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select @change="getGenresList(form.category)" v-model="form.category"
                                            class="form-select">
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
                            <div class="col-sm-6">
                                <div class="form-group" v-if="genres.list != null">
                                    <label>Жанры</label>
                                    <select v-model="form.genres" multiple placeholder="Можно выбрать несколько"
                                            style="width: 100%" class="form-select">
                                        <option v-for="genre in genres.list" :value="genre.id">{{genre.title}}</option>
                                    </select>
                                    <p>
                                        Жанры по кинопоиску:
                                        <span v-for="genre in examples.genres">
                                        {{genre.name}} &nbsp
                                    </span>
                                    </p>
                                </div>
                            </div>
                            </div>


                            <!--Type Select -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Тип:</label>
                                    <select v-model="form.type" style="width: 100%" class="form-select">
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


                            <!-- Duration Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="filmLength">Продолжительность:</label>
                                    <input v-model="form.duration" type="text" class="form-control" id="filmLength"
                                           placeholder="В минутах">
                                </div>
                            </div>

                            <!-- Rate Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ratingKinopoisk">Рейтинг:</label>
                                    <input v-model="form.rate" type="text" class="form-control" id="ratingKinopoisk"
                                           placeholder="Рейтинг">
                                </div>
                            </div>

                            <!-- Budget Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="budget">Бюджет:</label>
                                    <input v-model="form.budget" type="text" class="form-control" id="budget"
                                           placeholder="Бюджет">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <label for="slogan">Слоган:</label>
                                <input v-model="form.slogan" type="text" class="form-control" id="slogan"
                                       placeholder="Слоган">
                            </div>

                            <div class="form-group">
                                <label class="d-block" for="description">Описание:</label>

                                <textarea class="w-100" v-model="form.description" id="description" rows="10"
                                          placeholder="Вставьте описание"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta keywords:</label>
                                <input v-model="form.meta_keywords" type="text" class="form-control" id="meta_keywords"
                                       placeholder="Meta keywords">
                            </div>

                            <div class="form-group">
                                <label class="d-block" for="meta_description">Meta description:</label>

                                <textarea class="w-100" v-model="form.meta_description" id="meta_description" rows="4"
                                          placeholder="meta description"></textarea>
                            </div>
                        </div>



                        <div class="card-footer">
                            <button @click.prevent="store()" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>

        </div>

        <div v-if="errors"
             class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 z-10 position-fixed"
             role="alert">
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </AuthenticatedLayout>
</template>

<script>
    import {Head, Link, router,} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


    export default {
        name: "Create",
        props: ['categories', 'countries'],
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
                console.log(this.form.trailers);
                router.post('/admin/movies/store', this.form)
                   router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })


            }
        },

    }
</script>

