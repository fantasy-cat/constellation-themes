import Controller from './Menu.js'

const main = document.querySelector("#main-toggle")
const humanizer = document.querySelector("#humanizer-toggle")
const weapon = document.querySelector("#weapon-toggle")
const triggerbot = document.querySelector("#triggerbot-toggle")
const sound = document.querySelector("#sound-toggle")

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