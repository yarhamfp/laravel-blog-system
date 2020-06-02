<footer class="page-footer font-small stylish-color-dark pt-4 text-white" style="background-color: #343a40!important">
  <!-- Footer Links -->
  <div class="container text-center text-md-left text-white">
    <!-- Grid row -->
    <div class="row">
      <!-- Grid column -->
      <div class="col-md-4 mx-auto">
        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
          consectetur
          adipisicing elit.</p>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-2 mx-auto">
        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-2 mx-auto">
        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
      <hr class="clearfix w-100 d-md-none">
      <!-- Grid column -->
      <div class="col-md-2 mx-auto">
        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
  <!-- Footer Links -->
  <hr>
  <form action="{{route('subscriber.store')}}" method="POST" class="d-inline">
    @csrf
    <ul class="list-unstyled list-inline text-center py-2">
      <h3>Subscribe</h3>
      <li class="list-inline-item">
        <input type="text" class="form-control" name="email" placeholder="Your email">
        <!-- <h5 class="mb-1">Register for free</h5> -->
      </li>
      <li class="list-inline-item">
        <button type="submit" class="btn btn-danger btn-rounded d-inline"
          style="line-height: 1.5 !important;">Subscribe!</button>
      </li>
      <p>Subscribe untuk mendapatkan notifikasi terbaru dari web kami :)</p>
    </ul>
  </form>
  <hr>
  <!-- Social buttons -->
  <ul class="list-unstyled list-inline text-center">
    <li class="list-inline-item">
      <a href="#!" class="btn-floating btn-fb mx-1 text-white">
        <i class="fab fa-facebook-f"> </i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#!" class="btn-floating btn-tw mx-1 text-white">
        <i class="fab fa-twitter"> </i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#!" class="btn-floating btn-gplus mx-1 text-white">
        <i class="fab fa-google-plus-g"> </i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#!" class="btn-floating btn-li mx-1 text-white">
        <i class="fab fa-linkedin-in"> </i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#!" class="btn-floating btn-dribbble mx-1 text-white">
        <i class="fab fa-dribbble"> </i>
      </a>
    </li>
  </ul>
  <!-- Social buttons -->
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="#!" class="text-white"> Bakemono</a>
  </div>
  <!-- Copyright -->
</footer>