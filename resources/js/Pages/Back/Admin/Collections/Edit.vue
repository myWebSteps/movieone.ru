<template>

    <Head title="Редактировать коллекцию"/>

    <h2 class="bg-white p-4 shadow-md">Редактировать коллекцию {{ form.collection_id }}</h2>


    <section class="container mx-auto p-4">
            <div class="grid grid-flow-row grid-rows-[max-content_max-content_100px] gap-4">
                <div
                    class="grid grid-cols-[repeat(auto-fill,_minmax(max-content,_150px))] gap-4 items-center">
                <span class="cursor-pointer" @click="accordion = 'general'"
                      :class="accordion === 'general' ? 'border-b-2 border-red-400' : ''"
                >
                    Коллекция
                </span>
                    <span class="cursor-pointer" @click="accordion = 'articles'"
                          :class="accordion === 'articles' ? 'border-b-2 border-red-400' : ''"
                    >
                    Статьи коллекции
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
                    <label>Статус: <br>
                        <select v-model="form.is_published"
                        >
                            <option :value='0'>Черновик</option>
                            <option :value='1'>Коллекция опубликована</option>
                        </select>
                    </label>

                    <label>Заголовок коллекции: <small :class="form.collection_title.length > 40 ? 'text-red-500' : ''">
                        &nbsp{{ form.collection_title.length }}
                        / 40</small> <br>
                        <input v-model="form.collection_title" type="text"
                               class="w-full"
                               placeholder="Введите заголовок коллекции">
                    </label>

                    <label>Slug коллекции: <br>
                        <input v-model="form.slug" type="text"
                               class="w-full"
                               id="collection_slug" placeholder="Введите slug коллекции">
                    </label>

                    <label>Краткое описание:
                        <small
                            :class="form.description_min.length > 100 ? 'text-red-500' : ''">&nbsp{{
                                form.description_min.length
                            }}
                            / 100</small><br>
                        <textarea class="w-full"
                                  v-model="form.description_min"
                                  rows="5" placeholder="Вставьте описание">
                    </textarea>
                    </label>

                    <label>Полное описание:
                        <small
                            :class="form.description.length > 100 ? 'text-red-500' : ''">&nbsp{{
                                form.description.length
                            }}
                            / 100</small><br>
                        <textarea class="w-full"
                                  v-model="form.description"
                                  rows="10" placeholder="Полное описание">
                    </textarea>
                    </label>


                    <div>
                        <div class="my-2
                        w-1/2
                        md:w-1/4
                        "
                             v-if="poster_preview === null">
                            <img :src="form.poster" alt="...">
                        </div>
                        <div class="my-2
                        w-1/2
                        md:w-1/4
                        "
                             v-if="poster_preview !== null">
                            <img :src="poster_preview" alt="...">
                        </div>
                        <label>Картинка:
                            <div class="mb-3">
                                <input @input="handlePoster($event)"
                                       class="cform cform-custom-file"
                                       type="file">
                            </div>
                        </label>
                    </div>

                </section>
                <section v-if="accordion === 'articles'"
                         class="grid grid-flow-row gap-4"
                >
                        <template v-for="(article, index) in form.articles">

                                    <label :for="`article_title${index}`">Заголовок статьи:
                                        <small :class="article.article_title.length > 255 ? 'text-red-500' : ''">
                                            &nbsp{{ article.article_title.length }}
                                            / 255</small> <br>
                                    <input v-model="article.article_title" type="text"
                                           class="w-full"
                                           :id="`collection_title${index}`"
                                           placeholder="Введите заголовок статьи">
                                    </label>

                                    <label>Текст статьи:
                                        <small
                                            :class="article.article_description.length > 16300 ? 'text-red-500' : ''">
                                            &nbsp{{ article.article_description.length }}
                                            / 16300</small> <br>
                                    <textarea v-model="article.article_description"
                                              class="w-full"
                                              rows="10"
                                              placeholder="Текст статьи"></textarea>
                                    </label>


                                    <div class="my-2 w-1/2
                                       md:w-1/4
                                       "
                                         v-if="!previews[index]">
                                        <img :src="article.article_image" alt="">
                                    </div>
                                    <div class="my-2 w-1/2
                                        md:w-1/4
                                        "
                                         v-if="previews[index]">
                                        <img :src="previews[index]" alt="">
                                    </div>
                                    <label>Картинка:
                                        <div class="mb-3">
                                            <input @input="handleImage($event, index)"
                                                   type="file">
                                        </div>
                                    </label>

                                    <label>Выберите видео, соответствующее статье:</label>

                                    <div class="grid grid-flow-col grid-cols-[200px,_max-content]">
                                        <input @keypress.enter.prevent="getFilteredMovies(index)"
                                               v-model="article.movies_filter"
                                               type="search"
                                               class="w-full"
                                               placeholder="Фильтр по названию...">
                                        <button @click.prevent="getFilteredMovies(index)"
                                                class="bg-green-600 text-white box-border border-[1px] border-green-600 px-4 py-2
                             hover:text-green-600 hover:border-green-600 hover:bg-white"
                                        >
                                            <span class="material-symbols-sharp grid content-center">search</span>
                                        </button>
                                    </div>

                                    <div>
                                        <div>
                                            <label>
                                                <input v-model="article.article_movie"
                                                       value=""
                                                       class="hidden"
                                                       type="radio"
                                                       :name="`movie_article_${index}`"
                                                       disabled
                                                >
                                                Фильм не выбран
                                            </label>
                                        </div>
                                        <div v-for="movie in article.movies_list">
                                            <label>
                                                <input v-model="article.article_movie"
                                                       :value="movie.id"
                                                       class="text-[#333545] focus:ring-white"
                                                       type="radio"
                                                       :name="`movie_article_${index}`"
                                                >
                                                {{ movie.nameRu }} / {{ movie.nameEn }} / {{ movie.year }}
                                            </label>
                                        </div>
                                    </div>

                            <danger-button v-if="index > 0" @click="deleteArticle(index)"
                            class="justify-self-end"
                            >
                                Удалить статью
                            </danger-button>
                                <hr>
                        </template>

                        <div class="col-12 mt-4 mb-4 input-group-btn d-flex justify-content-end">
                            <button @click="addArticle()" type="button"
                                    class="bg-green-600 text-white box-border px-4 py-2 rounded-md justify-self-end
                             hover:text-green-600 hover:border-green-600 border-2 hover:bg-white">
                                Добавить статью
                            </button>
                        </div>
                </section>
                <section v-if="accordion === 'seo'">
                    <div class="grid grid-flow-row gap-4">
                        <label>Заголовок: <br>
                            <input v-model="form.meta_title"
                                   type="text"
                                   class="w-full"
                                   placeholder="Введите meta заголовок">
                        </label>
                        <label for="meta_keywords">Meta keywords:
                            <small :class="form.meta_keywords.length > 255 ? 'text-red-500' : ''">
                                &nbsp{{ form.meta_keywords.length }}
                                / 255</small> <br>
                        <input v-model="form.meta_keywords" type="text"
                               class="w-full" id="meta_keywords"
                               placeholder="Meta keywords">
                        </label>
                        <label class="d-block" for="meta_description">Meta description:
                            <small :class="form.meta_description.length > 16300 ? 'text-red-500' : ''">
                                &nbsp{{ form.meta_description.length }}
                                / 16300</small><br>
                        <textarea class="w-full"
                                  v-model="form.meta_description" rows="4"
                                  placeholder="meta description">
                        </textarea>
                        </label>
                    </div>
                </section>
                <div class="grid justify-items-center items-center">

                    <button @click.prevent="store()" type="submit"
                            class="bg-[#333545] justify-self-end px-4 py-2 rounded-md text-white
                        hover: border-2 hover:border-[#333545] hover:text-[#333545] hover:bg-white"
                    >
                        Submit</button>
                </div>

            </div>
        </section>

        <message :message.sync="message"></message>

</template>

<script>
import {Head, Link, router,} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Message from "@/Components/Message.vue";
import DangerButton from "@/Components/DangerButton.vue";



export default {
    name: "Create",
    layout: AuthenticatedLayout,
    props: ['data', 'movies'],
    components: {Head, Link, AuthenticatedLayout, Message, DangerButton},

    data() {
        return {
            accordion: 'general',
            previews: [],
            poster_preview: null,
            form: {
                is_published: this.data[0].is_published,
                collection_id: Number(this.data[0].id),
                collection_title: this.data[0].collection_title,
                slug: this.data[0].slug,
                poster: this.data[0].poster,
                description: this.data[0].description,
                description_min: this.data[0].description_min,
                meta_title: this.data[0].meta_title,
                meta_keywords: this.data[0].meta_keywords,
                meta_description: this.data[0].meta_description,
                articles: this.data[0].articles,
            },
            message: {
                body: [],
                type: '',
                show: false,
            }
        }
    },

    methods: {

        getFilteredMovies(index) {
            axios.post('/admin/collections/get_filtered_movies', {
                query_filter: this.form.articles[index].movies_filter
            })
                .then(res => {
                    this.form.articles[index].article_movie = "";
                    this.form.articles[index].movies_list = res.data;
                })
        },

        handlePoster(event) {
            this.form.poster = event.target.files[0]
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
                article_title: '',
                article_image: null,
                article_description: '',
                article_movie: null,
                movies_filter: '',
                movies_list: this.movies,
            })
        },


        store() {
            this.form.articles.forEach(elem => {
                delete elem.movies_filter
                delete elem.movies_list
            })
            this.form.articles = this.form.articles.filter((elem) => {
                if (elem.article_title != '' && elem.article_image != null && elem.article_description && elem.article_movie != null) {
                    return elem
                }
            })
            router.post(`/admin/collections/${this.data[0].id}`, {
                _method: 'PATCH',
                is_published: Boolean(this.form.is_published),
                collection_id: this.form.collection_id,
                collection_title: this.form.collection_title,
                slug: this.form.slug,
                description_min: this.form.description_min,
                description: this.form.description,
                poster: this.form.poster,
                articles: this.form.articles,
                meta_title: this.form.meta_title,
                meta_keywords: this.form.meta_keywords,
                meta_description: this.form.meta_description
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

