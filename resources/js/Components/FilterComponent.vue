<template>

    <!-- Mobile Filters -->
    <div class="filters mobile-filters shadow rounded bg-white mb-4 d-xs-block d-sm-none">
        <div class="border-bottom">
            <a class="h6 font-weight-bold text-dark d-block m-0 p-3" data-toggle="collapse" href="#mobile-filters" role="button" aria-expanded="false" aria-controls="mobile-filters">
                Фильтр
                <i class="fas fa-angle-down float-right mt-1"></i></a>
        </div>
        <div id="mobile-filters"
             :class="form.type || form.genre || form.country || form.genres_filter != null || form.countries_filter != null || originalYearFrom != data.yearFrom || originalYearTo != data.yearTo ? 'show' : ''"
             class="filters-body collapse multi-collapse">
            <div id="accordion">
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOffer">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseSort" aria-expanded="true" aria-controls="collapseSort">
                                Тип: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseSort" :class="form.type != null ? 'show' : ''" class="collapse" aria-labelledby="headingOffer" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       name="types_filter_mobile" class="custom-control-input" :value=null
                                       id="all_types_mobile">
                                <label class="custom-control-label" for="all_types_mobile">Кино и Сериалы
                                    <small class="text-black-50">{{totalCount}}</small></label>
                            </div>
                            <div v-if="typesCount.feature > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="feature"
                                       name="types_filter_mobile" class="custom-control-input" id="feature">
                                <label class="custom-control-label" for="feature">Полнометражные <small
                                    class="text-black-50">{{typesCount.feature}}</small></label>
                            </div>
                            <div v-if="typesCount.serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="serial"
                                       name="types_filter_mobile" class="custom-control-input" id="serial">
                                <label class="custom-control-label" for="serial">Сериалы <small
                                    class="text-black-50">{{typesCount.serial}}</small></label>
                            </div>
                            <div v-if="typesCount.mini_serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="mini_serial"
                                       name="types_filter_mobile"
                                       class="custom-control-input" id="mini_serial">
                                <label class="custom-control-label" for="mini_serial">Мини сериалы
                                    <small
                                        class="text-black-50">{{typesCount.mini_serial}}</small></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingTwo">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                Жанры:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapsetwo" :class="form.genre || form.genres_filter != null ? 'show' : ''"
                         class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск жанра..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           name="genres_filter_mobile" class="custom-control-input" :value=null
                                           id="all_genres_mobile">
                                    <label class="custom-control-label" for="all_genres">Все жанры <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <div v-for="genre in genres" class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           :value="genre.genre.slug"
                                           name="genres_filter_mobile"
                                           class="custom-control-input" :id="genre.genre.slug">
                                    <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                        <small class="text-black-50">{{genre.genresCount}}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Фильтр по странам -->

                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseCountries" aria-expanded="true" aria-controls="collapseOne">
                                Страны:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseCountries" :class="form.country || form.countries_filter != null ? 'show' : ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.countries_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск по странам..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon-countries-mobile">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.country" type="radio"
                                           name="countries_filter_mobile" class="custom-control-input" :value=null
                                           id="all_countries_mobile">
                                    <label class="custom-control-label" for="all_countries_mobile">Все страны <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <template v-for="country in countries">
                                    <div v-if="country.count > 0" class="custom-control custom-radio">
                                        <input @change.prevent="send()" v-model="form.country" type="radio"
                                               :value="country.slug" name="countries_filter_mobile"
                                               class="custom-control-input" :id="country.slug">
                                        <label class="custom-control-label" :for="country.slug">{{country.title}}
                                            <small class="text-black-50">{{country.count}}</small></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Фильтр по году -->
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingYear">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseYear" aria-expanded="true" aria-controls="collapseYear">
                                Год: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseYear" class="collapse show" aria-labelledby="headingYear" data-parent="#accordion">
                        <!-- Year_filter-->
                        <div class="filters-card-body card-shop-filters">

                            <div class='range-slider'>
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button @click="send()" class="btn btn-outline-primary">Применить</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Сортировать по: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOne" :class="form.order != null? 'show': ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter_mobile" class="custom-control-input" value=year
                                       id="year">
                                <label class="custom-control-label" for="year">Год</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter_mobile" class="custom-control-input" value=rate
                                       id="rate">
                                <label class="custom-control-label" for="rate">Рейтинг</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Filters -->

    <!-- Pad Filter -->
    <div class="filters shadow rounded bg-white mb-3 d-none d-xs-none d-sm-block d-md-block d-lg-none">
        <div class="filters-header border-bottom p-3">
            <h6 class="m-0 text-dark">Фильтр</h6>
        </div>
        <div class="filters-body">
            <div id="accordion">
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingTwo">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                Тип:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapsetwo" :class="form.type != null ? 'show' : ''" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       name="types_filter_pad" class="custom-control-input" :value=null
                                       id="all_types_pad">
                                <label class="custom-control-label" for="all_types_pad">Кино и Сериалы
                                    <small class="text-black-50">{{totalCount}}</small></label>
                            </div>
                            <div v-if="typesCount.feature > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="feature"
                                       name="types_filter_pad" class="custom-control-input" id="feature">
                                <label class="custom-control-label" for="feature">Полнометражные <small
                                    class="text-black-50">{{typesCount.feature}}</small></label>
                            </div>
                            <div v-if="typesCount.serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="serial"
                                       name="types_filter_pad" class="custom-control-input" id="serial">
                                <label class="custom-control-label" for="serial">Сериалы <small
                                    class="text-black-50">{{typesCount.serial}}</small></label>
                            </div>
                            <div v-if="typesCount.mini_serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="mini_serial"
                                       name="types_filter_pad"
                                       class="custom-control-input" id="mini_serial">
                                <label class="custom-control-label" for="mini_serial">Мини сериалы
                                    <small
                                        class="text-black-50">{{typesCount.mini_serial}}</small></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Жанры:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOne" :class="form.genres_filter || form.genre != null ? 'show' : ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск жанра..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           name="genres_filter_pad" class="custom-control-input" :value=null
                                           id="all_genres_pad">
                                    <label class="custom-control-label" for="all_genres_pad">Все жанры <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <div v-for="genre in genres" class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           :value="genre.genre.slug" name="genres_filter_pad"
                                           class="custom-control-input" :id="genre.genre.slug">
                                    <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                        <small class="text-black-50">{{genre.genresCount}}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Фильтр по странам -->

                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseCountries" aria-expanded="true" aria-controls="collapseOne">
                                Страны:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseCountries" :class="form.country || form.countries_filter != null ? 'show' : ''" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.countries_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск по странам..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon-countries-pad">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.country" type="radio"
                                           name="countries_filter_pad" class="custom-control-input" :value=null
                                           id="all_countries_pad">
                                    <label class="custom-control-label" for="all_countries_pad">Все страны <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <template v-for="country in countries">
                                    <div v-if="country.count > 0" class="custom-control custom-radio">
                                        <input @change.prevent="send()" v-model="form.country" type="radio"
                                               :value="country.slug" name="countries_filter_pad"
                                               class="custom-control-input" :id="country.slug">
                                        <label class="custom-control-label" :for="country.slug">{{country.title}}
                                            <small class="text-black-50">{{country.count}}</small></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Фильтр по году -->
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingYear11">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseYear" aria-expanded="true" aria-controls="collapseYear">
                                Год: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseYear" class="collapse show" aria-labelledby="headingYear" data-parent="#accordion">
                       <!-- Year_filter-->
                        <div class="filters-card-body card-shop-filters">

                            <div class='range-slider'>
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button @click="send()" class="btn btn-outline-primary">Применить</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOffer">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
                                Сортировать по: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOffer" class="collapse show" aria-labelledby="headingOffer" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter_pad" class="custom-control-input" value=year
                                       id="year">
                                <label class="custom-control-label" for="year">Год</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter_pad" class="custom-control-input" value=rate
                                       id="rate">
                                <label class="custom-control-label" for="rate">Рейтинг</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pad Filter -->

    <!-- Laptop Filters -->
    <div class="filters shadow rounded bg-white mb-3 d-none d-xs-none d-sm-none d-md-none d-lg-block">
        <div class="filters-header border-bottom p-3">
            <h6 class="m-0 text-dark">Фильтр</h6>
        </div>
        <div class="filters-body">
            <div id="accordion">
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingTwo">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                Тип:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapsetwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       name="types_filter" class="custom-control-input" :value=null
                                       id="all_types_laptop">
                                <label class="custom-control-label" for="all_types_laptop">Кино и Сериалы
                                    <small class="text-black-50">{{totalCount}}</small></label>
                            </div>
                            <div v-if="typesCount.feature > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="feature"
                                       name="types_filter" class="custom-control-input" id="feature">
                                <label class="custom-control-label" for="feature">Полнометражные <small
                                    class="text-black-50">{{typesCount.feature}}</small></label>
                            </div>
                            <div v-if="typesCount.serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="serial"
                                       name="types_filter" class="custom-control-input" id="serial">
                                <label class="custom-control-label" for="serial">Сериалы <small
                                    class="text-black-50">{{typesCount.serial}}</small></label>
                            </div>
                            <div v-if="typesCount.mini_serial > 0" class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.type" type="radio"
                                       value="mini_serial" name="types_filter"
                                       class="custom-control-input" id="mini_serial">
                                <label class="custom-control-label" for="mini_serial">Мини сериалы
                                    <small
                                        class="text-black-50">{{typesCount.mini_serial}}</small></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Жанры:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.genres_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск жанра..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           name="genres_filter" class="custom-control-input" :value=null
                                           id="all_genres">
                                    <label class="custom-control-label" for="all_genres">Все жанры <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <div v-for="genre in genres" class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.genre" type="radio"
                                           :value="genre.genre.slug" name="genres_filter"
                                           class="custom-control-input" :id="genre.genre.slug">
                                    <label class="custom-control-label" :for="genre.genre.slug">{{genre.genre.title}}
                                        <small class="text-black-50">{{genre.genresCount}}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Фильтр по странам -->

                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOne">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Страны:
                                <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <form class="mb-3">
                                <div class="input-group rounded">
                                    <input @keypress.enter.prevent="send()" v-model="form.countries_filter"
                                           type="search" class="form-control custom-first-element" placeholder="Поиск по странам..."
                                           aria-label="Search" aria-describedby="search-addon"/>
                                    <button @click.prevent="send()" class="btn btn-outline-primary custom-last-element"
                                            id="search-addon-countries">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input @change.prevent="send()" v-model="form.country" type="radio"
                                           name="countries_filter" class="custom-control-input" :value=null
                                           id="all_countries_laptop">
                                    <label class="custom-control-label" for="all_countries_laptop">Все страны <small
                                        class="text-black-50">{{totalCount}}</small></label>
                                </div>
                                <template v-for="country in countries">
                                    <div v-if="country.count > 0" class="custom-control custom-radio">
                                        <input  @change.prevent="send()" v-model="form.country" type="radio"
                                                :value="country.slug" name="countries_filter_laptop"
                                                class="custom-control-input" :id="country.slug">
                                        <label class="custom-control-label" :for="country.slug">{{country.title}}
                                            <small class="text-black-50">{{country.count}}</small></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Фильтр по году -->
                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingYear11">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseYear" aria-expanded="true" aria-controls="collapseYear">
                                Год: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseYear" class="collapse show" aria-labelledby="headingYear" data-parent="#accordion">

                        <!--Year Filter-->
                        <div class="filters-card-body card-shop-filters">

                            <div class='range-slider'>
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearFrom">
                                <input @input="slider" type="range" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                                <input type="number" :min="originalYearFrom" :max="originalYearTo" step="1" v-model="form.yearTo">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button @click="send()" class="btn btn-outline-primary">Применить</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="filters-card border-bottom p-3">
                    <div class="filters-card-header" id="headingOffer">
                        <h6 class="mb-0">
                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
                                Сортировать по: <i class="fas fa-angle-down float-right"></i>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOffer" class="collapse show" aria-labelledby="headingOffer" data-parent="#accordion">
                        <div class="filters-card-body card-shop-filters">
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter" class="custom-control-input" value=year
                                       id="year">
                                <label class="custom-control-label" for="year">Год</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input @change.prevent="send()" v-model="form.order" type="radio"
                                       name="order_filter" class="custom-control-input" value=rate
                                       id="rate">
                                <label class="custom-control-label" for="rate">Рейтинг</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Laptop Filters -->

</template>

<script>

    export default {
        name: "FilterComponent",
        props: [
            'form',
            'genres',
            'totalCount',
            'typesCount',
            'category',
            'data',
            'originalYearFrom',
            'originalYearTo',
            'countries',
        ],
        emits: ['interface'],


        methods:{
            send(){
                this.$emit('interface', this.form)
            },
            slider(){
                if (this.form.yearFrom > this.form.yearTo) {
                    this.form.yearFrom = this.form.yearTo
                }
            },
        },
    }

</script>

<style scoped>
    .range-slider {
        width: 100%;
        margin: auto;
        text-align: center;
        position: relative;
        height: 4em;
    }

    .range-slider input[type=range] {
        position: absolute;
        left: 0;
        bottom: 0;
    }

    input[type=number] {
        border: 1px solid #ddd;
        text-align: center;
        font-size: 1em;
        -moz-appearance: textfield;
    }

    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    input[type=number]:invalid,
    input[type=number]:out-of-range {
        border: 2px solid #ff6347;
    }

    input[type=range] {
        -webkit-appearance: none;
        width: 100%;
    }

    input[type=range]:focus {
        outline: none;
    }

    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #2497e3;
    }

    input[type=range]:focus::-ms-fill-lower {
        background: #2497e3;
    }

    input[type=range]:focus::-ms-fill-upper {
        background: #2497e3;
    }

    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        animate: 0.2s;
        background: #2497e3;
        border-radius: 1px;
        box-shadow: none;
        border: 0;
    }

    input[type=range]::-webkit-slider-thumb {
        z-index: 2;
        position: relative;
        box-shadow: 0px 0px 0px #000;
        border: 1px solid #2497e3;
        height: 18px;
        width: 18px;
        border-radius: 25px;
        background: #a1d0ff;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -7px;
    }
</style>

