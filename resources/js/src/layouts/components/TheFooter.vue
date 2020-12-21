
<template functional>
    <footer class="the-footer flex-wrap justify-between" :class="classes">
        <p>
          <span>COPYRIGHT &copy;</span>
          <span>{{ new Date().getFullYear() }} </span>
          <a href="https://devmarcoestrada.com" target="_blank" rel="nofollow">devmarcoestrada</a>
          <span class="hidden sm:inline-block">, Todos los Derechos Reservados</span>
        </p>
    </footer>
</template>

<script>
export default {
  name: 'the-footer',
  props: {
    classes: {
      type: String
    }
  }
}
</script>
