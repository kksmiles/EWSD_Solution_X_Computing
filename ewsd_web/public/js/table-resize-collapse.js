//need class container for the container where cards need to be displayed,
// table wih id #table-collapse-resize and the table need to be in a parent div 
// to keep elements in the parent div of the table, add .keep-resize class
//Need same table head data and row data count, if there are 5 header cells, there must be 5 row cells,
window.addEventListener("resize", resize);
window.addEventListener("DOMContentLoaded", resize);

var cachedWidth;
var cached;

function resize() {
    var width = window.innerWidth
    if (document.getElementsByClassName("keep-resize").length > 0) {
        resizeTable()
        if (width > 600) {
            var resizeElements = document.getElementsByClassName("keep-resize")
            var table = document.getElementById('table-resize-collapse')
            for (let a = 0; a < resizeElements.length; a++) {
                table.before(resizeElements[a])
            }
        } else if (width <= 600) {
            if (width != cached) {
                cached = width
                var elements = document.getElementsByClassName("keep-resize")
                var resizeElements = elements
                var container = document.getElementsByClassName('container')[0]
                var cardDiv = document.getElementsByClassName("card-parent")[0]
                for (let a = 0; a < resizeElements.length; a++) {
                    cardDiv.before(resizeElements[a])
                }
            }
        }
    } else {
        resizeTable()
    }
}

function resizeTable() {

    var width = window.innerWidth

    if (width > 600) {
        var table = document.getElementById("table-resize-collapse");
        if (!table) {
            return;
        }
        table.parentNode.style.display = "block"
        var cardDivs = document.getElementsByClassName("card-parent")
        for (let a = 0; a < cardDivs.length; a++) {
            cardDivs[a].innerHTML = ""
        }

    } else if (width <= 600) {
        if (width != cachedWidth) {
            cachedWidth = width

            var table = document.getElementById("table-resize-collapse")
            if (!table) {
                return;
            }
            var cardParentDiv = document.createElement("div")
            cardParentDiv.setAttribute("id", "card-parent")
            cardParentDiv.setAttribute("class", "card-parent")
            var container = document.getElementsByClassName('container')[0]
            // table.before(cardParentDiv)
            container.appendChild(cardParentDiv)
            table.parentNode.style.display = "none"

            for (var i = 1; row = table.rows[i]; i++) {

                var card = document.createElement("div")
                card.setAttribute("id", "card" + i)
                card.setAttribute("class", "card")
                card.style.padding = 20
                card.style.margin = 10
                card.style.borderBottomColor = "#4e73df"
                card.style.borderBottomWidth = 3
                card.style.marginBottom = 20
                // card.setAttribute("class", "container")

                cardParentDiv.appendChild(card)
                var tableNo = table.rows[i].children[0].innerHTML

                for (var j = 1; column = row.children[j]; j++) {
                    console.log(table.rows[0].children[j].innerHTML)
                    var tableHead = table.rows[0].children[j].innerHTML
                    if (j == 1) {
                        var tableNoDiv = document.createElement("p")
                        tableNoDiv.innerHTML = "<b>No.</b> " + tableNo
                        card.appendChild(tableNoDiv)
                    }
                    var cardData = document.createElement("p")
                    cardData.setAttribute("class", "card-text")
                    cardData.innerHTML = "<b>" + tableHead + "</b> - " + column.innerHTML
                    card.appendChild(cardData)
                }
            }

        }
    }
}