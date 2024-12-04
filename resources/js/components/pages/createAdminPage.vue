<template>
    <div class="admin-wrapper">
      <h2>Create Admin</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <input
            type="text"
            id="name"
            v-model="adminData.name"
            placeholder="Enter admin name"
            required
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            id="password"
            v-model="adminData.password"
            placeholder="Enter password"
            required
          />
        </div>
        <button type="submit">Create Admin</button>
      </form>
    </div>
  </template>

<script>
export default {
  data() {
    return {
      adminData: {
        name: "",
        password: ""
      }
    };
  },
  methods: {
    submitForm() {
      // Logic to handle form submission
      console.log("Admin Created:", this.adminData);
      // Clear the form
      this.adminData.name = "";
      this.adminData.password = "";
    }
  }
};
</script>
<style scoped type="scss">
.admin-wrapper{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
}

input{
    padding: 4px 16px 4px 16px;
    width: auto;
}

</style>