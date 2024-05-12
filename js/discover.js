const showMoreButtons = document.getElementsByClassName("show-more")

// TODO: pass the number of previews to show each time
let toShowCount = 2
let shownCount = 2

for (let button of showMoreButtons) {

    button.addEventListener("click", function() {

        const request = new XMLHttpRequest()
        const previewsType = button.id
        const section = button.parentElement.parentElement

        request.open(
            "GET",
            "template/get_previews.php?type=" + previewsType + "&show=" + toShowCount + "&skip=" + shownCount,
            true
        )
        request.onreadystatechange = function() {
            if ((this.readyState === 4) && (this.status === 200)) {
                // Add requested previews to section
                section.innerHTML += this.response
                shownCount += 2
            }
        }
        request.send()

        // Remove the clicked 'show more' button
        button.remove()
    })
}
