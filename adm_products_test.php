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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <img src="" alt="">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="newstyle.css">
    <title>Davao Fresh</title>
</head>
<body class="with-margin">
    <div>
        <div class="my-table table-hover">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 10%;">
                            <p class="fw-bold mb-1"></p>
                        </td>
                        <td style="width: 50%;">
                            <div class="d-flex align-items-center">
                                <img src="" style="width: 55px; height: 45px; margin-right: 20px"/>
                                <div class="ms-3">
                                    <p class="fw-bold mb-1" style="font-weight: 500;"></p>
                                    <p class="text-muted mb-0 small"></p>
                                </div>
                            </div>
                        </td>
                        <td width: 30%;>
                            <p class="fw-bold mb-1" style="font-weight: 500;">₱ </p>
                            <p class="text-muted mb-0 small"></p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                            <button type="button" class="btn btn-sm btn-outline-danger">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
    <ul class="pagination justify-content-end">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
        <ul>