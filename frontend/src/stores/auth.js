import axios from '@/apis/axios'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useCartStore } from '@/stores/cart'

export const useAuthStore = defineStore(
  'auth',
  () => {
    const router = useRouter()
    const cartStore = useCartStore()

    let user = ref(null)
    let token = ref(null)
    const isLoggedIn = computed(() => user.value !== null)

    function login(payload) {
      axios
        .post('login', payload)
        .then((response) => {
          let result = response.data
          if (!result.success) {
            console.log(result.message)
            return
          }

          this.user = result.user
          this.token = result.token
          cartStore.listCartItems()

          router.push('/')
        })
        .catch((error) => {
          console.log(error)
        })
    }

    function logout() {
      if (!isLoggedIn.value) {
        console.log('Not logged in')
        return
      }

      this.user = null
      this.token = null
      router.push('/')
    }

    function getHeaders() {
      return {
        headers: {
          Accept: 'application/json',
          Authorization: 'Bearer ' + token.value
        }
      }
    }

    return { user, token, login, logout, isLoggedIn, getHeaders }
  },
  {
    persist: true
  }
)
