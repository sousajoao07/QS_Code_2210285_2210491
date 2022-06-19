<template>
<div class="main">
    <welcome></welcome>
</div>       
</template>
<script>
export default {
    
     data() {
        return {
        }
     },
     methods:{

     },
     mounted(){
        console.log(this.$store.getters.getExpiration);
        console.log(this.$store.getters.getTokenType);
        console.log(this.$store.getters.getToken);
        console.log(this.$store.state.user);
    }
   
}
</script>
