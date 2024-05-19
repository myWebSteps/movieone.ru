<template>
    <section class="grid items-top main-container
    lg:sticky
    lg:top-0
    h-fit
    max-h-[40vh]
    lg:max-h-[60vh]
    z-10 overflow-y-hidden"
    >
        <img class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" v-lazy="img" alt="...">

        <span class="row-start-1 row-end-1 col-start-1 col-end-1
        lg:parallax
        pt-[6%]
        pl-[10%]
        text-white opacity-60 font-extrabold
        text-xl
        sm:text-2xl
        md:text-3xl">
            MovieOne.Ru <br>
            <span class="font-light">Онлайн-кинотеатр</span>
        </span>

    </section>
</template>

<script>
export default {
    name: "CoverImg",
    props: ['img'],

}
</script>
