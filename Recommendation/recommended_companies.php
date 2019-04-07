<?php
    $user = json_decode(file_get_contents("http://localhost:3000/users?email=john@gmail.com"));
    $user_interests = $user[0]->interests;
    $companies = json_decode(file_get_contents("http://localhost:3000/companies"));
    foreach ($companies as $company) {
        $interested = false;
        foreach ($company->interests as $company_interest) {
            foreach ($user_interests as $user_interest) {
                if($user_interest == $company_interest) {
                    $interested = true;
                    break;
                }
            }
            if($interested) break;
        }
        if($interested) {
            print_r($company);
        }
    }
?>