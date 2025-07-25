<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @include('includes.admin.style')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('includes.admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('includes.admin.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Web Senja {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="loading-clock">
        <div class="loader"></div>
    </div>

    @include('includes.admin.script')
    <script>
        $(document).ready(function() {
            function notification() {
                $.ajax({
                    url: "{{ route('admin.notif') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        let totalNotif = res.total;
                        $("#notif").text(totalNotif);

                        $('#notif-list').empty();

                        if (res.total > 0) {
                            res.contact.forEach(function(item) {
                                $('#notif-list').append(`
                    <a class="dropdown-item d-flex align-items-center" href="/admin/message/${item.id}">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{ asset('template_admin/img/undraw_profile_1.svg') }}" alt="..." />
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">
                                ${item.message.substring(0, 50)}...
                            </div>
                            <div class="small text-gray-500">${item.name} · ${new Date(item.created_at).toLocaleString()}</div>
                        </div>
                    </a>
            `);
                            });
                        } else {
                            $('#notif-list').append(
                                `<a class="dropdown-item text-center">No new notifications</a>`);
                        }
                    }

                });
            };
            notification();
            setInterval(notification, 10000)
        });
    </script>
    @yield('script')
</body>

</html>
