<template>
   <div>       
      <router-view></router-view>
   </div>  
</template>

<script>
export default {
    name: "App",


    mounted() {
        if(this.$route.name == "dashboard") {
        this.$router.push({
        path: "/dashboard",
        }).catch(()=>{});
        }
    }
}
</script>