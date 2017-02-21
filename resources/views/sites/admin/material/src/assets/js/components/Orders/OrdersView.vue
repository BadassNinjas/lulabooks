<template>
<div>
    <section id="content">
        <div class="container">
            <div class="c-header">
                <h2>Orders / Transactions</h2>
            </div>
            <div class="card">
                <div class="card-body card-padding">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h3 style="font-weight: 300;">Orders / Transactions</h3>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <list></list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import List from './Components/OrdersList.vue';
export default {
    components: {
        List
    }
}
</script>
