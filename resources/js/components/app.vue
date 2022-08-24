<template>
  <h1>Thêm</h1><br>
  <form method="post" @submit.prevent="SubmitEvent($event)">
    <label for="" class="form-label">Mã</label>
    <input type="text" v-model="product.code" id="" class="form form-control"
      v-bind:class="{ 'is-invalid': errors.code }" @blur="validate()">
    <span class="invalid-feedback">{{ errors.code }}</span>
    <label for="" class="form-label">Họ và Tên</label>
    <input type="text" name="name" id="" class="form form-control" v-model="product.name"
      v-bind:class="{ 'is-invalid': errors.name }" @blur="validate()">
    <span class="invalid-feedback">{{ errors.name }}</span>
    <label for="" class="form-label">Số Điện Thoại</label>
    <input type="text" name="sdt" id="" class="form form-control" v-model="product.sdt"
      v-bind:class="{ 'is-invalid': errors.sdt }" @blur="validate()">
    <span class="invalid-feedback">{{ errors.sdt }}</span>
    <label for="" class="form-label">Địa chỉ</label>
    <input type="text" name="address" id="" class="form form-control" v-model="product.address"
      v-bind:class="{ 'is-invalid': errors.address }" @blur="validate()">
    <span class="invalid-feedback">{{ errors.address }}</span>
    <button class="btn btn-primary">Add</button>
  </form>
</template>
<script>

export default {
  name: 'prduct',
  data() {
    return {
      errors: {
        code: '',
        name: '',
        sdt: '',
        address: '',
      },
      product: {
        code: '',
        name: '',
        sdt: '',
        address: '',
      }
    }
  },

  methods: {

    validate() {
      var check = true;
      this.errors = {
        code: '',
        name: '',
        sdt: '',
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

      } else if (!this.product.sdt) {
        this.errors.sdt = 'Số điện thoại không được để trống'
        check = false

      } else if (!this.isNumber(this.product.sdt)) {
        this.errors.sdt = 'SDT không hợp lệ'
      } else if (!this.product.address) {
        this.errors.name = 'Địa chỉ không được để trống'
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
        console.log(1);
      }

    }
  }
}
</script>
