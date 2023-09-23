<template>
    <div class="row m-3">
        <div class="accordion accordion-flush col-sm-6 m-3">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Parser
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="input-group mb-3">
                            <input v-model="form.kinopoiskId" type="number" class="form-control" placeholder="Введите номер видео по Кинопоиску" aria-label="Recipient's username" aria-describedby="basic-addon2" wfd-id="id1">
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
                        <button @click="checkInBD(form.kinopoiskId)" type="button" class="btn btn-block btn-info" id="testId">Тест</button>
                    </div>
                </div>
                <div v-if="test.id != null">
                    <div v-if="test.id == 1" class="alert alert-danger" role="alert">
                        Present in Database
                    </div>
                    <div v-if="test.id == 2"  class="alert alert-info" role="alert">
                        Absent in Database
                    </div>
                </div>

                <!-- Video Test -->
                <div class="col-sm-6">
                    <div class="form-group mt-3" v-if="form.kinopoiskId != null">
                        <div class="accordion accordion-flush">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button @click.prevent="testVideo()" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Тест Видео
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
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
                                <input v-model="form.kinopoiskId" type="number" class="form-control" id="KinopoiskId" placeholder="Введите Кинопоиск ID">
                            </div>
                        </div>

                        <div class="col-sm-6">
                        </div>


                        <!-- Year -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Год:</label>
                                <input v-model="form.year" type="text" placeholder="Выберите год" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <!-- NameRu -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nameRu">Русское название:</label>
                                <input v-model="form.nameRu" type="text" class="form-control" id="nameRu" placeholder="Введите русское название">
                            </div>
                        </div>

                        <!-- NameEn -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nameOriginal">Английское название:</label>
                                <input v-model="form.nameEn" type="text" class="form-control" id="nameOriginal" placeholder="Введите английское название">
                            </div>
                            <p> Оригинальное название:
                                <span>{{examples.nameOriginal}}</span>
                            </p>
                        </div>

                        <!--poster Upload -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="PosterUpload">Постер:</label>
                                    <div class="mb-3" id="PosterUpload">
                                        <input @input="form.poster = $event.target.files[0]" class="form-control" type="file">
                                    </div>
                                <a :href="examples.posterUrlPreview" target="_blank">Перейти к постеру</a>

                            </div>

                        </div>

                        <!-- Country Select -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Страны</label>
                                <select v-model="form.countries" class="form-select" multiple>
                                    <option disabled value="null">Выберите страны</option>
                                    <template v-for="country in countries">
                                        <option  :value="country.id">{{country.title}}</option>
                                    </template>
                                </select>
                                <p> Страны по Кинопоиску:
                                    <span v-for="country in examples.countries">
                                            {{country.country}} &nbsp
                                    </span>
                                </p>
                            </div>
                        </div>


                        <!-- Cat Select -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Категория</label>
                                <select @change="getGenresList(form.category)" v-model="form.category" class="form-select">
                                    <option disabled value="" selected>Выберите категорию</option>
                                    <template v-for="category in categories">
                                        <option  :value="category.id">{{category.title}}</option>
                                    </template>
                                </select>
                                <p  v-if="form.type != null">
                                    Категория Кинопоиска: {{form.type}}
                                </p>
                            </div>
                        </div>


                        <!--SubCat Select -->
                        <div class="col-sm-6">
                            <div class="form-group" v-if="genres.list != null">
                                <label>Жанры</label>
                                <select v-model="form.genres" multiple placeholder="Можно выбрать несколько" style="width: 100%" class="form-select">
                                    <option v-for="genre in genres.list" :value="genre.id">{{genre.title}}</option>
                                </select>
                                <p>
                                    Жанры по кинопоиску:
                                    <span v-for="genre in examples.genres">
                                        {{genre.genre}} &nbsp
                                    </span>
                                </p>
                            </div>
                        </div>


                        <!--Type Select -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Тип:</label>
                                <select v-model="form.type" style="width: 100%" class="form-select">
                                    <option value="" disabled>Выберите Тип</option>
                                    <option value="2">Кино</option>
                                    <option value="3">Сериалы</option>
                                    <option value="4">Мини сериалы</option>
                                </select>
                                <p> Тип по Кинопоиску:
                                    {{examples.type}}
                                </p>
                            </div>
                        </div>


                        <!-- Duration Parse -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="filmLength">Продолжительность:</label>
                                <input v-model="form.duration" type="text" class="form-control" id="filmLength" placeholder="В минутах">
                            </div>
                        </div>

                        <!-- Rate Parse -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ratingKinopoisk">Рейтинг:</label>
                                <input v-model="form.rate" type="text" class="form-control" id="ratingKinopoisk" placeholder="Рейтинг">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="slogan">Слоган:</label>
                            <input v-model="form.slogan" type="text" class="form-control" id="slogan" placeholder="Слоган">
                        </div>

                        <div class="form-group">
                            <label class="d-block" for="description">Описание:</label>

                            <textarea class="w-100" v-model="form.description" id="description" rows="10" placeholder="Вставьте описание"></textarea>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button @click.prevent="store()" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

            <!-- /.card-body -->
        </div>


        <div v-if="Object.entries(form.errors).length > 0">
            <p v-for="error in form.errors">
                {{error}}
            </p>
        </div>

    </div>

</template>

<script setup>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import { useForm } from '@inertiajs/vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {defineComponent, reactive, watch, onMounted, computed, defineProps} from 'vue';
    import {router} from '@inertiajs/vue3';

    const props = defineProps(['categories', 'countries']);

    const test = reactive({
        id: null,
    })
    let genres = reactive({
        list: null,
    })

    const examples = reactive({
        genres: null,
        type: null,
        posterUrlPreview: null,
        countries: null,
        nameOriginal: null,
    })

    const form = useForm({
        kinopoiskId: null,
        year: null,
        nameRu: null,
        nameEn: null,
        poster: null,
        category: "",
        countries: [],
        type: "",
        duration: null,
        ageLimits: null,
        rate: null,
        slogan: null,
        description: null,
        genres: [],
    });

    function parse()
    {
        axios.get(`https://kinopoiskapiunofficial.tech/api/v2.2/films/${this.form.kinopoiskId}`,
            {headers: {
                    'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                    'Content-Type': 'application/json',
                }})
            .then(response=>{
                console.log(response)
                this.form.year = response.data.year
                this.form.nameRu = response.data.nameRu
                this.form.nameEn = response.data.nameEn
                this.form.duration = response.data.filmLength
                this.form.ageLimits = response.data.ratingAgeLimits
                this.form.rate = response.data.ratingKinopoisk
                this.form.slogan = response.data.slogan
                this.form.description = response.data.description
                this.examples.genres = response.data.genres
                this.examples.type = response.data.type
                this.examples.posterUrlPreview = response.data.posterUrlPreview
                this.examples.countries = response.data.countries
                this.examples.nameOriginal = response.data.nameOriginal
            })
    }

    function getGenresList(category){
        axios.get(`/get_genres?category=${category}`)
            .then(response=>{
                this.genres.list = response.data
            })
    }

    function checkInBD(id){
        axios.post('/admin/movies/test_in_bd',{kinopoisk_id: String(id)})
            .then(response=>{
                console.log(response.data.length)

                if(response.data.length > 0){
                    this.test.id = 1
                }else{
                    this.test.id = 2
                }
            })
    }

    function testVideo(){
        new Kinobox('.kinobox_player', {
            'X-Settings': {
                "Alloha" : {
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
                "Collaps":{
                    "enable": true,
                    "position": 5,
                    "token": "",
                },
                "Hdvb":{
                    "enable": true,
                    "position": 6,
                    "token": "",
                },
                "Iframe":{
                    "enable": true,
                    "position": 7,
                    "token": "",
                },
                "Kodik":{
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
    }

    function store() {
        form.post('/admin/movies/store',
            {
                onSuccess: ()=> form.reset('year', 'nameRu', 'nameEn', 'poster', 'category', 'countries', 'type', 'duration', 'ageLimits', 'rate', 'slogan', 'description', 'genres')
            })

    }

</script>

<style scoped>

</style>
