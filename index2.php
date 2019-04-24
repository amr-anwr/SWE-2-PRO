<?php
$id= $_GET['id'];
$company = json_decode(file_get_contents("http://localhost:3000/companies?id=$id"));
$quizzes = json_decode(file_get_contents("http://localhost:3000/quizzes"));
$required_quizzes=array();
$company_required_quizzes = $company[0]->required_quizzes;
foreach ($quizzes as $quiz) {
    foreach ($company_required_quizzes as $required_quiz) {
        if($quiz->id == $required_quiz) {
            array_push($required_quizzes, $quiz);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Table V05</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1">
                <div class="wrap-table100-nextcols js-pscroll">
                    <div class="table100-nextcols">
                        <table>
                            <thead style="border: 3px; border-bottom-style: solid; border-color: lightgray">
                            <tr class="row100 head">
                                <th class="cell100 column2" style="border: 3px; border-right-style: solid; border-color: lightgray"><?php  echo $company[0]->name; ?>'s required quizzes</th>
                                <th class="cell100 column4" style=" padding-left: 10px;">tags</th>
                            </tr>
                            </thead>
                            <tbody>
                               <?php
                               $count=0;
                               $array_count = count($required_quizzes)-1;
                               foreach($required_quizzes as $item) {
                                   if ($count < $array_count) {
                                       echo "<tr class=\"row100 body\" style='border: 3px; border-bottom-style: solid; border-color: lightgray'>";
                                   } else {
                                       echo "<tr class=\"row100 body\">";
                                   }

                                   echo "<td class=\"cell100 column2\" style=\"border: 3px; border-right-style: solid; border-color: lightgray\">$item->name</td>";
                                   echo"<td class=\"cell100 column3\" style=\"border: 3px; border-right-style: solid; border-color: lightgray;  padding-left: 10px;\">";
                                   $tags = $item->tags;
                                   $lasttag = end($tags);
                                   foreach ($tags as $tag) {
                                       if($tag == $lasttag)
                                           echo "$tag.";
                                       else
                                           echo "$tag, ";
                                    }
                                   echo "</td>";
                               }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function(){
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function(){
            ps.update();
        })

        $(this).on('ps-x-reach-start', function(){
            $(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
        });

        $(this).on('ps-scroll-x', function(){
            $(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
        });

    });




</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>