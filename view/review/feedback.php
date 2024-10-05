<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedBack</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/Fonts.css">

    <style>
        /* Custom CSS for styling */
        .food-item {
            margin-bottom: 40px;
        }

        h1 {
            font-family: niceFont;
        }

        h2 {
            font-family: foodname;
            margin-top: 10px;
        }

        .food-item img {
            width: 100%;
            height: 100%;
            ;
            border-radius: 15px;
            object-fit: fill;
        }

        .imgcontainer {
            width: 200px;
            height: 200px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc700;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating input[type="radio"]:checked~label:hover~label {
            color: #ffc700;
        }

        .btn {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">How was your experience ?</h1>
        <div class="row justify-content-center">
            <!-- Food Item 1 -->
            <?php
            foreach ($foods as $index => $item) : ?>
                <div class="col-md-4 food" data-idfood="<?php echo $item->getIdFood() ?>">
                    <div class="food-item">
                        <div class="imgcontainer"><img src="data:image;base64,<?php echo base64_encode($item->getImage()) ?>" alt="Food"></div>
                        <h2><?php echo $item->getFoodName() ?></h2>
                        <div class="star-rating">
                            <input type="radio" id="star5-food<?php echo $index ?>" name="rating-food<?php echo $index ?>" value="5">
                            <label for="star5-food<?php echo $index ?>">&#9733;</label>
                            <input type="radio" id="star4-food<?php echo $index ?>" name="rating-food<?php echo $index ?>" value="4">
                            <label for="star4-food<?php echo $index ?>">&#9733;</label>
                            <input type="radio" id="star3-food<?php echo $index ?>" name="rating-food<?php echo $index ?>" value="3">
                            <label for="star3-food<?php echo $index ?>">&#9733;</label>
                            <input type="radio" id="star2-food<?php echo $index ?>" name="rating-food<?php echo $index ?>" value="2">
                            <label for="star2-food<?php echo $index ?>">&#9733;</label>
                            <input type="radio" id="star1-food<?php echo $index ?>" name="rating-food<?php echo $index ?>" value="1">
                            <label for="star1-food<?php echo $index ?>">&#9733;</label>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Comment Form -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Leave a Comment:</h2>
                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Leave a comment" maxlength="150"></textarea>
                </div>
                <button type="submit" class="btn btn-primary send" style="background-color: var(--secondcolor); border: none;">Submit</button>
            </div>
        </div>
    </div>

    <script>
        reviews = {};

        $('.send').on("click", () => {
            $('.food').each(function(index, element) {
                var idfood = $(this).data('idfood');

                var rating = $(this).find('input[type="radio"]:checked').val();
                reviews[idfood] = rating;
            })

            reviews['comment'] = $('textarea').val();

            sendReview(reviews);
        })




        function sendReview(rev) {
            var dataF = new FormData();
            dataF.append("review", JSON.stringify(rev));
            $.ajax({
                url: "index.php?action=addReview", // URL of the PHP script to load food items
                type: "POST",
                dataType: "text",
                data: dataF,
                processData: false, // Prevent jQuery from automatically converting the data
                contentType: false, // Ensure correct content type
                success: function(response) {
                    if (response === 'good') {
                        window.location.href="index.php?action=suc";
                    }
                    else{
                        window.location.href = "index.php?action=err";
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    window.location.href = "index.php?action=err";
                }
            });
        }
    </script>
</body>

</html>