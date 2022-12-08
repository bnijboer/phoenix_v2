module.exports = {
      content: [
            './resources/**/*.antlers.html',
            './resources/**/*.vue',
            './content/**/*.md'
      ],
      theme: {
          extend: {
              colors: {
                  'primary': '#7766FF',
                  'secondary': '#d2afff',
                  'primary-accent': '#5347b2',
                  'secondary-accent': '#a88ccc',
              },
          },
      },
      plugins: [
            require('@tailwindcss/typography'),
      ],
}
