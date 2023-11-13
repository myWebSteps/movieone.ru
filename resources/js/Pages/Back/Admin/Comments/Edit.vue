<template>

    <Head title="Редактировать Категорию" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать комментарий</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="updateComment()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Имя:</label>
                                <input v-model="form.name" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
                            </div>
                            <select v-model="form.rating" class="form-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                            </select>
                            <div class="form-group">
                                <label for="categoryLogo">Описание</label>
                                <input v-model="form.description" type="text" class="form-control" id="categoryLogo" placeholder="Logo категории">
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input v-model="form.approved" type="checkbox" class="custom-control-input" id="approved">
                                    <label class="custom-control-label" for="approved">Одобрить </label>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </section>

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 z-10 position-fixed" role="alert">
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </AuthenticatedLayout>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';

    export default {
        name: "Edit",
        props: ['comment'],
        components: {Head, Link, router, AuthenticatedLayout},

        data(){
            return{
                errors: false,
                form: {
                    name: this.comment.name,
                    rating: this.comment.rating,
                    description: this.comment.description,
                    approved: this.comment.approved,
                }
            }
        },

        mounted(){
            if(this.form.approved == 1){
                this.form.approved = true
            }else if(this.form.approved == 0){
                this.form.approved = false
            };
        },


        methods:{
            updateComment(){
                router.patch(`/admin/comments/${this.comment.id}`, {
                    name: this.form.name,
                    rating: this.form.rating,
                    description: this.form.description,
                    approved: this.form.approved,
                    })
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

