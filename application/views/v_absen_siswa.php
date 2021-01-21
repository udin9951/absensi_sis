<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }

    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }

    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }

    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">form Absen</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Absen</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">NIS</label><br>
                                <input type="number" name="nis" id="nis" class="form-control">
                            </div>
                            <div id="app" class="form-group">

                            </div>
                            <div style="text-align:center;display :none" id="div_loading">
                                <img id="loading-image" style="width : 50px;height : 50px; " src="<?= base_url('asset/images/loading.gif') ?>">
                            </div>
                            <div class="form-group">
                                <input type="button" id="btn-absen" class="btn btn-info btn-md" value="submit">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        var latitude
        var longitude

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            latitude = position.coords.latitude
            longitude = position.coords.longitude

        }



        $(document).ready(function() {

            $('#btn-absen').on('click', function() {
                nis = $('#nis').val()
                if (nis == "") {
                    alert('nis ga boleh kosong');
                } else {
                    getLocation();
                    $('#div_loading').show()
                    setTimeout(function() {
                        // latitude
                        // longitude

                        $.ajax({
                            url: "<?php echo site_url('Absen_siswa/get_nis') ?>",
                            type: "POST",
                            dataType: 'json',
                            data: {

                                nis: nis,
                                latitude: latitude,
                                longitude: longitude
                            },
                            success: function(response) {
                                $('#div_loading').hide()
                                $('#app').html(response)
                            }
                        })
                    }, 500)
                }



            });



        });
    </script>
</body>

</html>