<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Dancing+Script:wght@400;700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        body{font-family: 'Roboto', sans-serif;
                font-size: 12px;}
        title, h5{font-family: 'Anton', sans-serif;}
    </style>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!--Javascript for checkout.php-->
    <script type="text/javascript">
    $('.update-cart-form input[name="quantity"]').on('change',function(){
    $(this).parent().submit(); 
    });
    </script>
    <script src="js/main.js"></script>
    
    <!--extra css for admin directory-->
    <link rel="shortcut icon" href="../../public/img/favicon.ico">
<!--    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">-->
    <!--extra css for public directory-->
<!--    <link rel="stylesheet" type="text/css" href="css/style.css">-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <title><?php echo $pageTitle ?></title>

</head>