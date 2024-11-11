<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>

<body class="overflow-hidden">
    <div class="py-2 bg-ungu d-flex">
        <div class="px-4 py-2">
            <img src="img/logo-amikom-ungu.png" alt="logo amikom" width="100px">
        </div>
        <div class="text-white py-1">
            <h3>UNIVERSITAS AMIKOM YOGYAKARTA</h3>
            <p>
            <h6>Jl.Padjajaran, Ring Road Utara, Kel.Condongcatur, Kec.Depok, Kab.Sleman, Prop. Daerah Istimewa
                Yogyakarta</h5>
                </p>
                <p>
                <h6>Telp: +62274884201, Website: www.amikom.ac.id, Email : amikom@amikom.ac.id</h6>
                </p>
        </div>
    </div>
    <div class="judul text-center py-2">
        <span>
            <h1>DASHBOARD DOSEN</h1>
        </span>

    </div>
    <div class="container justify-content-center form-login rounded">
        <div class="form p-2 mx-1 py-4 justify-content-center">
            <form action="#" method="post">
                <div class="container">
                    <span class="text-center">
                        <h3>Register Dosen</h3>
                    </span>
                    <hr>
                    <label for="nik" class="form-label">NIK</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="nik" aria-describedby="basic-addon3">
                    </div>
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="nama" aria-describedby="basic-addon3">
                    </div>
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group mb-2">
                        <input type="email" class="form-control" id="email" aria-describedby="basic-addon3">
                    </div>
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <div class="d-flex gap-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="L">
                            <label class="form-check-label" for="L">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="P">
                            <label class="form-check-label" for="P">
                                Default radio
                            </label>
                        </div>
                    </div>
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control" id="password" aria-describedby="basic-addon3">
                    </div>
                    <button class="btn btn-login text-center bg-warning my-4 w-100"><b>Register</b></button>
                </div>
            </form>

        </div>
    </div>
    <div class="container justify-content-center footer-login mt-2">
        <span>
            <h6>Have a account ? <a href="#">Login</a> </h5>
        </span>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>