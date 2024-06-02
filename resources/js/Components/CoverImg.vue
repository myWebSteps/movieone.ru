<template>
    <section class="grid items-top main-container
    lg:sticky
    lg:top-0
    h-fit
    max-h-[40vh]
    lg:max-h-[60vh]
    z-10 overflow-y-hidden"
    >
        <img class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" :src="img" alt="Картинка сайта movieone.ru" width="1200" height="450">

        <span class="row-start-1 row-end-1 col-start-1 col-end-1
        lg:parallax
        pt-[6%]
        pl-[10%]
        ">
            <h1 class="text-xl sm:text-2xl md:text-3xl text-white opacity-60 font-extrabold">MovieOne.Ru <br>
            <span class="font-light pt-2">Онлайн-кинотеатр</span>
            </h1>
        </span>

    </section>
</template>

<script>
export default {
    name: "CoverImg",
    props: ['img'],

}
</script>
