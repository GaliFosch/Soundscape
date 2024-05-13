const showMoreButtons = document.getElementsByClassName("show-more")

// TODO: pass the number of previews to show each time
let toShowCount = 2
let shownCount = {}

for (let button of showMoreButtons) {
    const previewsType = button.id
    shownCount[`${previewsType}`] = toShowCount
    button.addEventListener("click", e => onShowMoreBtnClick(e))
}

function onShowMoreBtnClick(event) {

    let button = event.target
    let section = button.parentElement.parentElement
    const request = new XMLHttpRequest()
    const previewsType = button.id

    request.open(
        "GET",
        "template/get_previews.php?type=" + previewsType + "&show=" + toShowCount + "&skip=" + shownCount[`${previewsType}`],
        true
    )
    request.onreadystatechange = function() {
        if ((this.readyState === 4) && (this.status === 200)) {
            // Add requested previews to section
            section.innerHTML += this.response
            shownCount[`${previewsType}`] += toShowCount
            // Add listener to the new 'show button' created
            const newButton = document.getElementById(`${previewsType}`)
            if (newButton != null) {
                newButton.addEventListener("click", e => onShowMoreBtnClick(e))
            }
        }
    }
    request.send()

    // Remove the clicked 'show more' button
    button.remove()
}