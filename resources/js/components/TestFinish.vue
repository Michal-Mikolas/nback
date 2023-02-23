<template>
    <h1 class="h1">Poslední otázka!</h1>
    <p class="p">
        Vyrušilo vás během testu něco? Mohlo jít například o člověka, který nečekaně vstoupil do místnosti a&nbsp;vyžadoval vaši pozornost, nebo třeba o&nbsp;technický problém s&nbsp;internetem, aplikací apod.
    </p>

    <div class="grid grid-cols-2 gap-4 mt-8">
        <div>
            <button @click="interruption = true; $emit('change');"
                v-bind:class="['btn', 'btn-lg', 'w-full', 'shadow-lg', 'btn-warning',
                    interruption !== true? 'btn-outline': '',
                    interruption === false? 'opacity-50': '',
                ]"
            >
                <i class="fa-solid fa-face-surprise pr-1"></i> Ano <br/>
                <small>něco mě vyrušilo</small>
            </button>
        </div>
        <div>
            <button @click="interruption = false; $emit('change');"
                v-bind:class="['btn', 'btn-lg', 'w-full', 'shadow-lg', 'btn-success',
                    interruption !== false? 'btn-outline': '',
                    interruption === true? 'opacity-50': '',
                ]"
            >
                <i class="fa-solid fa-thumbs-up pr-1"></i> Ne <br/>
                <small>vše bylo v pořádku</small>
            </button>
        </div>
    </div>

    <div v-if="interruption" class="form-control row w-full my-4">
        <label class="label">
            <span class="label-text">
                Zde se o problému můžete rozepsat, pokud chcete:
            </span>
        </label>
        <textarea v-model="interruption_reason" class="textarea textarea-md textarea-bordered w-full" />
    </div>
</template>


<script>
export default {
    emits: ['change'],
    data() {
        return {
            'interruption': null,
            'interruption_reason': null,
        };
    },
    methods: {
    },
    computed: {
    },
}
</script>
