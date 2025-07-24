<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Favicon-->
    @include('includes.app.style')

</head>

<body id="page-top">
    <div class="loader-overlay">
        <div class="loader"></div>
    </div>
    <!-- Navigation-->
    @include('includes.app.navbar')
    <!-- Masthead-->
    @yield('content')
    <!-- Footer-->
    @include('includes.app.footer')
    <!-- Portfolio Modals-->
    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark">
                <div class="modal-body text-center p-0">
                    <img id="modalImagePreview" src="" class="img-fluid" alt="Preview"
                        style="max-height:90vh;">
                </div>
            </div>
        </div>
    </div>

   
    <!-- Bootstrap core JS-->
    @yield('script')

    {{-- strip tampilkan modal detail portofolio --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.portfolio-image');
            const modalImage = document.getElementById('modalImagePreview');

            images.forEach(img => {
                img.addEventListener('click', function() {
                    const src = this.getAttribute('data-img');
                    modalImage.src = src;
                    const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
                    modal.show();
                });
            });
        });
    </script>

</body>

</html>
