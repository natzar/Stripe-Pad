const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
 content: ["./../views/*.php","./../views/*/*.php"],
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


