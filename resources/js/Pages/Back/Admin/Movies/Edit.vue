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

                            <!--poster Upload -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="PosterUpload">Постер:</label>
                                    <div class="mb-3" id="PosterUpload">
                                        <input @input="form.poster = $event.target.files[0]" class="form-control" type="file">
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
                                        <option value="2">Кино</option>
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
                            <button @click.prevent="updateMovie()" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>


<!--            <div v-if="errors">-->
<!--                <p v-for="error in errors">-->
<!--                    {{error}}-->
<!--                </p>-->
<!--            </div>-->

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
                    year: this.movie.year,
                    poster: null,
                    countries: this.movie.countries,
                    category_id: this.movie.category_id,
                    genres: this.movie.genres,
                    type: this.movie.type,
                    duration: this.movie.duration,
                    rate: this.movie.rate,
                    slogan: this.movie.slogan,
                    description: this.movie.description,
                },
                genresList: this.genres,
            }
        },

        mounted(){
            console.log(this.form);
        },



        methods:{

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
                    nameRu: this.form.nameRu,
                    nameEn: this.form.nameEn,
                    countries: this.form.countries,
                    category_id: this.form.category_id,
                    genres: this.form.genres,
                    year: this.form.year,
                    duration: this.form.duration,
                    rate: this.form.rate,
                    slogan: this.form.slogan,
                    description: this.form.description,
                    poster: this.form.poster,
                    type: this.form.type,
                })
            },

            errorsDismiss(){
                this.errors = {}
            },

        },
    }
</script>

<style scoped>

</style>
