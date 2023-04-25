<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<script src="/app-assets/vendors/js/select/select2.min.js"></script>
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

<script src="/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
<script src="/js/image-uploader.js"></script>
<script src="/js/numeral.min.js"></script>
<script src="/app-assets/js/scripts/ui/ui-feather.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js
"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->
<form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dddeb21050da924580f6', {
        cluster: 'ap1',
        channelAuthorization: {
            endpoint: "/broadcasting/auth",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        },
    });

    var channel = pusher.subscribe('presence-chat.1');
    
    channel.bind("pusher:subscription_succeeded", function (members) {
        members.each(function(member) {
            // alert(JSON.stringify(member));
        });
    });
    
    channel.bind('my-event', function(data) {
        $(`#userchat-${data.message.from_id}, #userchat-${data.message.from_id}`).prependTo('.chat-users-list');
        $('#userchat-'+data.message.from_id).find('p').html(data.message.content)

        if($('.chat-users-list').find(`#userchat-${data.message.from_id}`).length == 0){
            let html = `<li id="userchat-${data.message.from_id}" data-id="${data.message.from_id}">
                <span class="avatar"><img src="/upload/images/${data.message.from.profile}" height="42" width="42"
                        alt="Generic placeholder image" />
                </span>
                <div class="chat-info">
                    <h5 class="mb-0">${data.message.from.name}</h5>
                    <p class="card-text text-truncate">
                        ${data.message.content}
                    </p>
                </div>
                <div class="chat-meta text-nowrap">
                    <small class="float-right mb-25 chat-time">${moment(data.message.created_at).format('HH:mm')}</small>
                    <span class="badge badge-danger badge-pill float-right">1</span>
                </div>
            </li>`;

            $('.chat-users-list').prepend(html);
            
        }

        if(chatTabId == data.message.from_id){
            var html = `
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <span class="avatar box-shadow-1 cursor-pointer">
                        <img src="/app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                    </span>
                </div>
                <div class="chat-body">
                    <div class="chat-content">
                        <p class="text-dark">${data.message.content}</p>
                    </div>
                </div>
            </div>`;
            $('.chats').append(html);
        }
    });

    channel.members.each(function (member) {
        var userId = member.id;
        var userInfo = member.info;

        console.log(userInfo)
    });


    // Subscribe to notification channel
    var notification_channel = pusher.subscribe('private-notification.{{ auth()->id() }}');
    
    // Bind a function to handle incoming notifications
    notification_channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
        if(data.type == 'App\\Notifications\\ExportReady'){
            toastr['success'](data.message, 'Success!', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
            });
        }
    });

    
</script>
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').select2();
    
    var isRtl = $('html').attr('data-textdirection') === 'rtl';

    const currencyInput = function() {
        const value = event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        event.target.value = numeral(value).format('0,0');
    }    

    const logout = function(){
        $('#logout').submit();
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

</script>
@if (session()->has('success'))
    <script>
        toastr['success']('{{ session("success") }}', 'Success!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
        });
    </script>
@endif
@if (session()->has('error'))
    <script>
        toastr['error']('{{ session("error") }}', 'error!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
        });
    </script>
@endif