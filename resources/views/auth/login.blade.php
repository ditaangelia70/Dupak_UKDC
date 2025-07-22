<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .poppins-thin {
      font-family: "Poppins", sans-serif;
      font-weight: 100;
      font-style: normal;
    }

    .poppins-extralight {
      font-family: "Poppins", sans-serif;
      font-weight: 200;
      font-style: normal;
    }

    .poppins-light {
      font-family: "Poppins", sans-serif;
      font-weight: 300;
      font-style: normal;
    }

    .poppins-regular {
      font-family: "Poppins", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .poppins-medium {
      font-family: "Poppins", sans-serif;
      font-weight: 500;
      font-style: normal;
    }

    .poppins-semibold {
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      font-style: normal;
    }

    .poppins-bold {
      font-family: "Poppins", sans-serif;
      font-weight: 700;
      font-style: normal;
    }

    .poppins-extrabold {
      font-family: "Poppins", sans-serif;
      font-weight: 800;
      font-style: normal;
    }

    .poppins-black {
      font-family: "Poppins", sans-serif;
      font-weight: 900;
      font-style: normal;
    }

    .poppins-thin-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 100;
      font-style: italic;
    }

    .poppins-extralight-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 200;
      font-style: italic;
    }

    .poppins-light-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 300;
      font-style: italic;
    }

    .poppins-regular-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 400;
      font-style: italic;
    }

    .poppins-medium-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 500;
      font-style: italic;
    }

    .poppins-semibold-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      font-style: italic;
    }

    .poppins-bold-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 700;
      font-style: italic;
    }

    .poppins-extrabold-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 800;
      font-style: italic;
    }

    .poppins-black-italic {
      font-family: "Poppins", sans-serif;
      font-weight: 900;
      font-style: italic;
    }
    body{
      padding: 0;
      margin: 0;
    }
    .app{
      position: fixed;
      width: 100%;
      height: 100%;
      background:#D9D9D9;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }
    .card{
      padding:20px;
      background: white;
      border-radius: 10px;
      width: 30%;
      box-shadow: 1px 4px #00000040;
    }
    .card-header{
      padding:20px 10px;
      text-align: center;
      font-weight: bold;
      font-size: 24px;
      border-bottom:1px solid #ff5733;
      margin-bottom:30px;
      background: white;
    }
    .input-parent{
      margin-bottom:10px;
    }
    button{
      padding:10px 15px;
      width: 100%;
      background: #ff5733 !important;
      color:white;
      font-weight: bold;
      border: 1px solid #ff5733;
      border-radius: 10px;
      cursor: pointer;
      transition: .5s;
    }
    button:hover{
      background: #ae3232;
    }
    .input-label{
      margin-bottom:5px;
      font-weight: bold;
    }
    .submit{
      margin-top: 20px;
    }
    .input{
      padding:10px 15px;
      display: flex;
      align-items: center;
    }
    .input i{
      margin-right: 10px;
      color: #ff5733 !important;
    }
    input{
      padding:10px 15px;
      background: whitesmoke;
      border:none;
      width: 100%;
      border-radius: 10px;
      outline:none;
    }
    .icon{
      margin-bottom: 10px;
    }
    .icon a{
      color: white !important;
      text-decoration: none;
      display: flex;
      font-size: 24px;
      align-items: center;
    }
    .icon img{
      width: 100%;
    }

    @media screen and (max-width:1000px){
      .card{
        width: 80%;
      }
    }
    .btn-primary {
        background-color: #ff5733 !important; /* Change to your desired color */
        border-color: #ff5733 !important;
    }

    .btn-primary:hover {
        background-color: #e04e2b !important;
        border-color: #e04e2b !important;
    }

    .btn-primary:active, 
    .btn-primary:focus {
        background-color: #c74424 !important;
        border-color: #c74424 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 87, 51, 0.5) !important;
    }

    .text-primary {
        --bs-text-opacity: 1;
        color: #ff5733 !important;
    }
  </style>
</head>
<body>
  <div class="app poppins-black">
    <div class="icon">
      <a style="margin-right:0;" class="navbar-brand d-flex align-items-center flex-column" href="{{ url('/') }}">
          <img src="/uploads/{{ $settings->web_icon }}" style="min-width: 64px;min-height: 64px;max-width: 84px;max-height: 84px;object-fit: contain;">
          <div style="color:black;font-size:16px;text-transform: uppercase;font-weight: bold;white-space: pre-wrap;"><?= str_replace('<br>', ' ',$settings->web_title) ?></div>
      </a>
    </div>
    <form class=card method=post>
      <div class=card-header>Welcome Back!</div>
      <div class="input-parent">
        <div class="input-label">NIP</div>
        <div class="input">
          <i class="fas fa-user"></i>
          <input name=username id=username placeholder="Masukan NIP...">
        </div>
      </div>
      <div class="input-parent">
        <div class="input-label">Password</div>
        <div class="input">
          <i class="fas fa-lock"></i>
          <input type="password" name=password id=username placeholder="Masukan password...">
        </div>
      </div>
      <div class="input-parent submit">
        <button>Login</button>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        const loginForm = document.querySelector('form');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const username = formData.get('username');
                const password = formData.get('password');
                
                fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ username, password }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        // Redirect to dashboard
                        window.location.href = '/';
                    } else {
                        Swal.fire({title:'Error!',text:'Login failed: ' + (data.message || 'Invalid credentials'),icon:'error'});
                    }
                })
                .catch(error => {
                    Swal.fire({title:'Error!',text:'Register failed: ' + (error.message || 'Something went wrong!'),icon:'error'});
                });
            });
        }
    </script>
</body>
</html>