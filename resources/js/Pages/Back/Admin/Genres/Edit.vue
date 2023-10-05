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
                    <form @submit.prevent="updateGenre(genre.id, genre.category_id, genre.title)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Category Title</label>
                                <input v-model="genre.title" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
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
            updateGenre(id, catId, title){
                router.patch(`/admin/genres/${id}`, {id: id, category_id: catId, title: title})
            },
        },

    }
</script>
