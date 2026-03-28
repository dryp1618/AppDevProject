<?php
    require_once('../bl/sectionManage.php');
    require_once('../bl/roomManage.php');
    require_once('../bl/scheduleManage.php');

    $roommanagement = new roomManage();
    $rooms = $roommanagement -> getRooms();
    $sectionmanagement = new sectionManage();
    $sections = $sectionmanagement -> getSections();
    $schedmanagement = new scheduleManage();
    $schedules = $schedmanagement -> getSchedules();

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Homepage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="admin2.css">
    <script defer src="../scripts/service.js"></script>

    <nav>   
        <?php include_once("components/navbarAdmin.html");?>
    </nav>
</head>
<body>
    <script async>
        $(document).ready(function () {
            $("#myTable").DataTable();
        }); 
    </script>
    <?php include_once("components/adminSideNavbar.html");?>
    <main class="main-border-box main-top">
        <div class="input-area">
                <div>
                    <label for="roomSelect">Room No.</label>
                    <select name="" id="roomSelect">
                        <option value="" disabled selected>Choose a Room</option>
                        <?php
                            $floorGroup = [];
                            foreach($rooms as $room){
                                $floor = substr($room['room_number'], 0, 2);
                                $floorGroup[$floor][] = $room;
                            }
                            foreach($floorGroup as $floor =>$rooms) : ?>
                                <optgroup label="Floor <?=  $floor ?>">
                                    <?php foreach($rooms as $room) : ?>
                                    <option value="<?=  $room['room_number']?>"><?=  $room['room_number']?></option>
                            <?php endforeach;?>
                                </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="sectionSelect">Section</label>
                    <select name="" id="sectionSelect">
                        <option value="" disabled selected>Choose a Section</option>
                        <?php
                            $deptGroup = [];
                            foreach ($sections as $section) {
                                $departmentName = $section['dept_name'];
                                $deptGroup[$departmentName][] = $section;
                            }

                            foreach ($deptGroup as $department => $deptSections) : ?>
                                <optgroup label="<?= $department ?>">
                                    <?php foreach ($deptSections as $section) : ?>
                                        <option value="<?= $section['sectionID'] ?>">
                                            <?= $section['year_level'] . $section['dept_code'] . $section['block'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="daySelect">Day</label>
                    <select name="" id="daySelect">
                        <option value="" disabled selected>Choose a Day</option>
                        <option value="1">Sunday</option>
                        <option value="2">Monday</option>
                        <option value="3">Tuesday</option>
                        <option value="4">Wednesday</option>
                        <option value="5">Thursday</ption>
                        <option value="6">Friday</option>
                        <option value="7">Saturday</option>
                    </select>
                </div>
                <div>
                    <label for="">Time Start</label>
                    <input type="time" id="timeIn">
                </div>
                <div>
                    <label for="">Time End</label>
                    <input type="time" id="timeOut">
                </div>
        </div>
        <div class="button-area">
            <button onclick="addNewSchedule()">Submit</button>
        </div>

    </main>
    <main class="main-border-box main-bottom">
        <table class="centered higlight striped" id="myTable">
            <thead>
                <tr>
                    <th> Room No. </th>
                    <th> Section No. </th>
                    <th> Day </th>
                    <th colspan="2"> Time </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($sched)) :  ?>
                <?php foreach($schedules as $sched) : ?>
                <tr>
                    <td><?= $sched["room_number"] ?></td>
                        <td><?= ucfirst($sched["type_name"]) ?></td>
                        <td><?= ucfirst($sched["day"]) ?></td>
                        <td><?= $sched["time_start"] ?></td>
                        <td><?= $sched["time_end"] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td>No Data Found</td>
                </tr>
                <?php endif ?>                 
            </tbody>
        </table>
    </main>

</body>
</html>