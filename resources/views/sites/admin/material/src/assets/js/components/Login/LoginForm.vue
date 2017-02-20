<template>
<div>
    <form v-on:submit.prevent="$parent.$parent.doLogin()">
        <div class="form-group fg-float">
            <div class="fg-line">
                <input type="text" class="input-sm form-control fg-input" v-model="$parent.$parent.user.credentials.email">
                <label class="fg-label">Email Address</label>
            </div>
        </div>

        <div class="form-group fg-float">
            <div class="fg-line">
                <input type="password" class="input-sm form-control fg-input" v-model="$parent.$parent.user.credentials.password">
                <label class="fg-label">Password</label>
            </div>
        </div>
        <button class="btn palette-Teal bg" type="submit">Sign in</button>
    </form>

</div>
</template>

<script>
export default {

}
</script>
