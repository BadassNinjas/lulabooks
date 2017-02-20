<template>
<div>
    <form v-on:submit.prevent="submitPreAuth()">
        <h4 class="h4 col-xs-b25">Would you like to register an account for future use? You can also checkout as a guest if you prefer.</h4>
        <h5 class="h5">Why register?</h5>
        <p>
            Registering an account saves you time when checking out, your billing and delivery detail will be saved so that you do not need to enter them on each checkout.
        </p>
        <div class="empty-space col-xs-b20"></div>
        <div class="alert alert-danger" v-if="error">
            <p>{{ error }}</p>
        </div>
        <div v-if="auth.choice == 'register'">
            <div class="row m10">
                <div class="col-sm-12">
                    <input class="simple-input" type="email" placeholder="Email Address" v-model="payload.email" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="password" placeholder="Desired Password" v-model="payload.password" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="password" placeholder="Confirm Password" v-model="payload.password_confirmation" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-12">
                    <div class="button block size-2 style-3">
                        <span class="button-wrapper">
                   <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                        <span class="text">Create Account</span>
                        </span>
                        <input type="submit" />
                    </div>
                    <br/>
                    <div class="button block size-2 style-1 noshadow" @click="auth.choice = 'login'">
                        <span class="button-wrapper">
                   <span class="icon"><i>Login</i></span>
                        <span class="text">I already have an account!</span>
                        </span>
                        <input type="button" />
                    </div>
                    <br/>
                    <div class="button block size-2 style-1 noshadow" @click="state.phase = 'billing-address'">
                        <span class="button-wrapper">
                   <span class="icon"><i>Guest</i></span>
                        <span class="text">No Thanks! Continue as guest!</span>
                        </span>
                        <input type="button" />
                    </div>
                </div>
            </div>
        </div>
        <div v-if="auth.choice == 'login'">
            <div class="row m10">
                <div class="col-sm-6">
                    <input class="simple-input" type="email" placeholder="Email Address" v-model="payload.email" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="password" placeholder="Your Password" v-model="payload.password" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-12">
                    <div class="button block size-2 style-3">
                        <span class="button-wrapper">
                   <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                        <span class="text">Login</span>
                        </span>
                        <input type="submit" />
                    </div>
                    <br/>
                    <div class="button block size-2 style-1 noshadow" @click="auth.choice = 'register'">
                        <span class="button-wrapper">
                   <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        <span class="text">Cancel</span>
                        </span>
                        <input type="button" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</template>
<script>
export default {
    props: [
        'state',
    ],
    data() {
        return {
            payload: {
                email: '',
                password: '',
                password_confirmation: '',
            },
            auth: {
                choice: 'register'
            },
            error: false,
        }
    },
    methods: {
        submitPreAuth: function() {
            if (this.auth.choice == 'register') {
                this.$http.post('/api/auth/register', this.payload).then((response) => {
                    if (response.data.success) {
                        this.$root.$emit('UserAuthDataReceived', response.data.payload);
                        this.state.phase = 'billing-address';
                    } else {
                        this.error = response.data.error.desc;
                    }
                });
            } else if (this.auth.choice == 'login') {
                this.$http.post('/api/auth/login', this.payload).then((response) => {
                    if (response.data.success) {
                        this.$root.$emit('UserAuthDataReceived', response.data.payload);
                        this.state.phase = 'billing-address';
                    } else {
                        this.error = response.data.error.desc;
                    }
                });
            }
        },
    }
}
</script>
