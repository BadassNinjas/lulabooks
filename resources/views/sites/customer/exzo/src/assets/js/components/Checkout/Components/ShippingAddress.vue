<template>
<div class="checkbox-toggle-wrapper">
    <div class="empty-space col-xs-b25"></div>
    <div class="row m10">
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="First name" />
            <div class="empty-space col-xs-b20"></div>
        </div>
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="Last name" />
            <div class="empty-space col-xs-b20"></div>
        </div>
    </div>
    <select country-list>
           <option disabled="disabled" selected="selected">Choose country</option>
           <option :value="country.name" v-for="country in Countries">{{ country.name }}</option>
       </select>
    <div class="empty-space col-xs-b20"></div>
    <input class="simple-input" type="text" value="" placeholder="Company name" />
    <div class="empty-space col-xs-b20"></div>
    <input class="simple-input" type="text" value="" placeholder="Street address" />
    <div class="empty-space col-xs-b20"></div>
    <div class="row m10">
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="Appartment" />
            <div class="empty-space col-xs-b20"></div>
        </div>
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="Town/City" />
            <div class="empty-space col-xs-b20"></div>
        </div>
    </div>
    <div class="row m10">
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="State/Country" />
            <div class="empty-space col-xs-b20"></div>
        </div>
        <div class="col-sm-6">
            <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" />
            <div class="empty-space col-xs-b20"></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted() {

    }
}
</script>
