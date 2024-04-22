<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <?php include_once('../plugins/plugins-css.php');?>
    <style>
        .select2-container .select2-selection--multiple {
            min-height:38px !important;
        }
        .select2-container--default .select2-container--focus .select2-selection--multiple {
            border:solid #ced4da 1px;
        }

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
                            <button type="button" class="btn btn-outline-success btn-sm" id="addEntryBtn"><i class="fa-solid fa-plus"></i>&nbsp;New Entry</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="editEntryBtn"><i class="fa-solid fa-pen"></i>&nbsp;Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="deleteEntryBtn"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
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
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Category</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = 
                                "SELECT 
                                    rooms.*, 
                                    (SELECT GROUP_CONCAT(categories.category SEPARATOR ', ') 
                                    FROM room_categories 
                                    LEFT JOIN categories ON room_categories.category_id = categories.id 
                                    WHERE room_categories.room_id = rooms.id) AS room_categories,
                                    (SELECT CONCAT('Floor ', addresses.floor, ', ', buildings.building) 
                                    FROM addresses 
                                    LEFT JOIN buildings ON addresses.building_id = buildings.id 
                                    WHERE rooms.address_id = addresses.id) AS room_location,
                                    (SELECT addresses.building_id 
                                    FROM addresses 
                                    WHERE rooms.address_id = addresses.id) AS room_building
                                FROM 
                                    rooms;
                                ";
                                
                                $result = $conn->query($query);
                                    while($list=$result->fetch_assoc()){
                            ?>
                            <tr>
                                <td></td>
                                <td><?=$list['id']?></td>
                                <td><?=$list['code']?></td>
                                <td><?=$list['room_location']?></td>
                                <td><?=$list['capacity']?></td>
                                <td><?=$list['room_categories']?></td>
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
        <form method="post" action="">
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
                                <div class="col-3 pe-1">
                                    <label for="enter_code" class="form-label">Room Code</label>
                                    <input type="text" class="form-control" id="enter_code" name="enter_code" value="">
                                </div>
                                <div class="col-3 px-1">
                                    <label for="enter_floor" class="form-label">Floor (1-4)</label>
                                    <input type="number" class="form-control" id="enter_floor" name="enter_floor" min="1" max="4" oninput="validity.valid||(value='');" pattern="\d*">
                                </div>
                                <div class="col ps-1">
                                    <label for="enter_bldg" class="form-label">Building</label>
                                    <select name="enter_bldg" class="form-select" id="enter_bldg">
                                        <option selected></option>
                                        <?php
                                        $result1 = $conn->query("SELECT * FROM buildings");
                                            while($room=$result1->fetch_assoc()){
                                        ?>
                                        <option value="<?= $room['id'] ?>"><?= $room['building'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_cat" class="form-label">Category</label>
                                    <select name="enter_cat[]" class="form-control multiple-category" id="enter_cat" multiple="multiple" style="width: 100%;">
                                    <?php
                                    $result2 = $conn->query("SELECT * FROM categories");
                                        while($room=$result2->fetch_assoc()){
                                    ?>
                                        <option value="<?= $room['id'] ?>"><?= $room['category'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="e" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="enter_cap" name="enter_cap" value="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="enter_desc" class="form-label">Description</label>
                                <textarea class="form-control" id="enter_desc" name="enter_desc" rows="5"></textarea>
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
        <form method="post" action="">
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
                            <div class="row mb-3 location">
                                <div class="col-3 pe-1">
                                    <label for="edit_code" class="form-label">Room Code</label>
                                    <input type="text" class="form-control" id="edit_code" name="edit_code" value="">
                                </div>
                                <div class="col-3 px-1">
                                    <label for="edit_floor" class="form-label">Floor (1-4)</label>
                                    <input type="number" class="form-control" id="edit_floor" name="edit_floor" min="1" max="4" oninput="validity.valid||(value='');" pattern="\d*">
                                </div>
                                <div class="col ps-1">
                                    <label for="edit_bldg" class="form-label">Building</label>
                                    <select name="edit_bldg" class="form-select" id="edit_bldg">
                                        <option selected></option>
                                        <?php
                                        $result1 = $conn->query("SELECT * FROM buildings");
                                            while($room=$result1->fetch_assoc()){
                                        ?>
                                        <option value="<?= $room['id'] ?>"><?= $room['building'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_cat" class="form-label">Category</label>
                                    <select name="edit_cat[]" class="form-control multiple-category" id="edit_cat" multiple="multiple" style="width: 100%;">
                                    <?php
                                    $result2 = $conn->query("SELECT * FROM categories");
                                        while($room=$result2->fetch_assoc()){
                                    ?>
                                        <option value="<?= $room['id'] ?>"><?= $room['category'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="edit_cap" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="edit_cap" name="edit_cap" value="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="edit_desc" class="form-label">Description</label>
                                <textarea class="form-control" id="edit_desc" name="edit_desc" rows="5"></textarea>
                            </div>
                        </div>
                        <!-- Modal Footer -->
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
<!-- Footer -->
<?php 
    // PHP logic for data insertion modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["addEntry"])) {
        $code = $_POST["enter_code"];
        $capacity = $_POST["enter_cap"];
        $description = $_POST["enter_desc"];
        $status = "Available";
        $floor = $_POST["enter_floor"];
        $building = $_POST["enter_bldg"];
        $location = "";

        switch ($building) {
            case "1":
                switch ($floor) {
                    case "1":
                        $location = "2";
                        break;
                    case "2":
                        $location = "3";
                        break;
                    case "3":
                        $location = "4";
                        break;
                    default:
                        break;
                }
                break;
            case "2":
                switch ($floor) {
                    case "1":
                        $location = "5";
                        break;
                    case "2":
                        $location = "6";
                        break;
                    case "3":
                        $location = "7";
                        break;
                    default:
                        break;
                }
                break;
            case "3":
                switch ($floor) {
                    case "1":
                        $location = "8";
                        break;
                    case "2":
                        $location = "9";
                        break;
                    case "3":
                        $location = "10";
                        break;
                    case "4":
                        $location = "11";
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }

        $query = "INSERT INTO rooms (code, capacity, description, status, address_id) VALUES ('$code', '$capacity', '$description', '$status', '$location')";

        if (mysqli_query($conn, $query)) {	
            // Get the ID of the inserted room
            $last_id = mysqli_insert_id($conn);
            
            // Insert selected categories for the room
            if(isset($_POST["enter_cat"])) {
                foreach ($_POST["enter_cat"] as $key => $value){
                    // Sanitize input to prevent SQL injection
                    $category_id = $_POST["enter_cat"][$key];
                    // Execute query to insert room category
                    $category_query = "INSERT INTO room_categories (room_id, category_id) VALUES ('$last_id', '$category_id')";
                    mysqli_query($conn, $category_query);
                }
            }
    
            echo "<script> alert('Data Inserted Successfully. Inserted Room ID: $last_id'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        } 
    }

    // PHP logic for data updating modal
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["editEntry"])) {
    //     // Fetch the room ID from the hidden input field in the edit modal
    //     $roomId = $_POST["edit_id"];

    //     // Fetch room data from the database based on the room ID
    //     $query = "SELECT * FROM rooms WHERE id = '$roomId'";
    //     $result = $conn->query($query);

    //     // Check if the query returned any rows
    //     if ($result->num_rows > 0) {
    //         // Fetch room data
    //         $roomData = $result->fetch_assoc();

    //         // Assign room data to variables
    //         $edit_code = $roomData['code'];
    //         $edit_floor = $roomData['floor'];
    //         $edit_bldg = $roomData['room_building'];
    //         $edit_cat = explode(", ", $roomData['room_categories']);
    //         $edit_cap = $roomData['capacity'];
    //         $edit_desc = $roomData['description'];
    //     } else {
    //         // Handle case where room data is not found
    //         echo "<script>alert('Room not found!');</script>";
    //     }
    // }
?>
<?php include_once('../plugins/plugins-js.php');?>
<script src="./js/script.js"></script>
<script>
    // Function to reset the modal form fields
    function resetModal() {
        // Reset input fields
        $('#enter_code').val('');
        $('#enter_cap').val('');
        $('#enter_desc').val('');
        $('#enter_floor').val('');
        $('#enter_bldg').val('');

        // Reset select2 dropdown
        $('.multiple-category').val(null).trigger('change');
    }

    $(document).ready(function() {
        // Initialize select2 dropdown
        $('.multiple-category').select2({
            dropdownParent: $('#addEntryModal'),
            width: 'resolve'
        });

        // Reset modal on close
        $('#addEntryModal').on('hidden.bs.modal', function () {
            resetModal();
        });
    });

</script>
</html>