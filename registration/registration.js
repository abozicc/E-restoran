var usernameInpt;
var emailInpt;
var passwordInpt;
var firsNameInpt;
var lastNameInpt;
var addressInpt;
var registerBtn;
var message;

var initRegisterFrame = function() {
    console.log('REGISTER INIT');

    // Fetch DOM elements
    usernameInpt = $('#username');
    emailInpt = $('#email');
    passwordInpt = $('#password');
    firsNameInpt = $('#first_name');
    lastNameInpt = $('#last_name');
    addressInpt = $('#address');
    registerBtn = $('#register_btn');
    message = $('#message_placeholder');

    // Register DOM elements event handlers
    registerBtn.on('click', register);// output data of each row
};

var register = function() {
    var username = usernameInpt.val();
    var email = emailInpt.val();
    var password = passwordInpt.val();
    var firstName = firsNameInpt.val();
    var lastName = lastNameInpt.val();
    var address = addressInpt.val();

    // Validate do we have all inputs
    if(!username || !email || !password || !firstName || !lastName || !address) {
        return;
    }

    // Hit register action
    $.ajax({
        type: 'POST',
        url: '../database/register.php',
        dataType: 'JSON',
        data: {
            username: username,
            email: email,
            password: password,
            firstName: firstName,
            lastName: lastName,
            address: address
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
