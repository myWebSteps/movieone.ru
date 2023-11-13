<template>

    <Head title="Редактировать видео" />

    <AuthenticatedLayout>
        <div class="row m-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактирование видео {{movie.id}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">

                            <!-- Year -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Год:</label>
                                    <input v-model="form.year" type="text" placeholder="Выберите год" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                                    <input v-model="form.nameRu" type="text" class="form-control" id="nameRu" placeholder="Введите русское название">
                                </div>
                            </div>

                            <!-- NameEn -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameOriginal">Английское название:</label>
                                    <input v-model="form.nameEn" type="text" class="form-control" id="nameOriginal" placeholder="Введите английское название">
                                </div>
                            </div>

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
                                        <span class="input-group-btn">
                                        <button @click="addTrailer()" type="button" class="btn btn-success">Добавить трейлер</button>
                                    </span>
                                    </form>
                                </div>
                            </div>

                            <!-- ageLimits -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ageLimits">Ограничения по возрасту:</label>
                                    <input v-model="form.age_limits" type="text" class="form-control" id="ageLimits" placeholder="Введите ограничения по возрасту">
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Slug">Slug:</label>
                                    <input v-model="form.slug" type="text" class="form-control" id="slug" placeholder="Введите слаг">
                                </div>
                            </div>

                            <!--poster Upload -->
                            <div class="row">
                            <div class="col-sm-6 d-flex align-items-center column-gap-2">
                                <div class="preview w-25 d-inline-flex">
                                    <img :src="examples.poster" alt="Превью постера" class="img-fluid">
                                </div>
                                <div class="form-group d-block">
                                        <label for="PosterUpload">Постер:</label>

                                    <div class="mb-3" id="PosterUpload">
                                        <input @input="form.poster = $event.target.files[0]" class="form-control" type="file">
                                    </div>
                                </div>

                            </div>

                            <!--backdrop Upload -->
                            <div class="col-sm-6">
                                <div class="preview w-50 d-inline-flex">
                                    <img :src="examples.backdrop" alt="Превью фоновой картинки" class="img-fluid">
                                </div>
                                <div class="form-group">
                                    <label for="BackdropUpload">Фоновая картинка:</label>
                                    <div class="mb-3" id="BackdropUpload">
                                        <input @input="form.backdrop = $event.target.files[0]" class="form-control"
                                               type="file">
                                    </div>
                                </div>

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
                                </div>
                            </div>


                            <!-- Cat Select -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select @change="renderGenres()" v-model="form.category_id" class="form-select">
                                        <option disabled value="" selected>Выберите категорию</option>
                                        <template v-for="category in categories">
                                            <option  :value="category.id">{{category.title}}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>


                            <!--SubCat Select -->
                            <div class="col-sm-6">
                                <div class="form-group" v-if="genres != null">
                                    <label>Жанры</label>
                                    <select v-model="form.genres" multiple placeholder="Можно выбрать несколько" style="width: 100%" class="form-select">
                                        <option v-for="genre in genresList" :value="genre.id">{{genre.title}}</option>
                                    </select>
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

                            <!-- Budget Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="budget">Бюджет:</label>
                                    <input v-model="form.budget" type="text" class="form-control" id="budget" placeholder="Бюджет">
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
                            <button @click.prevent="updateMovie()" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>
       </div>
        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 z-10 position-fixed" role="alert">
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </AuthenticatedLayout>

</template>

<script>
    import { Head, Link, router,} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

    export default {
        name: "Admin",
        components:{Head, Link, AuthenticatedLayout},
        props:['movie', 'categories', 'genres', 'countries'],

        data(){
            return{
                form:{
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
                    rate: this.movie.rate,
                    budget: this.movie.budget,
                    slogan: this.movie.slogan,
                    description: this.movie.description,
                    trailer: this.movie.trailer,
                    video_allowed: this.movie.video_allowed,
                    meta_keywords: this.movie.meta_keywords,
                    meta_description: this.movie.meta_description,
                },
                array:{},
                examples:{
                    poster: this.movie.poster,
                    backdrop: this.movie.backdrop,
                },
                genresList: this.genres,
                errors: false,
            }
        },


        methods:{

            deleteTrailer(elemIndex){
                this.form.trailers = this.form.trailers.filter((elem, index)=>{
                    return index != elemIndex
                })
            },

            addTrailer() {
                this.form.trailers.unshift({
                    url: null,
                    name: null,
                    site: 'dzen',
                })
            },

            renderGenres(){
                this.form.genres = []
                axios.get(`/get_genres?category=${this.form.category_id}`)
                .then(response =>{
                    this.genresList = response.data
                })
            },

            updateMovie(){
                console.log(this.form);
                router.post(`/admin/movies/${this.form.id}`, {
                    _method: 'patch',
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
                    rate: this.form.rate,
                    budget: this.form.budget,
                    slogan: this.form.slogan,
                    description: this.form.description,
                    poster: this.form.poster,
                    backdrop: this.form.backdrop,
                    type: this.form.type,
                    video_allowed: this.form.video_allowed,
                    meta_keywords: this.form.meta_keywords,
                    meta_description: this.form.meta_description,
                })
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },

        },
    }
</script>

<style scoped>

</style>
