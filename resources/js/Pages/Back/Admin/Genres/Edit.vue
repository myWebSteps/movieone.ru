<template>

    <Head title="Редактировать жанр" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать жанр</h2>
        </template>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">
                    <form @submit.prevent="updateGenre(genre.id, genre.category_id, genre.slug, genre.title)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="genreTitle">Genre Title</label>
                                <input v-model="genre.title" type="text" class="d-block cform cform-custom-input" id="genreTitle" placeholder="Название жанра">
                            </div>
                            <div class="form-group">
                                <label for="genreSlug">Genre Slug</label>
                                <input v-model="genre.slug" type="text" class="d-block cform cform-custom-input" id="genreSlug" placeholder="Slug жанра">
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
        name: "Edit",
        props: ['genre'],
        components: {Head, Link, AuthenticatedLayout},

        methods:{
            updateGenre(id, catId, slug, title){
                router.patch(`/admin/genres/${id}`, {id: id, category_id: catId, slug: slug, title: title})
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>
