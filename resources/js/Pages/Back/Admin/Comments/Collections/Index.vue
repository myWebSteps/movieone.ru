<template>

    <Head title="Комментарии к коллекциям" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Список комментариев к коллекциям</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Комментарии к коллекциям:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Comment_id</th>
                                        <th>Collection_name</th>
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
                                            <td>{{comment.comment_id}}</td>
                                            <td>{{comment.collection_name}}</td>
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
                                                <Link as="button" :href="`/admin/comments/collections/${comment.comment_id}/edit`" class="btn btn-block btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td>
                                                <Link method="delete" as="button" :href="`/admin/comments/collections/${comment.comment_id}`" type="button" class="btn btn-block btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i>
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

    }
</script>



