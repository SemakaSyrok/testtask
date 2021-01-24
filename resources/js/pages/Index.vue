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
    </div><!-- /.row -->

  </main>
</template>

<script>
export default {
  name: "Index",
  data: () => {
    return {
      articles: []
    }
  },
  created() {
    axios.get('/api/main').then(res => {
      this.articles = res.data.data.articles;
    })
  }
}
</script>

<style scoped>

</style>