<template>
    <h1 class="h1">Nejdříve něco o tobě</h1>

    <form @input="$emit('change')" action="" class="flex-col">
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
                <span v-bind:class="['label-text', isFullnameValid? 'text-success': 'text-warning']">Jak se jmenuješ?</span>
            </label>
            <input v-model="user['fullname']" ref="inputFullname"
                v-bind:class="['input', 'input-bordered', 'w-full', isFullnameValid? 'input-success': 'input-warning']"
                type="text" placeholder="Jan Novák" />

            <label class="label" v-if="!isFullnameValid && user['fullname'].length >= 3">
                <span class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-smile"></i> Vyplň prosím jméno i příjmení
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isBirthdateValid? 'text-success': 'text-warning']">Kdy ses narodil/a?</span>
            </label>
            <input v-model="user['birthdate']"
                v-bind:class="['input', 'input-bordered', 'w-full', isBirthdateValid? 'input-success': 'input-warning']"
                type="date" placeholder="31.12.1990" />

            <label class="label" v-if="(!isBirthdateValid && user['birthdate'])">
                <span class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-smile-wink"></i> Nee, tehdy ses určitě nenarodil/a
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isPassiveLanguageValid? 'text-success': 'text-warning']">
                    Kolika jazykům rozumíš?
                    <small class="small block opacity-75">(Češtinu a Slovenštinu berme jako jeden jazyk)</small>
                </span>
            </label>
            <input v-model="user['passiveLanguages']"
                v-bind:class="['input', 'input-bordered', 'w-full', isPassiveLanguageValid? 'input-siccess': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isPassiveLanguageValid && user['passiveLanguages'] !== null)">
                <span v-if="user['passiveLanguages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě rozumíš alespoň jednomu jazyku
                </span>
                <span v-if="user['passiveLanguages'] > 43" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tears"></i> Nevěřím, to je víc než Guinessův rekord
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isActiveLanguageValid? 'text-success': 'text-warning']">
                    Kolika jazyky zvládneš mluvit?
                    <small class="small block opacity-75">(Češtinu a Slovenštinu berme jako jeden jazyk)</small>
                </span>
            </label>
            <input v-model="user['activeLanguages']"
            v-bind:class="['input', 'input-bordered', 'w-full', isActiveLanguageValid? 'input-siccess': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isActiveLanguageValid && user['activeLanguages'] !== null)">
                <span v-if="user['activeLanguages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě mluvíš alespoň jedním jazykem
                </span>
                <span v-if="user['activeLanguages'] > 43" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tears"></i> Nevěřím, to je víc než Guinessův rekord
                </span>
            </label>
        </div>
    </form>

</template>


<script>
export default {
    emits: ['change'],
    data() {
        return {
            'user': {
                'fullname': '',
                'birthdate': null,
                'passiveLanguages': null,
                'activeLanguages': null,
            },
        };
    },
    methods: {
    },
    computed: {
        isValid(){
            return this.isFullnameValid
                && this.isBirthdateValid
                && this.isActiveLanguageValid
                && this.isPassiveLanguageValid;
        },
        isFullnameValid(){
            if (!this.user['fullname']) {
                return false;
            }
            if (!this.user['fullname'].match(/^[^\s].{2,} .{2,}[^\s].*$/)) {
                return false;
            }

            return true;
        },
        isBirthdateValid(){
            if (!this.user['birthdate']) {
                return false;
            }

            var minDate = dayjs(new Date()).subtract(120, 'years').toISOString().split('T')[0];
            var maxDate = dayjs(new Date()).subtract(3, 'years').toISOString().split('T')[0];

            if (this.user['birthdate'] < minDate) {
                return false;
            }
            if (this.user['birthdate'] > maxDate) {
                return false;
            }

            return true;
        },
        isPassiveLanguageValid(){
            if (this.user['passiveLanguages'] <= 0) {
                return false;
            }
            if (this.user['passiveLanguages'] > 43) {
                return false;
            }

            return true;
        },
        isActiveLanguageValid(){
            if (this.user['activeLanguages'] <= 0) {
                return false;
            }
            if (this.user['activeLanguages'] > 43) {
                return false;
            }

            return true;
        },
    },
    mounted(){
        this.$refs.inputFullname.focus();
    },
}
</script>
