<script setup>
import { ref } from 'vue'
import axios from '@/apis/axios'
import { useRouter } from 'vue-router'

let name = ref(null)
let email = ref(null)
let password = ref(null)

const router = useRouter()

const register = () => {
  let payload = {
    name: name.value,
    email: email.value,
    password: password.value
  }

  axios
    .post('register', payload)
    .then((response) => {
      let result = response.data
      if (!result.success) {
        console.log(result.message)
      }
      router.push('login')
    })
    .catch((error) => {
      console.log(error)
    })
}
</script>

<template>
  <div>
    <div class="title">Register</div>
    <div class="form">
      <form @submit.prevent="register">
        <div>
          <label for="name">Name</label>
          <input type="name" v-model="name" id="name" placeholder="Emiel" required />
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="email" id="email" placeholder="test@example.com" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="password" id="password" placeholder="••••••••" required />
        </div>
        <button type="submit">Register</button>
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
