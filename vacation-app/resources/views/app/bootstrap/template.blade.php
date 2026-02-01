<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">
        <title>@yield('title', 'Luxury Escapes')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
        @yield('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Luxury Escapes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('vacaciones.index') }}">Collection</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reservas.index') }}">My Trips</a>
                            </li>
                            @if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'advanced')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav ms-3">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Access</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home') }}">My Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home.edit') }}">Edit Profile</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('hero')

        <div class="main-content">
            @yield('modalcontent')
            @yield('content')
        </div>

        <!-- Notification Modal -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-serif">Notice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <p id="notificationMessage" class="mb-0 lead"></p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-luxury" data-bs-dismiss="modal">Understood</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-serif">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <p id="confirmationMessage" class="mb-4 lead"></p>
                        <div class="d-flex justify-content-center gap-2">
                             <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                             <form id="globalDeletedForm" action="" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger text-white">Confirm</button>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-primary text-white pt-5 pb-3 mt-5 border-top border-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h3 class="mb-4 font-serif text-accent">Luxury Escapes</h3>
                        <p class="text-white-50 small mb-4">Redefining the art of travel. We create exclusive experiences for those who seek the extraordinary in every destination.</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white-50 hover-accent">Instagram</a>
                            <a href="#" class="text-white-50 hover-accent">Twitter</a>
                            <a href="#" class="text-white-50 hover-accent">Facebook</a>
                        </div>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="text-uppercase ls-1 mb-3 fw-bold">Explore</h6>
                        <ul class="list-unstyled small text-white-50">
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Destinations</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Experiences</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Magazine</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Private Club</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="text-uppercase ls-1 mb-3 fw-bold">Company</h6>
                        <ul class="list-unstyled small text-white-50">
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">About Us</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Careers</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Press</a></li>
                            <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-white">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase ls-1 mb-3 fw-bold">Trust & Security</h6>
                        <div class="d-flex gap-3 mb-3">
                            <div class="bg-white-10 p-2 rounded"><small>SSL Secure</small></div>
                            <div class="bg-white-10 p-2 rounded"><small>24/7 Support</small></div>
                        </div>
                        <p class="small text-white-50">Secure payments guaranteed by Stripe and PayPal.</p>
                    </div>
                </div>
                <div class="row pt-4 border-top border-secondary text-center">
                    <div class="col-12">
                        <small class="text-muted">© {{ date('Y') }} Luxury Escapes. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script>
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('.navbar').style.backgroundColor = '#1a252f';
                    document.querySelector('.navbar').style.padding = '0.8rem 0';
                } else {
                    document.querySelector('.navbar').style.backgroundColor = 'transparent'; // Or init color
                    document.querySelector('.navbar').style.padding = '1.2rem 0';
                }
            });

            // Notification Modal Logic
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('success'))
                    const notifModalSuccess = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').textContent = "{{ session('success') }}";
                    notifModalSuccess.show();
                @endif
                @if(session('error'))
                    const notifModalError = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').textContent = "{{ session('error') }}";
                    notifModalError.show();
                @endif

                // Confirmation Modal Logic
                const confirmModal = document.getElementById('confirmationModal');
                confirmModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const action = button.getAttribute('data-action');
                    const message = button.getAttribute('data-message') || 'Are you sure you want to perform this action?';

                    const modalMessage = confirmModal.querySelector('#confirmationMessage');
                    const modalForm = confirmModal.querySelector('#globalDeletedForm');

                    modalMessage.textContent = message;
                    modalForm.action = action;
                });
            });
        </script>
        @yield('scritps')
    </body>
</html>