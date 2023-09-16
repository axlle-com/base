<?php

?>
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="loading bordered-layout"
      data-layout="bordered-layout"
      data-textdirection="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ empty($title) ? '' : ''.$title }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/main.css?v={{ time() }}">
    <link rel="stylesheet" href="/admin/css/common.css?v={{ time() }}">
    @stack('stylesheet')
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static"
      data-open="click"
      data-menu="vertical-menu-modern"
      data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <form class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST">
                                <div class="mb-1">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"
                                           class="form-control"
                                           id="email"
                                           name="email"
                                           placeholder="Email"
                                           tabindex="1"
                                           autofocus
                                           data-validator-required/>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                        <a href="/admin/forgot-password">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                    <div class="">
                                        <input type="password"
                                               class="form-control form-control-merge"
                                               id="password"
                                               name="password"
                                               tabindex="1"
                                               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                               data-validator-required/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3"/>
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 js-submit-button" tabindex="4">Sign in</button>
                            </form>
                            <p class="text-center mt-2">
                                <span>New on our platform?</span>
                                <a href="/admin/register">
                                    <span>Create an account</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
<script src="/admin/js/main.js?v={{ time() }}"></script>
<script src="/admin/js/common.js?v={{ time() }}"></script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
</html>
