<template>
    <h1 class="h1">Dotazník</h1>
    <p class="p">
        První částí výzkumu je krátký sociodemograický dotazník spojený se sebeposuzovací škálou úrovně znalosti druhého (nebo i dalšího) jazyka. Prosím, čtěte si veškeré otázky pečlivě, odpovídejte uvážlivě a pravdivě.
    </p>

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
                <span v-bind:class="['label-text', isEmailValid? 'text-success': 'text-warning']">Jaký je tvůj e-mail?</span>
            </label>
            <input v-model="user['email']" ref="inputEmail"
                v-bind:class="['input', 'input-bordered', 'w-full', isEmailValid? 'input-success': 'input-warning']"
                type="email" placeholder="jan.novak@email.cz" />

            <label class="label" v-if="(!isEmailValid && user['email'].length >= 5)">
                <span class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-frown"></i> Tohle nevypadá jako e-mail
                </span>
            </label>
        </div>

        <div class="form-control row w-full">
            <label class="label">
                <span v-bind:class="['label-text', isFullnameValid? 'text-success': 'text-warning']">Jak se jmenuješ?</span>
            </label>
            <input v-model="user['fullname']"
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
            <input v-model="user['passive_languages']"
                v-bind:class="['input', 'input-bordered', 'w-full', isPassiveLanguageValid? 'input-siccess': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isPassiveLanguageValid && user['passive_languages'] !== null)">
                <span v-if="user['passive_languages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě rozumíš alespoň jednomu jazyku
                </span>
                <span v-if="user['passive_languages'] > 43" class="label-text-alt text-warning">
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
            <input v-model="user['active_languages']"
            v-bind:class="['input', 'input-bordered', 'w-full', isActiveLanguageValid? 'input-siccess': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isActiveLanguageValid && user['active_languages'] !== null)">
                <span v-if="user['active_languages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě mluvíš alespoň jedním jazykem
                </span>
                <span v-if="user['active_languages'] > 43" class="label-text-alt text-warning">
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
                'email': '@',
                'fullname': '',
                'birthdate': null,
                'passive_languages': null,
                'active_languages': null,
            },
        };
    },
    methods: {
    },
    computed: {
        isValid(){
            return this.isEmailValid
                && this.isFullnameValid
                && this.isBirthdateValid
                && this.isActiveLanguageValid
                && this.isPassiveLanguageValid;
        },
        isEmailValid(){
            if (!this.user['email']) {
                return false;
            }
            if (!this.user['email'].match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                return false;
            }

            return true;
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
            if (this.user['passive_languages'] <= 0) {
                return false;
            }
            if (this.user['passive_languages'] > 43) {
                return false;
            }

            return true;
        },
        isActiveLanguageValid(){
            if (this.user['active_languages'] <= 0) {
                return false;
            }
            if (this.user['active_languages'] > 43) {
                return false;
            }

            return true;
        },
    },
    mounted(){
        this.$refs.inputEmail.focus();
    },
}
</script>
