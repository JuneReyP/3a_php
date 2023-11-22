<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    My Index Page

    <?php

    //echo "Hello from PHP";
    #echo "Hello from PHP";
    /* 
    echo "Hello from PHP";
    */
    // to initialize a variable
    $sample =  'hello';

    echo $sample;

    define("GREETING", "HEllo World!");
    echo '<br>' . GREETING . '<hr>' . '<h1>Heading</h1>';
    /* 
    if (condition) {
            code to be executed if condition is true;
        } elseif() {
            code to be executed if condition is false;
        } else{
            
        }

        switch (n) {
            case label1:
                code to be executed if n=label1;
                break;
            case label2:
                code to be executed if n=label2;
                break;
            case label3:
                code to be executed if n=label3;
                break;
                ...
            default:
                code to be executed if n is different from all labels;
        }

        while (condition is true) {
            code to be executed;
            }

        for (init counter; condition; increment counter) {
        code to be executed for each iteration;
        }

        foreach ($array as $value) {
            code to be executed;
            }

            $cars = ["Volvo", "BMW", "Toyota"]; //indexed array
*/
$age = ["Peter"=>"35", "Ben"=>37, "Joe"=>"43"];
echo $age['Peter'];
echo '<br>';
foreach($age as $key => $value){
    echo $value.'<br>';
}
    ?>
</body>

</html>