<template>
    <vnode :node="loadSVG()" />
</template>

<script>
    export default {
      props: {
        name: {
          type: String,
          required: true
        }
      },
      components: {
        'vnode': {
          functional: true,
            render(h, context) {
              return context.props.node
            }
        }
      },
      computed: {
        SVGLoader() {
            return () => require(`../../svg/${this.name}.svg`)
        }
      },
      methods: {
        loadSVG() {
          return this.SVGLoader().render.call(this);
        }
      }
    }
</script>
