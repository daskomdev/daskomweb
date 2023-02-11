const plugin = require('tailwindcss/plugin')

module.exports = {
  important: true,
  theme: {

    fontFamily: {
      'merri-italic': ['merri-italic'],
      'merri-bold': ['merri-bold'],
      'merri': ['merri-regular'],
      'monda-bold': ['monda-bold'],
      'monda': ['monda-regular'],
      'overpass': ['overpass-regular'],
      'overpass-bold': ['overpass-bold'],
      'overpass-thin': ['overpass-thin'],
      'overpass-italic': ['overpass-italic'],
      'overpass-mono': ['overpass-mono-regular'],
      'overpass-mono-bold': ['overpass-mono-bold'],
      'overpass-mono-thin': ['overpass-mono-thin'],
    },

    extend: {

      fontSize: {
        '9xl': '8rem',
      },

      opacity: {
        '90': '0.9',
      },
    
      borderRadius: {
        default: '.25rem',
        'none': '0',
        'sm': '.125rem',
        'lg': '.5rem',
        'full': '9999px',
        'large': '25px',
      },

      inset: {
        '0': 0,
        '5': '5rem',
        auto: 'auto',
        '1/2': '50%',
        '1/4': '25%',
        '-15%' : '-15%',
        'minFull': '-100%',
        'min20rem': '-20rem',
        'min18rem': '-18rem',
        'min4rem': '-4rem',
        'min1rem': '-1rem',
        '32full': 'calc(100% - 8rem)',
        '36full': 'calc(100% - 9rem)',
      },

      borderWidth: {
        '6': '6px',
        '16': '16px',
      },

      margin: {
        '18': '4.8rem',
      },

      spacing: {
        '34': '8.5rem',
        '30': '7rem',
        '36': '9rem',
        '72': '18rem',
        '20percent': '20%',
        '120': '20rem',
        '140': '25rem',
        '5': '1.15rem',
        '200': '40rem',
        '1/11': '9.0909090909%',
        '9/11': '81.8181818181%',
        '1/2min': 'calc(50% - 0.125rem)',
        '4full': 'calc(100% - 2rem)',
        '48full': 'calc(100% - 12rem)',
        '36full': 'calc(100% - 9rem)',
        '24full': 'calc(100% - 6rem)',
        '16full': 'calc(100% - 4rem)',
        '12full': 'calc(100% - 3rem)',
        '120full': 'calc(100% - 20rem)',
      },

      minHeight: {
        '0': '0',
        '24': '6rem',
        'full': '100%',
      },

      width: {
        '1/7': '14.28%',
      },

      height: {
        '60': '15rem',
        '1/4': '25%',
        '1/5': '20%',
        '1/3': '33.33333%',
        '2/3': '66.66667%',
        '3/5': '60%',
        '4/5': '80%',
        '3/4': '75%',
        '2/5': '40%',
        '1/2': '50%',
      },

      opacity: {
        '97': '0.97'
      },

      boxShadow: {
        '3xl': '0 35px 55px -15px rgba(0, 0, 0, 0.5)',
        'inner-xl': 'inset 0 4px 8px 0 rgba(0, 0, 0, 0.3)',
      },

      keyframes: {
        bouncex: {
          '0%, 100%': { 
            transform: 'translateX(-25%)',
            animationTimingFunction: 'cubic-bezier(0.8, 0, 1, 1)'
          },
          '50%': { 
            transform: 'translateX(0)',
            animationTimingFunction: 'cubic-bezier(0, 0, 0.2, 1)'
          },
        },
      },

      animation: {
        'bounce-x': 'bouncex 1s infinite'
      },

      zIndex: {
        '-10': '-10'
      }
    }
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    padding: ['responsive', 'hover', 'focus'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover', 'odd','even'],
    textColor: ['responsive', 'hover', 'focus', 'active', 'group-hover', 'odd', 'even'],
    zIndex: ['responsive', 'hover', 'focus'],
    scale: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    boxShadow: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
  },
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        '.inset-center': {
          bottom: '50%',
          left: '50%',
          transform: 'translate(-50%, 50%)',
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ]
}
