const accordion = ({
                       activeAccordion = '',
                   } = {}) => ({
    _type: 'accordion',
    activeAccordion,
    setActiveAccordion(id) {
        this.activeAccordion = (this.activeAccordion === id) ? '' : id
    }
})

export default accordion
