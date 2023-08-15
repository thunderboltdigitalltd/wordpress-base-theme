const popover = ({
                     popoverOpen = false,
                     popoverArrow = true,
                     popoverPosition = 'bottom',
                     popoverHeight = 0,
                     popoverOffset = 8
                 } = {}) => ({
    _type: 'popover',
    popoverOpen,
    popoverArrow,
    popoverPosition,
    popoverHeight,
    popoverOffset,
    popoverHeightCalculate() {
        this.$refs.popover.classList.add('invisible')
        this.popoverOpen = true
        let that = this
        $nextTick(() => {
            that.popoverHeight = that.$refs.popover.offsetHeight
            that.popoverOpen = false
            that.$refs.popover.classList.remove('invisible')
            that.$refs.popoverInner.setAttribute('x-transition', '')
            that.popoverPositionCalculate()
        })
    },
    popoverPositionCalculate() {
        if (window.innerHeight < (this.$refs.popoverButton.getBoundingClientRect().top + this.$ref.popoverButton.offsetHeight + this.popoverOffset + this.popoverHeight)) {
            this.popoverPosition = 'top'
        } else {
            this.popoverPosition = 'bottom'
        }
    },
    init() {
        let that = this
        window.addEventListener('resize', () => {
            this.popoverPositionCalculate()
        })
        $watch('popoverOpen', (value) => {
            if (value) {
                this.popoverPositionCalculate()
                document.getElementById('width').focus()
            }
        })
    }
})

export default popover
