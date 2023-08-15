const carousel = ({
                      activeSlide = '',
                      totalSlides = '',
                  } = {}) => ({
    _type: 'carousel',
    activeSlide,
    totalSlides,
    nextSlide() {
        const slideNumber = this.activeSlide.match(/(\d+)/)
        this.activeSlide = this.activeSlide === `slide-${this.totalSlides}` ? 'slide-1' : this.activeSlide.replace(/[0-9]/g, parseInt(slideNumber[0]) + 1)
    },
    prevSlide() {
        const slideNumber = this.activeSlide.match(/(\d+)/)
        this.activeSlide = this.activeSlide === 'slide-1' ? `slide-${this.totalSlides}` : this.activeSlide.replace(/[0-9]/g, parseInt(slideNumber[0]) - 1)
    },
    setActiveSlide(id) {
        this.activeSlide = (this.activeSlide === id) ? '' : id
    },
    init() {
        this.activeSlide = 'slide-1'
    },
})

export default carousel
