<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar Large -->
        <div class="sticky-sidebar d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block d-xxl-block">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar_large">
            <!-- Sidebar - Brand -->
            <Link class="sidebar-brand d-flex align-items-center justify-content-center p-2" href="/">
                <img class="h-100" src="/img/logo-icon.png" alt="logo image">
                <div class="sidebar-brand-text mx-3">MovieOne</div>
            </Link>
            <!-- Nav Item - Dashboard -->

            <li class="nav-item mt-2" :class="{'active': $page.url.startsWith(`/collections`)}">
                <Link class="nav-link font-weight-bold" href="/collections">
                    <i class="fas fa-fw fa-fire"></i>
                    <span>Подборки</span>
                </Link>
            </li>

            <li class="nav-item" :class="{'active': $page.url.startsWith(`/random_movies`)}">
                <Link class="nav-link font-weight-bold" :href="`/random_movies`">
                    <i class="fa-solid fa-shuffle"></i>
                    <span>Случайное видео</span>
                </Link>
            </li>


            <!-- Heading -->
            <div class="sidebar-heading mt-2 mb-1">Кино</div>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item  -->

            <li v-for="category in $page.props.categories" :class="{'active': $page.url.startsWith(`/movies?category=${category.slug}`)}" class="nav-item">
            <Link class="nav-link font-weight-bold" :href="`/movies?category=${category.slug}&order=year&page=1`">
            <i class="font-weight-bold" :class="category.logo"></i>
            <span>{{category.title}}</span>
            </Link>
            </li>
        </ul>
    </div>
        <!-- End of Sidebar -->

        <!-- Sidebar Small -->
        <div class="sticky-sidebar d-xs-block d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none  ">
            <ul class="navbar-nav sidebar sidebar-dark accordion toggled" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <Link class="sidebar-brand d-flex align-items-center justify-content-center p-2" href="/">
                    <img class="h-100" src="/img/logo-icon.png" alt="logo image">
                    <div class="sidebar-brand-text mx-3">MovieOne</div>
                </Link>


                <!-- Heading -->
                <div class="sidebar-heading mt-3 mb-1">Кино</div>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Nav Item  -->
                <li v-for="category in $page.props.categories" :class="{'active': $page.url.startsWith(`/movies?category=${category.slug}`)}" class="nav-item">
                    <Link class="nav-link" :href="`/movies?category=${category.slug}&order=year&page=1`">
                        <i class="font-weight-bold" :class="category.logo"></i>
                        <span>{{category.title}}</span>
                    </Link>
                </li>
            </ul>
        </div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark topbar mb-4 pl-0 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input @keypress.enter.prevent="commenceSearch()" v-model="searchKey" type="text" class="form-control bg-white border-0 small" placeholder="Искать фильмы по названию..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button @click.prevent="commenceSearch()" class="btn bg-white text-lg" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input @keypress.enter.prevent="commenceSearch()" v-model="searchKey" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button @click.prevent="commenceSearch()" class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->

                        <li v-if="playlist" class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle text-lg" href="#" id="playlistDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-eye"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger bg-gradient-danger">{{playCount}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="playlistDropdown">
                                <h6 class="dropdown-header">
                                    Избранные видео
                                </h6>
                                <Link v-for="item in playlist" :href="`/movies/${item.slug}`" class="dropdown-item d-flex align-items-center">
                                        <div class="w-25">
                                            <img :src="item.posterUrl" :alt="item.nameRu"
                                                 class="w-100">
                                        </div>
                                    <div class="w-75 p-2">
                                        <span class="font-weight-bold">{{item.nameRu}} / {{item.nameEn}}</span>
                                        <div v-for="genre in item.genres" class="small text-gray-500">{{genre.title}}</div>
                                        <div class="small text-danger">{{item.year}}</div>
                                    </div>
                                </Link>
                            </div>
                        </li>

                        <li v-if="bookmarks" class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle text-lg" href="#" id="bookmarksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-tags"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger bg-gradient-danger">{{bookmarksCount}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="playlistDropdown">
                                <h6 class="dropdown-header">
                                    Избранные коллекции
                                </h6>
                                <Link v-for="item in bookmarks" :href="`/collections/${item.slug}`" class="dropdown-item d-flex align-items-center">
                                    <div class="w-25">
                                        <img :src="item.poster" :alt="item.collection_title"
                                             class="w-100">
                                    </div>
                                    <div class="w-75 p-2">
                                        <span class="font-weight-bold">{{item.collection_title}}</span>
                                        <div class="small text-gray-500">{{item.description_min}}</div>
                                        </div>
                                </Link>
                            </div>
                        </li>
                  </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                    <slot></slot>

            </div>
            <!-- End of Main Content -->
            <!-- Footer -->


            <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end my-z-index" role="alert">
                <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
                <div v-for="error in errors">
                    <span>{{error}}</span>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container d-flex justify-content-around">
                    <div class="copyright text-center my-auto ">
                        <span>MovieOne &copy; 2023</span>
                    </div>
                    <div class="justify-self-end d-inline-flex">
                         <span class="nav-item mr-3 d-flex align-items-center">
                                  <a  href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA==" class="nav-link text-gray-600">
                                      <i style="font-size: 24px" class ="fa-brands fa-instagram p-0 m-0"></i>
                                  </a>
                              </span>
                        <span class="nav-item mr-3 d-flex align-items-center">
                                    <a  href="https://dzen.ru/movieone" class="nav-link p-0 m-0" target="_blank">
                                        <img style="height: 28px; padding-bottom: 2px" src="/img/zen-grey.svg" alt="zen_image">
                                    </a>
                                </span>
                        <span class="nav-item mr-3 d-flex align-items-center">
                                  <a href="https://t.me/kino_movieone" class="nav-link text-gray-600">
                                      <i style="font-size: 24px" class="fa-brands fa-telegram p-0 m-0"></i>
                                  </a>
                              </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded mb-5" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</template>

<script>
    import { Link } from "@inertiajs/vue3";
    import {router} from '@inertiajs/vue3';


    export default {
        name: "FrontLayout",

        components: {Link},

        data(){
            return {
                searchKey: '',
                playCount: null,
                playlist: null,
                bookmarksCount: null,
                bookmarks: null,

                form:{
                    categories: null
                },
                errors: null,
            }
        },

        mounted() {
                this.playListCount()
                this.makePlaylist()
                this.bookmarksCountFunc()
                this.makeBookmarks()


            // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
            $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
                if ($(window).width() > 768) {
                    var e0 = e.originalEvent,
                        delta = e0.wheelDelta || -e0.detail;
                    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                    e.preventDefault();
                }
            });

            // Scroll to top button appear
            $(document).on('scroll', function() {
                var scrollDistance = $(this).scrollTop();
                if (scrollDistance > 100) {
                    $('.scroll-to-top').fadeIn();
                } else {
                    $('.scroll-to-top').fadeOut();
                }
            });

            // Smooth scrolling using jQuery easing
            $(document).on('click', 'a.scroll-to-top', function(e) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: ($($anchor.attr('href')).offset().top)
                }, 1000, 'easeInOutExpo');
                e.preventDefault();
            });

            // Toggle the side navigation
            $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
              $("body").toggleClass("sidebar-toggled");
              $(".sidebar").toggleClass("toggled");
              if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
              };
            });


        },



        methods:{
            commenceSearch(){
                    if(this.searchKey.length >= 3) {
                        router.get(`/search?key=${this.searchKey}`)
                    }else{
                        this.errors = ['Поиск должен содержать минимум 3 символа']

                        setTimeout(this.deleteErrors, 2500)
                    }

            },
            deleteErrors(){
                this.errors = false
            },

            playListCount(){
                if(localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != '')
                {
                    this.playCount = localStorage.getItem('playlist').split(',')

                    this.playCount = this.playCount.filter(function (el) {
                        return el != '';
                    });

                    this.playCount = this.playCount.length

                }else{
                    this.playCount = null
                }
            },

            makePlaylist(){
                if(localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != ''){
                    axios.post('/playlist', {id: localStorage.getItem('playlist')})
                        .then(response=>{
                            this.playlist = response.data.data
                        })

                }else{
                    this.playlist = null
                }
            },

            bookmarksCountFunc(){
                if(localStorage.hasOwnProperty('bookmarks') && localStorage.getItem('bookmarks') != '')
                {
                    this.bookmarksCount = localStorage.getItem('bookmarks').split(',')

                    this.bookmarksCount = this.bookmarksCount.filter(function (el) {
                        return el != '';
                    });

                    this.bookmarksCount = this.bookmarksCount.length

                }else{
                    this.bookmarksCount = null
                }
            },

            makeBookmarks(){
                if(localStorage.hasOwnProperty('bookmarks') && localStorage.getItem('bookmarks') != ''){
                    axios.post('/bookmarks', {id: localStorage.getItem('bookmarks')})
                        .then(response=>{
                            console.log(response)
                            this.bookmarks = response.data.data
                        })

                }else{
                    this.bookmarks = null
                }
            },


        },


    }
</script>
