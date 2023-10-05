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
                                <input v-model="form.title" type="text" class="form-control" id="genreTitle" placeholder="Название жанра">
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
        name: "Create",
        props: ['genre'],
        components: {Head, Link, AuthenticatedLayout},

        data(){
          return{
              form:{
                  title: null,
                  category_id: route().params.category,
              },
          }
        },

        methods:{
            newGenre(){
                router.post(`/admin/genres/${route().params.category}/store`, this.form)
            },
        },

    }
</script>
