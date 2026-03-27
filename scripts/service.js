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
      window.location.href = "../views/loginPage.php";
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
    success: (returnData) => {
      console.log("Logging in...");
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
  exit;
}