<template>
<div class="row">
    <div class="col-lg-7">
        <h4 class="h4 col-xs-b25">Book Sales Request</h4>
        <div v-if="isComplete">
            <div class="empty-space col-xs-b50"></div>
            <h3 class="h3">
                Thank you! We have received your request and will be in contact with you soon!
            </h3>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
        </div>
        <form v-on:submit.prevent="submitRequest()" v-if="!isComplete">
            <div class="row" v-if="error">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <p>{{ error }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>Do you have old books that you don't need anymore? We buy books! Enter your details and the relevant information of your book and we will get in touch as soon as possible!</p>
                </div>
            </div>
            <div class="empty-space col-xs-b50"></div>
            <div class="row m10">
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="First name" v-model="payload.firstname" required="" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Last name" v-model="payload.lastname" required="" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-6">
                    <input class="simple-input" type="email" value="" placeholder="Email Address" v-model="payload.email" required="" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Contact Number" v-model="payload.phone" required="" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-12">
                    <b>Books</b>
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="row" v-for="book in books">
                    <div class="col-sm-4">
                        <input class="simple-input" type="text" value="" placeholder="Book Title" v-model="book.name" required="" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-4">
                        <input class="simple-input" type="text" value="" placeholder="Book ISBN" v-model="book.isbn" required="" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control simple-input" v-model="book.grade" required="">
                        <option value="" disabled hidden>Select Book Grade</option>
                         <option value="A-GRADE">A-GRADE</option>
                         <option value="B-GRADE">B-GRADE</option>
                     </select>
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-lg-4">
                    <div class="button size-2 style-1 noshadow" @click="addBook">
                        <span class="button-wrapper">
                            <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        <span class="text">Add Another book</span>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="button block size-2 style-3">
                        <span class="button-wrapper">
                     <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                        <span class="text">Submit</span>
                        </span>
                        <input type="submit" />
                    </div>
                </div>
            </div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="empty-space col-xs-b50"></div>
        <p style="font-size: 16px;">
            <b>Grade A</b> - Requirements
            <ul>
                <li>No markings</li>
                <li>No highlighting</li>
                <li>Near brand new condition</li>
            </ul>
            <br/>
            <b>Grade B</b> - Requirements
            <ul>
                <li>Minimal markings</li>
                <li>Minimal highlighting</li>
                <li>Completely intact</li>
            </ul>
        </p>
    </div>
</div>
</template>
<script>
export default {
    mounted() {
        this.addBook();
    },
    data: function() {
        return {
            payload: {
                firstname: '',
                lastname: '',
                phone: '',
                email: '',
            },
            books: [],
            booksDone: 0,
            success: false,
            error: false,
            result: false,
        }
    },
    computed: {
        isComplete: function() {
            return (this.books.length > 0 && this.books.length == this.booksDone);
        }
    },
    methods: {
        addBook: function() {
            var that = this;

            that.books.push({
                name: '',
                isbn: '',
                grade: '',
            });
        },
        submitRequest: function() {
            var that = this;

            this.books.forEach(function(entry) {
                var payload = that.payload;
                payload.name = entry.name;
                payload.isbn = entry.isbn;
                payload.grade = entry.grade;

                that.$http.post('/api/sales/request', payload).then((response) => {
                    that.booksDone++;
                });
            });
        }
    }
}
</script>
