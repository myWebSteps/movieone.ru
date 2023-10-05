<template>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input v-model="searchKey" class="form-control form-control-navbar" type="search" placeholder="Введите название видео" aria-label="Search">
                                <div class="input-group-append">
                                    <Link :href="route('search.index', {key: searchKey})" class="btn btn-navbar">
                                        <i class="fas fa-search"></i>
                                    </Link>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Playlist Dropdown Menu -->
                <li v-if="playlist" class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa-solid fa-tags"></i>
                        <span class="badge badge-danger navbar-badge">{{playCount}}</span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <router-link v-for="item in playlist" :to="{name: 'film', params: {id: item.id}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img :src="item.posterUrl" :alt="item.nameRu" class="img-size-50 mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{item.nameRu}}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{item.nameOriginal}}</p>
                                    <p class="text-sm text-muted">{{item.year}}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </router-link>
                        <div class="dropdown-divider"></div>

                    </div>


                </li>

            <li class="nav-item ml-4">
                    <a  href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA==" class="nav-link" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://t.me/kino_movieone" class="nav-link" target="_blank">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
         <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <Link :href="route('front.index')" class="brand-link">
                <img src="/img/logo-icon.png" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-light">MovieOne</span>
            </Link>

            <!-- Sidebar -->
            <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-overflow os-host-overflow-y">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li v-for="category in $page.props.categories" class="nav-item">
                            <Link  class="nav-link" :href="route('catalog.index', {category: category.id, order: 'year', page: '1', genre: '', type: ''})">
                                <i :class="category.logo"></i>
                                <p class="pl-2">{{category.title}}</p>
                            </Link>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">

            <!-- Page Content -->
            <main>
                <slot />
            </main>

        </div>

        <!-- Main Footer -->
        <footer class="main-footer d-flex justify-content-around">
            <div class="justify-content-start col-6">
                <strong>MovieOne &copy; 2023</strong>
            </div>
            <div class="d-flex justify-content-end col-6">

              <span class="nav-item">
                  <a  href="https://instagram.com/roman_makukha_89?igshid=OGQ5ZDc2ODk2ZA==" class="nav-link">
                      <i class="fa-brands fa-instagram"></i>
                  </a>
              </span>
                <span class="nav-item ml-2">
                  <a href="https://t.me/kino_movieone" class="nav-link">
                      <i class="fa-brands fa-telegram"></i>
                  </a>
              </span>
            </div>



        </footer>

    </div>

</template>

<script>
    import { Link } from "@inertiajs/vue3";
    import ApplicationLogo from "@/Components/ApplicationLogo.vue";
    import NavLink from "@/Components/NavLink.vue";
    import Dropdown from "@/Components/Dropdown.vue";
    import DropdownLink from "@/Components/DropdownLink.vue";



    export default {
        name: "Header",

        components: {Link},

        data(){
            return {
                searchKey: null,
                playCount: null,
                playlist: null,
                form:{
                    categories: null
                }
            }
        },

        mounted() {
                this.playListCount()
                this.makePlaylist()
        },

        methods:{

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
                console.log('makePlaylist')
                if(localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != ''){
                    axios.post('/playlist', {id: localStorage.getItem('playlist')})
                        .then(response=>{
                            this.playlist = response.data.data
                        })

                }else{
                    this.playlist = null
                }
            },


        },


    }
</script>
