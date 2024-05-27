import { defineStore } from 'pinia'
import { useAuthStore } from './auth'
import { ref, computed } from 'vue'
import axios from 'axios'

export const useCartStore = defineStore('cart', () => {
  let cart = ref([])

  const authStore = useAuthStore()

  function listCartItems() {
    if (!authStore.isLoggedIn) {
      return
    }
    console.log('Listing cart items')

    axios
      .get(import.meta.env.VITE_BASE_URL+'/api/cart', authStore.getHeaders())
      .then((response) => {
        console.log(response)
        this.cart = response.data.cart
      })
      .catch((error) => {
        console.log(error)
      })
  }

  function addProducts(productId, amount) {
    if (!authStore.isLoggedIn) {
      console.log('User not logged in')
      return
    }

    let payload = {
      product_id: productId,
      user_id: authStore.user.id,
      amount: amount
    }

    axios
      .post(import.meta.env.VITE_BASE_URL+'/api/cart/update', payload, authStore.getHeaders())
      .then((response) => {
        if (!response.data.success) {
          console.log(response.data.message)
          return
        }
        console.log('Product added to cart')
      })
      .then(() => {
        this.listCartItems()
      })
      .catch((error) => {
        console.log(error)
      })
  }

  const cartTotal = computed(() => {
    return cart.value.reduce((total, item) => {
      return total + item.price * item.amount
    }, 0)
  })

  return {
    cart,
    cartTotal,
    addProducts,
    listCartItems
  }
})
