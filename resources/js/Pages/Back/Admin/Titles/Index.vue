<template>

    <Head title="Заголовки" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список заголовков</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4 mt-4 col-md-4 col-6">

                    <Link href="/admin/titles/create" class="btn btn-success">Добавить заголовок</Link>
                </div>


                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Заголовки:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="title in data">
                                        <tr>
                                            <td>{{title.id}}</td>
                                            <td>{{title.description}}</td>
                                            <td>
                                                <Link as="button" :href="`/admin/titles/${title.id}/edit`" class="btn btn-block btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="`/admin/titles/${title.id}`" type="button" class="btn btn-block btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i>
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



