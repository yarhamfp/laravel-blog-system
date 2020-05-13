<script src="{{ url('frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ url('frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{ url('frontend/js/jquery-ui.js')}}"></script>
<script src="{{ url('frontend/js/popper.min.js')}}"></script>
<script src="{{ url('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{ url('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{ url('frontend/js/jquery.stellar.min.js')}}"></script>
<script src="{{ url('frontend/js/jquery.countdown.min.js')}}"></script>
{{-- <script src="{{ url('frontend/js/bootstrap-datepicker.min.js')}}"></script> --}}
<script src="{{ url('frontend/js/jquery.easing.1.3.js')}}"></script>
<script src="{{ url('frontend/js/aos.js')}}"></script>
<script src="{{ url('frontend/js/jquery.fancybox.min.js')}}"></script>
<script src="{{ url('frontend/js/jquery.sticky.js')}}"></script>
<script src="{{ url('frontend/js/jquery.mb.YTPlayer.min.js')}}"></script>
<script src="{{url('frontend/js/main.js')}}"></script>
<script>
  const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});
</script>