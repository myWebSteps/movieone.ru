<template>
    <div class="grid grid-flow-row gap-4 pb-4">
        <section class="py-2 border-b-gray-200 border-b-[1px] w-full max-h-96 overflow-y-auto">
            <div v-if="comments.length > 0" v-for="comment in comments"
                 class="grid grid-cols-[1fr,_4fr]">
                <img src="/img/comment.webp" class="w-1/2 justify-self-center self-top" alt="...">
                <div class="grid grid-flow-row grid-rows-[30px,_minmax(70px,_max-content),_minmax(50px,_max-content)]">
                    <div class="grid grid-flow-col justify-self-start gap-2">
                        <span class="font-bold text-gray-900">
                            {{comment.name}}
                        </span>
                        <span>
                            {{comment.created_at}}
                        </span>
                    </div>
                    <p class="text-gray-900">{{comment.description}}</p>

                    <div class="grid grid-cols-[repeat(auto-fit,_minmax(20px,_160px))]">
                        <div class="bg-gray-200 py-2 px-4 grid content-center">
                            <p class="text-gray-900 text-sm">Pейтинг: {{comment.rating}}/5</p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="grid items-center bg-gray-300 h-[100px]">
                <p class="align-self-center p-2">Комментариев еще нет.
                    Будьте первым!</p>
            </div>

        </section>
        <section class="grid grid-flow-row gap-2">
            <h5 class="text-lg">Оставьте комментарий</h5>
            <form name="leaveComment" class="grid gap-2">
                <div>
                    <label>Имя:<span class="text-red-500">*</span></label>&nbsp
                    <input v-model="commentsForm.name" type="text" class="w-3/4 md:w-1/2"
                           required="" placeholder="Введите имя">
                </div>

                <div class="grid grid-cols-[repeat(auto-fit,_minmax(50px,_300px))] gap-1">

                    <div>
                        <label>Оценка:</label><br>
                        <ul class="grid grid-cols-[repeat(6,_40px)] grid-flow-col w-[240px] rounded-md overflow-hidden">
                            <li class="grid items-center justify-items-center bg-gray-300 cursor-pointer py-1">
                                <i class="icon-star_half text-[#333545] text-xl"></i>
                            </li>
                            <li v-for="item in 5"
                                class="grid items-center justify-items-center cursor-pointer py-1"
                                @click = "commentsForm.rating = item"
                                :class="commentsForm.rating === item ? 'bg-[#333545] text-white' : 'bg-gray-300'"
                            >
                                <span>{{item}}</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <div>
                    <label>Комментарий:
                        <small :class="commentsForm.description.length > 255 ? 'text-red-500' : ''">
                            &nbsp{{commentsForm.description.length}}
                            / 255</small>
                    </label>
                    <textarea required="" v-model="commentsForm.description" rows="8"
                              class="w-full"
                              placeholder="Напишите комментарий"></textarea>
                </div>

                <div class="justify-self-end py-2 px-6 border-2 border-pink-800 rounded-2xl text-pink-700 hover:bg-pink-800 hover:text-white">
                    <button @click.prevent="leaveComment()" type="submit" class="btn btn-primary">Оставить комментарий</button>
                </div>

            </form>

        </section>

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
                    this.commentsForm.description = ''
                })

            },
        },
    }
</script>


