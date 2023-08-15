const imageGallery = ({
                          imageGalleryOpened = false,
                          imageGalleryActiveUrl = null,
                          imageGalleryImageIndex = null
                      } = {}) => ({
    __type: 'image_gallery',
    imageGalleryOpened,
    imageGalleryActiveUrl,
    imageGalleryImageIndex,
    imageGalleryOpen(event) {
        this.imageGalleryImageIndex = event.target.dataset.index
        this.imageGalleryActiveUrl = event.target.src
        this.imageGalleryOpened = true
    },
    imageGalleryClose() {
        this.imageGalleryOpened = false
        setTimeout(() => this.imageGalleryActiveUrl = null, 300)
    },
    imageGalleryNext() {
        if (this.imageGalleryImageIndex == this.$refs.gallery.childElementCount) {
            this.imageGalleryImageIndex = 1
        } else {
            this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) + 1
        }
        this.imageGalleryActiveUrl = this.$refs.gallery.querySelector(`[data-index='${this.imageGalleryImageIndex}']`).src
    },
    imageGalleryPrev() {
        if (this.imageGalleryImageIndex == 1) {
            this.imageGalleryImageIndex = this.$refs.gallery.childElementCount
        } else {
            this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) - 1
        }
        this.imageGalleryActiveUrl = this.$refs.gallery.querySelector(`[data-index='${this.imageGalleryImageIndex}']`).src
    },
    init() {
        const imageGalleryPhotos = this.$refs.gallery.querySelectorAll('img')
        for(let i = 0; i < imageGalleryPhotos.length; i++) {
            imageGalleryPhotos[i].setAttribute('data-index', i + 1)
        }
    }
})

export default imageGallery
