<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.1/date-1.5.2/fh-4.0.0/r-3.0.0/sc-2.4.0/datatables.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/admin-sidebar.php');?>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                            <h4>Schedule Management</h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-outline-success btn-sm" id="newEntry"><i class="fa-solid fa-plus"></i>&nbsp;New Entry</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="editBtn"><i class="fa-solid fa-pen"></i>&nbsp;Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="deleteBtn"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <table id="room-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 100px;">ID</th>
                                <th>Day/s</th>
                                <th>Course Code</th>
                                <th>Course Description</th>
                                <th>Faculty</th>
                                <th>Time Range</th>
                                <th>Class Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result2 = $conn->query("SELECT * FROM schedules");
                                    while($userList=$result2->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?=$userList['schedule_id']?></td>
                                <td><?=$userList['day']?></td>
                                <td><?=$userList['course_id']?></td>
                                <td><?=$userList['course_id']?></td>
                                <td><?=$userList['user_id']?></td>
                                <td><?=$userList['time_slot_id']?></td>
                                <td><?=$userList['section_id']?></td>
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
        <form method="post" action="" id="">
            <div class="modal fade" id="addEntryModal" tabindex="-1" aria-labelledby="addEntryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEntryModalLabel">Add Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i>&nbsp;Cancel</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-circle-check"></i>&nbsp;Apply and Add New</button>
                            <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-check"></i>&nbsp;Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.1/date-1.5.2/fh-4.0.0/r-3.0.0/sc-2.4.0/datatables.min.js"></script>
<script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
</html>