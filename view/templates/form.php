<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="static/css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="static/js/form.js"></script>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h4><a href="/">Homepage</a></h4>
        <form id="signup_form">
            <div class="input_container first_name">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text">
                <span class="error" id="first_name_error"></span>
            </div>
            <div class="input_container last_name">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text">
                <span class="error" id="last_name_error"></span>
            </div>
            <div class="input_container email">
                <label for="email">Email</label>
                <input id="email" name="email" type="text">
                <span class="error" id="email_error"></span>
            </div>
            <button id="submit_button">Submit</button>
            <span class="success_message" id="success_message"></span>
        </form>
    </div>
</div>
</body>
</html>

<script>
    let form = new Form('signup_form')
    let submitButton = $('#submit_button')

    submitButton.on('click', function (event) {
        form.handleSave(event)
    })
</script>
