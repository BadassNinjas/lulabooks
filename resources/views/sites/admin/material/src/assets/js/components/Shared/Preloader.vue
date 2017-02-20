<template>
<div>
    <div class="media">
        <div class="preloader pull-left" :class="getSize" style="margin: 4px 4px 0 0;">
            <svg class="pl-circular" viewBox="25 25 50 50">
              <circle class="plc-path" cx="50" cy="50" r="20"></circle>
            </svg>
        </div>
        <div class="media-body">
            <p class="media-heading"><b>{{ title ? title : 'Loading - Please wait...' }}</b><br/>{{ message ? message : 'We\'re hard at work to get this working...' }}</p>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: [
        'title',
        'message',
        'size'
    ],
    computed: {
        getSize: function() {
            return this.size ? 'pl-' + this.size : 'pl-xl';
        }
    }
}
</script>
</script>
