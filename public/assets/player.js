"use strict";function Kinobox(t,e){try{this.version="20240404",this.container=t instanceof Object?t:document.querySelector(t),this.box={},this.baseUrl=new URL(e.baseUrl||"https://kinobox.tv/"),this.state={container:t,args:e,isMenuOpen:!1,players:[]},this.search=e.search,this.settings=function(t){const e={menu:{enable:!0,default:"menu_list",mobile:"menu_button",format:"{N} :: {T} ({Q})",limit:null,open:!1},players:{},params:{},translations:{"не требуется":1,"оригинальная дорожка":1,"русская":1,"русский":1,"дублирование":2,"дублированный":2,"дубляж":2,"полное дублирование":2,"hdrezka studio":7,"проф.":8,"профессиональный":8,"многоголосый":9,"любительский":20,"двухголосый":21,"звук с ts":1100,"оригинальная":1111,portugues:1234,"белорус":1234,"субтитры":1234,"украин":1234}};return t.menu&&Object.assign(e.menu,t.menu),t.players&&(e.players=t.players),t.params&&(e.params=t.params),e}(e)}catch(t){throw this.container.innerHTML="",this.container.textContent=t+" "+t.stack,t}this.log=function(t,e){if(e)for(let s in e)t=t.replace("{"+s+"}",e[s]);console.info("[Kinobox] "+t)},this.isMobile=function(){return"ontouchstart"in document.documentElement||window.screen.width<500},this.isSearchBot=function(){const t=window.navigator.userAgent.toLowerCase();return["Googlebot","http://yandex.com/bots","YandexRenderResourcesBot","bingbot","AhrefsBot"].some(function(e){return t.includes(e.toLowerCase())})},this.getSearchUrl=function(){const t=new URLSearchParams;this.container.dataset.kinopoisk&&t.set("kinopoisk",this.container.dataset.kinopoisk),this.container.dataset.imdb&&t.set("imdb",this.container.dataset.imdb),this.container.dataset.title&&t.set("title",this.container.dataset.title),this.container.dataset.query&&t.set("query",this.container.dataset.query),this.search&&(this.search.kinopoisk&&t.set("kinopoisk",this.search.kinopoisk),this.search.imdb&&t.set("imdb",this.search.imdb),this.search.title&&t.set("title",this.search.title),this.search.query&&t.set("query",this.search.query));const e=Object.keys(this.settings.players);if(e.length>0){const s=e.join(",").toLowerCase();t.set("sources",s)}const s=this.baseUrl;return s.pathname="api/players",s.search=t.toString(),s.toString()},this.getConfiguredPlayers=function(){let t=this.state.players;Object.keys(this.settings.players).length>0&&(t=t.filter(function(t){const e=this.settings.players.findByKeyCase(t.source);return!(e.hasOwnProperty("enable")&&!1===e.enable)}.bind(this)));const e={};return Object.keys(this.settings.players).forEach(function(t){e[t.toLowerCase()]=this.settings.players[t].position}.bind(this)),t=(t=(t=t.sort(function(t,s){const i=t.source.toLowerCase(),n=s.source.toLowerCase();return e[i]-e[n]}.bind(this))).filter(function(t){return t.success})).filter(function(t){return null!==t.iframeUrl}),this.settings.menu.limit&&this.settings.menu.limit>0&&(t=t.slice(0,this.settings.menu.limit)),t},this.sortTranslations=function(t){function e(t,e){const s=e.name.toLowerCase();let i=0,n=!1;for(const e in t)if(t.hasOwnProperty(e)){const o=t[e];if(e.toLowerCase()===s)return o;-1!==s.indexOf(e.toLowerCase())&&(n=!0,o>i&&(i=o))}return n?i:1e3}const s=this.settings.translations;return t.reduce(function(t,i){return e(s,i)<e(s,t)?i:t})},this.getIframeUrl=function(t,e){const s=this.settings.players.findByKeyCase(e);if(s){let i=s.findByKeyCase("domain");const n=e.toLowerCase();i&&("alloha"===n?t=t.replace(/^(https?:\/\/)[^\/]+/,i):"cdnmovies"===n?t=t.replace(/^(https?:\/\/)[^\/]+/,i):"videocdn"===n&&(i.startsWith("//")&&(i="https:"+i),t=t.replace(/^(https?:\/\/[^\/]+\/[^\/]+)/,i)))}t=new URL(t),e=e.toLowerCase();const i=new URLSearchParams(t.search),n=this.settings.params.findByKeyCase("all");if(n)for(const t in n)i.set(t,n[t]);const o=this.settings.params.findByKeyCase(e);if(o)for(const t in o)i.set(t,o[t]);return t.search=i.toString(),t.toString()}}function kbox(t,e){new Kinobox(t,e).init()}Object.defineProperty(Object.prototype,"findByKeyCase",{enumerable:!1,configurable:!0,value:function(t){t=t.toLowerCase();for(let e in this)if(this.hasOwnProperty(e)&&e.toLowerCase()===t)return this[e]}}),Kinobox.prototype.appendStyles=function(){const t=document.createElement("link");t.rel="stylesheet";const e=this.baseUrl;e.pathname="kinobox.min.css",e.searchParams.append("v",this.version),t.href=e.toString(),document.head.appendChild(t),"undefined"!=typeof CSS&&CSS.supports("aspect-ratio","1/1")||(this.container.style.height=this.container.offsetWidth/1.777777+"px",this.container.style.maxHeight=this.container.offsetHeight+"px")},Kinobox.prototype.bindHotkeys=function(){document.addEventListener("keypress",function(t){const e=t.target.parentNode.firstElementChild.tagName;if("INPUT"!==e&&"TEXTAREA"!==e){const e=parseInt(t.key);e?this.selectPlayer(e):("x"===t.key||"0"===t.key)&&this.showMenu(!this.state.isMenuOpen)}}.bind(this))},Kinobox.prototype.fetch=function(t,e){const s={success:!1,data:null},i=new XMLHttpRequest;i.onload=function(){200===i.status?s.success=!0:i.onerror(null)},i.onerror=function(){s.success=!1,console.error("Error "+i.status+": "+i.statusText+"\n",i.response),e(s)},i.onloadend=function(){s.data=i.response,e(s)},i.open("GET",t),i.responseType="json",i.send()},Kinobox.prototype.showLoader=function(t){t?this.box.loader.classList.remove("kinobox_hidden"):this.box.loader.classList.add("kinobox_hidden")},Kinobox.prototype.showMessage=function(t){t?(this.box.message.textContent=t,this.box.message.classList.remove("kinobox_hidden")):(this.box.message.textContent="",this.box.message.classList.add("kinobox_hidden")),this.showLoader(!1)},Kinobox.prototype.showNavigation=function(t){!1!==this.settings.menu.enable&&(t?(this.box.nav.removeAttribute("disabled"),this.box.nav.setAttribute("active","true")):(this.box.nav.removeAttribute("active"),this.box.nav.setAttribute("disabled","true")))},Kinobox.prototype.showMenu=function(t){this.state.isMenuOpen=t,this.box.ul.setAttribute("active",t),t?this.box.ul.setAttribute("active","true"):this.box.ul.removeAttribute("active")},Kinobox.prototype.showIframe=function(t){this.log("Loading iframe: {url}",{url:t}),this.showLoader(!0);const e=document.createElement("iframe");e.className="kinobox_iframe",e.allowFullscreen=!0,e.frameBorder="0",e.src=t,this.box.iframeWrapper.innerHTML="",this.box.iframeWrapper.appendChild(e);const s=Date.now();e.addEventListener("load",function(){this.log("Iframe loaded in {time} ms: {url}",{time:Date.now()-s,url:e.src}),this.showLoader(!1)}.bind(this))},Kinobox.prototype.selectPlayer=function(t){if(this.box.ul){const e='[data-number="{id}"]'.replace("{id}",t),s=this.box.ul.querySelector(e);s&&s.click()}},Kinobox.prototype.createRefreshButton=function(){const t=document.createElement("button");t.className="kinobox_button_refresh",t.textContent="Обновить",this.box.message.appendChild(t),t.addEventListener("click",function(){t.disabled=!0,this.init()}.bind(this))},Kinobox.prototype.buildContainer=function(){this.container.innerHTML="",this.box.wrapper=document.createElement("div"),this.box.wrapper.className="kinobox_wrapper",this.container.appendChild(this.box.wrapper),this.box.loader=document.createElement("div"),this.box.loader.className="kinobox_loader",this.box.wrapper.appendChild(this.box.loader),this.box.message=document.createElement("div"),this.box.message.className="kinobox_message kinobox_hidden",this.box.wrapper.appendChild(this.box.message),this.box.iframeWrapper=document.createElement("div"),this.box.iframeWrapper.className="kinobox_iframe_wrapper",this.box.wrapper.appendChild(this.box.iframeWrapper),this.box.nav=document.createElement("nav"),this.box.nav.className="kinobox_nav",this.box.nav.style.display="none",this.box.wrapper.appendChild(this.box.nav),this.box.ul=document.createElement("ul"),this.box.ul.className="kinobox_nav_ul",this.box.nav.appendChild(this.box.ul),this.box.buttonMenu=document.createElement("button"),this.box.buttonMenu.className="kinobox_nav_button",this.box.nav.appendChild(this.box.buttonMenu),!1===this.settings.menu.enable&&this.showNavigation(!1),this.isMobile()?(this.box.nav.classList.add(this.settings.menu.mobile),this.box.buttonMenu.setAttribute("enabled","true")):(this.box.nav.classList.add(this.settings.menu.default),"menu_button"===this.settings.menu.default&&this.box.buttonMenu.setAttribute("enabled","true")),this.box.ul.addEventListener("mouseenter",function(){this.box.nav.classList.contains("menu_list")&&this.showMenu(!0)}.bind(this)),this.box.ul.addEventListener("mouseleave",function(){this.box.nav.classList.contains("menu_list")&&this.showMenu(!1)}.bind(this)),this.box.buttonMenu.addEventListener("click",function(){this.showMenu(!this.state.isMenuOpen)}.bind(this))},Kinobox.prototype.buildMenu=function(){this.settings.menu.open&&this.showMenu(!0);const t=this.getConfiguredPlayers();0===t.length&&this.showMessage("Видео не найдено."),t.forEach(function(t,e){if(!1!==t.success){const s=this.sortTranslations(t.translations),i=(e+1).toString(),n=document.createElement("li");n.dataset.number=i,n.dataset.url=this.getIframeUrl(s.iframeUrl,t.source),n.title="{N}. {T} ({Q}) [{S}]".replace("{N}",i).replace("{S}",t.source).replace("{T}",s.name||"Не указано").replace("{Q}",s.quality||"-"),n.innerHTML=this.settings.menu.format.replace("{N}",i).replace("{S}",t.source).replace("{T}",s.name||"Не указано").replace("{Q}",s.quality||"-"),this.box.ul.appendChild(n),n.addEventListener("click",function(){this.log("Switch to player: {number}, {source}",{number:n.dataset.number,source:t.source}),[].forEach.call(this.box.ul.querySelectorAll("li"),function(t){t.removeAttribute("active")}),n.setAttribute("active",""),this.showIframe(n.dataset.url)}.bind(this))}}.bind(this))},Kinobox.prototype.init=function(){if(this.isSearchBot())return this.buildContainer(),this.showMessage("Disabled."),void this.log("Disabled.");this.log("Initializing"),this.appendStyles(),this.buildContainer(),this.bindHotkeys(),this.log("Searching");const t=this.getSearchUrl(),e=function(t){try{t.data?t.data.message?this.showMessage(t.data.message):t.data.detail?this.showMessage(t.data.detail):t.data.error?this.showMessage(t.data.error.message):(this.state.players=t.data,this.buildMenu(),this.showNavigation(!0),this.selectPlayer(1)):(this.showMessage("Ошибка загрузки данных."),this.createRefreshButton())}catch(t){console.error(t),this.showMessage("Ошибка загрузки данных."),this.createRefreshButton()}}.bind(this);this.fetch(t,e)},document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll('[data-kinobox="auto"]').forEach(function(t){new Kinobox(t,{}).init()})});
