const navigationMenu = ({
                            navigationMenuOpen = false,
                            navigationMenu = '',
                            navigationMenuCloseDelay = 200,
                            navigationMenuCloseTimeout = null,
                        } = {}) => ({
    _type: 'navigationMenu',
    navigationMenuOpen,
    navigationMenu,
    navigationMenuCloseDelay,
    navigationMenuCloseTimeout,
    navigationMenuLeave() {
        let that = this
        this.navigationMenuCloseTimeout = setTimeout(() => {
            this.navigationMenuClose()
        }, this.navigationMenuCloseDelay)
    },
    navigationMenuReposition(navElement) {
        this.navigationMenuClearCloseTimeout()
        this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px'
        this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2)
    },
    navigationMenuClearCloseTimeout() {
        clearTimeout(this.navigationMenuCloseTimeout)
    },
    navigationMenuClose() {
        this.navigationMenuOpen = false
        this.navigationMenu = ''
    }
})

export default navigationMenu
