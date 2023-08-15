const slideOver = ({slideOverOpen = false} = {}) => ({
    _type: 'slide_over',
    slideOverOpen,
    onEscape() {
        this.closeSlideOver()
    },
    onClick() {
        this.slideOverOpen = true
    },
    closeSlideOver() {
        this.slideOverOpen = false
    }
})

export default slideOver
