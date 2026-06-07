<?php 
session_start();
if(!isset($_SESSION['admin'])) header("Location: login.php");
include 'db.php'; 
include 'header.php'; 

// getting the selected course
$selected_course = isset($_GET['course']) ? $_GET['course'] : '';
?>

<div class="card p-4 shadow">
    <h3>Registered Students List</h3>
    
    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <label>Filter by Course:</label>
            <select name="course" class="form-control" onchange="this.form.submit()">
                <option value="">All Courses</option>
                <?php
                $c_sql = "SELECT DISTINCT course FROM students";
                $c_res = mysqli_query($conn, $c_sql);
                while($c = mysqli_fetch_assoc($c_res)) {
                    $selected = ($selected_course == $c['course']) ? 'selected' : '';
                    echo "<option value='".$c['course']."' $selected>".$c['course']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="button" class="btn btn-success" onclick="exportTableToExcel('studentTable', 'Student_List_<?php echo $selected_course; ?>')">Download Excel</button>
        </div>
    </form>

    <table class="table table-hover mt-3" id="studentTable">
        <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Course</th></tr>
        </thead>
        <tbody>
            <?php
            // getting the query filter
            $sql = ($selected_course != "") ? "SELECT * FROM students WHERE course = '$selected_course'" : "SELECT * FROM students";
            $res = mysqli_query($conn, $sql);
            
            while($r = mysqli_fetch_assoc($res)) {
                $qr_link = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=" . urlencode($r['student_id']);
                echo "<tr>
                        <td>".$r['student_id']."</td>
                        <td>".$r['name']."</td>
                        <td>".$r['course']."</td>
                      </tr>";
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
    
    filename = filename ? filename + '.xls' : 'student_list.xls';
    
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
        