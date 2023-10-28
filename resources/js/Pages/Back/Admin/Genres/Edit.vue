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
                                <input v-model="genre.title" type="text" class="form-control" id="genreTitle" placeholder="Название жанра">
                            </div>
                            <div class="form-group">
                                <label for="genreSlug">Genre Slug</label>
                                <input v-model="genre.slug" type="text" class="form-control" id="genreSlug" placeholder="Slug жанра">
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
            },
        },

    }
</script>
