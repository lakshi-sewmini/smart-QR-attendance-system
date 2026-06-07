<?php 
session_start();
if(!isset($_SESSION['admin'])) header("Location: login.php");
include 'db.php'; 
include 'header.php'; 

// Getting the selected date or today's date
$selected_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : date('Y-m-d');
?>

<div class="card p-4 shadow">
    <h3>Attendance Report</h3>
    
    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <label>Select Date:</label>
            <input type="date" name="filter_date" class="form-control" value="<?php echo $selected_date; ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-success" onclick="exportTableToExcel('attendanceTable', 'Attendance_Report_<?php echo $selected_date; ?>')">Download Excel</button>
        </div>
    </form>

    <table class="table table-hover mt-3" id="attendanceTable">
        <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Time</th></tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT students.student_id, students.name, attendance.arrival_time 
                    FROM attendance 
                    JOIN students ON attendance.student_id = students.student_id 
                    WHERE DATE(attendance.arrival_time) = '$selected_date'
                    ORDER BY attendance.arrival_time DESC";
            
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) > 0) {
                while($r = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                            <td>".$r['student_id']."</td>
                            <td>".$r['name']."</td>
                            <td>".$r['arrival_time']."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No records found for this date.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    filename = filename ? filename + '.xls' : 'attendance_data.xls';
    
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob( blob, filename);
    } else {
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>

