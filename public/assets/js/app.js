document.addEventListener('alpine:init', () => {
    Alpine.data('mainState', () => {
        let lastScrollTop = 0

        const init = function () {
            // scroll detection
            window.addEventListener('scroll', () => {
                let st = window.pageYOffset || document.documentElement.scrollTop
                if (st > lastScrollTop) {
                    this.scrollingDown = true
                    this.scrollingUp = false
                } else {
                    this.scrollingDown = false
                    this.scrollingUp = true
                    if (st === 0) {
                        this.scrollingDown = false
                        this.scrollingUp = false
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st
            })

            // apply theme to <html> or <body>
            this.applyTheme()
        }

        const getTheme = () => {
            const stored = window.localStorage.getItem('dark')
            if (stored !== null) {
                return JSON.parse(stored)
            }

            // ⬇️ Default: light mode (false)
            return false
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        return {
            init,
            isDarkMode: getTheme(),

            toggleTheme() {
                this.isDarkMode = !this.isDarkMode
                setTheme(this.isDarkMode)
                this.applyTheme()
            },

            applyTheme() {
                if (this.isDarkMode) {
                    document.documentElement.classList.add('dark')
                } else {
                    document.documentElement.classList.remove('dark')
                }
            },

            isSidebarOpen: window.innerWidth > 1024,
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) return
                this.isSidebarHovered = value
            },

            handleWindowResize() {
                this.isSidebarOpen = window.innerWidth > 1024
            },

            scrollingDown: false,
            scrollingUp: false,
        }
    })
})
