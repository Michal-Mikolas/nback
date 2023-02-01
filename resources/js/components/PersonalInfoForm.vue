<template>
    <h1 class="h1">Dotazník</h1>
    <p class="p">
        První částí výzkumu je krátký sociodemograický dotazník spojený se sebeposuzovací škálou úrovně znalosti druhého (nebo i&nbsp;dalšího) jazyka. Prosím, čtěte si veškeré otázky pečlivě, odpovídejte uvážlivě a pravdivě.
    </p>

    <form @input="$emit('change')" @change="$emit('change')" action="" class="flex-col">
        <!--
        #######
        #        ####  #####  #    #
        #       #    # #    # ##  ##
        #####   #    # #    # # ## #
        #       #    # #####  #    #
        #       #    # #   #  #    #
        #        ####  #    # #    #
        -->

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isLangLevelValid? 'text-success': 'text-warning']">
                    Na této škále zaznačte svůj subjektivní názor na to, na jaké úrovni si vedete ve znalosti nejvíce rozvinutého dalšího jazyka
                    <small class="small block text-secondary-content">
                        A = základní uživatel <br/>
                        B = samostatný uživatel <br/>
                        C = zkušený uživatel
                    </small>
                </span>
            </label>
            <input v-model="user['lang_level']" type="range" min="0" max="6" step="1"
                v-bind:class="['range', 'w-full', 'range-success']"
                />
            <div class="w-full flex justify-between text-xs px-2">
                <button @click.prevent="user['lang_level'] = 0">A0</button>
                <button @click.prevent="user['lang_level'] = 1">A1</button>
                <button @click.prevent="user['lang_level'] = 2">A2</button>
                <button @click.prevent="user['lang_level'] = 3">B1</button>
                <button @click.prevent="user['lang_level'] = 4">B2</button>
                <button @click.prevent="user['lang_level'] = 5">C1</button>
                <button @click.prevent="user['lang_level'] = 6">C2</button>
            </div>

            <span v-bind:class="[
                'inline-block', 'mt-2', 'h-0', 'w-0', 'border-x-8', 'border-x-transparent', 'border-b-[9px]', 'border-b-success', 'relative', 'top-[1px]',
                user['lang_level'] == 0? 'ml-[2%]': '',
                user['lang_level'] == 1? 'ml-[17%]': '',
                user['lang_level'] == 2? 'ml-[33%]': '',
                user['lang_level'] == 3? 'ml-[48%]': '',
                user['lang_level'] == 4? 'ml-[64%]': '',
                user['lang_level'] == 5? 'ml-[79%]': '',
                user['lang_level'] == 6? 'ml-[94%]': '',
            ]"></span>
            <span class="label-text-alt p-2 bg-success text-success-content rounded-lg">

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 0">
<b>A0 = Starter / begginer = úplný začátečník</b>

Žádná či velice malá znalost druhého jazyka.

-	Druhý jazyk nikdy nestudoval
-	Pasivně umí jen pár slovíček
-	Umí se představit v jedné nebo dvou větách
-	Poznávat výslovnost</pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 1">
<b>A1 = začátečník</b>

Rozumí každodenním výrazům a zcela základním frázím, jejichž cílem je vyhovět konkrétním potřebám, a umí tyto výrazy a fráze používat. Uživatel umí představit sebe a ostatní a klást jednoduché otázky týkající se informací osobního rázu, např. o místě, kde žije, o lidech, které zná, a věcech, jež vlastní.

A)	<b>Poslech a mluva</b> – dokáže se jednoduchým způsobem domluvit, mluví-li partner pomalu a jasně. Umí se zeptat na jednoduché otázky, např. kde je obchod, kolik je hodin …
B)	<b>Čtení a psaní</b> – dokáže přečíst a napsat text na pohledu z dovolené.</pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 2">
<b>A2 = mírně pokročilí</b>

Rozumí větám a často používaným výrazům vztahujícím se k oblastem, které se jej bezprostředně týkají (např. základní informace o něm/jí, jeho/její rodině, o nakupování, bezprostředním okolí a o zaměstnání). Dokáže komunikovat o známých a běžných skutečnostech, jež vyžadují jednoduchou a přímou výměnu informací. Umí jednoduchým způsobem popsat svou vlastní rodinu, bezprostřední okolí a záležitosti týkající se jeho/jejích nejnaléhavějších potřeb.

A)	<b>Poslech a mluva</b> - poměrně plynulý mluvený projev o jednoduchých tématech
B)	<b>Čtení a psaní</b> – schopnost komunikovat slovem i písmem o jednoduchých konverzačních tématech</pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 3">
<b>B1 = středně pokročilí</b>

Zvládá většinu konverzačních situací, které mohou nastat při cestování v místě, kde se hovoří danou řečí. Bez přípravy dokáže konverzovat na téma, které je běžné, zajímavé nebo souvisí s každodenní realitou (např. rodina, zájmy, práce, cestování a aktuální události).

A)	<b>Poslech a mluva</b> - dokáže porozumět přímým pokynům nebo veřejným oznámením. Dokáže limitovaným způsobem vyjadřovat své názory na abstraktní / kulturní témata nebo nabídnout radu v oblasti, které rozumí. Dokáže dobře přepínat mezi formálním a neformálním jazykem.
B)	<b>Čtení a psaní</b> - Dokáže porozumět běžným nařízením a předpisům. Dokáže napsat dopis nebo vytvořit poznámky ohledně známých nebo předvídatelných záležitostí. Bez problémů vyjádří svůj názor na aktuální situaci, hovoří plynule a na otázky odpovídá spontánně.</pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 4">
<b>B2 = vyšší středně pokročilí</b>

Umí se vyjadřovat plynule a spontánně bez výrazného pátrání po vhodných výrazech. Dokáže pružně a efektivně užívat jazyk pro účely společenské i profesionální. Dokáže přesně formulovat své myšlenky a názory a konfrontovat je s myšlenkami a názory ostatních mluvčích.

A)	<b>Poslech a mluva</b> - dokáže nejen vést rozhovor na známé téma, ale také zvládne udržet krok s konverzací na širší škále témat. Jakožto turista v cizí zemi dokáže požádat o ujasnění nebo lepší vysvětlení, a pravděpodobně porozumí odpovědi. V zaměstnání se dokáže zeptat na faktické informace a porozumět odpovědi. Dokáže vyjádřit svůj názor, a odprezentovat argumenty v limitovaném rozsahu. V roli studenta dokáže zodpovědět věcné otázky. Dokáže zkontrolovat, zda rozumí všem pokynům. Nedělá mu problém číst v cizím jazyce odborné články, sledovat cizojazyčné filmy či rozumět vysílaným zprávám na zahraničních stanicích.
B)	<b>Čtení a psaní</b> - umí vyhledávat v textu relevantní informace. Dokáže si vést poznámky zatímco někdo hovoří nebo napsat dopis obsahující nadstandardní požadavky. Dokáže rychle a s dobrým porozuměním přečíst informativní médium. Zvládá vyjádřit názory a obhájit si je. Umí napsat jednoduchou zprávu faktografické povahy ve které hodnotí, radí apod. Prezentuje názory s obsahem odborných výrazů. </pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 5">
<b>C1 = pokročilý</b>

Rozumí širokému rejstříku náročných a dlouhých textů a rozpozná implicitní významy textů. Umí se plynule a pohotově vyjadřovat bez zjevného hledání výrazů. Umí jazyk užívat pružně a efektivně pro společenské, akademické a profesní účely.

A)	<b>Poslech a mluva</b> - dokáže efektivně přispět na schůzkách a seminářích v rámci své pracovní oblasti a také udržet krok s konverzací s dobrou mírou plynulosti, používá i abstraktní výrazy. Rozumí celému spektru různých odborných i publicistických textů. Porozumí i osobám mluvícím netypickým dialektem.
B)	<b>Čtení a psaní</b> - dokáže číst dostatečně rychle na to se vypořádat s akademickým kurzem, a dokáže rozumně a přesně vyjadřovat své připomínky na pracovních schůzkách nebo napsat kus práce která vyjadřuje schopnost komunikovat. V psaném jazyce rozumí nejrůznějším idiomům a bez problémů chápe odbornou literaturu. Zvládá sepsat odborné texty bez gramatických chyb, které obsahují neobvyklé slovní spojení.</pre>

                <pre class="whitespace-pre-wrap" v-if="user['lang_level'] == 6">
<b>C2 = expert / jazyk na úrovni rodilého mluvčího</b>

Snadno rozumí téměř všemu, co si vyslechne nebo přečte. Dokáže shrnout informace z různých mluvených a psaných zdrojů a přitom dokáže přednést polemiku a vysvětlení v logicky uspořádané podobě.

A)	<b>Poslech a mluva</b> - rozumí každému rozhovoru, který v cizím jazyce zaslechne. Dokáže porozumět i dialogům a nářečím. Chápe slangové výrazy i odbornou terminologii.
B)	<b>Čtení a psaní</b> - má dobré kritické myšlení, dokáže proto bez problémů hledat chyby v odborných textech a lidé jej považují za rodilého mluvčího.</pre>

            </span>
        </div>

        <div class="form-control row w-full">
            <label class="label">
                <span v-bind:class="['label-text', isEmailValid? 'text-success': 'text-warning']">
                    Jaký je Váš e-mail?
                    <small class="small block text-secondary-content">
                        E-mail bude použit výhradně pro účely zaslání výsledku testu po dokončení výzkumu. Neobjeví se v bakalářské práci, ani ho nepředám třetí osobě.
                    </small>
                </span>
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

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isBirthdateValid? 'text-success': 'text-warning']">
                    Uveďte prosím své datum narození
                </span>
            </label>
            <input v-model="user['birthdate']"
                v-bind:class="['input', 'input-bordered', 'w-full', isBirthdateValid? 'input-success': 'input-warning']"
                type="date" placeholder="31.12.1990" />

            <label class="label" v-if="(!isBirthdateValid && user['birthdate'])">
                <span class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-smile-wink"></i> Tehdy jste se určitě nenarodil/a
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isEducationValid? 'text-success': 'text-warning']">
                    Jaký je Váš nejvyšší dosažený stupeň vzdělání?
                </span>
            </label>
            <select v-model="user['education']"
                v-bind:class="['select', 'select-bordered', 'w-full', isEducationValid? 'select-success': 'select-warning']" >
                <option disabled selected></option>
                <option value="0">Žádné / nedokončené základní</option>
                <option value="1">Základní</option>
                <option value="2">Střední s výučním listem</option>
                <option value="3">Střední s maturitou</option>
                <option value="4">Vyšší odborné - titul DiS.</option>
                <option value="5">Vysokoškolské - bakalářský stupeň</option>
                <option value="6">Vysokoškolské - magisterský stupeň</option>
                <option value="7">Vysokoškolské - doktorský stupeň</option>
            </select>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isPassiveLanguageValid? 'text-success': 'text-warning']">
                    Kolika jazykům rozumíte?
                    <small class="small block text-secondary-content">Češtinu a Slovenštinu berme jako jeden jazyk.</small>
                </span>
            </label>
            <input v-model="user['passive_languages']"
                v-bind:class="['input', 'input-bordered', 'w-full', isPassiveLanguageValid? 'input-success': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isPassiveLanguageValid && user['passive_languages'] !== null)">
                <span v-if="user['passive_languages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě rozumíte alespoň jednomu jazyku
                </span>
                <span v-if="user['passive_languages'] > 43" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tears"></i> Nevěřím, to je víc než Guinessův rekord
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isActiveLanguageValid? 'text-success': 'text-warning']">
                    Kolika jazyky zvládnete mluvit?
                    <small class="small block text-secondary-content">Češtinu a Slovenštinu berme jako jeden jazyk.</small>
                </span>
            </label>
            <input v-model="user['active_languages']"
                v-bind:class="['input', 'input-bordered', 'w-full', isActiveLanguageValid? 'input-success': 'input-warning']"
                min="0" step="1.0" type="number" placeholder="" />

            <label class="label" v-if="(!isActiveLanguageValid && user['active_languages'] !== null)">
                <span v-if="user['active_languages'] <= 0" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i> Určitě mluvíte alespoň jedním jazykem
                </span>
                <span v-if="user['active_languages'] > 43" class="label-text-alt text-warning">
                    <i class="fa-regular fa-face-grin-tears"></i> Nevěřím, to je víc než Guinessův rekord
                </span>
            </label>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span v-bind:class="['label-text', isDisorderValid? 'text-success': 'text-warning']">
                    Máte diagnostikováno ADD, ADHD, či poruchu pozornosti?
                </span>
            </label>
            <select v-model="user['disorder']"
                v-bind:class="['select', 'select-bordered', 'w-full', isDisorderValid? 'select-success': 'select-warning']"
                >
                <option disabled selected></option>
                <option value="1">Ano</option>
                <option value="0">Ne</option>
            </select>
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
                'birthdate': null,
                'disorder': null,
                'education': null,
                'passive_languages': null,
                'active_languages': null,
                'lang_level': 0,
            },
        };
    },
    methods: {
    },
    computed: {
        isValid(){
            return this.isLangLevelValid
                && this.isEmailValid
                && this.isBirthdateValid
                && this.isEducationValid
                && this.isActiveLanguageValid
                && this.isPassiveLanguageValid
                && this.isDisorderValid;
        },
        isLangLevelValid(){
            if (this.user['lang_level'] === null) {
                return false;
            }

            return true;
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
        isEducationValid(){
            if (this.user['education'] === null) {
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
        isDisorderValid(){
            if (this.user['disorder'] === null) {
                return false;
            }

            return true;
        },
    },
    mounted(){
        // this.$refs.inputEmail.focus();
    },
}
</script>
