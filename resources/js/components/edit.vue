
<template>
    <h1>Edit</h1>
    <form @submit.prevent="SubmitEvent($event)">
        <label for="">Code</label>
        <Field type="text" name="code" v-model="product.code" placeholder="Code" class="form-control" />
        <span class="invalid-feedback">{{ errors.code }}</span>
        <label for="name">Họ và tên</label>
        <Field type="text" name="name" v-model="product.name" placeholder="Họ Và Tên" class="form-control" />
        <span class="invalid-feedback">{{ errors.name }}</span>
        <label for="">Số điện thoại</label>
        <Field type="text" name="telephone" v-model="product.telephone" placeholder="Số điện thoại"
            class="form-control" />
        <span class="invalid-feedback">{{ errors.telephone }}</span>
        <label for="address">Địa chỉ</label>
        <Field type="text" name="address" v-model="product.address" placeholder="Địa chỉ" class="form-control" />
        <span class="invalid-feedback">{{ errors.address }}</span>
        <button class="btn btn-primary">Update</button>
    </form>

</template>
<script>
import axios from 'axios';
import {
    Field,
} from "vee-validate";
export default {
    props: ["data"],
    data() {
        return {
            errors: {
                code: '',
                name: '',
                telephone: '',
                address: '',
            },
            product: {
                code: this.data.company.code,
                name: this.data.company.name,
                telephone: this.data.company.telephone,
                address: this.data.company.address,
            }

        };
    },

    // created() {
    //     var id = window.location.href;
    //     id = id.substr(30, 2);
    //     axios.get('http://localhost:8000/api/company/edit/' + id)
    //         .then((response) => {
    //             this.product = response.data;
    //             console.log(response.data);
    //         });
    // },
    components: {
        Field,
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
            var id = window.location.href;
            id = id.substr(30, 2);
            axios.post(`http://localhost:8000/api/company/updateall/${id}`, this.product, {
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
            }).then(function (data) {
                window.location.href = "http://localhost:8000/company"
            })
        },
    }

}
</script>
<style>
input,
label {
    display: block;
    margin-top: 10px;

}

input+span {
    display: block;
}

button {
    margin-top: 20px;
}
</style>

