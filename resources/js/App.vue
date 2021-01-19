<template>
   <div>       
      <router-view></router-view>
   </div>  
</template>

<script>
export default {
    name: "App",


    mounted() {
        this.$router.push({
        path: "/dashboard",
        }).catch(()=>{});
    }
}
</script>