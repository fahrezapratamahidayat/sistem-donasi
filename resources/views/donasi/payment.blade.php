<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <button id="pay-button">Bayar Sekarang</button>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '/donasi/success';
                },
                onPending: function(result) {
                    window.location.href = '/donasi/pending';
                },
                onError: function(result) {
                    window.location.href = '/donasi/error';
                },
                onClose: function() {
                    window.location.href = '/donasi/cancel';
                }
            });
        };
    </script>
</body>
</html> 