<?php

    // configuration
    require("../includes/config.php"); 
    
    // create 'positions' associative array
    $positions = [];
    
    // query database for user
    $user = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);  
    $rows = query("SELECT * FROM shares WHERE id = ?", $_SESSION["id"]);

    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
            ];
        }
    }
    
    // get cash balance
    $balance = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    
    // dislay 2 to 4 decimal symbols
    if ($balance[0]["cash"] < 1.00)
        $balance[0]["cash"] = number_format($balance[0]["cash"], 4, '.', '');
        
    else
        $balance[0]["cash"] = number_format($balance[0]["cash"], 2, '.', '');
    
    // render portfolio
    render("portfolio.php", [
        "title" => "Portfolio",
        "positions" => $positions, 
        "balance" => $balance[0]["cash"],
        "user" => $user[0]["username"] 
        ]);

    
?>
