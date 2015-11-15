<?php

function pdo_connect() {
    try {
        // Production server
        $dbhost="mysql:host=mysql-user.cse.msu.edu;dbname=wrigh517";
        $user = "wrigh517";
        $password = "Cw3s5Cbf6wZCeG8a";
        return new PDO($dbhost, $user, $password);
    } catch(PDOException $e) {
        die( "Unable to select database");
    }
}

/**
 * Process the XML query
 * @param $xmltext the provided XML
 */
function processXml($xmltext) {
    // Load the XML
    $xml = new XMLReader();
    if(!$xml->XML($xmltext)) {
        echo '<hatter status="no" msg="invalid XML" />';
        exit;
    }

    // Connect to the database
    $pdo = pdo_connect();

    // Read to the start tag
    while($xml->read()) {
        if($xml->nodeType == XMLReader::ELEMENT && $xml->name == "hatter") {

            // We have the hatter tag
            $magic = $xml->getAttribute("magic");
            if($magic != "NechAtHa6RuzeR8x") {
                echo '<hatter status="no" msg="magic" />';
                exit;
            }
            $user = $xml->getAttribute("user");
            $password = $xml->getAttribute("pw");
            $userid = getUser($pdo, $user, $password);


            // Read to the hatting tag
            while($xml->read()) {
                if($xml->nodeType == XMLReader::ELEMENT &&
                    $xml->name == "hatting") {

                    $name = $xml->getAttribute("name");
                    $uri = $xml->getAttribute("uri");
                    $x = $xml->getAttribute("x");
                    $y = $xml->getAttribute("y");
                    $angle = $xml->getAttribute("angle");
                    $scale = $xml->getAttribute("scale");
                    $color = $xml->getAttribute("color");
                    $hat = $xml->getAttribute("hat");
                    $feather = $xml->getAttribute("feather") == "yes" ? 1 : 0;

                    $nameQ = $pdo->quote($name);
                    $uriQ = $pdo->quote($uri);


                    // Checks
                    if(!is_numeric($x) || !is_numeric($y) || !is_numeric($angle) ||
                        !is_numeric($scale) || !is_numeric($color) || !is_numeric($hat)) {
                        echo '<hatter status="no" msg="invalid" />';
                        exit;
                    }

                    $query = <<<QUERY
REPLACE INTO hatting(name, userid, uri, type, x, y, rotation, scale, color, feather)
VALUES($nameQ, '$userid', $uriQ, $hat, $x, $y, $angle, $scale, $color, $feather)
QUERY;
                    if(!$pdo->query($query)) {
                        echo '<hatter status="no" msg="insertfail">' . $query . '</hatter>';
                        exit;
                    }

                    echo '<hatter status="yes"/>';
                    exit;
                }
            }


        }

    }

    echo '<hatter save="no" msg="invalid XML" />';
}