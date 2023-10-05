<template>

    <Head title="Категории" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список видео</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4 mt-4 col-md-4 col-6">

                    <Link :href="route('movies.create')" class="btn btn-success">Добавить видео</Link>
                </div>


                <div class="row">
                    <div class="col-md-10 col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Видео:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Kinopoisk ID</th>
                                        <th>year</th>
                                        <th>nameRu</th>
                                        <th>nameEn</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="movie in data">
                                        <tr>
                                            <td>{{movie.id}}</td>
                                            <td>{{movie.kinopoisk_id}}</td>
                                            <td>{{movie.year}}</td>
                                            <td>{{movie.nameRu}}</td>
                                            <td>{{movie.nameEn}}</td>
                                            <td>
                                                <Link as="button" class="btn btn-block btn-outline-warning btn-sm w-50"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="route('movies.destroy', {movie: movie.id})" type="button" class="btn btn-block btn-outline-danger btn-sm w-50"><i class="fa-solid fa-trash"></i>
                                                </Link>
                                            </td>
                                        </tr>


                                    </template>





                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>


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

    export default {
        name: "Index",
        props: ['data'],
        components: {Head, Link, AuthenticatedLayout},

    }
</script>
