<template>
   <div>       
      <router-view></router-view>
   </div>  
</template>

<script>
export default {
    name: "App",


    mounted() {
        if(this.$route.path == "/dashboard" || this.$route.path == "/") {
        this.$router.push({ 
        path: "/dashboard",
        }).catch(()=>{});
        }
    }
}
</script>