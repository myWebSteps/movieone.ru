<template>
    <Head title="Dashboard" />
    <h2 class="bg-white p-4 shadow-md">Dashboard</h2>
        <section class="container mx-auto p-4">
            <div class="grid justify-items-center">
                <div>You're logged in!</div>
            </div>
        </section>

</template>

<script>
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    name: 'Main',
    layout: AuthenticatedLayout,
    components:{Head, Link},
}
</script>
