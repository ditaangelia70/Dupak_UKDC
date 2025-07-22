<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login: AHP Decision Support System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .below-minimum {
            color: red;
        }
        
        .not-passed {
            background-color: rgba(255, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-dark">
    <div style="
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h3 class="text-center mb-4 text-white">Fill Data To Register</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/register') }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
                                <a href="/login" class="mx-3">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        const registerForm = document.querySelector('form[action*="/register"]');
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const name = formData.get('name');
                const email = formData.get('email');
                const password = formData.get('password');

                if(password.length < 6)
                    return Swal.fire({title:'Error!',text:'Password must be 6 or greater!',icon:'error'});
                
                fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ name, email, password, role:'atasan' }),
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({title:'Success!',text:(data.message || 'Something went wrong!'),icon:'success'}).then(()=>{
                        window.location = '/login';
                    });
                })
                .catch(error => {
                    Swal.fire({title:'Error!',text:'Register failed: ' + (error.message || 'Something went wrong!'),icon:'error'});
                });
            });
        }
    </script>
</body>
</html>