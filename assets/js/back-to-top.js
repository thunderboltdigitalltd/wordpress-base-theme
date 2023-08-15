import {animate, scroll} from "motion";

export const toTop = (threshold = 400) => {
    const backToTop = document.getElementById('backToTop')

    if (backToTop) {
        scroll(({y}) => {
            if (y.current >= threshold) {
                animate(backToTop, {opacity: 1})
            } else {
                animate(backToTop, {opacity: 0})
            }
        })

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        })
    }
}
