    <script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function () {
        $("#scroll-pelatihan").click(function () {
            $("html, body").animate({
                scrollTop: $("#pelatihan").offset().top
            }, 1000);
        });
    });
    </script>

    <footer class="text-white p-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8">
                    <h5 class="font-weight-bold">@ITC UPNYK 2018</h5>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-4">Instagram</div>
                        <div class="col-4">Facebook</div>
                        <div class="col-4">Line</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>