const ticketTables = document.querySelectorAll(".ticket_table");
const houseeButtons = document.querySelectorAll(".housee");
const matchNumbers = [];

function generateTicket() {
    ticketTables.forEach((table) => {

        table.innerHTML = "";

        var usedNumbers = new Set();

        for (var row = 0; row < 3; row++) {
            var tr = document.createElement("tr");
            for (var col = 0; col < 9; col++) {
                var td = document.createElement("td");
                var innerDiv = document.createElement("div");
                var isDarkCell = (row % 2 == 0 && col % 2 != 0) || (row % 2 != 0 && col % 2 == 0);

                // Generate unique numbers for each cell within the specified range
                var minRange = col * 10 + 1;
                var maxRange = (col + 1) * 10;

                var cellNumber = generateUniqueNumber(usedNumbers, minRange, maxRange);

                ticketNumber = cellNumber;
                usedNumbers.add(ticketNumber);

                if (!isDarkCell || (row == 0 && col == 3) || (row == 0 && col == 7) || (row == 0 && col == 5) || (row == 1 && col == 8)) {
                    innerDiv.textContent = ticketNumber;
                    innerDiv.classList.add("star");
                }

                if ((row == 0 && col == 8) || (row == 0 && col == 6) || (row == 0 && col == 4)) {
                    innerDiv.textContent = '';
                }

                td.className = isDarkCell ? "dark-cell" : "light-cell";
                td.appendChild(innerDiv);
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }
    })

    function generateUniqueNumber(usedNumbers, min, max) {
        var randomNumber;
        do {
            randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
        } while (usedNumbers.has(randomNumber));

        return randomNumber;
    }
}

function highlightNumber(number) {
    $('#numberTable td').removeClass('highlight-bg');
    $('#numberTable td:contains(' + number + ')').filter(function () {
        return $(this).text() == number;
    }).addClass('highlight highlight-bg');
}

generateTicket();


var cancelNum = document.querySelectorAll(".star");

function getRandomNumber(usedNumbers) {
    var randomNumber;
    do {
        randomNumber = Math.floor(Math.random() * 90) + 1;
    } while (usedNumbers.includes(randomNumber));
    return randomNumber;
}

function updateWinNumbers(number) {
    $('.numbers').prepend('<div class="win-numbers">' + number + '</div>');
}

var previousNumber;
var usedNumbers = [];

window.addEventListener("load", () => {
    setTimeout(() => {
        setInterval(function () {
            if (usedNumbers.length === 90) {
                console.log("All numbers from 1 to 90 have been used.");
                return;
            }

            var randomNumber = getRandomNumber(usedNumbers);
            highlightNumber(randomNumber);
            updateWinNumbers(randomNumber);

            previousNumber = randomNumber;
            usedNumbers.push(randomNumber);

        }, 5000);
    }, 6000);

    cancelNum.forEach(element => {
        element.addEventListener("click", () => {
            element.classList.toggle("cancel-num");
            var clickedNumber = parseInt(element.textContent, 10);

            if (clickedNumber === previousNumber) {
                console.log("Match! You clicked the generated number.");
                matchNumbers.push("win");
                console.log(matchNumbers);
            }
        });
    });
});

const userAvatar = document.getElementById("user-avatar");
const username = document.getElementById("user-name");

houseeButtons.forEach((element, index) => {
    element.addEventListener("click", () => {
        const illuminatedElement = document.getElementsByClassName("Illuminated")[index];
        const terminateElement = document.getElementsByClassName("terminate")[index];

        if (matchNumbers.length == 15) {
            console.log("housee");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I am sure"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        imageUrl: userAvatar.src,
                        imageHeight: 100,
                        imageAlt: "user image",
                        title: `Congratulations! ${username.textContent}`,
                        text: `${username.textContent} has won the game`,
                    });
                }
            });
        } else {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I am sure"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "error",
                        title: "Illuminated!",
                        text: "Your ticket has been Illuminated.",
                    });
                    console.log(`Illuminated housee ${index}`);
                    illuminatedElement.style.display = "block";
                    terminateElement.style.cssText = "opacity: 0.5; position: relative; z-index: -1;";
                }
            });
        }
    });
});


window.onload = function () {
    var timer = document.getElementById('timer');
    var mainLoader = document.getElementById('main-loader');
    var loader = document.querySelector(".printing");
    const invite = document.getElementById("invite")
    const leave = document.getElementById("leave")
    const footer = document.querySelector("footer")
    var time = 3;

    timer.style.display = 'inline-block';

    var timerInterval = setInterval(function () {
        timer.innerHTML = time;
        time--;

        if (time == 0) {
            clearInterval(timerInterval); // Stop the timer when it reaches 0
            loader.style.display = "none";

            footer.style.display = "none";
            // GSAP animations after the timer completes
            gsap.to("#curtain_1", {
                x: '-100%',
                duration: 3
            });

            gsap.to("#curtain_2", {
                x: '100%',
                duration: 3
            }).eventCallback("onComplete", function () {
                mainLoader.style.display = "none";
            });
        }
    }, 1000);


    invite.addEventListener("click", () => {
        footer.style.display = "block"
    })

    leave.addEventListener("click", () => {
        footer.style.display = "none"
    })
}