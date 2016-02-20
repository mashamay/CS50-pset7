<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // get user stocks for the form
        $stock = query("SELECT symbol FROM shares WHERE id = ?", $_SESSION["id"]);
       
        // else render form
        render("sell_form.php", ["stock" => $stock, "title" => "Sell"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $transaction = 'SELL';
        
        // get quote
        $stock = lookup($_POST["symbol"]);
        
        // get quantity
        $shares = query("SELECT shares FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        // multiply stock price by quantity
        $value = $stock["price"] * $shares[0]["shares"];
        
        // add cash to the balance
        query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
        
        // remove stocks from portfolio
        $query = query("DELETE FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        // update history
        query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        
        // redirect to home
        redirect("/");
    }
?>    
        
        
