  <!-- Bootstrap core CSS -->
  <link href="{{ url('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <script data-search-pseudo-elements defer src="{{ url('backend/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js') }}" crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="{{ url('frontend/css/modern-business.css') }}" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{Storage::disk('public')->url('settings/'.App\Setting::first()->icon)}}" />