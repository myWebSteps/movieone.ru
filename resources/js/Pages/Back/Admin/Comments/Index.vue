<template>

    <Head title="Категории" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список комментариев</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Комментарии:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Movie_id</th>
                                        <th>Movie_name</th>
                                        <th>Author_name</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="comment in data_comments">
                                        <tr>
                                            <td>{{comment.movie_id}}</td>
                                            <td>{{comment.movie_name}}</td>
                                            <td>{{comment.name}}</td>
                                            <td>{{comment.rating}}</td>
                                            <td>{{comment.description}}</td>
                                            <td v-if="comment.approved === 0" class="text-danger">
                                                На рассмотрении
                                            </td>
                                            <td v-else-if="comment.approved === 1" class="text-success">
                                                Одобрено
                                            </td>
                                            <td>
                                                <Link as="button" :href="`/admin/comments/${comment.comment_id}/edit`" class="btn btn-block btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="`/admin/comments/${comment.comment_id}`" type="button" class="btn btn-block btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i>
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
        props: ['data_comments'],
        components: {Head, Link, AuthenticatedLayout},

        mounted(){
            console.log(this.data_comments)
        },


    }
</script>



