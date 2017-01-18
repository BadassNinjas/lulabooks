<template>
  <div>
    <div style="padding: 0 26px">
        <h1 style="font-weight: 300;" class="text-center">Your basic product has been {{ process.creatingProduct ? 'created' : 'modified' }}!</h1>
    </div>
    <div>
        <h3 style="font-weight: 300;">A few things you may want to do in order to make your product more appealing to your customer</h3>
        <br/>
        <ul>
            <li>Assign your product to an organised category</li>
            <li>Add some content like videos, descriptors, and marketing related information</li>
            <li>Upload some images and select a primary display image</li>
        </ul>
        <br/>
        <h4 style="font-weight: 300;">Click the green button to {{ process.creatingProduct ? 'start adding your ' : 'modify existing ' }} information or the other to exit.</h4>
    </div>
    <div>
        <button type="submit" class="btn btn-lg btn-success waves-effect" @click="process.step = 3">Let's Do It!</button>
        <button type="button" class="btn btn-lg btn-default waves-effect" @click="process.step = 1">Back</button>
    </div>
  </div>
</template>
<script>
export default {
    props: [
      'process',
    ],
}
</script>
