<template>

    <Head title="Категории" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список категорий</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4 mt-4 col-md-4 col-6">

                    <Link :href="this.route('categories.create')" class="btn btn-success">Добавить категорию</Link>
                </div>


                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Категории:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Category logo</th>
                                        <th>Action</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="category in categories">
                                        <tr>
                                            <td>{{category.id}}</td>
                                            <td>{{category.title}}</td>
                                            <td> <i :class="category.logo"></i></td>
                                            <td>
                                                <Link as="button" :href="this.route('categories.edit', {category: category.id})" class="btn btn-block btn-outline-warning btn-sm w-50"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="this.route('categories.destroy', {category: category.id})" type="button" class="btn btn-block btn-outline-danger btn-sm w-50"><i class="fa-solid fa-trash"></i>
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
        props: ['categories'],
        components: {Head, Link, AuthenticatedLayout},

    }
</script>



