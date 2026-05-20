//  =========================== VALIDATION =====================================
function allowOnlyNumbers(element) {
  element.value = element.value.replace(/[^0-9]/g, "");
}
function allowOnlyLetters(element) {
  element.value = element.value.replace(/[^a-zA-Z]/g, "");
}

function setError(id, msg) {
  const el = document.getElementById(id);
  el.textContent = msg;
  el.classList.add("visible");
}

function clearError(id) {
  const el = document.getElementById(id);
  el.textContent = "";
  el.classList.remove("visible");
}

function validate() {
  const pw = document.getElementById("userPassword").value;
  const confirm = document.getElementById("confPassword").value;
  let valid = true;

  if (pw === "") {
    setError("err-password", "Password cannot be empty.");
    valid = false;
  } else if (!/^(?=.*[0-9])(?=.*[_.!@#$*])[^\s]{6,}$/.test(pw)) {
    setError(
      "err-password",
      "Password needs 6+ characters, one number, and one special character (_ . ! @ # $ *).",
    );
    valid = false;
  } else {
    clearError("err-password");
  }

  if (confirm === "") {
    setError("err-confirm", "Please confirm your password.");
    valid = false;
  } else if (pw !== confirm) {
    setError("err-confirm", "Passwords do not match.");
    valid = false;
  } else {
    clearError("err-confirm");
  }

  return valid;
}

document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("keydown", (e) => {
    if (e.key === "Enter") newUserRegisterFunc();
  });

  document.getElementById("userPassword").addEventListener("input", validate);
  document.getElementById("confPassword").addEventListener("input", validate);

  document.getElementById("txtfName").addEventListener("input", () => {
    const val = document.getElementById("txtfName").value.trim();
    val.length < 3
      ? setError("err-fname", "First name needs at least 3 characters.")
      : clearError("err-fname");
  });

  document.getElementById("txtlName").addEventListener("input", () => {
    const val = document.getElementById("txtlName").value.trim();
    val.length < 3
      ? setError("err-lname", "Last name needs at least 3 characters.")
      : clearError("err-lname");
  });

  document.getElementById("regID").addEventListener("input", () => {
    const val = document.getElementById("regID").value.trim();
    !/^\d+$/.test(val) || val.length !== 10
      ? setError("err-id", "ID must be exactly 10 digits.")
      : clearError("err-id");
  });

  document.getElementById("email").addEventListener("input", () => {
    const val = document.getElementById("email").value.trim();
    const emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
    !emailRegex.test(val)
      ? setError("err-email", "Invalid email address.")
      : clearError("err-email");
  });

  document.getElementById("phone").addEventListener("input", () => {
    const val = document.getElementById("phone").value.trim();
    const phoneRegex = /^0(9\d{9}|[2-8]\d{7,8})$/;
    !phoneRegex.test(val)
      ? setError("err-phone", "Invalid Philippine phone number.")
      : clearError("err-phone");
  });
});

//  =========================== USER =====================================

function swalError(mes) {
  return Swal.fire(mes, "", "error");
}
function swalCheck(mes) {
  return Swal.fire(mes, "", "success");
}
function swalConfirm(mes) {
  return Swal.fire({
    title: mes,
    showCancelButton: true,
    confirmButtonText: "Confirm",
    cancelButtonTezt: "Cancel",
  });
}

function newUserRegisterFunc() {
  var firstName = document.getElementById("txtfName").value.trim();
  var lastName = document.getElementById("txtlName").value.trim();
  var userID = document.getElementById("regID").value.trim();
  var email = document.getElementById("email").value.trim();
  var phone = document.getElementById("phone").value.trim();
  var password = document.getElementById("userPassword").value.trim();

  const idRegex = /^\d+$/;
  const emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
  const phoneRegex = /^0(9\d{9}|[2-8]\d{7,8})$/;

  let valid = true;

  if (firstName.length < 3) {
    setError("err-fname", "First name needs at least 3 characters.");
    valid = false;
  } else clearError("err-fname");

  if (lastName.length < 3) {
    setError("err-lname", "Last name needs at least 3 characters.");
    valid = false;
  } else clearError("err-lname");

  if (!idRegex.test(userID) || userID.length !== 10) {
    setError("err-id", "ID must be exactly 10 digits.");
    valid = false;
  } else clearError("err-id");

  if (!emailRegex.test(email)) {
    setError("err-email", "Invalid email address.");
    valid = false;
  } else clearError("err-email");

  if (!phoneRegex.test(phone)) {
    setError("err-phone", "Invalid Philippine phone number.");
    valid = false;
  } else clearError("err-phone");

  if (!valid) return;
  if (!validate()) return;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      regFName: firstName,
      regLName: lastName,
      regUserID: userID,
      regEmail: email,
      regPhone: phone,
      regPass: password,
    },
    success: (returnData) => {
      swalCheck("Regustration Successful!");
      window.location.href = "../views/login.php";
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
      swalError(xhr.responseText || "An Error occurred! Please try again.");
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
    url: "../../controllers/userController.php",
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

  const loginIdRegex = /^\d+$/;

  if (!loginIdRegex.test(loginID)) {
    console.log("Invalid ID.");
    return;
  }

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
        swalConfirm("Logging in! Please wait." || returnData.message);
        window.location.href = "../views/home.php";
      } else {
        console.log(returnData.message || "Login fails.");
      }
    },
    error: (xhr) => {
      swalError(xhr.responseText || "Error loggin in, please try again.");
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
    url: "../../controllers/scheduleController.php",
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
    url: "../../controllers/scheduleController.php",
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
    url: "../../controllers/scheduleController.php",
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

//  =========================== ROOM =====================================

function toggleRoom(sched_id) {
  $.ajax({
    url: "../../controllers/roomController.php",
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
