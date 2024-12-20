const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
 content: ["./../../views/*.php","./../../views/*/*.php","./../../views/templates/*.php","./../../app/*.html"],
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


