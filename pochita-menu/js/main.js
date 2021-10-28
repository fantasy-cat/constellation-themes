class Controller {
    sectionQuery = null
    navQuery = null
    sections = document.querySelectorAll('.section')
    navigation = document.querySelectorAll('.nav-item')

    doLoop() {
        this.sections.forEach((section) => this.toggleDisplay(section))
        this.navigation.forEach((nav) => this.toggleActive(nav))
    }

    toggleDisplay(section) {
        section?.classList?.replace('visible', 'hidden')
        this.sectionQuery?.classList?.replace('hidden', 'visible')
    }

    toggleActive(nav) {
        nav?.classList?.replace('active', 'inactive')
        this.navQuery?.classList?.replace('inactive', 'active')
    }

    constructor(sectionelement, navelement) {
        this.sectionelement = sectionelement
        this.navelement = navelement
        this.sectionQuery = document.querySelector(sectionelement)
        this.navQuery = document.querySelector(navelement)
        this.doLoop()
    }
}

const main = document.querySelector("#main-toggle")
const humanizer = document.querySelector("#humanizer-toggle")
const weapon = document.querySelector("#weapon-toggle")
const triggerbot = document.querySelector("#triggerbot-toggle")
const sound = document.querySelector("#sound-toggle")
const tf2 = document.querySelector("#tf2-toggle")

main.onclick = () => {
    new Controller('#main', '#main-toggle')
}

humanizer.onclick = () => {
    new Controller('#humanizer', '#humanizer-toggle')
}

weapon.onclick = () => {
    new Controller('#weapon', '#weapon-toggle')
}

triggerbot.onclick = () => {
    new Controller('#triggerbot', '#triggerbot-toggle')
}

sound.onclick = () => {
    new Controller('#sound', '#sound-toggle')
}

tf2.onclick = () => {
    new Controller('#tf2', '#tf2-toggle')
}