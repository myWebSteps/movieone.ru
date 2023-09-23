<template>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="{name: 'home'}" class="nav-link">ГЛАВНАЯ</router-link>
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
                            <input v-model="searchVal" class="form-control form-control-navbar" type="search" placeholder="Введите название видео" aria-label="Search">
                            <div class="input-group-append">
                                <button @click.prevent="makeRoute()" class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
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

<!-- USER -->
<!--    <nav class="navbar navbar-expand navbar-dark topbar mb-4 pl-0 static-top shadow">-->
<!--        &lt;!&ndash; Sidebar Toggle (Topbar) &ndash;&gt;-->
<!--        <button @click.prevent="this.$parent.$refs.sidebar.toggleNavBar()" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">-->
<!--            <i class="fa fa-bars"></i>-->
<!--        </button>-->
<!--        &lt;!&ndash; Topbar Search &ndash;&gt;-->
<!--        <form class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">-->
<!--            <div class="input-group">-->
<!--                <input v-model="searchVal" type="text" class="form-control bg-white border-0 small" placeholder="Напишите название кино" aria-label="Search" aria-describedby="basic-addon2">-->
<!--                <div class="input-group-append">-->
<!--                    <router-link :to="{name: 'search', query:{-->
<!--                        keyword: searchVal,-->
<!--                        page: 1-->
<!--                    }}"-->
<!--                                 class="btn bg-white" type="button">-->
<!--                        <i class="fas fa-search fa-sm"></i>-->
<!--                    </router-link>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!--        &lt;!&ndash; Topbar Navbar &ndash;&gt;-->
<!--        <ul class="navbar-nav ml-auto">-->
<!--            &lt;!&ndash; Nav Item - Search Dropdown (Visible Only XS) &ndash;&gt;-->
<!--            <li class="nav-item dropdown no-arrow d-sm-none">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    <i class="fas fa-search fa-fw"></i>-->
<!--                </a>-->
<!--                &lt;!&ndash; Dropdown - Messages &ndash;&gt;-->
<!--                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated&#45;&#45;grow-in" aria-labelledby="searchDropdown">-->
<!--                    <form class="form-inline mr-auto w-100 navbar-search">-->
<!--                        <div class="input-group">-->
<!--                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
<!--                            <div class="input-group-append">-->
<!--                                <button class="btn btn-primary" type="button">-->
<!--                                    <i class="fas fa-search fa-sm"></i>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </li>-->
<!--            &lt;!&ndash; Nav Item - Alerts &ndash;&gt;-->
<!--            <li class="nav-item no-arrow mx-1">-->
<!--                <a class="nav-link" href="offers.html">-->
<!--                    <i class="fas fa-fire fa-fw"></i>-->
<!--                    &lt;!&ndash; Counter - Alerts &ndash;&gt;-->
<!--                    <span class="badge badge-danger bg-gradient-danger">NEW</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="nav-item dropdown no-arrow mx-1">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    <i class="fas fa-bell fa-fw"></i>-->
<!--                    &lt;!&ndash; Counter - Alerts &ndash;&gt;-->
<!--                    <span class="badge badge-danger badge-counter">8+</span>-->
<!--                </a>-->
<!--                &lt;!&ndash; Dropdown - Alerts &ndash;&gt;-->
<!--                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated&#45;&#45;grow-in" aria-labelledby="alertsDropdown">-->
<!--                    <h6 class="dropdown-header">-->
<!--                        Alerts-->
<!--                    </h6>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="mr-3">-->
<!--                            <div class="icon-circle bg-primary text-white">-->
<!--                                KN-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="small text-gray-500">December 12, 2019</div>-->
<!--                            <span class="font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit.-->
<!--                                 </span>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="dropdown-list-image mr-3">-->
<!--                            <img class="rounded-circle w-60" src="img/s1.png" alt="">-->
<!--                            <div class="status-indicator bg-success"></div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="text-truncate">Duis vel est sit amet ipsum egestas efficitur.</div>-->
<!--                            <div class="small text-gray-500">Gurdeep Osahan · 58m</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="dropdown-list-image mr-3">-->
<!--                            <img class="rounded-circle w-60" src="img/s2.png" alt="">-->
<!--                            <div class="status-indicator"></div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="text-truncate">Pellentesque euismod diam sit amet nibh molestie, imperdiet feugiat mi feugiat.</div>-->
<!--                            <div class="small text-gray-500">Jae Chun · 1d</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="dropdown-list-image mr-3">-->
<!--                            <img class="rounded-circle w-60" src="img/s3.png" alt="">-->
<!--                            <div class="status-indicator bg-warning"></div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="text-truncate">Quisque ac justo bibendum nunc fringilla pharetra nec sit amet mauris.</div>-->
<!--                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="mr-3">-->
<!--                            <div class="icon-circle bg-success">-->
<!--                                <i class="fas fa-donate text-white"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="small text-gray-500">December 7, 2019</div>-->
<!--                            Sed aliquet nibh nec odio congue, in condimentum massa dapibus.-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                        <div class="mr-3">-->
<!--                            <div class="icon-circle bg-warning">-->
<!--                                <i class="fas fa-exclamation-triangle text-white"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <div class="small text-gray-500">December 2, 2019</div>-->
<!--                            Pellentesque sit amet nunc consectetur, porta sapien a, bibendum dolor.-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
<!--                </div>-->
<!--            </li>-->
<!--            &lt;!&ndash; Nav Item - User Information &ndash;&gt;-->
<!--            <li class="nav-item dropdown no-arrow">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Askbootstrap</span>-->
<!--                    <img class="img-profile rounded-circle" src="img/s4.png">-->
<!--                </a>-->
<!--                &lt;!&ndash; Dropdown - User Information &ndash;&gt;-->
<!--                <div class="dropdown-menu dropdown-menu-right shadow animated&#45;&#45;grow-in" aria-labelledby="userDropdown">-->
<!--                    <a class="dropdown-item" href="profile.html">-->
<!--                        <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>-->
<!--                        Profile-->
<!--                    </a>-->
<!--                    <a class="dropdown-item" href="profile.html">-->
<!--                        <i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i>-->
<!--                        Watchlist-->
<!--                    </a>-->
<!--                    <a class="dropdown-item" href="profile.html">-->
<!--                        <i class="fas fa-list-alt fa-sm fa-fw mr-2 text-gray-400"></i>-->
<!--                        Your Lists-->
<!--                    </a>-->
<!--                    <a class="dropdown-item" href="profile.html">-->
<!--                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>-->
<!--                        Account Settings-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">-->
<!--                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>-->
<!--                        Logout-->
<!--                    </a>-->
<!--                </div>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </nav>-->

</template>

<script>


    export default {
        name: "Header",

        data(){
            return {
                searchVal: null,
                playCount: null,
                playlist: null

            }
        },

        mounted(){
            this.PlayListCount()
            this.makePlaylist()
        },

        methods:{
            makeRoute(){
                this.$router.push({name: 'search_by_key', query:{
                        key: this.searchVal,
                        order: 'year',
                        page: 1,
                    }})
            },
            PlayListCount(){
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
                    axios.post('/api/playlist', {id: localStorage.getItem('playlist')})
                    .then(response=>{
                        console.log(response.data.data)
                        this.playlist = response.data.data
                    })

                }else{
                    this.playlist = null
                }
            },


        },


    }
</script>

<style scoped>

</style>
