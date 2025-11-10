const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ["./../app/views/*.php", "./../app/views/*/*.php", "./../app/views/*/*/*.php", "./../admin/views/*.php", "./../admin/*/*.php", "./../admin/*/*/*.php", "./../landing/views/*.php", "./../landing/views/*/*.php", "./../landing/views/*/*/*.php"],
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
    require('@tailwindcss/forms')],

  theme: {
    extend: {
      fontFamily: {
        sans: [
          '-apple-system',
          'BlinkMacSystemFont',
          '"Segoe UI"',
          'Roboto',
          '"Helvetica Neue"',
          'Arial',
          'sans-serif',
        ],
      },
    },
  },
  // ...
}




