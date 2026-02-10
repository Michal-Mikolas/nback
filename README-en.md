# N-Back Memory Test

This web application is an interactive tool designed to test and measure a user's **Working Memory (WM)** using the **N-Back method**. It was originally developed as part of a Bachelor's thesis to collect data and compare results across a population.

The application allows users to test their memory, view their results immediately, and compare their performance against other participants.

## 🧠 What is the N-Back Test?

The **N-back** task is a continuous performance task that is commonly used as an assessment in cognitive neuroscience to measure a part of working memory and working memory capacity.

The subject is presented with a sequence of stimuli (in this case, letters), and the task consists of indicating when the current stimulus matches the one from **N** steps earlier in the sequence.

## ✨ Features

### 🎮 Interactive Testing
- **Progressive Difficulty**: The test scales from easy to hard.
    - **Trial Rounds**: Users start with a 1-back and 2-back trial to understand the mechanics. Interactive feedback is provided if mistakes are made.
    - **Main Test**: Consists of 4 levels (2-back, 3-back, 4-back, and 5-back), each with 51 cards.
- **Randomized Sequences**: The application generates random sequences of letters with a controlled percentage of "matches" (approx. 30%) to ensure consistency in difficulty.

### 📊 Results & Comparison
- **Immediate Feedback**: Users see their results right after finishing the test.
- **Population Comparison**: The app calculates and displays:
    - **Percentile**: How the user performed compared to others.
    - **Average & Median**: General population statistics.
- **Detailed Error Analysis**: Breakdowns of:
    - **Success Rate**: Correctly identified matches.
    - **Omission Errors**: Forgotten marks (missed matches).
    - **Commission Errors**: Marked incorrectly (false positives).

### 📝 Data Collection
- **Demographics**: Collects age, sex, and education level.
- **Language Skills**: specialized section for bilingual users to correlate memory performance with language proficiency (C1/C2 etc.).
- **Longitudinal Data**: Users can return and re-take the test (Main Test vs. Minor/Practice Tests).

## 🛠 Technology Stack

The project is built as a **Single Page Application (SPA)** using **Laravel** as the API backend and **Vue.js** for the frontend.

- **Backend**: [Laravel 8](https://laravel.com)
- **Frontend**: [Vue.js 3](https://vuejs.org)
- **Styling**: [TailwindCSS](https://tailwindcss.com) + [DaisyUI](https://daisyui.com)
- **Database**: MySQL

## 🚀 Installation

To run this project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/Michal-Mikolas/nback.git
   cd nback
   ```

2. **Install Backend Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   Copy the `.env.example` file to `.env` and configure your database credentials.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Migration**
   ```bash
   php artisan migrate
   ```

6. **Build Frontend Assets**
   ```bash
   npm run dev
   # or for production
   npm run prod
   ```

7. **Run the Server**
   ```bash
   php artisan serve
   ```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Michal Mikoláš**
- [LinkedIn](https://www.linkedin.com/in/michal-mikolas)
- [GitHub](https://github.com/Michal-Mikolas)
