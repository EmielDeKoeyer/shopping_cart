import axios from 'axios'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const base_axios = axios.create({
  // Base url of server side rest apis
  baseURL: import.meta.env.VITE_BASE_URL+'/api/',
  headers: {
    Accept: 'application/json'
  }
})

export default base_axios
