/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php",
    "./parts/*.php",
    "./leaderboard/index.php",
    "./manager/index.php",
    "./profile/index.php",
    "./manager/create/index.php",
    "./manager/redeems/index.php"],
  theme: {
    extend: {
      colors: {
        darkblue: {
          '100': '#130a3e'
        },
        redpink: {
          '100': '#e33146'//e33146
        }

      }
    },
  },
  plugins: [],
}
