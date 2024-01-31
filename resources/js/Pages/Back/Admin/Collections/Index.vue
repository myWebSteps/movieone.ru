<template>

    <Head title="Видео" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список коллекций</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4 mt-4 col-md-4 col-6">

                    <Link href="/admin/collections/create" class="btn btn-success">Добавить коллекцию</Link>
                </div>


                <div class="row">
                    <div class="col-md-10 col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Коллекции:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Заголовок</th>
                                        <th>Описание</th>
                                        <th>Статус</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="collection in data">
                                        <tr>
                                            <td>{{collection.id}}</td>
                                            <td>{{collection.collection_title}}</td>
                                            <td>{{collection.description_min}}</td>
                                            <td v-if="Boolean(collection.is_published)" class="text-success">Коллекция опубликована</td>
                                            <td v-else class="text-danger">Черновик</td>
                                            <td>
                                                <Link :href="`/admin/collections/${collection.id}/edit`" as="button" class="btn btn-block btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="`/admin/collections/${collection.id}`" type="button" class="btn btn-block btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i>
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
