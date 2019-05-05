<?php
session_start();

$id= $_SESSION["id"];
$company = json_decode(file_get_contents("http://localhost:3000/companies?id=$id"));
$users = json_decode(file_get_contents("http://localhost:3000/users"));
$company_scores = $company[0]->requiredScore;
$quizzes = json_decode(file_get_contents("http://localhost:3000/quizzes"));
$people = array();
$company_required_quizzes = $company[0]->required_quizzes;
$i =0 ;
$j =0;
$f =0;
$flag =0;
for(;$i< count($users);$i++ ){
    $user_quzzies =$users[$i]->Quzies;
    for($j =0 ; $j <  count($user_quzzies);$j++){
        for($f =0 ; $f < count($company_required_quizzes);$f++){
            if($user_quzzies[$j] == $company_required_quizzes[$f]){
                if($users[$i]->Scores[$j] >= $company_scores[$f]){
                    array_push($people,$i+1);
                    $flag =1;
                    break;
                }
            }
        }
        if($flag){
            $flag =0;
            break;
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
<body >
	<div id="z" class="limiter"  >

        <h1 style="margin-left: 38%; color:white; padding-top:5px;">Welcome <?php echo $_SESSION['name'] ?></h1>

		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1">
					<div class="wrap-table100-nextcols js-pscroll">
						<div class="table100-nextcols">
							<table style="background-image: url("amr.jpg")">
								<thead style="border: 3px; border-bottom-style: solid; border-color: lightgray">
									<tr class="row100 head">
										<th class="cell100 column2" style="border: 3px; border-right-style: solid; border-color: lightgray">Name</th>
										<th class="cell100 column3" style="border: 3px; border-right-style: solid; border-color: lightgray; padding-left: 10px;">email</th>
										<th class="cell100 column4" style=" padding-left: 10px;">quizzes</th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                        $count =0;
                                        $array_count=count($people)-1;
                                        foreach ($people as $user) {
                                            if($count<$array_count){
                                                echo "<tr class=\"row100 body\" style='border: 3px; border-bottom-style: solid; border-color: lightgray'>";
                                            }else{
                                                echo "<tr class=\"row100 body\">";
                                            }
                                            $count++;
                                            $i = (int)$user;
                                            $i--;
                                            $use = $users[$i]->Name;
                                            $email = $users[$i]->email;
                                            echo "<td class=\"cell100 column2\" style=\"border: 3px; border-right-style: solid; border-color: lightgray\">$use</td>
                                            <td class=\"cell100 column3\" style=\"border: 3px; border-right-style: solid; border-color: lightgray;  padding-left: 10px;\">$email</td><td class=\"cell100 column4\" style=' padding-left: 10px;'>";
                                            foreach ($users[$i]->Quzies as $interest) {
                                                $quizz =$quizzes[((int)$interest)-1]->name;
                                                echo "$quizz ".",";
                                            }
                                            echo ".</td></tr>";
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



        z.style.backgroundImage ="url(am.jpg)";
	</script>
<!--===============================================================================================-->

    <script src="js/main.js"></script>

</body>
</html>