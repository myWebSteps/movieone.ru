<template>

    <Head title="Создать жанр" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="display-6">Создать жанр</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="newGenre()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="genreTitle">Genre Title</label>
                                <input v-model="form.title" type="text" class="d-block cform cform-custom-input" id="genreTitle" placeholder="Название жанра">
                            </div>
                            <div class="form-group">
                                <label for="genreSlug">Slug</label>
                                <input v-model="form.slug" type="text" class="d-block cform cform-custom-input" id="genreSlug" placeholder="Slug жанра">
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

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end" role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
        </div>

    </AuthenticatedLayout>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';

    export default {
        name: "Create",
        props: ['data'],
        components: {Head, Link, AuthenticatedLayout},

        data(){
          return{
              form:{
                  title: null,
                  category_id: this.data,
                  slug: null,
              },
              errors: false,
          }
        },

        methods:{
            newGenre(){
                router.post(`/admin/genres/${this.data}/store`, this.form)
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>
