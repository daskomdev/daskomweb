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
      },

      margin: {
        '18': '4.8rem',
      },

      spacing: {
        '34': '8.5rem',
        '36': '9rem',
        '72': '18rem',
        '20percent': '20%',
        '120': '20rem',
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
      }
    }
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    padding: ['responsive', 'hover', 'focus'],
  },
  plugins: []
}
