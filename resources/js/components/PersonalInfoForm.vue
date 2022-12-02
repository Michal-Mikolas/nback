<template>
    <form action="" class="flex-col">
        <!--
        #######
        #        ####  #####  #    #
        #       #    # #    # ##  ##
        #####   #    # #    # # ## #
        #       #    # #####  #    #
        #       #    # #   #  #    #
        #        ####  #    # #    #
        -->
        <div class="form-control row w-full">
            <label class="label">
                <span class="label-text">What is your name?</span>
            </label>
            <input type="text" placeholder="John Doe" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">What is your birthdate?</span>
            </label>
            <input type="date" placeholder="31.12.1990" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">How many languages do you understand?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">How many languages do you speak?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full" />
        </div>
    </form>

</template>


<script>
export default {
    data() {
        return {
        }
    },
    methods: {
    }
}
</script>
