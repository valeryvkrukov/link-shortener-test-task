<template>
  <div class="container">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Link Shortener</h2>
    <p class="mt-2 text-center text-sm text-red-600" v-if="error !== ''">
      {{ error }}
    </p>
    <p class="mt-2 text-center text-sm" v-if="shortenedLink !== ''">
      Shortened URL:
      <a :href="shortenedLink" class="font-medium text-indigo-600 hover:text-indigo-500">
        {{ shortenedLink }}
      </a>
    </p>
    <form class="mt-8 space-y-6" @submit.prevent="makeLink">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="original_url" class="sr-only">URL Address</label>
          <input id="original_url" type="text" autocomplete="off" placeholder="URL Address" v-model="form.original_url" required autofocus class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
      </div>
      <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create shortened link
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import useShortenedLink from '../composables/link';
import { reactive } from 'vue';
import { onMounted } from 'vue';

export default {
  name: 'MainForm',
  setup() {
    const form = reactive({
      original_url: ''
    });
    const { error, shortenedLink, storeLink } = useShortenedLink();

    const makeLink = async () => {
      await storeLink({ ...form });
    };

    return {
      form,
      error,
      shortenedLink,
      makeLink
    };
  }
}

/*export default {
  name: "MainForm",
  data: () => ({
    current_host: location.protocol + '//' + location.host + location.pathname,
    original_url: null,
    shortened_url: 'stguj54e5u6hd',
    error: null
  }),
  setup: () => ({
    //
  }),
  methods: {
    createLink(e) {
      e.preventDefault();
      if (this.original_url.length > 5) {
        axios.post('/shortener_form').then(response => {

        });
      } else {
        this.error = 'Minimal URL length 5 is symbols';
      }
    }
  }
}*/
</script>

<style scoped>

</style>