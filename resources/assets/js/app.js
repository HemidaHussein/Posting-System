
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var Paginate = require('vuejs-paginate')
Vue.component('paginate', Paginate)

Vue.component('example', require('./components/Example.vue'));
Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('post-table', require('./components/Posts.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
//Vue.component('paginate', require('./components/vue-bootstrap-pagination.vue'));


const app = new Vue({
    el: '#app',

    data: function () {
        return {

            activeItem: '',
            posts: [],
            current_page:'',
            last_page:'',
        }
    }
    ,
    methods: {
        isActive: function (menuItem) {
            return this.activeItem === menuItem
        },
        setActive: function (menuItem) {
            if(menuItem == 'posts'){
                this.readPosts();
            }
            this.activeItem = menuItem // no need for Vue.set()
            // alert(this.nav ['item'][menuItem]);
        },


            readPosts: function () {
                axios.get('/posts')
                    .then(response => {
                    this.posts = response.data;
                    this.current_page = response.data.current_page;
                    this.last_page = response.data.last_page;
                    //console.log(Paginate.pageCount);
            });
            },

        clickCallback: function (page) {
            axios.get('/posts?page='+(page+1))
                .then(response => {
                this.posts = response.data;
            this.current_page = response.data.current_page;
            this.last_page = response.data.last_page;
            //console.log(Paginate.pageCount);
        });
        },







    }
});
