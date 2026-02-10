# Paměťový test N-Back

Tato webová aplikace je interaktivní nástroj určený k testování a měření **pracovní paměti (Working Memory, WM)** pomocí metody **N-Back**. Původně vznikla jako součást bakalářské práce, jejímž cílem bylo sbírat data a porovnávat výsledky napříč populací.
Uživatelé si mohou otestovat paměť, okamžitě vidět své výsledky a porovnat svůj výkon s ostatními účastníky.

## 🧠 Co je N-Back test?

**N-back** je typ paměťového testu, který se často používá v kognitivní neurovědě ke zkoumání pracovní paměti a její kapacity.
Testovanému je postupně zobrazována sekvence podnětů (v tomto případě písmen) a jeho úkolem je označit **moment**, kdy aktuální podnět odpovídá tomu, který se objevil **N kroků zpět** v posloupnosti.

## Demo 
Aplikaci si můžete vyzkoušet online na [lea.michalm.cz](https://lea.michalm.cz).

## ✨ Funkce aplikace

### 🎮 Interaktivní testování
- **Postupně se zvyšující obtížnost**: Test je navržen tak, aby plynule přecházel od jednodušších úloh ke složitějším.
    - **Zkušební kola**: Uživatelé začínají s 1-back a 2-back testem, aby pochopili princip. V případě chyb dostávají okamžitou zpětnou vazbu.
    - **Hlavní test**: Skládá se ze 4 úrovní (2-back, 3-back, 4-back a 5-back), přičemž každá úroveň obsahuje 51 karet.
- **Náhodně generované sekvence**: Aplikace vytváří náhodné posloupnosti písmen s **kontrolovaným podílem shod** (přibližně 30 %), aby byla zachována konzistentní obtížnost.

### 📊 Výsledky a porovnání
- **Okamžité vyhodnocení**: Výsledky jsou k dispozici ihned po dokončení testu.
- **Srovnání s populací**: Aplikace zobrazuje:
    - **Percentil**: Jak si uživatel vedl ve srovnání s ostatními.
    - **Průměr a medián**: Základní statistiky celé populace.
- **Detailní analýza chyb**: Přehled zahrnující:
    - **Úspěšnost**: Správně rozpoznané shody.
    - **Chyby typu „zapomenuté označení“**: Shody, které uživatel neoznačil, i když měl.
    - **Chyby typu „označeno nesprávně“**: Situace, kdy byl podnět označen chybně (false positives).

### 📝 Sběr dat
- **Demografické údaje**: Věk, pohlaví a dosažené vzdělání.
- **Jazykové dovednosti**: Speciální část pro bilingvní uživatele, která umožňuje zkoumat vztah mezi jazykovou úrovní (např. C1/C2) a výkonem paměti.
- **Dlouhodobé sledování**: Uživatelé se mohou k testu opakovaně vracet a absolvovat jej znovu (hlavní test vs. kratší tréninkové testy).

## 🛠 Použité technologie

Projekt je vytvořen jako **Single Page Application (SPA)**, kde **Laravel** slouží jako backendové API a **Vue.js** zajišťuje frontend.
- **Backend**: [Laravel 8](https://laravel.com)
- **Frontend**: [Vue.js 3](https://vuejs.org)
- **Styly**: [TailwindCSS](https://tailwindcss.com) + [DaisyUI](https://daisyui.com)
- **Databáze**: MySQL

## 🚀 Instalace

Postup pro spuštění projektu lokálně:

1. **Stažení zdrojových kódů**
   ```bash
   git clone https://github.com/Michal-Mikolas/nback.git
   cd nback
   ```

2. **Instalace backendových závislostí**
   ```bash
   composer install
   ```

3. **Instalace frontendových závislostí**
   ```bash
   npm install
   ```

4. **Nastavení prostředí**
   Zkopírujte soubor `.env.example` na `.env` a nastavte přihlašovací údaje k databázi.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrace databáze**
   ```bash
   php artisan migrate
   ```

6. **Sestavení frontendových assetů**
   ```bash
   npm run dev
   # nebo pro produkční prostředí
   npm run prod
   ```

7. **Spuštění serveru**
   ```bash
   php artisan serve
   ```

## 📄 Licence

Projekt je open-source a je šířen pod licencí [MIT](https://opensource.org/licenses/MIT).

## 👨‍💻 Autor

**Michal Mikoláš**

* [LinkedIn](https://www.linkedin.com/in/michal-mikolas)
* [GitHub](https://github.com/Michal-Mikolas)
