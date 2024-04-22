<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <?php include_once('../plugins/plugins-css.php');?>
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/admin-sidebar.php');?>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4>Course Management</h4>
                        <div class="actions fs-6">
                            <form method="get" action="" id="">
                                <button type="button" class="btn btn-outline-success btn-sm" id="addEntryBtn"><i class="fa-solid fa-plus"></i>&nbsp;New Entry</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="editEntryBtn"><i class="fa-solid fa-pen"></i>&nbsp;Edit</button>
                                <button type="button" class="btn btn-outline-danger btn-sm" id="deleteEntryBtn"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <table id="display-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM courses";
                                
                                $result = $conn->query($query);
                                    while($list=$result->fetch_assoc()){
                            ?>
                            <tr>
                                <td></td>
                                <td><?=$list['id']?></td>
                                <td><?=$list['code']?></td>
                                <td><?=$list['description']?></td>
                            </tr>
                            <?php
								}
						    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modals for action class -->
        <!-- Add Entry Modal -->
        <form method="post" action="" id="addEntryForm">
            <div class="modal fade" id="addEntryModal" tabindex="-1" aria-labelledby="addEntryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEntryModalLabel">Add Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col">
                                    <label for="enter_code" class="form-label">Course Code</label>
                                    <input type="text" class="form-control" id="enter_code" name="enter_code" value="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col">
                                    <label for="enter_desc" class="form-label">Description</label>
                                    <textarea class="form-control" id="enter_desc" name="enter_desc" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <!-- <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-circle-check"></i>&nbsp;Apply and Add New</button> -->
                            <button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal" name="addEntry"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Edit Entry Modal -->
        <form method="post" action="" id="">
            <div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="editEntryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEntryModalLabel">Edit Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</body>
<!-- PHP logic for data insertion modal -->
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["addEntry"])) {
        $code = $_POST["enter_code"];
        $description = $_POST["enter_desc"];

        $query = "INSERT INTO courses (code, description) VALUES ('$code', '$description')";

        if (mysqli_query($conn, $query)) {	
            echo "<script> alert('Data Inserted Successfully'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
?>
<?php include_once('../plugins/plugins-js.php');?>
<script src="./js/script.js"></script>
<script>
    // Function to reset the modal form fields
    function resetModal() {
        // Reset input fields
        $('#enter_code').val('');
        $('#enter_desc').val('');
    }

    $(document).ready(function() {
        // Reset modal on close
        $('#addEntryModal').on('hidden.bs.modal', function () {
            resetModal();
        });
    });

</script>
</html>