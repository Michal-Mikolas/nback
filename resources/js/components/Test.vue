<template>
    <!--
    #######
        #    ######  ####  #####
        #    #      #        #
        #    #####   ####    #
        #    #           #   #
        #    #      #    #   #
        #    ######  ####    #
    -->
    <div class="symbol">
        A
    </div>

    <div class="bottom-container">
        <button @click="sameBtnClicked()" class="btn btn-secondary w-full">Shodné s 1 předchozí</button>
    </div>
</template>


<script>
export default {
    data() {
        return {
        }
    },
    methods: {
        sameBtnClicked(){
            console.log('clicked!!!')
        }
    }
}
</script>
