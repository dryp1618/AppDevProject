function clearUserFormsFunc() {
  document.getElementById("txtFirstName").value = "";
  document.getElementById("txtLastName").value = "";
  document.getElementById("txtUserID").value = "";
  document.getElementById("roleSelect").selectedIndex = null;
}

function addUserFunc() {
  var firstName = document.getElementById("txtFirstName").value;
  var lastName = document.getElementById("txtLastName").value;
  var userID = document.getElementById("txtUserID").value;
  var roleID = document.getElementById("roleSelect").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      fName: firstName,
      lName: lastName,
      userID: userID,
      roleID: roleID,
    },
    success: (returnData) => {
      console.log("Data sent to register a user.");
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

function deleteUserFunc() {}

function redirectFunc(redirectID) {
  switch (redirectID) {
    case 1: //registration
      window.location.href = "../views/homePage.php";
      break;
    default:
      console.error("No valid redirects!");
      break;
  }
  exit;
}
