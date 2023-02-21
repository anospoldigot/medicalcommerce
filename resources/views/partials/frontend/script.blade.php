<form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="
https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js
"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.min.js"
    integrity="sha512-IkLiryZhI6G4pnA3bBZzYCT9Ewk87U4DGEOz+TnRD3MrKqaUitt+ssHgn2X/sxoM7FxCP/ROUp6wcxjH/GcI5Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"
    integrity="sha512-fTTVSuY9tLP+l/6c6vWz7uAQqd1rq3Q/GyKBN2jOZvJSLC5RjggSdboIFL1ox09/Ezx/AKwcv/xnDeYN9+iDDA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
    integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="
https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js
"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dddeb21050da924580f6', {
        cluster: 'ap1',
        channelAuthorization: {
            endpoint: "/broadcasting/auth",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        },
    });

    var channel = pusher.subscribe('presence-chat.1');
    channel.bind('my-event', function(data) {
        if(data.message.from_id == id){
            $('#chat-content').append(myChatTemplate(data.message));
        }else if(data.message.to_id == id){
            $('#chat-content').append(adminChatTemplate(data.message));
        }
        alert(JSON.stringify(data));
    });
    
    // console.log(channel);
    
    channel.bind("pusher:subscription_succeeded", function (members) {
        members.each(function(member) {
            // console.log(JSON.stringify(member));
        });
    });

    $('.chat-tab').hide();
    $('.blantershow-chat').click(function(){
        $('.chat-tab').fadeToggle();
    });
</script>
<script>

    const LoadingTemplate = `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    Loading...`;

    function logout ()
    {
        $('form#logout').submit()
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var animation = bodymovin.loadAnimation({
        container: document.getElementById("loading-animation"),
        renderer: "svg",
        loop: true,
        autoplay: true,
        path: "{{ asset('frontend/img/loading.json') }}"
    });

    $(window).on("load", function() {
        // $("#loading-wrapper").fadeOut();
        $("#preloader").delay(350).fadeOut("slow");
    });
    
    const addToCart = function(product_id){
            const target = event.currentTarget;
            
            $.ajax({
                beforeSend: function(){
                    target.innerHTML = LoadingTemplate;
                    $(target).addClass('disabled');
                },
                url: '{{ route("fe.carts.store") }}',
                method: 'POST',
                data: {
                    product_id
                },
                success: function(res){
                    if(res.success){
                        window.location.href = res.redirect_url
                    }
                },
                error: function(err){
                    alert(JSON.stringify(err))
                    location.reload();
                }
            })
        }
    function formatRupiah(angka, prefix, toFixed = ''){
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '') + toFixed;
    }


    $.get('{{ route("fe.chats.index") }}', function(res){
        let html = '';
        const id = '{{ auth()->id() }}'
        if(!res.success) console.log('Error');
        
        for (const key in res.data) {
            html+= dateChatTemplate(key);
            const subhtml = res.data[key].reverse().map((value, key) => {
                if(value.from_id == id){
                    return myChatTemplate(value)
                }else{
                    return adminChatTemplate(value)
                }
            })
            
            html+=subhtml.join('');
        }

        $('#chat-content').html(html);
    })

    const dateChatTemplate = function(date){
        return `<div class="divider d-flex align-items-center mb-4">
            <p class="text-center mx-3 mb-0" style="color: #a2aab7;">${moment(date).fromNow()}</p>
        </div>`
    }

    const adminChatTemplate = function(data){

        return `<div class="d-flex flex-row justify-content-start mb-4">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp" alt="avatar 1"
                style="width: 40px; height: 100%;">
            <div>
                <p class="small p-2 ml-3 mb-1 rounded-3 bg-light">${data.content}</p>
                <p class="small ml-3 mb-3 rounded-3 text-muted">${moment(data.created_at).format('HH:mm')}</p>
            </div>
        </div>`

    }
    const myChatTemplate = function(data){
        return `<div class="d-flex flex-row justify-content-end">
            <div>
                <p class="small p-2 mr-3 mb-1 text-white rounded-3 bg-primary">${data.content}</p>
                <p class="small mr-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${moment(data.created_at).format('HH:mm')}</p>
            </div>
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp" alt="avatar 1"
                style="width: 40px; height: 100%;">
        </div>`
    }


    $('#send-chat-btn').click(function(){
        const data = {
            content: $('#chat-input').val()
        }

        $.ajax({
            beforeSend: function(){
                $('#send-chat-btn').prop('disabled', true)
            },
            url: '{{ route("fe.chats.store") }}',
            method: 'POST',
            data,
            success: function(res){
                $('#chat-input').val('');
                $('#send-chat-btn').prop('disabled', false)
            },
            error: function(err){
                console.log(err);
            }
        })
    })


    // Durasi (Dalam menit)
    var duration = 2;

    function onCountdownFinished() {
        const countdownElement = document.getElementById("countdown");
        const html = '<a href="javascript:void(0)" onclick="resendVerification()" class="text-primary">Kirim ulang</a>'
        countdownElement.innerHTML = html
    }

    // Fungsi untuk menampilkan countdown
    function displayCountdown() {
        var countdownElement = document.getElementById("countdown");
        var minutes = Math.floor(duration / 60);
        var seconds = duration % 60;
        
        if (seconds < 10) { seconds="0" + seconds; } countdownElement.innerHTML= "0" + minutes + ":" + seconds; duration=duration - 1;
            if (duration>= 0) {
            setTimeout(displayCountdown, 1000);
            } else {
                onCountdownFinished();
            }
    }

    duration = duration * 60;
    
    function CopyMe(TextToCopy) {
        var TempText = document.createElement("input");
        TempText.value = TextToCopy;
        document.body.appendChild(TempText);
        TempText.select();
        
        document.execCommand("copy");
        document.body.removeChild(TempText);
        
        alert("Copied the text: " + TempText.value);
    }
</script>