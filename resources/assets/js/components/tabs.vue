<template>
    <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li role="presentation" :class="{'active':tab.active}" v-for="tab in tablist" ><a :href="'#'+tab.name" :aria-controls="tab.name" role="tab" data-toggle="tab">{{tab.title}}</a></li>
    </ul>
    <div class="tab-content">
        <slot></slot>
    </div>
    </div>
</template>
<script>
    export default{
       data () {
          return {
            tablist: []
          }
      },
      created(){
        this.$children.forEach(c=>{
            this.tablist.push({
                    "name": c.name,
                    "title": c.title,
                    "active": c.active
                });
        })
      }
  }
</script>
