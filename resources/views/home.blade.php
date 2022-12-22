<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Outspot</title>

    <meta name="description" content="Outspot, building small proof of concept">
    <meta name="author" content="Demeulenaere Thomas">
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css') }}">

    <!-- END Stylesheets -->
</head>
<body>

<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="row g-0 justify-content-center">
            <div class="hero-static col-lg-7">
                <div class="content content-full overflow-hidden">

                    <!-- Header -->
                    <div class="py-5 text-center">
                        <a href="index.html">
                            <i class="fa-2x fa fa-basket-shopping text-dark"></i>
                        </a>
                        <h1 class="h3 fw-bold mt-3 mb-2">Welcome to my POC</h1>
                        <h2 class="fs-base fw-medium text-muted mb-0">Let's get started, it will only take a few seconds!</h2>
                    </div>
                    <!-- END Header -->


                    <form class="js-validation-installation" action="{{ route('pay') }}" method="POST">
                        @csrf
                        <!-- Outspot section -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Outspot</h3>
                            </div>
                            <div class="block-content">
                                <div class="row items-push">
                                    <div class="col-lg-4">
                                        <p class="fs-sm text-muted">
                                            Please pay with a amount between 10 and 100EUR.
                                        </p>
                                    </div>
                                    <div class="col-lg-6 offset-lg-1">
                                        <div class="mb-4">
                                            <label class="form-label" for="amount">Amount</label>
                                            <input type="number"
                                                   min="10"
                                                   max="100"
                                                   class="form-control form-control-lg"
                                                   id="amount"
                                                   name="amount"
                                                   placeholder="Enter amount here...">
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-dark mt-2" type="submit">Pay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Outspot section -->
                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->


<script src="{{ asset('js/oneui.app.min.js') }}"></script>

<!-- jQuery (required for jQuery Validation plugin) -->
<script src="{{ asset('js/lib/jquery.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/op_installation.min.js') }}"></script>
</body>
</html>
