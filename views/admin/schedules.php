<?php
    session_start();
    require_once dirname(__DIR__, 2) . '/bl/sectionManage.php';
    require_once dirname(__DIR__, 2) . '/bl/roomManage.php';
    require_once dirname(__DIR__, 2) . '/bl/scheduleManage.php';
    require_once dirname(__DIR__, 2) . '/bl/scheduleTypeManage.php';
    require_once dirname(__DIR__, 2) . '/bl/dayManage.php';


    $roommanagement = new roomManage();
    $rooms = $roommanagement -> getRooms();

    $schedtypemanage = new schedTypeManage();
    $schedtype = $schedtypemanage -> getScheduleTypes();

    $daysmanage = new dayManage();
    $days = $daysmanage -> getDays();

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
    <title>Room Tracker | Admin Schedule View </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="../components/main.css">
    <link rel="stylesheet" href="admin2.css">
    
    <script defer src="../../scripts/service.js"></script>
</head>
<body>
    <nav>
        <?php require_once dirname(__DIR__, 2) . '/views/components/navbar.php';?>
    </nav>
    <script async>
        $(document).ready(function () {
            $("#myTable").DataTable();
        }); 
    </script>
    <?php include_once("adminSideNavbar.html");?>
    <main class="main-border-box main-top">
        <div class="input-area">
            <div class="entry-area">
                <label for="schedTypeSelect" class="label-line">Schedule Type</label>
                <select name="schedTypeSelect" class="input-field select-box" id="schedTypeSelect">
                    <option value="" disabled selected>Choose a type</option>
                        <?php foreach($schedtype as $type) : ?>
                        <option value="<?= $type['schedTypeID'] ?>" ><?= ucfirst($type['type_name']) ?></option>
                        <?php endforeach; ?>
                </select>
                <div class="icon-container">
                    <span class="material-symbols-outlined">arrow_drop_down</span>
                </div>
            </div>
            <div class="entry-area">
                <label for="roomSelect" class="label-line">Room No.</label>
                <select name="roomSelect" class="input-field select-box" id="roomSelect">
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
                                <option value="<?= $room['room_number']?>"><?=  $room['room_number']?></option>
                        <?php endforeach;?>
                            </optgroup>
                    <?php endforeach; ?>
                </select>
                <div class="icon-container">
                    <span class="material-symbols-outlined">arrow_drop_down</span>
                </div>
            </div>
            <div class="entry-area">
                <label for="sectionSelect" class="label-line">Section</label>
                <select name="sectionSelect" class="input-field select-box" id="sectionSelect">
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
                                    <option value="<?= $section['section_code'] ?>">
                                        <?= $section['section_code'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                    <?php endforeach; ?>
                </select>
                <div class="icon-container">
                    <span class="material-symbols-outlined">arrow_drop_down</span>
                </div>
            </div>
            <div class="entry-area">
                <label for="daySelect" class="label-line">Day</label>
                <select name="daySelect" class="input-field select-box" id="daySelect">
                    <option value="" disabled selected>Choose a Day</option>
                    <?php foreach($days as $day) : ?>
                        <option value="<?= $day['day_id'] ?>" ><?= ucfirst($day['day_name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="icon-container">
                    <span class="material-symbols-outlined">arrow_drop_down</span>
                </div>
            </div>
            <div class="entry-area">
                <label for="timeIn" class="label-line">Time Start</label>
                <input type="time" class="input-field" id="timeIn">
            </div>
            <div class="entry-area">
                <label for="timeOut" class="label-line">Time End</label>
                <input type="time" class="input-field" id="timeOut">
            </div>
        </div>
        <div class="button-area">
            <button onclick="addNewSchedule()">Submit<span class="material-symbols-outlined">add_circle</span></button>
        </div>

    </main>
    <main class="main-border-box main-bottom">
        <table class="display compact" id="myTable">
            <thead>
                <tr>
                    <th> Count </th>
                    <th> Type </th>
                    <th> Room </th>
                    <th> Section </th>
                    <th> Day </th>
                    <th colspan="3"> <center>Time</center> </th>
                    <th> <center>Action</center> </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($schedules)) :  ?>
                <?php foreach($schedules as $index=> $sched) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= ucfirst($sched["type_name"]) ?></td>
                    <td><?= $sched["room_number"] ?></td>
                    <td><?= $sched["section_code"] ?></td>
                        <td><?= ucfirst($sched["day_name"]) ?></td>
                        <td><center><?= date_format(date_create($sched["time_start"]), "g:i A") ?></center></td>
                        <td><center>-</center></td>
                        <td></center><?= date_format(date_create($sched["time_end"]),"g:i A") ?></center></td>
                        <td class="action-button-area">
                            <button class="disable-button" onclick="toggleRoom(<?= $sched['room_number'] ?>)" title="Disable Room"><span class="material-symbols-outlined">block</span></button>
                            <button class="update-button" onclick="changeSchedInfo(<?= $sched['sched_id'] ?>)" title="Edit Schedule entry"><span class="material-symbols-outlined">edit</span></button>
                            <button class="delete-button" onclick="deleteSchedule(<?= $sched['sched_id'] ?>)" title="Delete Schedule entry"><span class="material-symbols-outlined">delete</span></button>
                        </td>
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