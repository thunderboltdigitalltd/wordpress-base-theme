export const randRange = (data, remove = false) => {
    const index = Math.floor(data.length * Math.random())
    const item = data[index]

    if (remove) {
        data.splice(index, 1)
    }

    return item
}

export const calculatePosition = (el) => {
    const root = document.documentElement
    const body = document.body
    const rect = el.getBoundingClientRect()

    const scrollTop = window.pageYOffset || root.scrollTop || body.scrollTop || 0
    const scrollLeft = window.pageXOffset || root.scrollLeft || body.scrollLeft || 0

    const clientTop = root.clientTop || body.clientTop || 0
    const clientLeft = root.clientLeft || body.clientLeft || 0

    return {
        top: Math.round(rect.top + scrollTop - clientTop),
        left: Math.round(rect.left + scrollLeft - clientLeft),
        height: rect.height,
        width: rect.width
    }
}
