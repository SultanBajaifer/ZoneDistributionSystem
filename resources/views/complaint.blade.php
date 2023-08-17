<!doctype html>
<html lang="en">

<head>
    <title>Send Complaint</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<style>
    .about {
        font-size: 15px;
    }

    #timer {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #timer span {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Zone Distribution Managment System</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Send your Complaint</h3>
                                    <div id="form-message-warning" class="mb-4">

                                    </div>
                                    <div id="form-message-success" class="mb-4">
                                        Your message was sent, thank you!
                                    </div>
                                    <form action="{{route('complaints.store')}}" method="POST" id="contactForm"
                                        name="contactForm" class="contactForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">Full Name</label>
                                                    <input required type="text" class="form-control"
                                                        name="complainterName" id="name" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="passport">Passport</label>
                                                    <input required type="text" class="form-control" name="passportNum"
                                                        id="passport" placeholder="passport">
                                                </div>
                                            </div>
                                            <input type="hidden" name="timestamp" value="{{ time() }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Email Address</label>
                                                    <input required type="email" class="form-control" name="email"
                                                        id="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="display: none">
                                                <div class="form-group">
                                                    <label class="label" for="username">User
                                                        name</label>
                                                    <input type="text" class="form-control" name="username"
                                                        id="username" placeholder="username">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="#">Message</label>
                                                    <textarea required name="discription" class="form-control"
                                                        id="message" cols="30" rows="4"
                                                        placeholder="Message"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <div>
                                                    <input type="submit" disabled id="submit-btn" value="Send Complaint"
                                                        class="btn btn-warning">
                                                    <div class="submitting"></div>
                                                </div>
                                                <div id="timer">
                                                    <span id="minutes">01</span>:<span id="seconds">00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                                <div class="info-wrap bg-warning w-100 p-md-5 p-4" style="color: black">
                                    <h3 style="color: black">About us</h3>
                                    <p class="mb-4 about">Zone Distribution Managment System is built to mangae the
                                        distribution operation for anyone! company, organization, school, university or
                                        even individuals</p>
                                    <div class="dbox w-100 d-flex align-items-start">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-map-marker"></span>
                                        </div>
                                        <div class="text pl-3" style="color: black">
                                            <p class="about"><span style="color: black">Address:</span> Yemen, Fouh
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-phone"></span>
                                        </div>
                                        <div class="text pl-3" style="color: black">
                                            <p class="about" style="color: black"><span
                                                    style="color: black">Phone:</span> <a href="tel://77777777"
                                                    style="color: black">+967 7777 7777
                                                    77</a></p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-paper-plane"></span>
                                        </div>
                                        <div class="text pl-3" style="color: black">
                                            <p class="about" style="color: black"><span
                                                    style="color: black">Email:</span> <a
                                                    href="mailto:{{env('MAIL_USERNAME')}}"
                                                    style="color: black">{{env('MAIL_USERNAME')}}</a>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        const countdown = document.getElementById('timer');
const minutesSpan = document.getElementById('minutes');
const secondsSpan = document.getElementById('seconds');
const submitBtn = document.getElementById('submit-btn');

let totalSeconds = 60;
let timerInterval = null;

function startTimer() {
  timerInterval = setInterval(() => {
    totalSeconds--;
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;

    minutesSpan.textContent = minutes.toString().padStart(2, '0');
    secondsSpan.textContent = seconds.toString().padStart(2, '0');

    if (totalSeconds <= 0) {
      clearInterval(timerInterval);
      submitBtn.disabled = false;
    }
  }, 1000);
}

startTimer();
    </script>

</body>

</html>