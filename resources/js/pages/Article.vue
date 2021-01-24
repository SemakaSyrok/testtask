<template>
  <div class="container px-4">
    <article
        v-if="article"
        class="blog-post border m-2 p-2"
    >
      <h2 class="blog-post-title">{{ article.slug }}</h2>

      <img :src="article.image" alt="">

      <div class="container row mt-2">
        <div class="col-3">
          <button class="btn btn-primary blog-post-meta" @click="like">Likes {{ article.likes }}</button>
        </div>
        <div class="col-3">
          <p class="blog-post-meta">Views {{ article.views }}</p>
        </div>
        <div class="col-12 p-2">
          {{ article.text }}
        </div>
      </div>
    </article>

    <hr>

    <div class="comments container p-2 ">
      <h3>Коментарии</h3>
      <div
          v-if="article.comments.length > 0"
          class="comment col-6 p-2 mt-2 border"
          v-for="comment in article.comments"
          :key="comment.id"
      >
        <h5>{{ comment.subject }}</h5>
        <p>{{ comment.text }}</p>
      </div>
    </div>

    <hr>

    <div class="container row my-2 pt-5">
      <div class="p-4" v-if="!loading && !commented">
        <label class="form-label" for="subject">Subject</label><br>
        <input class="form-control" name="subject" id="subject" v-model="form.subject" @focus="errors = []"><br>
        <label class="form-label" for="text">Text</label><br>
        <textarea
            class="form-control"
            name="text"
            id="text"
            cols="30"
            rows="4"
            v-model="form.text"
            @focus="errors = []"
        ></textarea><br>
        <div class="alert alert-danger" v-if="errors.length > 0">
          <ul>
            <li v-for="error in formatedErrors">
              {{ error }}
            </li>
          </ul>
        </div>
        <br>
        <button class="btn btn-primary" @click="comment">Оставить коментарий</button>
      </div>
      <div class="p-4" v-else>
        <p v-if="loading">
          Загрузка...
        </p>
        <p v-else>
          Коментарий оставлен
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Article",
  data: () => {
    return {
      article: null,
      loading: false,
      errors: [],
      commented: false,
      form: {
        subject: '',
        text: ''
      }
    }
  },
  computed: {
    formatedErrors() {
      return this.errors.map(error => error.pop());
    }
  },
  methods: {
    like() {
      axios.get('/api/articles/' + this.$route.params.slug + '/like').then(res => {
        this.article.likes = res.data;
      })
    },
    comment() {
      this.loading = true;
      axios.post('/api/articles/' + this.$route.params.slug + '/comment', {
        post_id: this.article.id,
        text: this.form.text,
        subject: this.form.subject
      }).then(res => {
        this.article.comments.push(res.data)
        this.commented = true;
      }).catch(err => {
        if (err.response.data.errors) {
          this.errors = Object.values(err.response.data.errors)
        }
      }).finally(() => {
        this.loading = false;
      })
    }
  },
  created() {
    axios.get('/api/articles/' + this.$route.params.slug).then(res => {
      this.article = res.data.data;
    })
    let ctx = this;
    setTimeout(function () {
      axios.get('/api/articles/' + ctx.$route.params.slug + '/view').then(res => {
        ctx.article.views = res.data;
      })
    }, 5000)
  }
}
</script>

<style scoped>

</style>