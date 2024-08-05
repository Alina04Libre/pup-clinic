<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
</head>

<body>
    <div id="sy-whatshelp">
        <!-- minano -->

        <!-- <a href="/chatify/ {{ auth()->id()}}" target="_blank" class="sywh-open-services" data-tooltip="Message Us" data-placement="left"> -->
        <a href="/chatify/4" target="_blank" class="sywh-open-services" data-tooltip="Message Us" data-placement="left">
            <i class="fa fa-comments" style=" margin-top: 15px;"></i>
            <div class="unread_message">{{ auth()->user()->getMessageCount()}}</div>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('4d05757c21d71ee8d884', {
          cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            
            // minano
            $.ajax({
                url: "{{ route('unreadcount')}}",
                method: "GET",
                success:function(data) {
                    $('.unread_message').html(data.count);
                }
            })

        });
      </script>
</body>

<style>
    #sy-whatshelp {
        right: 25px;
        bottom: 25px;
        position: fixed;
        z-index: 9999;
    }

    #sy-whatshelp a.sywh-open-services {
        background-color: #c23616;
        color: #fff;
        line-height: 55px;
        margin-top: 10px;
        border: none;
        cursor: pointer;
        font-size: 23px;
        width: 55px;
        height: 55px;
        text-align: center;
        box-shadow: 2px 2px 8px -3px #000;
        border-radius: 100%;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        -ms-border-radius: 100%;
        display: inline-block;
    }


    .unread_message {
        margin-top: 10px;
        margin-left: 50px;
        position: absolute;
        background-color: red;
        color: #ffffff;
        width: 15px;
        height: 15px;
        text-align: center;
        border-radius: 50%;
        font-size: 12px;
        line-height: 15px;
        top: -7px;
        left: -7px;
        z-index: 1;
    }


    a[data-tooltip] {
        position: relative;
    }

    a[data-tooltip]::before,
    a[data-tooltip]::after {
        position: absolute;
        display: none;
        opacity: 0.85;
        transition: all 0.3s ease-in-out;
    }

    a[data-tooltip]::before {
        content: attr(data-tooltip);
        background: #000;
        color: #fff;
        font-size: 13px;
        padding: 7px 11px;
        border-radius: 5px;
        white-space: nowrap;
        text-decoration: none;
    }

    a[data-tooltip]::after {
        width: 0;
        height: 0;
        border: 6px solid transparent;
        content: "";
    }

    a[data-tooltip]:hover::before,
    a[data-tooltip]:hover::after {
        display: block;
    }

    a.sywh-open-services[data-tooltip]::before,
    a.sywh-open-services[data-tooltip]::after {
        display: block;
    }

    a.data-tooltip-hide[data-tooltip]::before,
    a.data-tooltip-hide[data-tooltip]::after {
        display: none !important;
    }

    a.sywh-open-services[data-tooltip][data-placement="left"]::before {
        top: 11px;
    }

    a[data-tooltip][data-placement="left"]::before {
        top: -7px;
        right: 100%;
        line-height: normal;
        margin-right: 10px;
    }

    a[data-tooltip][data-placement="left"]::after {
        border-left-color: #000;
        border-right: none;
        top: 50%;
        right: 100%;
        margin-top: -6px;
        margin-right: 4px;
    }

    a[data-tooltip][data-placement="right"]::before {
        top: -7px;
        left: 100%;
        line-height: normal;
        margin-left: 10px;
    }

    a[data-tooltip][data-placement="right"]::after {
        border-right-color: #000;
        border-left: none;
        top: 50%;
        left: 100%;
        margin-top: -6px;
        margin-left: 4px;
    }

    a[data-tooltip][data-placement="top"]::before {
        bottom: 100%;
        left: 0;
        margin-bottom: 10px;
    }

    a[data-tooltip][data-placement="top"]::after {
        border-top-color: #000;
        border-bottom: none;
        bottom: 100%;
        left: 10px;
        margin-bottom: 4px;
    }

    a[data-tooltip][data-placement="bottom"]::before {
        top: 100%;
        left: 0;
        margin-top: 10px;
    }

    a[data-tooltip][data-placement="bottom"]::after {
        border-bottom-color: #000;
        border-top: none;
        top: 100%;
        left: 10px;
        margin-top: 4px;
    }
</style>

</html>
