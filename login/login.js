// var usernameInpt;
var emailInpt;
var passwordInpt;
var loginBtn;
var message;

var initRegisterFrame = function() {
    console.log('REGISTER INIT');

    // Fetch DOM elements
  //  usernameInpt = $('#username');
    emailInpt = $('#email');
    passwordInpt = $('#password');
      loginBtn = $('#login_btn');
    message = $('#message_placeholder');
    
      loginBtn.on('click', register);// output data of each row
};

var register = function() {
   // var username = usernameInpt.val();
    var email = emailInpt.val();
    var password = passwordInpt.val();
    
     if( !email || !password){
         
          return;
     }
    
      $.ajax({
        type: 'POST',
        url: '../database/login.php',
        dataType: 'JSON',
        data: {
           // username: username,
            email: email,
            password: password,
           
        },
        success: function(response) {
            console.log(response);
            message.text(response);
        },
        error: function() {
            // You will end up here only if you have errors in php actions
            console.log(arguments);
        }
    });

};

// Listens to register view load and call init action
window.addEventListener('load', initRegisterFrame, false);
