<?php include ("ViewHtml/_ViewHeader.php") ?>

<div class="container mt-5">

    <h2>Image Gallery</h2>
    <?php if ($_UserIsLogin): ?>

            <form class="form-inline" id="uploadForm" enctype="multipart/form-data" >
                <input type="file" name="fileToUpload" class="btn btn-light" id="fileToUpload">
                <input type="text" class="form-control" id="CarName" name="CarName" style="margin-left:10px"
                    placeholder="Enter Car Name Please..." required>
                <input type="submit" value="Upload Image" class="btn btn-primary" style="margin-left:10px" name="submit">
            </form>

    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="photos/car1.png" class="card-img-top" style="object-fit: cover; height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">BMW 520d</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="photos/car2.png" class="card-img-top" style="object-fit: cover; height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">HYUNDAI i10</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="photos/car3.png" class="card-img-top" style="object-fit: cover; height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">KOISENNING AGERA</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="photos/car4.png" class="card-img-top" style="object-fit: cover; height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">MCLAREN SLR</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="photos/car5.png" class="card-img-top" style="object-fit: cover; height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">ALFA ROMEO HYPER</h5>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {

        var username = $('#username').val();
        <?php if ($_UserIsLogin): ?>
                username = '<?php echo $_SESSION['username'] ?>';
                username = "User Name : " + username;
                $('#username').val(username);
                $('#username').prop('readonly', true);
        <?php endif; ?>

        $('#uploadForm').submit(function (e) {
            debugger;
            e.preventDefault(); 
            var formData = new FormData($(this)[0]);

            debugger;
            $.ajax({
                url: 'api/productapi.php',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Dosya başarıyla yüklendi: ' + response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Dosya yüklenirken bir hata oluştu: ' + errorThrown);
                }
            });
        });
    });

</script>

<?php include ("ViewHtml/_ViewFooter.php") ?>