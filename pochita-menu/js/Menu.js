export class Controller {
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

export default Controller