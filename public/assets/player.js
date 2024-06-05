"use strict";

function Kinobox(n, t) {
    function r(n) {
        const t = {
            menu: {
                enable: !0,
                "default": "menu_list",
                mobile: "menu_button",
                format: "{N} :: {T} ({Q})",
                limit: null,
                open: !1
            },
            players: {},
            params: {},
            translations: {
                "не требуется": 1,
                "оригинальная дорожка": 1,
                "русская": 1,
                "русский": 1,
                "дублирование": 2,
                "дублированный": 2,
                "дубляж": 2,
                "полное дублирование": 2,
                "hdrezka studio": 7,
                "проф.": 8,
                "профессиональный": 8,
                "многоголосый": 9,
                "любительский": 20,
                "двухголосый": 21,
                "звук с ts": 1100,
                "оригинальная": 1111,
                portugues: 1234,
                "белорус": 1234,
                "субтитры": 1234,
                "украин": 1234
            }
        };
        return n.menu && Object.assign(t.menu, n.menu), n.players && (t.players = n.players), n.params && (t.params = n.params), t
    }

    try {
        this.version = "20240404";
        this.container = n instanceof Object ? n : document.querySelector(n);
        this.box = {};
        this.baseUrl = new URL(t.baseUrl || "https://kinobox.tv/");
        this.state = {container: n, args: t, isMenuOpen: !1, players: []};
        this.search = t.search;
        this.settings = r(t)
    } catch (i) {
        this.container.innerHTML = "";
        this.container.textContent = i + " " + i.stack;
        throw i;
    }
    this.log = function (n, t) {
        if (t) for (let i in t) n = n.replace("{" + i + "}", t[i]);
        console.info("[Kinobox] " + n)
    };
    this.isMobile = function () {
        return "ontouchstart" in document.documentElement || window.screen.width < 500
    };
    this.isSearchBot = function () {
        const n = window.navigator.userAgent.toLowerCase();
        return ["Googlebot", "http://yandex.com/bots", "YandexRenderResourcesBot", "bingbot", "AhrefsBot"].some(function (t) {
            return n.includes(t.toLowerCase())
        })
    };
    this.getSearchUrl = function () {
        const n = new URLSearchParams;
        this.container.dataset.kinopoisk && n.set("kinopoisk", this.container.dataset.kinopoisk);
        this.container.dataset.imdb && n.set("imdb", this.container.dataset.imdb);
        this.container.dataset.title && n.set("title", this.container.dataset.title);
        this.container.dataset.query && n.set("query", this.container.dataset.query);
        this.search && (this.search.kinopoisk && n.set("kinopoisk", this.search.kinopoisk), this.search.imdb && n.set("imdb", this.search.imdb), this.search.title && n.set("title", this.search.title), this.search.query && n.set("query", this.search.query));
        const i = Object.keys(this.settings.players);
        if (i.length > 0) {
            const t = i.join(",").toLowerCase();
            n.set("sources", t)
        }
        const t = this.baseUrl;
        return t.pathname = "api/players", t.search = n.toString(), t.toString()
    };
    this.getConfiguredPlayers = function () {
        let n = this.state.players;
        Object.keys(this.settings.players).length > 0 && (n = n.filter(function (n) {
            const t = this.settings.players.findByKeyCase(n.source);
            return !(t.hasOwnProperty("enable") && t.enable === !1)
        }.bind(this)));
        const t = {};
        return Object.keys(this.settings.players).forEach(function (n) {
            t[n.toLowerCase()] = this.settings.players[n].position
        }.bind(this)), n = n.sort(function (n, i) {
            const r = n.source.toLowerCase(), u = i.source.toLowerCase();
            return t[r] - t[u]
        }.bind(this)), n = n.filter(function (n) {
            return n.success
        }), n = n.filter(function (n) {
            return n.iframeUrl !== null
        }), this.settings.menu.limit && this.settings.menu.limit > 0 && (n = n.slice(0, this.settings.menu.limit)), n
    };
    this.sortTranslations = function (n) {
        function t(n, t) {
            const r = t.name.toLowerCase();
            let i = 0, u = !1;
            for (const t in n) if (n.hasOwnProperty(t)) {
                const f = n[t];
                if (t.toLowerCase() === r) return f;
                r.indexOf(t.toLowerCase()) !== -1 && (u = !0, f > i && (i = f))
            }
            return u ? i : 1e3
        }

        const i = this.settings.translations;
        return n.reduce(function (n, r) {
            return t(i, r) < t(i, n) ? r : n
        })
    };
    this.getIframeUrl = function (n, t) {
        const f = this.settings.players.findByKeyCase(t);
        if (f) {
            let i = f.findByKeyCase("domain");
            const r = t.toLowerCase();
            i && (r === "alloha" ? n = n.replace(/^(https?:\/\/)[^\/]+/, i) : r === "cdnmovies" ? n = n.replace(/^(https?:\/\/)[^\/]+/, i) : r === "videocdn" && (i.startsWith("//") && (i = "https:" + i), n = n.replace(/^(https?:\/\/[^\/]+\/[^\/]+)/, i)))
        }
        n = new URL(n);
        t = t.toLowerCase();
        const i = new URLSearchParams(n.search), r = this.settings.params.findByKeyCase("all");
        if (r) for (const n in r) i.set(n, r[n]);
        const u = this.settings.params.findByKeyCase(t);
        if (u) for (const n in u) i.set(n, u[n]);
        return n.search = i.toString(), n.toString()
    }
}

function kbox(n, t) {
    new Kinobox(n, t).init()
}

Object.defineProperty(Object.prototype, "findByKeyCase", {
    enumerable: !1,
    configurable: !0,
    value: function (n) {
        n = n.toLowerCase();
        for (let t in this) if (this.hasOwnProperty(t) && t.toLowerCase() === n) return this[t];
        return undefined
    }
});
Kinobox.prototype.appendStyles = function () {
    const n = document.createElement("link");
    n.rel = "stylesheet";
    const t = this.baseUrl;
    t.pathname = "kinobox.min.css";
    t.searchParams.append("v", this.version);
    n.href = t.toString();
    document.head.appendChild(n);
    typeof CSS != "undefined" && CSS.supports("aspect-ratio", "1/1") || (this.container.style.height = this.container.offsetWidth / 1.777777 + "px", this.container.style.maxHeight = this.container.offsetHeight + "px")
};
Kinobox.prototype.bindHotkeys = function () {
    document.addEventListener("keypress", function (n) {
        const t = n.target.parentNode.firstElementChild.tagName;
        if (t !== "INPUT" && t !== "TEXTAREA") {
            const i = parseInt(n.key);
            i ? this.selectPlayer(i) : (n.key === "x" || n.key === "0") && this.showMenu(!this.state.isMenuOpen)
        }
    }.bind(this))
};
Kinobox.prototype.fetch = function (n, t) {
    const r = {success: !1, data: null}, i = new XMLHttpRequest;
    i.onload = function () {
        if (i.status === 200) r.success = !0; else i.onerror(null)
    };
    i.onerror = function () {
        r.success = !1;
        console.error("Error " + i.status + ": " + i.statusText + "\n", i.response);
        t(r)
    };
    i.onloadend = function () {
        r.data = i.response;
        t(r)
    };
    i.open("GET", n);
    i.responseType = "json";
    i.send()
};
Kinobox.prototype.showLoader = function (n) {
    n ? this.box.loader.classList.remove("kinobox_hidden") : this.box.loader.classList.add("kinobox_hidden")
};
Kinobox.prototype.showMessage = function (n) {
    n ? (this.box.message.textContent = n, this.box.message.classList.remove("kinobox_hidden")) : (this.box.message.textContent = "", this.box.message.classList.add("kinobox_hidden"));
    this.showLoader(!1)
};
Kinobox.prototype.showNavigation = function (n) {
    this.settings.menu.enable !== !1 && (n ? (this.box.nav.removeAttribute("disabled"), this.box.nav.setAttribute("active", "true")) : (this.box.nav.removeAttribute("active"), this.box.nav.setAttribute("disabled", "true")))
};
Kinobox.prototype.showMenu = function (n) {
    this.state.isMenuOpen = n;
    this.box.ul.setAttribute("active", n);
    n ? this.box.ul.setAttribute("active", "true") : this.box.ul.removeAttribute("active")
};
Kinobox.prototype.showIframe = function (n) {
    this.log("Loading iframe: {url}", {url: n});
    this.showLoader(!0);
    const t = document.createElement("iframe");
    t.className = "kinobox_iframe";
    t.allowFullscreen = !0;
    t.frameBorder = "0";
    t.src = n;
    this.box.iframeWrapper.innerHTML = "";
    this.box.iframeWrapper.appendChild(t);
    const i = Date.now();
    t.addEventListener("load", function () {
        this.log("Iframe loaded in {time} ms: {url}", {time: Date.now() - i, url: t.src});
        this.showLoader(!1)
    }.bind(this))
};
Kinobox.prototype.selectPlayer = function (n) {
    if (this.box.ul) {
        const i = '[data-number="{id}"]'.replace("{id}", n), t = this.box.ul.querySelector(i);
        t && t.click()
    }
};
Kinobox.prototype.createRefreshButton = function () {
    const n = document.createElement("button");
    n.className = "kinobox_button_refresh";
    n.textContent = "Обновить";
    this.box.message.appendChild(n);
    n.addEventListener("click", function () {
        n.disabled = !0;
        this.init()
    }.bind(this))
};
Kinobox.prototype.buildContainer = function () {
    this.container.innerHTML = "";
    this.box.wrapper = document.createElement("div");
    this.box.wrapper.className = "kinobox_wrapper";
    this.container.appendChild(this.box.wrapper);
    this.box.loader = document.createElement("div");
    this.box.loader.className = "kinobox_loader";
    this.box.wrapper.appendChild(this.box.loader);
    this.box.message = document.createElement("div");
    this.box.message.className = "kinobox_message kinobox_hidden";
    this.box.wrapper.appendChild(this.box.message);
    this.box.iframeWrapper = document.createElement("div");
    this.box.iframeWrapper.className = "kinobox_iframe_wrapper";
    this.box.wrapper.appendChild(this.box.iframeWrapper);
    this.box.nav = document.createElement("nav");
    this.box.nav.className = "kinobox_nav";
    this.box.nav.style.display = "none";
    this.box.wrapper.appendChild(this.box.nav);
    this.box.ul = document.createElement("ul");
    this.box.ul.className = "kinobox_nav_ul";
    this.box.nav.appendChild(this.box.ul);
    this.box.buttonMenu = document.createElement("button");
    this.box.buttonMenu.className = "kinobox_nav_button";
    this.box.nav.appendChild(this.box.buttonMenu);
    this.settings.menu.enable === !1 && this.showNavigation(!1);
    this.isMobile() ? (this.box.nav.classList.add(this.settings.menu.mobile), this.box.buttonMenu.setAttribute("enabled", "true")) : (this.box.nav.classList.add(this.settings.menu.default), this.settings.menu.default === "menu_button" && this.box.buttonMenu.setAttribute("enabled", "true"));
    this.box.ul.addEventListener("mouseenter", function () {
        this.box.nav.classList.contains("menu_list") && this.showMenu(!0)
    }.bind(this));
    this.box.ul.addEventListener("mouseleave", function () {
        this.box.nav.classList.contains("menu_list") && this.showMenu(!1)
    }.bind(this));
    this.box.buttonMenu.addEventListener("click", function () {
        this.showMenu(!this.state.isMenuOpen)
    }.bind(this))
};
Kinobox.prototype.buildMenu = function () {
    this.settings.menu.open && this.showMenu(!0);
    const n = this.getConfiguredPlayers();
    n.length === 0 && this.showMessage("Видео не найдено.");
    n.forEach(function (n, t) {
        if (n.success !== !1) {
            const r = this.sortTranslations(n.translations), u = (t + 1).toString(),
                i = document.createElement("li");
            i.dataset.number = u;
            i.dataset.url = this.getIframeUrl(r.iframeUrl, n.source);
            i.title = "{N}. {T} ({Q}) [{S}]".replace("{N}", u).replace("{S}", n.source).replace("{T}", r.name || "Не указано").replace("{Q}", r.quality || "-");
            i.innerHTML = this.settings.menu.format.replace("{N}", u).replace("{S}", n.source).replace("{T}", r.name || "Не указано").replace("{Q}", r.quality || "-");
            this.box.ul.appendChild(i);
            i.addEventListener("click", function () {
                this.log("Switch to player: {number}, {source}", {
                    number: i.dataset.number,
                    source: n.source
                });
                [].forEach.call(this.box.ul.querySelectorAll("li"), function (n) {
                    n.removeAttribute("active")
                });
                i.setAttribute("active", "");
                this.showIframe(i.dataset.url)
            }.bind(this))
        }
    }.bind(this))
};
Kinobox.prototype.init = function () {
    if (this.isSearchBot()) {
        this.buildContainer();
        this.showMessage("Disabled.");
        this.log("Disabled.");
        return
    }
    this.log("Initializing");
    this.appendStyles();
    this.buildContainer();
    this.bindHotkeys();
    this.log("Searching");
    const n = this.getSearchUrl(), t = function (n) {
        try {
            n.data ? n.data.message ? this.showMessage(n.data.message) : n.data.detail ? this.showMessage(n.data.detail) : n.data.error ? this.showMessage(n.data.error.message) : (this.state.players = n.data, this.buildMenu(), this.showNavigation(!0), this.selectPlayer(1)) : (this.showMessage("Ошибка загрузки данных."), this.createRefreshButton())
        } catch (t) {
            console.error(t);
            this.showMessage("Ошибка загрузки данных.");
            this.createRefreshButton()
        }
    }.bind(this);
    this.fetch(n, t)
};
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[data-kinobox="auto"]').forEach(function (n) {
        new Kinobox(n, {}).init()
    })
});

