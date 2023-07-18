/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,js,php}", "./public/scripts/functions.php", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        primary:'#2ABCA2',
      },
      fontFamily: {
        body: ["Arvo", "serif"]
      },
      backgroundImage: {
        'rainbow-course': "url('img/CourseRainbow.jpg')",
        'beach-course': "url('img/BeachCourse.jpg')",
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
