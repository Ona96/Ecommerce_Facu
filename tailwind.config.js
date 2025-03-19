/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
    ],
    theme: {
      extend: {
        colors:{
          'rosa': '#800020',
          'beige': '#F9C7B1',
          'gris-claro': '#F5F5F5',
          'gris-oscurito': '#D3D3D3',
          'rosa-claro': '#FADCD9',
        },
        fontFamily:{
          sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
        },
      },
    },
    plugins: [],
  }