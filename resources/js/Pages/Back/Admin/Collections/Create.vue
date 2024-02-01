<template>

    <Head title="Создать коллекцию"/>

    <AuthenticatedLayout>

        <template #header>
            <h2 class="display-6">Создать коллекцию</h2>
        </template>

        <section class="content">
            <div class="container-fluid">

                <div class="bg-white p-3 widget shadow rounded mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- General Info -->
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                               aria-controls="general" aria-selected="true">Коллекция</a>
                        </li>
                        <!-- Articles -->
                        <li class="nav-item">
                            <a class="nav-link" id="articles-tab" data-toggle="tab" href="#articles" role="tab"
                               aria-controls="articles" aria-selected="false">Статьи коллекции</a>
                        </li>

                        <!-- SEO-->
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                               aria-controls="seo" aria-selected="false">SEO</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">

                            <div class="col-12 mt-1">
                                <label for="collection_title">Заголовок коллекции:</label>
                                <input v-model="form.collection_title" type="text"
                                       class="d-block cform cform-custom-input w-100"
                                       id="collection_title" placeholder="Введите заголовок коллекции">
                            </div>

                            <div class="col-12 mt-2">
                                <label class="d-block" for="collection_description_min">Краткое описание:<small
                                    :class="form.description_min.length > 100 ? 'text-danger' : ''">&nbsp{{form.description_min.length}}
                                    / 100</small></label>

                                <textarea class="w-100 d-block cform cform-custom-input" v-model="form.description_min"
                                          id="collection_description_min" rows="10"
                                          placeholder="Вставьте описание"></textarea>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="d-block" for="collection_description">Полное описание: <small
                                    :class="form.description.length > 1225 ? 'text-danger' : ''">&nbsp{{form.description.length}}
                                    / 1225</small></label>

                                <textarea class="w-100 d-block cform cform-custom-input" v-model="form.description"
                                          id="collection_description" rows="20"
                                          placeholder="Вставьте полное описание"></textarea>
                            </div>

                            <!--poster Upload -->
                            <div class="col-12 mt-4">
                                <div v-if="poster_preview" class="mb-2 mt-2">
                                    <img class="container-fluid col-xs-12 col-sm-6 col-xl-3"
                                         :src="poster_preview" alt="">
                                </div>
                                <label for="collection_poster">Постер:</label>
                                <div class="mb-3" id="collection_poster">
                                    <input @input.prevent="handlePoster($event)"
                                           class="cform cform-custom-file"
                                           type="file">
                                </div>
                            </div>

                        </div>

                        <!-- Articles Tab -->
                        <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">

                            <div class="row">
                                <template v-for="(article, index) in form.articles">
                                    <div class="col-12 mt-3 mb-3">
                                        <div class="col-12 mt-1">
                                            <label :for="`collection_title${index}`">Заголовок коллекции:</label>
                                            <input v-model="article.article_title" type="text"
                                                   class="d-block cform cform-custom-input w-100"
                                                   :id="`collection_title${index}`"
                                                   placeholder="Введите заголовок статьи">
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label :for="`article_description${index}`">Текст статьи:</label>
                                            <textarea class="w-100 d-block cform cform-custom-input"
                                                      v-model="article.article_description"
                                                      :id="`article_description${index}`" rows="20"
                                                      placeholder="Текст статьи"></textarea>
                                        </div>

                                        <!--poster Upload -->
                                        <div class="col-12 mt-4">
                                            <div v-if="previews[index]" class="mb-2 mt-2">
                                                <img class="container-fluid col-xs-12 col-sm-6 col-12"
                                                     :src="previews[index]" alt="">
                                            </div>
                                            <label for="`article_image${index}`">Картинка:</label>
                                            <div class="mb-3" :id="`article_image${index}`">
                                                <input @input.prevent="handleImage($event, index)"
                                                       class="cform cform-custom-file"
                                                       type="file">
                                            </div>
                                        </div>

                                        <!-- Related videos -->
                                        <div class="col-12 mt-2">

                                            <label class="d-block">Выберите видео, соответствующее статье:</label>
                                            <select v-model="article.article_movie"
                                                    class="cform cform-custom-input d-block w-100">
                                                <option :value=null disabled>Выберите видео, соответствующее статье
                                                </option>
                                                <option v-for="movie in movies" :value="movie.id">{{movie.nameRu}} /
                                                    {{movie.nameEn}} / {{movie.year}}
                                                </option>
                                            </select>

                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-3 mb-3">
                                            <button v-if="index > 0" @click="deleteArticle(index)" type="button"
                                                    class="cform-btn cform-custom-btn cform-btn-error col-3">Удалить
                                                статью
                                            </button>
                                        </div>
                                        <hr>
                                    </div>


                                </template>

                                <div class="col-12 mt-4 mb-4 input-group-btn d-flex justify-content-end">
                                    <button @click="addArticle()" type="button"
                                            class="cform-btn cform-custom-btn cform-btn-secondary">Добавить статью
                                    </button>
                                </div>
                            </div>

                        </div>

                        <!--SEO Tab-->
                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">

                            <div class="row">

                                <!-- Meta title -->
                                <div class="col-12 mt-1">
                                    <label for="meta_title">Заголовок коллекции:</label>
                                    <input v-model="form.meta_title" type="text"
                                           class="d-block cform cform-custom-input w-100"
                                           id="meta_title" placeholder="Введите meta заголовок">
                                </div>

                                <div class="col-12">
                                    <label for="meta_keywords">Meta keywords:</label>
                                    <input v-model="form.meta_keywords" type="text"
                                           class="w-100 d-block cform cform-custom-input" id="meta_keywords"
                                           placeholder="Meta keywords">
                                </div>

                                <div class="col-12">
                                    <label class="d-block" for="meta_description">Meta description:</label>

                                    <textarea class="w-100 d-block cform cform-custom-input"
                                              v-model="form.meta_description" id="meta_description" rows="4"
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

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end"
             role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert"
                    aria-label="Close">X
            </button>
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
        props: ['movies'],
        components: {Head, Link, AuthenticatedLayout},

        data() {
            return {
                previews: [],
                poster_preview: null,
                form: {
                    collection_title: null,
                    poster: null,
                    description: '',
                    description_min: '',
                    meta_title: "",
                    meta_keywords: "",
                    meta_description: "",
                    articles: [
                        {
                            article_title: null,
                            article_image: null,
                            article_description: null,
                            article_movie: null,
                        }
                    ],
                },
                errors: null,
            }
        },

        methods: {

            handlePoster(event)
            {
                this.form.poster = event.target.files[0];
                this.poster_preview = URL.createObjectURL(event.target.files[0])
            },

            handleImage(event, articleIndex) {
                this.form.articles[articleIndex].article_image = event.target.files[0]
                this.previews[articleIndex] = URL.createObjectURL(event.target.files[0])
            },

            deleteArticle(elemIndex) {
                this.form.articles = this.form.articles.filter((elem, index) => {
                    return index != elemIndex
                })
            },

            addArticle() {
                this.form.articles.push({
                    article_title: null,
                    article_image: null,
                    article_description: null,
                    article_movie: null,
                })
            },


            store() {
                this.form.articles = this.form.articles.filter((elem) => {
                    if (elem.article_title != '' && elem.article_image != null && elem.article_description && elem.article_movie != null) {
                        return elem
                    }
                })
                router.post('/admin/collections/store', this.form)
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })


            }
        },

    }
</script>

