<template>
  <div class="content-center	">
    <div class="w-1/3 p-3 content-center	">
      <div class="relative">
        <form ref="subForm" action="#">
          <input type="email" v-model="email"
                 class="bg-white h-14 w-full px-4 pr-20 rounded-md focus:outline-none hover:cursor-pointer" required
                 name="email">
          <button @click="subscribe" type="submit"
                  class="h-10 rounded bg-black absolute top-2 text-sm right-2 px-3 text-white hover:bg-gray-900 ">
            Subscribe Now
          </button>
        </form>
      </div>
    </div>
    <div class="grid md:gap-4 md:grid-cols-3">
      <div v-for="post in posts"
           class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
          <img class="rounded-t-lg" :src="post.image_url" alt=""/>
        </a>
        <div class="p-5">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              {{ post.title }}
            </h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{ post.description }}
          </p>
          <a href="#"
             class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Read more
            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {

  props: ['websiteId'],
  data: function () {
    return {
      posts: {},
      email: '',
    }
  },
  mounted() {
    window.axios.get(`/api/v1/websites/${this.websiteId}/posts`).then(res => {
      this.posts = res.data.posts
    })
  },
  methods: {
    subscribe: function (e) {
      e.preventDefault();
      let comp = this;
      if (!this.$refs.subForm.checkValidity()) {
        return;
      }
      window.axios.post(`/api/v1/websites/${this.websiteId}/subscribe`, {
        email: this.email,
      }).then(res => {
        window.Vue.swal('Thanks for subscribing!');
        comp.email = '';
      }).catch(function (error) {
        let status = error.response.status;
        if (status === 422) {
          window.Vue.swal(error.response.data.message);
        }
        window.Vue.swal('Something went wrong');
      })

    }
  }
}
</script>
