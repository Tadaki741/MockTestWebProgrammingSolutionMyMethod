<?php
$user_choice = "";
$object_csv = array();
$size = 0;

if(isset($_GET["test"])){
    if( $_GET["selectType"] === "latest_10_months"){
        $size = 300;
    }
    else if($_GET["selectType"] === "latest_10_days"){
        $size = 10;
    }
}

else {
    echo ("Please select date constraint");
    header("Location: index.html");
}

function sortTime ($object1, $object2) {
    return strtotime($object2["Date_reported"]) - strtotime($object1["Date_reported"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>

        </nav>
    </header>


    <main>

        <section id="tableContainer">
            <h1>COVID REPORT</h1>
            <table id="MyTable">

                <tbody>
                <tr>
                    <th>Reported Date</th>
                    <th>Cumulative Cases</th>

                </tr>
                <?php
                //Load the data from the file
//                $fp = fopen('who_covid_southeast.csv','r');
//                flock($fp,LOCK_SH);
//                if(file_exists('who_covid_southeast.csv')){
//                    //Loop through each line
//                    while($line = fgets($fp)){
//                        $data_array = explode(",",$line);
//                        //mine id is s3821186, last digit is 6, which is Phillipines
//                        if($data_array[1] === "PH"){
//                            //index 0 and index 5 is the key
//                            $reported_date = $data_array[0];
//                            $cumulative_case = $data_array[5];
//
//                            //Output the value
//                            echo "
//                        <tr>
//                        <td>{$reported_date}</td>
//                        <td>{$cumulative_case}</td>
//</tr>
//                        ";
//                        }
//                        else {
//                            continue;
//                        }
//
//                    }
//                }
                //Get data
                $rows   = array_map('str_getcsv', file('who_covid_southeast.csv'));
                //Get the first row that is the HEADER row.
                $header_row = array_shift($rows);
                //This array holds the final response.
                $employee_csv    = array();
                foreach($rows as $row) {
                    if(!empty($row)){
                        $employee_csv[] = array_combine($header_row, $row);
                    }
                }

                usort($employee_csv,'sortTime');

                for($i = 0 ; $i < $size ; $i += 1 ){
                    $country = $employee_csv[$i]["Country"];
                    $reportDate = $employee_csv[$i]["Date_reported"];
                    $countryCode = $employee_csv[$i]["Country_code"];
                    $WHO_region = $employee_csv[$i]["WHO_region"];
                    $cumulative_case = $employee_csv[$i]["Cumulative_cases"];
                    $new_deaths = $employee_csv[$i]["New_deaths"];
                    $cumulative_deaths = $employee_csv[$i]["Cumulative_deaths"];
//                    print_r("Country: " . $country . "<br>");
//                    print_r("Date_reported: " . $reportDate . "<br>");
//                    print_r("Country_code: " . $countryCode . "<br>");
//                    print_r("WHO_region: " . $WHO_region . "<br>");
//                    print_r("Cumulative_cases: " . $cumulative_case . "<br>");
//                    print_r("New_deaths: " . $new_deaths. "<br>");
//                    print_r("Cumulative_deaths: " . $cumulative_deaths . "<br>");
//                    echo "<p>-----------------</p>";
                    echo "
                    <tr>
                    <td>$reportDate</td>
                    <td>$cumulative_case</td>
</tr>
                    ";
                }

                ?>
                </tbody>

                <tfoot>

                </tfoot>

            </table>
        </section>

    </main>

    <footer>

    </footer>

</body>
</html>