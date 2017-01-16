<template lang="html">
  <form v-on:submit.prevent="submitForm()">
      <div class="modal-body">
          <div class="form-group input-group fg-float">
              <span class="input-group-addon"></span>
              <div class="fg-line" :class="{ 'fg-toggled': product.name.length }">
                  <input type="text" class="input-lg form-control fg-input" v-model="product.name">
                  <label class="fg-label">What is the name of your product?</label>
              </div>
          </div>
          <br/>
          <div class="form-group input-group fg-float">
              <span class="input-group-addon"></span>
              <div class="fg-line" :class="{ 'fg-toggled': product.caption.length }">
                  <input type="text" class="input-lg form-control fg-input" v-model="product.caption">
                  <label class="fg-label">Think of a great caption to market this product!</label>
              </div>
          </div>
          <br/>
          <div class="form-group input-group fg-float">
              <span class="input-group-addon">R</span>
              <div class="fg-line" :class="{ 'fg-toggled': product.price.length }">
                  <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                  <label class="fg-label">How much do you want to sell this item for?</label>
              </div>
              <span class="input-group-addon last">ZAR</span>
          </div>
          <br/>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-lg btn-success waves-effect">{{ process.creatingProduct ? 'Create Product' : 'Modify Product' }}</button>
          <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Cancel</button>
      </div>
  </form>

</template>

<script>
export default {
  data () {
    return {}
  },
  computed: {},
  mounted () {},
  methods: {},
  components: {}
}
</script>

<style lang="css">
</style>
