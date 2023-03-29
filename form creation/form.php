<template>
  <div>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="firstname">First Name*</label>
        <input type="text" class="form-control" id="firstname" v-model="firstname" required>
      </div>
      <div class="form-group">
        <label for="lastname">Last Name*</label>
        <input type="text" class="form-control" id="lastname" v-model="lastname" required>
      </div>
      <div class="form-group">
        <label for="street">Street</label>
        <input type="text" class="form-control" id="street" v-model="street">
      </div>
      <div class="form-group">
        <label for="housenumber">House Number</label>
        <input type="text" class="form-control" id="housenumber" v-model="housenumber">
      </div>
      <div class="form-group">
        <label for="zipcode">Zip Code</label>
        <input type="text" class="form-control" id="zipcode" v-model="zipcode">
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" v-model="city">
      </div>
      <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" class="form-control" id="email" v-model="email" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      firstname: '',
      lastname: '',
      street: '',
      housenumber: '',
      zipcode: '',
      city: '',
      email: '',
    }
  },
  methods: {
    submitForm() {
      const data = {
        firstname: this.firstname,
        lastname: this.lastname,
        street: this.street,
        housenumber: this.housenumber,
        zipcode: this.zipcode,
        city: this.city,
        email: this.email,
      };
      axios.post('/api/contacts', data)
        .then(response => {
          console.log(response.data);
          alert('Contact information has been saved successfully!');
        })
        .catch(error => {
          console.log(error.response.data);
          alert('Error occurred while saving contact information!');
        });
    }
  }
}
</script>
