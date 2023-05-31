<!DOCTYPE html>
<html>

<head>
  <?php include_once 'include/head.php'; ?>
  <title>Contact</title>
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once 'include/header.php'; ?>
    <!-- end header section -->
  </div>

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Get In Touch
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container contact-form">
            <form action="">
              <div class="form-row">
                <div class="col-lg-6">
                  <div>
                    <input type="text" placeholder="Your Name" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div>
                    <input type="text" placeholder="Phone Number" />
                  </div>
                </div>
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="btn_box">
                <button>
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- footer section -->
  <?php include_once 'include/footer.php' ?>
  <!-- footer section -->

  <?php include_once 'include/script.php'; ?>

</body>

</html>