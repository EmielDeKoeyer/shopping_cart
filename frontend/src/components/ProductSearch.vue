<script setup>
import { ref } from 'vue'

const emit = defineEmits(['search'])
let searchKey = ref('')

function search() {
  emit('search', searchKey.value)
}
</script>

<template>
  <div id="product_search">
    <form @submit.prevent="search">
      <div class="search">
        <input
          type="search"
          v-model="searchKey"
          placeholder="Search"
          @input="search"
        />

        <button type="submit">Search</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
#product_search {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}
</style>
