<?php include 'header.php'; ?>
<script src="https://unpkg.com/html5-qrcode"></script>
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card p-4">
            <h4>Scan Student QR</h4>
            <div id="reader"></div>
            <div id="result" class="mt-3 p-3 bg-light rounded">Point camera at QR</div>
        </div>
    </div>
</div>
<script>
    function onScanSuccess(txt) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('result').innerHTML = this.responseText;
            }
        };
        x.open("GET", "log_attendance.php?id=" + txt, true);
        x.send();
    }
    var scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    scanner.render(onScanSuccess);
</script>