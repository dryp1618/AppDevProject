// == VALIDATION ===
// const rules = [
//   {
//     input: document.getElementById("txtfName"),
//     error: document.getElementById("err-first-name"),
//     validate(v) {
//       if (!v) return "Username is required.";
//       if (v.length < 3)
//         return `Too short — need ${3 - v.length} more character${3 - v.length > 1 ? "s" : ""}.`;
//       if (/\s/.test(v)) return "No spaces allowed.";
//       return null;
//     },
//   },
//   {
//     input: document.getElementById("txtlName"),
//     error: document.getElementById("err-last-name"),
//     validate(v) {
//       if (!v) return "Username is required.";
//       if (v.length < 3)
//         return `Too short — need ${3 - v.length} more character${3 - v.length > 1 ? "s" : ""}.`;
//       if (/\s/.test(v)) return "No spaces allowed.";
//       return null;
//     },
//   },
//   {
//     input: document.getElementById("email"),
//     error: document.getElementById("err-email"),
//     validate(v) {
//       if (!v) return "Email is required.";
//       if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v))
//         return "Enter a valid email address.";
//       return null;
//     },
//   },
//   {
//     input: document.getElementById("password"),
//     error: document.getElementById("err-password"),
//     validate(v) {
//       if (!v) return "Password is required.";
//       if (v.length < 8)
//         return `Too short — need ${8 - v.length} more character${8 - v.length > 1 ? "s" : ""}.`;
//       if (!/\d/.test(v)) return "Must contain at least one number.";
//       if (!/[^a-zA-Z0-9]/.test(v)) return "Must contain at least one symbol.";
//       return null;
//     },
//   },
// ];

// rules.forEach(({ input, error, validate }) => {
//   input.addEventListener("input", () => {
//     const msg = validate(input.value);
//     if (msg) {
//       error.textContent = msg;
//       error.classList.add("visible");
//     } else {
//       error.classList.remove("visible");
//     }
//   });
// });

//  =========================== USER =====================================

function newUserRegisterFunc() {
  var firstName = document.getElementById("txtfName").value.trim();
  var lastName = document.getElementById("txtlName").value.trim();
  var userID = document.getElementById("regID").value.trim();
  var email = document.getElementById("email").value.trim();
  var phone = document.getElementById("phone").value.trim();
  var usrPass = document.getElementById("userPassword").value.trim();

  const emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
  const phoneRegex = /^0(9\d{9}|[2-9]\d{7,8})$./; //philippine local phone numbers
  const passwordRegex = /^(?=.*[0-9])(?=.*[_.!@#$*])[^\s]{6,}$/; //at least one number, one special character, more than 6 characters

  if (firstName.length < 3 && lastName.length < 3) {
    console.log(
      "First or Last name too short. Three or more characters required.",
    );
    return;
  }
  if (userID.length == 10) {
    console.log("User ID is only 10 digits.");
    return;
  }

  if (!emailRegex.test(email)) {
    console.log("Invalid email.");
    return;
  }

  if (!phoneRegex.test(phone)) {
    console.log("Invalid phone number.");
    return;
  }

  if (!passwordRegex.test(password)) {
    console.log("Invalid password.");
    return;
  }

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
  var firstName = document.getElementById("txtFirstName").value.trim();
  var lastName = document.getElementById("txtLastName").value.trim();
  var roleID = document.getElementById("roleSelect").value.trim();

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
  var loginID = document.getElementById("loginID").value.trim();
  var password = document.getElementById("userPassword").value.trim();

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

//  =========================== ROOM. =====================================

function toggleRoom(sched_id) {
  $.ajax({
    url: "../controllers/roomController.php",
    type: "POST",
    data: {
      disableRoom: sched_id,
    },
    success: (returnData) => {
      console.log("Disabling room...");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}
