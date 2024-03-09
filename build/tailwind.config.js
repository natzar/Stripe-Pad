const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
 content: ["./../app/views/*.php","./../app/templates/*.php","./../app/*.html"],
 plugins:[
 require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
 require('@tailwindcss/forms')],
 
  theme: {
    extend: {
      fontFamily: {
        
      },
    },
  },
  // ...
}
