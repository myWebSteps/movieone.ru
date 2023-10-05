<template>

    <Head title="Страны" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список стран</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4 mt-4 col-md-4 col-6">

                    <Link :href="this.route('countries.create')" class="btn btn-success">Добавить страну</Link>
                </div>


                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Страны:</h3>
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
                                    <template v-for="country in countries">
                                        <tr>
                                            <td>{{country.id}}</td>
                                            <td>{{country.title}}</td>
                                            <td>
                                                <Link as="button" :href="this.route('countries.edit', {country: country.id})" class="btn btn-block btn-outline-warning btn-sm w-50"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="this.route('countries.destroy', {country: country.id})" type="button" class="btn btn-block btn-outline-danger btn-sm w-50"><i class="fa-solid fa-trash"></i>
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
        props: ['countries'],
        components: {Head, Link, AuthenticatedLayout},

    }
</script>
