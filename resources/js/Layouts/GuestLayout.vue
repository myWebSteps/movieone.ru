<template>
    <div class="container">
        <div class="absolute
        top-1/2
        right-1/2
        translate-x-1/2
        -translate-y-1/2
        border-2
        rounded-xl
        grid
        grid-flow-row
        gap-4
        p-4
">
            <div class="justify-self-center">
                <Link href="/" class=" h-[4.375rem] mx-auto ">
                        <img src="/img/logo-icon.webp" class="w-[60px]" alt="...">
                </Link>
            </div>
            <div class="my-2 justify-self-center">
                    <slot/>
            </div>

        </div>
    </div>

</template>

<script>
    import {Link} from "@inertiajs/vue3";

export default {
        name: 'login',
        components:{Link},
}


</script>
