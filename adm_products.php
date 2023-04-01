<?php
// include 'adm_navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">

  <link rel="icon" href="assets/icon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <img src="" alt="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
  <link rel="stylesheet" href="newstyle.css">
  <script src="https://cdn.tailwindcss.com/3.2.4"></script>
  <title>Davao Fresh</title>
</head>

<body>
  <div class="my-table">
    <table class="table align-middle mb-0 bg-white">
      <thead class="bg-light">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <!-- Product Name + Category Column-->
            <div class="d-flex align-items-center">
              <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px; margin-right: 20px" class="rounded-circle" />
              <div class="ms-3">
                <p class="fw-bold mb-1">Product Name</p>
                <p class="text-muted mb-0 small">Product Category</p>
              </div>
            </div>
          </td>
          <!-- Price + Unit of Measurement -->
          <td>
            <!-- <span class="badge badge-success rounded-pill d-inline">Active</span> -->
            <p class="fw-bold mb-1" style="font-weight: 500;">P 10.00</p>
            <p class="text-muted mb-0 small">per piece</p>
          </td>
          <!-- Actions -->
          <td>
            <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
            <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
          </td>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
</body>
<script>
  // Sa Navbar animations ni
  window.addEventListener('scroll', function() {
    var navbar = document.querySelector('nav');
    if (window.pageYOffset > 0) {
      navbar.classList.add('nav-shadow');
    } else {
      navbar.classList.remove('nav-shadow');
    }
  });

  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
      document.querySelector("nav").style.padding = "1% 10%";
      document.querySelector("nav").style.height = "50px";
      document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
    } else {
      document.querySelector("nav").style.padding = "2% 10%";
      document.querySelector("nav").style.height = "60px";
      document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
    }
  }
</script>

</html>