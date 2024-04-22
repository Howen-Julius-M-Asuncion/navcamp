<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - <?php echo SITE_NAME?></title>
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
                        <h4>User List</h4>
                        <div class="actions fs-6">
                            <form method="get" action="" id="actionsForm">
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Password</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM users";
                                
                                $result = $conn->query($query);
                                    while($list=$result->fetch_assoc()){
                            ?>
                            <tr>
                                <td></td>
                                <td><?=$list['id']?></td>
                                <td><?=$list['username']?></td>
                                <td><?=$list['email']?></td>
                                <td><?=$list['first_name'].' '.$list['last_name']?></td>
                                <td><?=$list['password']?></td>
                                <td><?=$list['created_at']?></td>
                                <td><?=$list['updated_at']?></td>
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
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row mb-3 location">
                                <div class="col">
                                    <label for="enter_user" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="enter_user" name="enter_user" value="">
                                </div>
                                <div class="col">
                                    <label for="enter_email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="enter_email" name="enter_email" value="">
                                </div>
                            </div>
                            <div class="row mb-3 name">
                                <div class="col">
                                    <label for="enter_first" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="enter_first" name="enter_first" value="">
                                </div>
                                <div class="col">
                                    <label for="enter_last" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="enter_last" name="enter_last" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_type" class="form-label">Account Type</label>
                                    <select name="enter_type" class="form-select" id="enter_type">
                                        <option selected></option>
                                        <option value="1">Student</option>
                                        <option value="2">Faculty</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <!-- <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-circle-check"></i>&nbsp;Apply and Add New</button> -->
                            <button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal" name="editEntry"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Edit Entry Modal -->
        <form method="post" action="" id="editEntryForm">
            <div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="editEntryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEntryModalLabel">Edit Entry</h5>
                            <input type="text" class="ms-5" id="edit_id" name="edit_id" value="" disabled>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_user" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="edit_user" name="edit_user" value="">
                                </div>
                                <div class="col">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="edit_email" name="edit_email" value="">
                                </div>
                            </div>
                            <div class="row mb-3 name">
                                <div class="col">
                                    <label for="edit_first" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="edit_first" name="edit_first" value="">
                                </div>
                                <div class="col">
                                    <label for="edit_last" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="edit_last" name="edit_last" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_pass" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="edit_pass" name="edit_pass" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_type" class="form-label">Account Type</label>
                                    <select name="edit_type" class="form-select" id="edit_type">
                                        <option selected></option>
                                        <option value="1">Student</option>
                                        <option value="2">Faculty</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal" name="editEntry"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<!-- Footer -->
<?php 
    // PHP logic for data insertion modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["addEntry"])) {
        $email = $_POST["enter_email"];
        $username = $_POST["enter_user"];
        $first_name = $_POST["enter_first"];
        $last_name = $_POST["enter_last"];

        $query = "INSERT INTO users (username, email, password, first_name, last_name, created_at, updated_at) VALUES ('$username', '$email', '12345', '$first_name', '$last_name', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        if (mysqli_query($conn, $query)) {	
            echo "<script> alert('Data Inserted Successfully'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // PHP logic for data update modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["editEntry"])) {
        $email = $_POST["edit_email"];
        $username = $_POST["edit_user"];
        $password = $_POST["edit_pass"];
        $first_name = $_POST["edit_first"];
        $last_name = $_POST["edit_last"];
        $id = $_POST["edit_id"];

        $query = "UPDATE users SET username = '$username', email = '$email', password = '$hashed_password', first_name = '$first_name', last_name = '$last_name', updated_at = CURRENT_TIMESTAMP WHERE id = $id";

        if (mysqli_query($conn, $query)) {	
            echo "<script> alert('Data Updated Successfully'); </script>";
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
        $('#enter_user').val('');
        $('#enter_email').val('');
        $('#enter_type').val('');

        // Reset select2 dropdown
        $('.multiple-category').val(null).trigger('change');
    }

    $(document).ready(function() {
        // Reset modal on close
        $('#addEntryModal').on('hidden.bs.modal', function () {
            resetModal();
        });
    });
</script>
</html>
