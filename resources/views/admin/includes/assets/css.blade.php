<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                animation: {
                    'slide-down': 'slideDown 0.2s ease-out',
                    'slide-up': 'slideUp 0.2s ease-out',
                    'fade-in': 'fadeIn 0.3s ease-out',
                    'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                },
                keyframes: {
                    slideDown: {
                        '0%': { opacity: '0', transform: 'translateY(-10px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    slideUp: {
                        '0%': { opacity: '0', transform: 'translateY(10px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    pulseSoft: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '.8' }
                    }
                }
            }
        }
    }
</script>
