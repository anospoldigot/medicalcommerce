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

<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
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
        $('#userchat-'+data.message.from_id).find('p').html(data.message.content)
    });

    channel.members.each(function (member) {
        var userId = member.id;
        var userInfo = member.info;

        console.log(userInfo)
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