<template>
    <div>
        <div class="row card-body reviews-card">
            <div v-if="comments.length > 0" v-for="comment in comments"
                 class="media mb-4 row border-bottom">
                <img class="d-flex mr-3 rounded-circle" src="/img/comment.webp" alt="">
                <div class="media-body col-12">
                    <div class="mt-0 mb-1">
                        <p class="h6 mr-2 font-weight-bold text-gray-900 d-inline-block">
                            {{comment.name}}</p>
                        <p class="d-inline-block"><i class="fa fa-calendar"></i>
                            {{comment.updated_at}}</p>
                    </div>
                    <p class="text-gray-900">{{comment.description}}</p>
                </div>

                <div class="row col-12">
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <p>Сюжет: {{comment.plot}}/5</p>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <p>Игра актеров: {{comment.actors_game}}/5</p>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <p>Атмосфера: {{comment.atmosphere}}/5</p>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <p>Общий рейтинг: {{comment.rating}}/5</p>
                    </div>
                </div>
            </div>
            <div v-else class="d-flex justify-content-center bg-gray-200 no-comments w-100">

                    <p class="align-self-center p-0 m-0">Комментариев еще нет.
                        Будьте первым!</p>

            </div>

        </div>
        <div class="p-4 bg-light rounded">
            <h5 class="card-title mb-4">Оставьте комментарий</h5>
            <form name="leaveComment">
                <div class="row">
                        <div class="col-12">
                            <label>Имя: <span class="text-danger">*</span></label>
                            <input v-model="commentsForm.name" type="text" class="form-control col-xl-6 col-lg-8 col-md-10"
                                   required="" placeholder="Введите имя">
                        </div>
                        <div class="col-xl-6 col-12 mt-2">
                        <label class="d-block pt-2">Оценка:</label>
                            <div class="radio-group radio-group-small">
                                <input v-model="commentsForm.rating" :value=null type="radio" id="comment_plot_null" name="comment_plot"
                                       checked disabled>
                                <label class="m-0" for="comment_plot_null"><i class="fa-solid fa-not-equal"></i></label>
                                <template v-for="item in 5">
                                    <input v-model="commentsForm.rating" :value="item" type="radio" :id="`comment_rating_${item}`" name="comment_rating">
                                    <label class="m-0" :for="`comment_rating_${item}`">{{item}}</label>
                                </template>

                            </div>
                        </div>

                    <div class="col-12 mt-2">
                            <label>Комментарий:
                                <small :class="commentsForm.description.length > 255 ? 'text-danger' : ''">
                                    &nbsp{{commentsForm.description.length}}
                                    / 255</small>
                            </label>
                        <textarea required="" v-model="commentsForm.description" rows="8"
                                  cols="100" class="form-control"
                                  placeholder="Напишите комментарий"></textarea>
                    </div>

                <div class="col-12 mt-4">
                    <button @click.prevent="leaveComment()" type="submit" class="btn btn-primary">Отправить</button>
                </div>

                </div>
            </form>

        </div>

    </div>
</template>

<script>
    import {router} from "@inertiajs/vue3";

    export default {
        name: "CommentsComponent",
        props: ['comments', 'type', 'id', 'message'],
        data() {
            return {
                commentsForm: {
                    name: null,
                    rating: null,
                    description: '',
                },
            }
        },
        methods: {
            leaveComment() {
                router.post(`/${this.type}/add_comment`, {
                    id: this.id,
                    name: this.commentsForm.name,
                    plot: this.commentsForm.plot,
                    actors_game: this.commentsForm.actors_game,
                    atmosphere: this.commentsForm.atmosphere,
                    rating: this.commentsForm.rating,
                    description: this.commentsForm.description,
                }, {
                    preserveScroll: true,
                })
                router.on('error', (error) => {

                    this.message.body = error.detail.errors
                    this.message.type = 'error'
                    this.message.show = true

                })
                router.on('success', () => {

                    this.message.body = ['Отзыв успешно отослан, он появится после модерации']
                    this.message.type = 'success'
                    this.message.show = true
                    this.commentsForm.plot = null
                    this.commentsForm.actors_game = null
                    this.commentsForm.atmosphere = null
                    this.commentsForm.name = null
                    this.commentsForm.rating = null
                    this.commentsForm.description = ''
                })

            },
        },
    }
</script>

<style scoped>

</style>
