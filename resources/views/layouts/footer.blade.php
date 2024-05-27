<footer>
    <ul class="d-flex align-items-center mx-5">
        <li class="menus">
            <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
        </li>
        <li class="menus">
            <a href="https://www.facebook.com/" target="_blank">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li class="menus">
            <a href="javascript:void(0)" id="chat">
                <i class="fa fa-envelope"></i>
            </a>
        </li>

        <div class="chat d-none">

            <div class="top">
                <h6>Chat Here</h6>
            </div>

            <!-- Chat -->
            <div class="messages">
                @include('chat/receive', ['message' => ''])
            </div>
            <!-- End Chat -->

            <!-- Footer -->
            <div class="bottom">
                <form id="chat">
                    <div class="input-group">
                        <input type="text" class="form-control" id="message" name="message"
                            placeholder="Enter message..." autocomplete="off">
                        <button type="submit" class="btn-snd">
                            <div class="fa fa-send"></div>
                        </button>
                    </div>
                </form>
            </div>
            <!-- End Footer -->
        </div>

        <li class="menus" id="copyLink">
            <a href="#">
                <i class="fa fa-share-square"></i>
            </a>
        </li>
    </ul>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
    integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#chat").click(() => {
        $(".chat").toggleClass("d-none");
    })

    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'ap2'
    });
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function(data) {
        $.post("/chat/receive", {
                _token: '{{ csrf_token() }}',
                message: data.message,
            })
            .done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    //Broadcast messages
    $("#chat").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "/chat/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #message").val(),
            }
        }).done(function(res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>
</body>

</html>
