<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Stylesheet.css">
</head>
<body class="register-body">
    @include('header')

    <div class="reg-box">
        <h3>Register</h3>
        <form action="">
            <label for="reg-fname">First Name</label>
            <input type="text" id="reg-fname" name="reg-fname">
            <label for="reg-lname">Last Name (optional)</label>
            <input type="text" id="reg-lname" name="reg-lname">
            <label for="reg-email">Email</label>
            <input type="email" id="reg-email" name="reg-email">
            <label for="reg-phone">Phone</label>
            <input type="tel" id="reg-phone" name="reg-phone">
            <label for="reg-password">Password</label>
            <input type="tel" id="reg-password" name="reg-password">
            <div class="register-birth">
                <fieldset>
                    <legend>
                        <label class="reg-birth-label" for="reg-gender">Gender</label>
                    </legend>
                    <select class="reg-birth-form" name="reg-gender" id="reg-gender">
                        <option class="reg-gender-option" style="display: none; "></option>
                        <option class="reg-gender-option">Male</option>
                        <option class="reg-gender-option">Female</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>
                        <label class="reg-birth-label" for="reg-month">Month</label>
                    </legend>
                    <select class="reg-birth-form" name="reg-month" id="reg-month" placholder="Month">
                        <option class="reg-month-option" style="display: none;"></option>
                        <option class="reg-month-option">January</option>
                        <option class="reg-month-option">February</option>
                        <option class="reg-month-option">March</option>
                        <option class="reg-month-option">April</option>
                        <option class="reg-month-option">May</option>
                        <option class="reg-month-option">June</option>
                        <option class="reg-month-option">July</option>
                        <option class="reg-month-option">August</option>
                        <option class="reg-month-option">September</option>
                        <option class="reg-month-option">October</option>
                        <option class="reg-month-option">November</option>
                        <option class="reg-month-option">December</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>
                        <label class="reg-birth-label" for="reg-day">Day</label>
                    </legend>    
                    <input class="reg-birth-form" type="number" id="reg-day" name="reg-day">
                </fieldset>
                <fieldset>
                    <legend>
                        <label class="reg-birth-label" for="reg-year">Year</label>
                    </legend>    
                    <input class="reg-birth-form" type="number" id="reg-year" name="reg-year">
                </fieldset>
            </div>
        </form>
    </div>

    @include('footer')
</body>
</html>