<template>
<div>
    <div v-if="user.authenticated">
        <navigation-bar></navigation-bar>

        <section id="main">

            <side-navigation-bar></side-navigation-bar>

            <router-view></router-view>

            <footer id="footer">
                Copyright &copy; 2017 LulaBooks

                <ul class="f-menu">
                    <li><a href="">Home</a></li>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Reports</a></li>
                    <li><a href="">Support</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </footer>

        </section>
    </div>
    <div v-if="!user.authenticated">
        <login-view></login-view>
    </div>
    <div class="page-loader palette-Teal bg">
        <div class="preloader pl-xl pls-white">
            <svg class="pl-circular" viewBox="25 25 50 50">
                <circle class="plc-path" cx="50" cy="50" r="20"/>
            </svg>
        </div>
    </div>
    <old-browser-notice></old-browser-notice>
</div>
</template>

<script>
import NavigationBar from './Shared/NavigationBar.vue';
import SideNavigationBar from './Shared/SideNavigationBar.vue';
import OldBrowserNotice from './Shared/OldBrowserNotice.vue';
import LoginView from '../components/Login/LoginView.vue';

export default {
    mounted() {
        if (System.AuthCheckComplete !== true) {
            this.checkLogin();
        }

        this.$http.get('/api/basket').then((response) => {
            this.user.cart.items = response.data.payload.items;
            this.user.cart.count = this.user.cart.items.length;
            this.user.cart.total = response.data.payload.total;
        });

        this.$http.get('/api/products').then((response) => {
            this.products.current = response.data.payload;
        });
    },
    created() {
      this.$root.$on('CreateProductRequested', this.postProduct);
      this.$root.$on('UpdateProductRequested', this.putProduct);
      this.$root.$on('UpdateProductCategoryRequested', this.updateProductCategory);
    },
    methods: {
        doLogin: function() {
            this.$http.post('/api/auth', this.user.credentials).then((response) => {
                this.user.credentials.email = '';
                this.user.credentials.password = '';

                if (response.data.success && (response.data.payload.role == 'superadmin' || response.data.payload.role == 'admin')) {
                    this.user.authenticated = true;
                    this.user.persona = response.data.payload;

                    this.notify('Welcome ' + this.user.persona.firstname + ' ' + this.user.persona.lastname, 'success');
                } else {
                    alert('Login incorrect or your account does not have admin rights.');
                }

            });
        },
        doLogout: function() {
            this.$http.delete('/api/auth').then((response) => {
                this.user.credentials.email = '';
                this.user.credentials.password = '';
                this.user.authenticated = false;
                this.user.persona = {};
            });
        },
        checkLogin: function() {
            System.AuthCheckComplete = true;

            this.$http.get('/api/auth').then((response) => {

                this.user.credentials.email = '';
                this.user.credentials.password = '';

                if (response.data.success && response.data.payload.role == 'superadmin') {
                    this.user.authenticated = true;
                    this.user.persona = response.data.payload;

                    this.notify('<b>LulaBooks Admin Panel</b><br/>Welcome ' + this.user.persona.firstname + ' ' + this.user.persona.lastname, 'inverse');

                    $('body').attr('data-ma-header', 'teal');
                }
            });
        },
        addToBasket: function(productId, basketQuantity) {

            this.$http.post('/api/basket', {
                id: productId,
                qty: basketQuantity
            }).then((response) => {
                this.user.cart.items = response.data.payload.items;
                this.user.cart.count = this.user.cart.items.length;
                this.user.cart.total = response.data.payload.total;

                alert('Item added to basket successfully');
            });
        },
        notify: function(message, type) {
            $.growl({
                message: message
            }, {
                type: type,
                allow_dismiss: false,
                label: 'Cancel',
                className: 'btn-xs btn-inverse',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: 2500,
                animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
                },
                offset: {
                    x: 30,
                    y: 30
                }
            });
        },
        postProduct: function(product) {
          this.$http.post('/api/products', product).then((response) => {
              if (response.data.success) {
                  this.$root.$emit('CreateProductReceived', response.data.payload);
              } else {
                  alert(response.data.payload.error.desc);
              }
          });
        },
        putProduct: function(product) {
          this.$http.put('/api/products/' + product.id, product).then((response) => {
              if (response.data.success) {
                  this.$root.$emit('UpdateProductReceived', response.data.payload);
              } else {
                  alert(response.data.payload.error.desc);
              }
          });
        },
        updateProductCategory: function(categoryId) {
            var payload = this.product;

            payload.category_id = categoryId;

            this.$http.put('/api/products/' + this.product.id, payload).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.category = response.data.payload.category;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
    },
    components: {
        NavigationBar,
        SideNavigationBar,
        OldBrowserNotice,
        LoginView,
    },
    data: function() {
        return {
            category: {
                managingItem: {}
            },
            user: {
                credentials: {
                    email: '',
                    password: '',
                    remember: true,
                },
                authenticated: false,
                persona: {},
                cart: {
                    count: 0,
                    total: 0,
                    items: []
                }
            },
            products: {
                current: [],
                related: [],
                promoted: []
            }
        }
    },
    watch: {
        'user.authenticated': function(value) {
            if (value == true) {
                $('body').attr('data-ma-header', 'teal')
            } else {
                $('body').removeAttr('data-ma-header');
            }
        }
    }
}
</script>
