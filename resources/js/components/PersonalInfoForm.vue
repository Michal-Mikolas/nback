<template>
    <h1 class="h1">Nejdříve něco o tobě</h1>

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
                <span class="label-text">Jak se jmenuješ?</span>
            </label>
            <input type="text" placeholder="Jan Novák" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Kdy ses narodil/a?</span>
            </label>
            <input type="date" placeholder="31.12.1990" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Kolika jazykům rozumíš?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Kolika jazyky zvládneš mluvit?</span>
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
    },
}
</script>
