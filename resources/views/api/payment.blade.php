<html>
    <head>
    </head>
    <body>
    @include('layouts.website.script')

    <script>
        (function() {
            const messageData = {
                success: true,
                data: {
                    id: "{{$data['data']['id']}}",
                    status: "{{$data['data']['status']}}",
                    amount: "{{$data['data']['amount']}}",
                    message: "{{$data['data']['message']}}",
                },
            };
            window.ReactNativeWebView.postMessage(JSON.stringify(messageData));
        })();
    </script>
    </body>
</html>



