<template>
<div>
    <section id="content">
        <div class="container">
            <div class="c-header">
                <h2>Dashboard</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Textarea <small>Form control which supports multiple lines of text. Change 'rows' attribute as necessary.</small></h2>
                </div>

                <div class="card-body card-padding">
                    <p class="c-black f-500 m-b-20">Basic Example</p>

                    <div class="form-group">
                        <div class="fg-line">
                            <textarea class="form-control" rows="5" placeholder="Let us type some lorem ipsum...."></textarea>
                        </div>
                    </div>

                    <p class="c-black f-500 m-t-20 m-b-20">Height Auto Growing</p>

                    <div class="form-group">
                        <div class="fg-line">
                            <textarea class="form-control auto-size" placeholder="Start pressing Enter to see growing..."></textarea>
                        </div>
                    </div>

                    <p class="c-black f-500 m-b-20 m-t-20">Disabled State</p>

                    <div class="form-group">
                        <div class="fg-line disabled">
                            <textarea class="form-control" disabled>This is disabled</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
