<template>
    <div>
        <div class="card-body p-0 reviews-card">
            <div v-if="comments.comments.length > 0" v-for="comment in comments.comments"
                 class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="/img/comment.webp" alt="">
                <div class="media-body">
                    <div class="mt-0 mb-1">
                        <p class="h6 mr-2 font-weight-bold text-gray-900 d-inline-block">
                            {{comment.name}}</p>
                        <p class="d-inline-block"><i class="fa fa-calendar"></i>
                            {{comment.updated_at}}</p>
                        <p class="stars-rating float-right d-inline-block">
                            <template v-for="(item, index) in 5">
                                <i :class="comment.rating > index ? 'text-danger' : ''"
                                   class="fa fa-heart pl-1 fs-6"></i>
                            </template>
                            <span class="rounded bg-danger text-dark ml-1 pl-1 pr-1 fs-6">{{comment.rating}}/5</span>
                        </p>
                    </div>
                    <p>{{comment.description}}</p>
                </div>
            </div>
            <div v-else>
                <div class="d-flex justify-content-center bg-gray-200 no-comments">
                    <p class="align-self-center p-0 m-0">У этого кино пока нет комментариев.
                        Будьте первым!</p>
                </div>
            </div>

        </div>
        <div class="p-4 bg-light rounded mt-4">
            <h5 class="card-title mb-4">Оставьте комментарий</h5>
            <form name="sentMessage">
                <div class="row">
                    <div class="control-group form-group col-lg-4 col-md-4">
                        <div class="controls">
                            <label>Имя: <span class="text-danger">*</span></label>
                            <input v-model="commentsForm.name" type="text" class="form-control"
                                   required="" placeholder="Введите имя">
                        </div>
                    </div>
                    <div class="control-group form-group col-lg-4 col-md-4">
                        <div class="controls">
                            <label>Оценка <span class="text-danger">*</span></label>
                            <select required="" v-model="commentsForm.rating"
                                    class="form-control custom-select">
                                <option :value=null disabled selected>Оцените фильм</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Комментарий <span class="text-danger">*</span></label>
                        <textarea required="" v-model="commentsForm.description" rows="3"
                                  cols="100" class="form-control"
                                  placeholder="Напишите комментарий"></textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button @click.prevent="leaveComment()" type="submit" class="btn btn-primary">Отправить</button>
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
        data(){
            return{
                commentsForm: {
                    name: null,
                    rating: null,
                    description: null,
                },
            }
        },
        methods:{
            leaveComment() {
                router.post(`/${this.type}/add_comment`, {
                    id: this.id,
                    name: this.commentsForm.name,
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

                    this.commentsForm.name = null
                    this.commentsForm.rating = null
                    this.commentsForm.description = null
                })

            },
        },
    }
</script>

<style scoped>

</style>
