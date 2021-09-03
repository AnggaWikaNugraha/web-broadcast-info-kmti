@if ($message = Session::get('success'))
    <div class="alert alert-success fade show" role="alert">
        <button id="click__close" type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>

    <script>
        setTimeout(() => {
            var button = document.getElementById("click__close");
            button.click();
        }, 2000);
    </script>
@endif

@if ($message = Session::get('error'))
    <div alert alert-danger fade show" role="alert">
        <button id="click__close" type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    <script>
        setTimeout(() => {
            var button = document.getElementById("click__close");
            button.click();
        }, 2000);
    </script>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button id="click__close" type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    <script>
        setTimeout(() => {
            var button = document.getElementById("click__close");
            button.click();
        }, 2000);
    </script>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button id="click__close" type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    <script>
        setTimeout(() => {
            var button = document.getElementById("click__close");
            button.click();
        }, 2000);
    </script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button id="click__close" type="button" class="close" data-dismiss="alert">×</button>
        Check the following errors :(
    </div>
    <script>
        setTimeout(() => {
            var button = document.getElementById("click__close");
            button.click();
        }, 2000);
    </script>
@endif
