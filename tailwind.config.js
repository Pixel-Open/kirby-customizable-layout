/** @type {import('tailwindcss').Config} */

/* Switch color value according to your theme */
const color1 = "#1f2937";
const color2 = "#4f46e5";
const color3 = "#0ea5e9";
const color4 = "#72e2ca";
const color5 = "#e0e7ff";

/* Add more color available by creating a new variable and adding it to this array according to the syntax */
const customColors = {
  [color1]: color1,
  [color2]: color2,
  [color3]: color3,
  [color4]: color4,
  [color5]: color5,
};

module.exports = {
  content: [],
  theme: {
    extend: {
      colors: {
        ...customColors,
      },
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
      pattern: new RegExp(`bg-(${Object.keys(customColors).join('|')})$`),
    },
    {
      pattern: new RegExp(`text-(${Object.keys(customColors).join('|')})$`),
      variants: ['[&_*]'],
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

