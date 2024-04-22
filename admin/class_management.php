<?php
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management - <?php echo SITE_NAME?></title>
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
                        <h4>Class Management</h4>
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
                                <th></th>
                                <th>Section</th>
                                <th>Faculty</th>
                                <th>Academic Year</th>
                                <th>Courses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = 
                                "SELECT classes.*, 
                                    (SELECT GROUP_CONCAT(courses.code SEPARATOR ', ') 
                                    FROM class_courses 
                                    LEFT JOIN courses ON class_courses.course_id = courses.id 
                                    WHERE class_courses.class_id = classes.id) AS class_courses,
                                    CONCAT(year_start, '-', year_end) AS academic_year,
                                    (SELECT code FROM sections WHERE sections.id = classes.section_id) AS section_code,
                                    (SELECT CONCAT(first_name, ' ', last_name) FROM users WHERE users.id = faculty.user_id) AS user_full_name
                                FROM 
                                    classes, faculty;
                                ";
                            
                                
                                $result = $conn->query($query);
                                    while($list=$result->fetch_assoc()){

                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?=$list['section_code']?></td>
                                <td><?=$list['user_full_name']?></td>
                                <td><?=$list['academic_year']?></td>
                                <td><?=$list['class_courses']?></td>
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
                                    <label for="enter_section" class="form-label">Section</label>
                                    <select class="form-select" id="enter_section" name="enter_section" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result2 = $conn->query(
                                            "SELECT * FROM sections;"
                                            );
                                            while($sectionList=$result2->fetch_assoc()){
                                        ?>
                                        <option value="<?= $sectionList['id']?>"><?= $sectionList['code'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="enter_faculty" class="form-label">Faculty</label>
                                <select class="form-select" id="enter_faculty" name="enter_faculty" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result3 = $conn->query(
                                            "SELECT *, 
                                                (SELECT CONCAT(first_name, ' ', last_name) FROM users WHERE users.id = faculty.user_id) AS full_name
                                            FROM faculty;"
                                            );
                                            while($userList=$result3->fetch_assoc()){
                                        ?>
                                        <option value="<?= $userList['id']?>"><?= $userList['full_name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_year1" class="form-label">Start Year</label>
                                    <input type="number" min="1900" max="2099" class="form-control" id="enter_year1" name="enter_year1" value="<?= date('Y') ?>" onchange="updateEndYear()">
                                </div>
                                <div class="col">
                                    <label for="enter_year2" class="form-label">End Year</label>
                                    <input type="number" min="1900" max="2099" class="form-control" id="enter_year2" name="enter_year2" value="<?= date('Y')+1 ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_course" class="form-label">Courses</label>
                                    <select name="enter_course[]" class="form-control multiple-category" id="enter_course" multiple="multiple" style="width: 100%;">
                                    <?php
                                    $result2 = $conn->query("SELECT * FROM courses");
                                        while($course=$result2->fetch_assoc()){
                                    ?>
                                        <option value="<?= $course['id'] ?>"><?= $course['description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
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
                            <div class="mb-3">
                                <div class="col">
                                    <label for="enter_section" class="form-label">Section</label>
                                    <select class="form-select" id="enter_section" name="enter_section" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result2 = $conn->query(
                                            "SELECT * FROM sections;"
                                            );
                                            while($sectionList=$result2->fetch_assoc()){
                                        ?>
                                        <option value="<?= $sectionList['id']?>"><?= $sectionList['code'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="enter_faculty" class="form-label">Faculty</label>
                                <select class="form-select" id="enter_faculty" name="enter_faculty" aria-label="Default select example">
                                        <option selected></option>
                                        <?php
                                        $result3 = $conn->query(
                                            "SELECT *, 
                                                (SELECT CONCAT(first_name, ' ', last_name) FROM users WHERE users.id = faculty.user_id) AS full_name
                                            FROM faculty;"
                                            );
                                            while($userList=$result3->fetch_assoc()){
                                        ?>
                                        <option value="<?= $userList['id']?>"><?= $userList['full_name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_year1" class="form-label">Start Year</label>
                                    <input type="number" min="1900" max="2099" class="form-control" id="enter_year1" name="enter_year1" value="<?= date('Y') ?>" onchange="updateEndYear()">
                                </div>
                                <div class="col">
                                    <label for="enter_year2" class="form-label">End Year</label>
                                    <input type="number" min="1900" max="2099" class="form-control" id="enter_year2" name="enter_year2" value="<?= date('Y')+1 ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enter_course" class="form-label">Category</label>
                                    
                                </div>
                            </div>
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
        $section = $_POST["enter_section"];
        $faculty = $_POST["enter_faculty"];
        $start_year = $_POST["enter_year1"];
        $end_year = $_POST["enter_year2"];

        $query = "INSERT INTO classes (section_id, faculty_id, year_start, year_end) VALUES ('$section', '$faculty', '$start_year', '$end_year')";

        if (mysqli_query($conn, $query)) {	
            // Get the ID of the inserted class
            $last_id = mysqli_insert_id($conn);
            
            // Insert selected courses for the class
            if(isset($_POST["enter_course"])) {
                foreach ($_POST["enter_course"] as $key => $value){
                    $category_id = $_POST["enter_course"][$key];
                    $course_query = "INSERT INTO class_courses (class_id, course_id) VALUES ('$last_id', '$category_id')";
                    mysqli_query($conn, $course_query);
                }
            }
    
            echo "<script> alert('Data Inserted Successfully. Inserted Class ID: $last_id'); </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        } 
    }
?>
<?php include_once('../plugins/plugins-js.php');?>
<script src="./js/script.js"></script>
<script>
    function updateEndYear() {
        var startYear = document.getElementById('enter_year1').value;
        var endYearInput = document.getElementById('enter_year2');

        // Calculate end year as start year + 1
        var endYear = parseInt(startYear) + 1;
        
        // Update the value of enter_year2 input field
        endYearInput.value = endYear;
    }

        // Function to reset the modal form fields
        function resetModal() {
        // Reset input fields
        $('#enter_code').val('');
        $('#enter_faculty').val('');
        $('#enter_year1').val('');
        $('#enter_year2').val(''); 

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