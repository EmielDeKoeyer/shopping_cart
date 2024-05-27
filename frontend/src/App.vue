<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
const authStore = useAuthStore()
</script>

<template>
  <header>
    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <span class="right_side">
          <RouterLink v-if="!authStore.isLoggedIn" to="/login">Login</RouterLink>
          <RouterLink v-if="!authStore.isLoggedIn" to="/register">Register</RouterLink>
          <RouterLink v-if="authStore.isLoggedIn" to="/cart">Cart</RouterLink>
          <button v-if="authStore.isLoggedIn" @click="authStore.logout()">Log out</button>
        </span>
      </nav>
    </div>
  </header>

  <main>
    <RouterView />
  </main>
</template>

<style scoped>
header {
  position: sticky;
  top: 0;
  z-index: 1000;
  background-color: #585151;
  height: 50px;
  padding: 0 20px;
}

nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  font-size: large;
  font-weight: bold;
}

.right_side {
  display: flex;
  gap: 10px;
}

.wrapper,
nav {
  height: 50px;
}
</style>
