const tooltip = ({
                     tooltipVisible = false,
                     tooltipText = '',
                     tooltipArrow = true,
                     tooltipPosition = top,
                 } = {}) => ({
    __type: tooltip,
    tooltipVisible,
    tooltipText,
    tooltipArrow,
    tooltipPosition,
    init() {
        this.$refs.content.addEventListener('mouseenter', () => this.tooltipVisible = true)
        this.$refs.content.addEventListener('mouseleave', () => this.tooltipVisible = false)
    }
})

export default tooltip
