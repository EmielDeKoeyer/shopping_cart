<script setup>
import { useCartStore } from '@/stores/cart'
import { useAuthStore } from '@/stores/auth'
import { ref, onMounted } from 'vue'

const authStore = useAuthStore()
const cartStore = useCartStore()

const props = defineProps({
  product: Object,
  text: String
})

onMounted(() => {
  if (props.product.amount) {
    amount.value = props.product.amount
  }
})

const amount = ref(1)

async function addProducts() {
  await cartStore.addProducts(props.product.id, amount.value)
}
</script>

<template>
  <div class="item_detail">
    <img class="" :src="props.product.url" alt="product image" />
    <div class="details">
      <div>
        <div>
          {{ props.product.title }}
        </div>
        <div>price: €{{ props.product.price }}</div>
      </div>

      <div v-if="authStore.isLoggedIn">
        <div>
          amount:
          <input type="number" v-model="amount" />
        </div>
        <button @click.prevent="addProducts">{{ props.text }}</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.details {
  display: flex;
  justify-content: space-between;
}

.item_detail {
  margin-bottom: 50px;
}

button {
  margin-top: 10px;
  float: right;
}
</style>
