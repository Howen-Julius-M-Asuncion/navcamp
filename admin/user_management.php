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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.1/b-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/rg-1.5.0/sb-1.7.0/sp-2.3.0/sl-2.0.0/datatables.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/admin-sidebar.php');?>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4>User Management</h4>
                        <form method="post" action="" id="actionsForm">
                            <div class="actions fs-6">
                                <button type="button" class="btn btn-outline-success btn-sm" id="addEntryBtn"><i class="fa-solid fa-plus"></i>&nbsp;New Entry</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="editEntryBtn"><i class="fa-solid fa-pen"></i>&nbsp;Edit</button>
                                <button type="button" class="btn btn-outline-danger btn-sm" id="deleteEntryBtn"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row px-3">
                    <table id="display-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Full Name</th>
                                <th>Account Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result2 = $conn->query("SELECT user_accounts.*, user_types.title FROM user_accounts JOIN user_types ON user_accounts.user_type_ID = user_types.type_ID");
                                    while($userList=$result2->fetch_assoc()){
                                        $full_name = $userList['first_name'].' '.$userList['last_name'];
                            ?>
                            <tr>
                                <td></td>
                                <td><?=$userList['user_id']?></td>
                                <td><?=$userList['username']?></td>
                                <td><?=$userList['email']?></td>
                                <td><?=$userList['password']?></td>
                                <td><?=$full_name?></td>
                                <td><?=$userList['title']?></td>
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
                            <div class="mb-3">
                                <label for="enter_email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="enter_email" name="enter_email" value="">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_user" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="enter_user" name="enter_user" value="">
                                </div>
                                <div class="col">
                                    <label for="enter_type" class="form-label">Account Type</label>
                                    <!-- <input type="text" class="form-control" id="enter_cat" name="enter_cat" value=""> -->
                                    <select class="form-select" id="enter_type" name="enter_type" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result2 = $conn->query("SELECT * FROM user_types");
                                            while($userList=$result2->fetch_assoc()){
                                        ?>
                                        <option value="<?= $userList['type_id'] ?>"><?= $userList['title'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_first" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="enter_first" name="enter_first" value="">
                                </div>
                                <div class="col">
                                    <label for="enter_last" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="enter_last" name="enter_last" value="">
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
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEntryModalLabel">Edit Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Hidden ID input -->
                            <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="">
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="edit_email" name="edit_email" value="">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_user" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="edit_user" name="edit_user" value="">
                                </div>
                                <div class="col">
                                    <label for="edit_type" class="form-label">Account Type</label>
                                    <!-- <input type="text" class="form-control" id="enter_cat" name="enter_cat" value=""> -->
                                    <select class="form-select" id="edit_type" name="edit_type" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result2 = $conn->query("SELECT * FROM user_types");
                                            while($userList=$result2->fetch_assoc()){
                                        ?>
                                        <option value="<?= $userList['type_id'] ?>"><?= $userList['title'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_first" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="edit_first" name="edit_first" value="">
                                </div>
                                <div class="col">
                                    <label for="edit_last" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="edit_last" name="edit_last" value="">
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal" name="addEntry"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</body>
<?php 
    // PHP logic for data insertion modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["addEntry"])) {
        $email = $_POST["enter_email"];
        $username = $_POST["enter_user"];
        $first_name = $_POST["enter_first"];
        $last_name = $_POST["enter_last"];
        $account_type = $_POST["enter_type"];

        $query = "INSERT INTO user_accounts (username, email, password, first_name, last_name, user_type_id) VALUES ('$username', '$email', '12345', '$first_name', '$last_name', '$account_type')";

        if (mysqli_query($conn, $query)) {	
            echo "<script> alert('Data Inserted Successfully'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // PHP logic for data update modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["editEntry"])) {
        $email = $_POST["enter_email"];
        $username = $_POST["enter_user"];
        $first_name = $_POST["enter_first"];
        $last_name = $_POST["enter_last"];
        $account_type = $_POST["enter_type"];

        $query = "INSERT INTO user_accounts (username, email, password, first_name, last_name, user_type_id) VALUES ('$username', '$email', '12345', '$first_name', '$last_name', '$account_type')";

        if (mysqli_query($conn, $query)) {	
            echo "<script> alert('Data Inserted Successfully'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
?>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.1/b-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/rg-1.5.0/sb-1.7.0/sp-2.3.0/sl-2.0.0/datatables.min.js"></script>
<script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
</html>