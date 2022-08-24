<template>
    <h1>Thêm</h1><br>
    <form action="/company" method="post" @submit.prevent="SubmitEvent($event)" ref="formCreate">
        <input type="hidden" :value="csrfToken" name="_token" />

        <label for="" class="form-label">Mã</label>
        <input type="text" v-model="product.code" id="" class="form form-control"
            v-bind:class="{ 'is-invalid': errors.code }" @blur="validate()">
        <span class="invalid-feedback">{{ errors.code }}</span>
        <label for="" class="form-label">Họ và Tên</label>
        <input type="text" name="name" id="" class="form form-control" v-model="product.name"
            v-bind:class="{ 'is-invalid': errors.name }" @blur="validate()">
        <span class="invalid-feedback">{{ errors.name }}</span>
        <label for="" class="form-label">Số Điện Thoại</label>
        <input type="text" name="telephone" id="" class="form form-control" v-model="product.telephone"
            v-bind:class="{ 'is-invalid': errors.telephone }" @blur="validate()">
        <span class="invalid-feedback">{{ errors.telephone }}</span>
        <label for="" class="form-label">Địa chỉ</label>
        <input type="text" name="address" id="" class="form form-control" v-model="product.address"
            v-bind:class="{ 'is-invalid': errors.address }" @blur="validate()">
        <span class="invalid-feedback">{{ errors.address }}</span>
        <button class="btn btn-primary">Add</button>
    </form>
</template>
<script>
import $ from "jquery";
export default {
    name: 'prduct',
    data() {
        return {
            errors: {
                code: '',
                name: '',
                telephone: '',
                address: '',
            },
            product: {
                code: '',
                name: '',
                telephone: '',
                address: '',
            },
        }
    },
    methods: {

        validate() {
            var check = true;
            this.errors = {
                code: '',
                name: '',
                sdtelephonet: '',
                address: '',
            }
            if (!this.product.code) {
                this.errors.code = 'Mã số khuông được để trống'
                check = false

            } else if (this.product.code.length > 10) {
                this.errors.code = 'Mã số không được quá 10 ký tự'
                check = false

            } else if (!this.product.name) {
                this.errors.name = 'Họ và Tên không được để trống'
                check = false

            } else if (!this.validateName(this.product.name)) {
                this.errors.name = 'Họ và Tên không được có ký tự đặc biệt và số'
                check = false

            } else if (!this.product.telephone) {
                this.errors.telephone = 'Số điện thoại không được để trống'
                check = false

            } else if (!this.isNumber(this.product.telephone)) {
                this.errors.telephone = 'SDT không hợp lệ'
            } else if (!this.product.address) {
                this.errors.address = 'Địa chỉ không được để trống'
                check = false
            }
            return check
        },
        validateName(value) {
            return /^[a-zA-Z]+(?:-[a-zA-Z]+)*$/.test(value)
        },
        isNumber(value) {
            return /^\d*$/.test(value)
        },

        SubmitEvent() {
            if (this.validate()) {

                // this.$refs.formCreate.submit();

                $.ajax({
                    url: '/company',
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        code: this.product.code,
                        name: this.product.name,
                        telephone: this.product.telephone,
                        address: this.product.address
                    },
                    success: function (data) {
                        window.location.href = "http://127.0.0.1:8000/company"
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })

            }
        }
    }
}
</script>
