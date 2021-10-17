import Echo from 'laravel-echo';
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
if (token){
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}else{
  console.error('CSRF token not found');
}

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true,
  // auth: {
  //   headers: {
  //     Authorization: 'Bearer ' + YourTokenLogin
  //   },
  // },
});