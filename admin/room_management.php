<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
    // if(isset($_POST['limit'])) {
    //     $limit = $_POST['limit'];
    // } else {
    //     $limit = 100;
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management - <?php echo SITE_NAME?></title>
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
                            <h4>Room List</h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-outline-success btn-sm" id="newEntry"><i class="fa-solid fa-plus"></i>&nbsp;New Entry</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="editBtn"><i class="fa-solid fa-pen"></i>&nbsp;Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="deleteBtn"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col d-flex justify-content-between mt-2">
                        <!-- Pagination selection -->
                        <!-- <form method="post" action="" id="limitForm">
                            <div class="entries d-flex align-items-center">
                                Show&nbsp;
                                <select class="form-select form-select-sm" name="limit-pages" id="limit-pages">
                                    <option disabled="disabled" selected="selected"> -- </option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>&nbsp;Entries
                            </div>
                        </form> -->
                        <!-- <div class="search">
                            <label>
                                <input class="me-2" id="searchInput" type="text" placeholder="Search...">
                                <i class="mx-2 fa-solid fa-magnifying-glass"></i>
                            </label>
                        </div> -->
                    </div>
                </div>
                <div class="row px-3">
                    <table id="room-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Code</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Description</th>
                                <th>Schedule</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Pagination logic
                                // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                // $start = ($page -1)* $limit;

                                // $result1 = $conn->query("SELECT count(room_id) AS id FROM rooms");
                                // $custCount =  $result1->fetch_all(MYSQLI_ASSOC);
                                // $total = $custCount[0]['id'];
                                // $pages = ceil($total / $limit);

                                // $previous = $page - 1;
                                // $next = $page + 1;

                                // Display results
                                // $result2 = $conn->query("SELECT * FROM rooms LIMIT $start, $limit");
                                $result2 = $conn->query("SELECT * FROM rooms");
                                    while($userList=$result2->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?=$userList['code']?></td>
                                <td><?=$userList['room_type_id']?></td>
                                <td><?=$userList['location_id']?></td>
                                <td><?=$userList['capacity']?></td>
                                <td><?=$userList['description']?></td>
                                <td><?=$userList['schedule_id']?></td>
                                <td><?=$userList['room_status']?></td>
                            </tr>
                            <?php
								}
						    ?>
                        </tbody>
                    </table>
                    <!-- Pagination navigation -->
                    <!-- <nav class="mt-2">
                        <ul class="pagination">
                            <li class="page-item">
                            <a class="page-link" href="?page=<?= $previous; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item">
                            <a class="page-link" href="?page=<?= $next; ?>"aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>

        <!-- Modals for action class -->
        <!-- Add Entry Modal -->
        <form method="post" action="" id="">
            <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRoomModalLabel">Add Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="submit modal-close text-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="submit modal-save btn-primary" name="saveChanges">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</body>

<script src="./js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.1/date-1.5.2/fh-4.0.0/r-3.0.0/sc-2.4.0/datatables.min.js"></script>
<script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
<script>
    // Modal function
	const addRoomButton = document.getElementById('newEntry');
	const addRoomModal = new bootstrap.Modal(document.getElementById('addRoomModal'));

	addRoomButton.addEventListener('click', function(event) {
        event.preventDefault();
        addRoomModal.show();
	});

    // Pagination function
    new DataTable('#room-table', {
        info: true,
        paging: true,
        responsive: true,
        fixedHeader: true,
        language: { 
            search: "", 
            searchPlaceholder: "Search..." ,
            lengthMenu: "Show _MENU_ Entries",
        }
    });
</script>
</html>