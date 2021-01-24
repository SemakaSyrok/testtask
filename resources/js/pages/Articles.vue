<template>
  <main class="container">
    <div class="row">
      <div class="col-md-8">

        <article
            v-for="(article, idx) in articles"
            class="blog-post border m-2 p-2"
            :key="idx"
        >
          <h2 class="blog-post-title">{{ article.slug }}</h2>

          <img :src="article.image" alt="">

          <div class="container-fluid row">
            <div class="col-6">
              <p class="blog-post-meta">Likes {{ article.likes }}</p>
            </div>
            <div class="col-6">
              <p class="blog-post-meta">Views {{ article.views }}</p>
            </div>
            <div class="col-12 p-2">
              <router-link :to="'/articles/' + article.slug">
                <button class="btn btn-primary">Смотреть</button>
              </router-link>
            </div>
          </div>
        </article>

      </div>
    </div>

    <div class="col-md-8">
      <button class="btn btn-primary" v-if="prev" @click="loadData(prev)">
        Prev
      </button>
      <button class="btn btn-primary" v-if="next" @click="loadData(next)">
        Next
      </button>
    </div>

  </main>
</template>

<script>
export default {
  name: "Articles",
  data: () => {
    return {
      articles: [],
      next: null,
      prev: null
    }
  },
  methods: {
    loadData(data = null) {
      const link = data ? data : '/api/articles';
      axios.get(link).then(res => {
        this.articles = res.data.data.articles
        this.next = res.data.links.next;
        this.prev = res.data.links.prev;
      })
    }
  },
  created() {
    this.loadData();
  },
}
</script>

<style scoped>

</style>