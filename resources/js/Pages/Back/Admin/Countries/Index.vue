<template>

    <Head title="Страны"/>

        <h2 class="bg-white p-4 shadow-md">Список стран</h2>

        <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[minmax(50px,_max-content)_1fr]
         gap-4 py-4">
            <div class="grid items-center grid-cols-[max-content]">
                <Link href="/admin/countries/create"
                      class="px-4 py-2  rounded-xl border-2 border-cyan-950 text-cyan-950 hover:bg-cyan-950 hover:text-white">
                    Добавить страну
                </Link>
            </div>

            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center">
                <div>
                    <h3>Страны:</h3>
                </div>
                <div class="grid grid-cols-[40px_max-content_minmax(200px,_max-content)] text-nowrap gap-4
                border-2 border-cyan-950 px-4 py-2 w-fit bg-white text-gray-800 items-center">
                    <div>#</div>
                    <div>Title</div>
                    <div class="justify-self-center">Action</div>
                    <template v-for="country in countries">
                        <div>{{ country.id }}</div>
                        <div>{{ country.title }}</div>
                        <div class="grid grid-flow-col justify-around justify-content-center">
                            <Link as="button" :href="`/admin/countries/${country.id}/edit`"
                                  class="py-1 px-6 border-2 border-amber-300 rounded-2xl text-amber-300 hover:bg-amber-300 hover:text-white
                            grid items-center
                            ">
                                <i class="icon-edit_square font-bold"></i>
                            </Link>
                            <Link @click.prevent="deleteInstance(country.id)" v-if="$page.props.auth.user.role <= 9" as="button"
                                  href="#"
                                  type="button"
                                  class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white
                                    grid items-center">
                                <i class="icon-delete font-bold"></i>
                            </Link>
                        </div>
                    </template>
                </div>

            </div>

        </section>

</template>

<script>
import {Head, router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    name: "Index",
    layout: AuthenticatedLayout,
    props: ['countries'],
    components: {Head, Link},
    methods: {
        deleteInstance(id) {
            router.delete(`/admin/countries/${id}`, {
                onBefore: () => confirm('Вы уверены, что хотите удалить этот жанр?'),
            })
        },
    },
}
</script>
