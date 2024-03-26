<template>

    <div @click="show.parser = !show.parser"
         class="
                 grid justify-items-center items-center
                  right-[5px] w-[50px] h-[50px]
                 rounded-full bg-green-600 text-white shadow-md shadow-gray-600
                z-30
                border-2 border-green-600
                hover:bg-white hover:text-green-600
                "
         :class="show.parser ? 'fixed' : 'absolute top-[1rem]'"
    >
        <span v-if="show.parser === false" class="material-symbols-sharp">recenter</span>

        <span v-if="show.parser === true" class="material-symbols-sharp">close</span>
    </div>

    <div
        class="fixed top-[9rem] left-[5%] right-[60px] bg-white z-20 duration-500
                shadow-lg
                md:left-[40%]
                grid grid-flow-row grid-rows-2
                "
        :class="show.parser ? '' : 'translate-x-[200%]'"
    >
        <label class="p-2">
            Кинопоиск ID: <br>
            <div class="grid grid-cols-[minmax(30px,100%),_minmax(30px,100px)]">
                <input v-model="form.kinopoiskId" type="number"
                       placeholder="Введите кинопоиск ID фильма"
                       class="rounded-l-2xl"
                >
                <button
                    class="py-1 px-6 border-2 border-red-700 rounded-r-2xl text-red-700 hover:bg-red-700 hover:text-white"
                    @click.prevent="parse()">
                    Parse
                </button>
            </div>
        </label>
        <!--Tests-->
        <div class="grid grid-cols-2">
            <p v-if="test.id != null" class="px-2">Наличие в БД:
                <span v-if="test.id == 1" class="text-red-500">Present in database</span>
                <span v-if="test.id == 2" class="text-green-500">Absent in database</span>
            </p>
            <p v-if="test.players != null"
               class="px-2"
            >Наличие в плеерах:
                <template v-if="test.players.length > 0 ">
                       <span v-for="player in test.players"
                             class="text-green-500"
                       >
                           {{ player.source }} &nbsp
                       </span>
                </template>
                <template v-else>
                                 <span class="text-red-500"
                                 >Видео не найдено ни в одном из плееров</span>
                </template>
            </p>


        </div>

    </div>


</template>

<script>
export default {
    name: "Parser",
    props: ['form', 'examples', 'message', 'show'],

    data() {
        return {
            test: {
                id: null,
                players: null,
            },
        }
    },

    methods: {
        parse() {
            axios.get(`https://api.kinopoisk.dev/v1.4/movie/${this.form.kinopoiskId}`,
                {
                    headers: {
                        'X-API-KEY': 'E1J0H6V-27AMY5A-P3RYSY9-S4F1KM0',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    this.form.year = response.data.year
                    this.form.nameRu = response.data.name
                    this.form.nameEn = response.data.alternativeName
                    this.form.duration = response.data.movieLength
                    this.form.age_limits = response.data.ageRating
                    this.form.budget = response.data.budget.value + ' ' + response.data.budget.currency
                    this.form.slogan = response.data.slogan
                    this.examples.description = response.data.description
                    if (response.data.videos.trailers.length > 0) {
                        this.form.trailers = response.data.videos.trailers
                    }
                    this.examples.rate = response.data.rating.kp
                    this.examples.genres = response.data.genres
                    this.examples.category = response.data.type
                    this.examples.type = response.data.isSeries
                    this.examples.posterUrlPreview = response.data.poster.previewUrl
                    this.examples.backdropUrl = response.data.backdrop.url
                    this.examples.countries = response.data.countries

                    this.message.body = ['Информация успешно получена']
                    this.message.type = 'success'
                    this.message.show = true


                }).catch((error) => {
                this.message.body = [error.message]
                this.message.type = 'error'
                this.message.show = true
            });
            this.checkInBD()
            this.testVideo()
        },

        testVideo() {
            axios.get(`https://kinobox.tv/api/players/main?kinopoisk=${this.form.kinopoiskId}`)
                .then(response => {
                    this.test.players = response.data
                })
        },

        checkInBD() {
            axios.post('/admin/movies/test_in_bd', {kinopoisk_id: this.form.kinopoiskId})
                .then(response => {

                    if (response.data.length > 0) {
                        this.test.id = 1
                    } else {
                        this.test.id = 2
                    }
                })
        },
    },

}
</script>

<style scoped>

</style>
