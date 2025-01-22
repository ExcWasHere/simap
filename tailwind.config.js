/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      container: {
        center: true,
        padding: '1rem'
      },
      fontFamily: {
        'montserrat': ['Montserrat', 'sans-serif'],
        'source-sans': ['"Source Sans 3"', 'sans-serif'],
      }
    },
  },
  plugins: [
  ],
}

