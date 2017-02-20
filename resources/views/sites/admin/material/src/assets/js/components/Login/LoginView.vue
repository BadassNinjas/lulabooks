<template>
<div class="login" data-lbg="teal">
    <div class="l-block toggled">
        <div class="lb-header palette-Teal bg">
            <i class="zmdi zmdi-account-circle"></i> Hi there! Please Sign in
        </div>
        <div class="lb-body">
            <login-form></login-form>
        </div>
    </div>
</div>
</template>

<script>
import LoginForm from './LoginForm.vue';

export default {
    components: {
        LoginForm
    }
}
</script>
