/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./user-mgmt/*.{html,js}"],
  theme: {
    colors: {
      "green-dark": "#314536",
      "light-green": "#758B7C",
      white: "#ffffff",
      gray: "#989C9A",
      "eggshell?": "#F9F4F4",
      xanadu: {
        50: "#f6f7f6",
        100: "#e0e7e1",
        200: "#c1cec4",
        300: "#9bada0",
        400: "#758b7c",
        500: "#5b7162",
        600: "#48594f",
        700: "#3c4941",
        800: "#323d36",
        900: "#2d3430",
        950: "#171c19",
      },
    },
    fontFamily: {
      Inter: ["Inter", "sans-serif"],
    },
  },
};
