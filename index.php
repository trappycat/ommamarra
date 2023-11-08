<!DOCTYPE html>
<html>
<head>
    <title>Bouncing Image RPG</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-image: url("gradient.gif");
        background-repeat: no-repeat;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    #image {
        position: absolute;
    }

    #attackButton {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        transition-duration: 0.4s;
    }

    #attackButton:hover {
        background-color: #45a049;
    }

    #upgradePoints {
        position: fixed;
        top: 20px;
        right: 20px;
        color: #FFF;
        font-size: 18px;
    }
    </style>
</head>
<body>
    <?php
        $imageSrc = "img.png";
        $imageWidth = 100; // adjust the width of the image
        $imageHeight = 100; // adjust the height of the image

        $upgradePoints = 0; // Initialize upgrade points

        echo "<img id='image' src='$imageSrc' width='$imageWidth' height='$imageHeight' alt='Bouncing Image'>";
    ?>

    <button id="attackButton">Attack!</button>
    <div id="upgradePoints">Upgrade Points: <?php echo $upgradePoints; ?></div>

    <script>
        var image = document.getElementById('image');
        var attackButton = document.getElementById('attackButton');
        var upgradePoints = <?php echo $upgradePoints; ?>;
        var imageWidth = <?php echo $imageWidth; ?>;
        var imageHeight = <?php echo $imageHeight; ?>;
        var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

        var posX = Math.random() * (screenWidth - imageWidth);
        var posY = Math.random() * (screenHeight - imageHeight);
        var velX = Math.random() < 0.5 ? 5 : -5; // Random initial direction
        var velY = Math.random() < 0.5 ? 3 : -3; // Random initial direction
        var accY = 0.5;

        var isAttacking = false;

        image.style.left = posX + 'px';
        image.style.top = posY + 'px';

        function updatePosition() {
            posX += velX;
            posY += velY;
            velY += accY;

            if (posX <= 0 || posX >= screenWidth - imageWidth) {
                velX *= -1;
            }

            if (posY <= 0 || posY >= screenHeight - imageHeight) {
                velY *= -1;
            }

            if (isAttacking) {
                image.style.backgroundColor = 'red';
                setTimeout(function() {
                    image.style.backgroundColor = '';
                    isAttacking = false;
                }, 500);
            }

            image.style.left = posX + 'px';
            image.style.top = posY + 'px';

            requestAnimationFrame(updatePosition);
        }

        image.addEventListener('click', function() {
            if (upgradePoints > 0) {
                upgradePoints--;
                displayUpgradePoints();
                isAttacking = true;
            }
        });

        attackButton.addEventListener('click', function() {
            if (upgradePoints > 0) {
                upgradePoints--;
                displayUpgradePoints();
                isAttacking = true;
            }
        });

        function displayUpgradePoints() {
            document.getElementById('upgradePoints').innerHTML = 'Upgrade Points: ' + upgradePoints;
        }

        displayUpgradePoints();
        updatePosition();
    </script>
</body>
</html>