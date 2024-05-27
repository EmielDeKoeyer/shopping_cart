<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

let email = ref(null)
let password = ref(null)

const store = useAuthStore()

const login = () => {
  const payload = {
    email: email.value,
    password: password.value
  }

  store.login(payload)
}
</script>

<template>
  <div>
    <div class="title">Sign in</div>
    <div class="form">
      <form @submit.prevent="login">
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="email" id="email" placeholder="test@example.com" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="password" id="password" placeholder="••••••••" required />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.title {
  margin-bottom: 20px;
}

form > div {
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 5px;
}
</style>
