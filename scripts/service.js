//  =========================== USER =====================================

function newUserRegisterFunc() {
  var firstName = document.getElementById("txtfName").value;
  var lastName = document.getElementById("txtlName").value;
  var userID = document.getElementById("regID").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var usrPass = document.getElementById("userPassword").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      regFName: firstName,
      regLName: lastName,
      regUserID: userID,
      regEmail: email,
      regPhone: phone,
      regPass: usrPass,
    },
    success: (returnData) => {
      console.log("Data sent to register user.");
      window.location.href = "../views/login.php";
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function updateUserFunc(userID) {
  var firstName = document.getElementById("txtFirstName").value;
  var lastName = document.getElementById("txtLastName").value;
  var roleID = document.getElementById("roleSelect").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      uFName: firstName,
      uLName: lastName,
      uroleID: roleID,
      uUserID: userID,
    },
    success: (returnData) => {
      console.log("Data sent to update selectef user.");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function deleteUserFunc(userID) {
  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      delID: userID,
    },
    success: (returnData) => {
      console.log("Deleting user...");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function loginFunc() {
  var loginID = document.getElementById("loginID").value;
  var password = document.getElementById("userPassword").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      loginID: loginID,
      loginPass: password,
    },
    dataType: "json",
    success: (returnData) => {
      if (returnData.success) {
        console.log(returnData.message || "Login works.");
        window.location.href = "../views/home.php";
      } else {
        console.log(returnData.message || "Login fails.");
      }
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function redirectFunc(redirectID) {
  switch (redirectID) {
    case 1: //registration
      window.location.href = "../views/homePage.php";
      break;
    default:
      console.error("No valid redirects!");
      window.location.reload();
      break;
  }
}

//  =========================== SCHEDULE =====================================

function addNewSchedule() {
  var type = document.getElementById("schedTypeSelect").value;
  var section = document.getElementById("sectionSelect").value;
  var room = document.getElementById("roomSelect").value;
  var day = document.getElementById("daySelect").value;
  var timeIn = document.getElementById("timeIn").value;
  var timeOut = document.getElementById("timeOut").value;

  $.ajax({
    url: "../controllers/scheduleController.php",
    type: "POST",
    data: {
      newSchedType: type,
      newSchedSect: section,
      newSchedRoom: room,
      newSchedDay: day,
      newSchedTimeIn: timeIn,
      newSchedTimeOut: timeOut,
    },
    success: (returnData) => {
      console.log("Making new Schedule...");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function changeSchedInfo(sched_id) {
  var type = document.getElementById("schedTypeSelect").value;
  var section = document.getElementById("sectionSelect").value;
  var room = document.getElementById("roomSelect").value;
  var day = document.getElementById("daySelect").value;
  var timeIn = document.getElementById("timeIn").value;
  var timeOut = document.getElementById("timeOut").value;

  $.ajax({
    url: "../controllers/scheduleController.php",
    type: "POST",
    data: {
      updSchedID: sched_id,
      updSchedType: type,
      updSchedSect: section,
      updSchedRoom: room,
      updSchedDay: day,
      updSchedTimeIn: timeIn,
      updSchedTimeOut: timeOut,
    },
    success: (returnData) => {
      console.log("Changing selected Schedule...");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function deleteSchedule(sched_id) {
  $.ajax({
    url: "../controllers/scheduleController.php",
    type: "POST",
    data: {
      delSchedID: sched_id,
    },
    success: (returnData) => {
      console.log("Deleting schedule...");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}
