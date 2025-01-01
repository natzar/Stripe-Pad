const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
 content: ["./../app/views/*.php","./../app/views/*/*.php","./../app/views/*/*/*.php"],
 plugins:[
 require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
 require('@tailwindcss/forms')],
 
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  // ...
}


