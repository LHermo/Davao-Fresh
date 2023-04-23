<?php
include 'functions.php';
?>
<html>

<head>
    <title>Increment/Decrement Example</title>
    <script>
        function increment() {
            var inputField = document.getElementById("quantity-input");
            var value = parseInt(inputField.value);
            inputField.value = value + 1;
        }

        function decrement() {
            var inputField = document.getElementById("quantity-input");
            var value = parseInt(inputField.value);
            if (inputField.value != 0) {
                inputField.value = value - 1;
            }
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- <input type="number" id="quantity-input" value="0" /> -->
    <!-- <button onclick="increment()">+</button>
    <button onclick="decrement()">-</button> -->

    <div class="product-card" style="margin-top: 18px;  ">
        <div class="product-card-content">
            <div class="price">
                <span class="cost">₱ 10.00<span>
                        <span class="description">/ per kilo</span>
            </div>
            <div class="product-image"><img src="assets/Artichoke.png"></div>
            <div class="product-details">
                <p class="category">VEGE</p>
                <p class="name">LILILLIILIL</p>
            </div>
            <div class="quantity-selector">
                <button class="plus-btn" onclick="decrement()">-</button>
                <input class="quantity-input" type="number" id="quantity-input" min="0" value="0">
                <button class="minus-btn" onclick="increment()">+</button>
            </div>

            <button class="button-products" onclick="addToBasket()">Add to basket</button>
        </div>
    </div>
</body>

</html>