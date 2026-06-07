<?php include 'db.php'; include 'header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h4 class="text-center mb-4">Register New Student</h4>
            <form method="POST">
                <input type="text" name="sid" class="form-control mb-2" placeholder="Student ID" required>
                <input type="text" name="sname" class="form-control mb-2" placeholder="Full Name" required>
                <input type="text" name="course" class="form-control mb-3" placeholder="Course" required>
                <button type="submit" name="reg" class="btn btn-success w-100">Register & Generate QR</button>
            </form>
            
            <?php
            if(isset($_POST['reg'])){
                $id = $_POST['sid']; $name = $_POST['sname']; $course = $_POST['course'];
                if(mysqli_query($conn, "INSERT INTO students VALUES ('$id', '$name', '$course')")){
                    $qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$id";
                    echo "<div class='text-center mt-3' id='qrArea'>
                            <img src='$qr' id='qrImg' crossorigin='anonymous'>
                            <br><p>ID: $id</p>
                            <button class='btn btn-sm btn-primary' onclick='downloadQR(\"$id\")'>Download QR</button>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
function downloadQR(id) {
    const image = document.getElementById('qrImg');
    const imagePath = image.src;
    
    fetch(imagePath)
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'QR_' + id + '.png';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(() => alert('Download failed!'));
}
</script>
