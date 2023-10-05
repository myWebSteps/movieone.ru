<template>

    <Head title="Жанры" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список жанров</h2>
        </template>
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="card" v-for="item in data">
                            <div class="card-header">
                                <h3 class="card-title">{{item.category_title}}</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="genre in item.genres">
                                        <tr>
                                            <td>{{genre.id}}</td>
                                            <td>{{genre.title}}</td>
                                            <td>
                                                <Link as="button" :href="this.route('genres.edit', {category: item.category_id, genre: genre.id})" class="btn btn-block btn-outline-warning btn-sm w-50"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="this.route('genres.destroy', {genre: genre.id})" type="button" class="btn btn-block btn-outline-danger btn-sm w-50"><i class="fa-solid fa-trash"></i>
                                                </Link>
                                            </td>
                                        </tr>



                                    </template>





                                    </tbody>
                                </table>

                                <Link :href="this.route('genres.create', {category: item.category_id})" class="p-4">Добавить жанр</Link>

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
