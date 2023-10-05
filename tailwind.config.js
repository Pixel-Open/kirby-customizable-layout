/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [],
  theme: {
    extend: {
      spacing: {
        '320': '80rem',
        '240': '60rem',
        '160': '40rem',
        '80': '20rem',
      },
    },
  },
  safelist: [
    {
      pattern: /^mb-(4|8|16)$/,
    },
    {
      pattern: /^m(l-0|r-0|x-auto)$/
    },
    {
      pattern: /^grid-cols-(2|3|4)$/,
      variants: ['xl'],
    },
    {
      pattern: /^w-(320|240|160|80)$/,
    },
    {
      pattern: /^gap-(16|8|0)$/,
    },
    {
      pattern: /^p(r|l|x)?-(16|8|0)$/,
    },
    {
      pattern: /^content-(start|end|center|between|around|evenly)$/,
    },
  ],
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}

