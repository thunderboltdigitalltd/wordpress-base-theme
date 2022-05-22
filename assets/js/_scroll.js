import LocomotiveScroll from 'locomotive-scroll'
import {ScrollTrigger} from 'gsap/ScrollTrigger'
import {gsap} from 'gsap'

export let scroll

export const initScroll = (el, scrollOptions = {}) => {
    const defaultOptions = {
        el: document.querySelector(el),
        smooth: true,
        getSpeed: true,
        getDirection: true,
        repeat: true,
    }

    const options = {
        ...defaultOptions,
        ...scrollOptions,
    }

    setTimeout(() => {
        gsap.registerPlugin(ScrollTrigger)

        scroll = new LocomotiveScroll(options)

        scroll.on('scroll', ScrollTrigger.update)

        ScrollTrigger.scrollerProxy(el, {
            scrollTop(value) {
                return arguments.length ? scroll.scrollTo(value, 0, 0) : scroll.scroll.instance.scroll.y
            },
            getBoundingClientRect() {
                return {
                    top: 0,
                    left: 0,
                    width: window.innerWidth,
                    height: window.innerHeight,
                }
            },
            pinType: document.querySelector(el).style.transform ? 'transform' : 'fixed',
        })

        smoothScrollAnchorLinks()

        ScrollTrigger.addEventListener('refresh', () => scroll.update())

        ScrollTrigger.refresh()
    }, 400)
}

const smoothScrollAnchorLinks = () => {
    const links = document.querySelectorAll('a[href^=\\#]:not([href$=\\#])')

    links.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault()
            e.stopPropagation()

            scroll.scrollTo(document.querySelector(link.getAttribute('href')))
        })
    })
}
