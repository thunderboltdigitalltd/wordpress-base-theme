const tabs = ({
                  tabSelected = 1,
                  tabId = $id('tabs'),
              } = {}) => ({
    __type: 'tabs',
    tabSelected,
    tabId,
    tabButtonClicked(tabButton) {
        this.tabSelected = tabButton.id.replace(this.tabId + '-', '')
        this.tabRepositionMarker(tabButton)
    },
    tabRepositionMarker(tabButton) {
        this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px'
        this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px'
        this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px'
    },
    tabContentActive(tabContent) {
        return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '')
    }
})

export default tabs
