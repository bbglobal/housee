$(document).ready(function () {
    $(".hamburger--spin").click(function () {
        $(this).toggleClass("is-active");
        var headerDrop = $(".header-drop");
        if (headerDrop.is(":visible")) {
            headerDrop.slideUp();
        } else {
            headerDrop.slideDown();
        }
    });
    $(".btn-show-powers").click(function () {
        var powers = $(".powers");
        if (powers.is(":visible")) {
            powers.slideUp();
        } else {
            powers.slideDown();
        }
    });

    $('.slider-nav').slick({
        dots: true,
        arrows: false,
        infinite: false,
        speed: 300,
        grab: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $("#showAlert").click(() => {
        $("#join-room").toggleClass("d-none")
        $("#room-id").toggleClass("d-none")
    });

    $("#addCoins").click(() => {
        Swal.fire({
            title: "How many Coins do you want to add",
            input: "number",
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: async (coins) => {
                try {
                    return coins;
                } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const coins = result.value;
                window.location.href = `/phonepe/${coins}`;
            }
        });
    });

    $(".btn-buyNow").click(function () {
        const ticketValue = $(this).closest('.tickets').find('.ticket').val();

        Swal.fire({
            title: "Please Add a quantity",
            input: "number",
            inputAttributes: {
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                console.log(quantity * ticketValue)
                window.location.href = `/tickets/${ticketValue}?q=${quantity}`;
            }
        });
    });

    $(".powerTicket").click(function () {
        const ticketValue = $(this).closest('.powerTickets').find('.ticket').val();

        Swal.fire({
            title: "Please Add a quantity",
            input: "number",
            inputAttributes: {
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                console.log(quantity * ticketValue)
                window.location.href = `/power-ticket/${ticketValue}?q=${quantity}`;
            }
        });
    });

    $(".roomTickets").click(function () {
        const ticketValue = $(this).closest('.room').find('.ticket').val();

        Swal.fire({
            title: "Please Add a quantity",
            input: "number",
            inputAttributes: {
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                console.log(quantity * ticketValue)
                window.location.href = `/room-ticket/${ticketValue}?q=${quantity}`;
            }
        });
    });

    $(".btnPower").click(function () {
        const powerName = $(this).closest('.uup').find('.power').val();

        Swal.fire({
            title: `You have selected ${powerName}`,
            input: "number",
            inputAttributes: {
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                window.location.href = `/powers/${powerName}?q=${3 * quantity}`;
            }
        });
    });

    $(".tickets figure").click(function () {
        const ticketValue = $(this).closest('.tickets').find('.ticket').val();
        const availableText = $(this).closest('.tickets').find('.available').text();
        const available = parseInt(availableText.match(/\d+/)[0], 10);

        if (available < 1) {
            return alert('you do not have this ticket');
        }

        Swal.fire({
            title: `You can select max 5`,
            input: "number",
            inputAttributes: {
                max: 5,
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Play",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    if (quantity > 5) {
                        throw new Error("Quantity cannot be greater than 5");
                    }
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                if (quantity > available) {
                    return alert('you do not have enough ticket');
                }
                window.location.href = `/start/${ticketValue}?q=${quantity}`;
            }
        });
    });

    $(".powerTickets figure").click(function () {
        const ticketValue = $(this).closest('.powerTickets').find('.ticket').val();
        const availableText = $(this).closest('.powerTickets').find('.available').text();
        const available = parseInt(availableText.match(/\d+/)[0], 10);

        if (available < 1) {
            return alert('you do not have this ticket');
        }

        Swal.fire({
            title: `You can select max 5`,
            input: "number",
            inputAttributes: {
                max: 5,
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Play",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    if (quantity > 5) {
                        throw new Error("Quantity cannot be greater than 5");
                    }
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                window.location.href = `/start/power/${ticketValue}?q=${quantity}`;
            }
        });
    });

    $(".room figure").click(function () {
        const ticketValue = $(this).closest('.room').find('.ticket').val();
        const availableText = $(this).closest('.room').find('.available').text();
        const available = parseInt(availableText.match(/\d+/)[0], 10);

        if (available < 1) {
            return alert('you do not have this ticket');
        }

        Swal.fire({
            title: `You can select max 5`,
            input: "number",
            inputAttributes: {
                max: 5,
                min: 1,
            },
            showCancelButton: true,
            confirmButtonText: "Play",
            showLoaderOnConfirm: true,
            preConfirm: async (quantity) => {
                try {
                    if (quantity > 5) {
                        throw new Error("Quantity cannot be greater than 5");
                    }
                    return quantity;
                } catch (error) {
                    Swal.showValidationMessage(`
                        ${error}
                    `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                const quantity = result.value;
                window.location.href = `/start/room/${ticketValue}?q=${quantity}`;
            }
        });
    });

    var createLink = $("#createLink");

    createLink.on("click", function (event) {
        event.preventDefault();

        var randomId = generateRandomId();

        Swal.fire({
            title: "<strong>Your room ID is <u>" + randomId + "</u></strong>",
            icon: "info",
            html: `
            Copy and share with your friends`,
            showCancelButton: true,
            confirmButtonText: "Continue",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#randomIdInput").val(randomId);
                $("#randomIdForm").submit();
            }
        });
    });

    function generateRandomId() {
        var characters =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        var randomId = "";

        for (var i = 0; i < 8; i++) {
            randomId += characters.charAt(
                Math.floor(Math.random() * characters.length)
            );
        }

        return randomId;
    }

    $("#withdraw").click(function () {
        $("#storePyaeeInfo").modal("show");
        $("#pyaeeInfoForm")[0].reset();
    });

    $('input[name="withdraw"]').change(function () {
        if ($('#credit-card').is(':checked')) {
            $('#credit-card-section').slideDown();
            $('#upi-section').slideUp();
        } else if ($('#upi').is(':checked')) {
            $('#credit-card-section').slideUp();
            $('#upi-section').slideDown();
        }
    });

    $('#upi-section .pay-options li:first-child').addClass('select-options');

    $('#upi-section .pay-options li').on('click', function () {
        $('#upi-section .pay-options li').removeClass('select-options');

        $('#upi-section .form-select').addClass('d-none');

        $(this).addClass('select-options');

        var selectedIndex = $(this).index();
        $('#upi-section .form-select').eq(selectedIndex).removeClass('d-none');
    });


}); 
