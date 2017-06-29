<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>UPS ERROR!</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        @include('common.css')
    </head>
    <body>
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <h1 class="text-white">404!</h1>
                <h2 class="text-white">Sorry, page not found</h2><br>
                <a class="btn btn-info waves-effect waves-light" href="/home">Back to Dashboard</a>
                <p style="margin-top:20px;" class="text-white">{{ $exception->getMessage() }}</p>
            </div>
        </div>
        @include('common.js')
    </body>
</html>