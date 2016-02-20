<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {      
        // render form
        render("buy_form.php", ["title" => "Buy"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]) || empty($_POST["shares"]))
            apologize("You must enter a stock symbol and quantity of shares to buy.");
        
        if (lookup($_POST["symbol"]) === false)
            apologize("Invalid stock symbol.");

        if (preg_match("/^\d+$/", $_POST["shares"]) == false)
            apologize("You must enter a whole, positive integer.");

        $transaction = 'BUY';
        
        // get quote
        $stock = lookup($_POST["symbol"]);
        
        // calculate total
        $value = $stock["price"] * $_POST["shares"];
        
        // query user's cash
        $cash =	query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);	
        
        // if user's cash < total cost (user can't afford purchase)
        if ($cash[0]["cash"] < $value)
        {
            // apologize
            apologize("You can't afford this purchase.");
        }         
        
        else
        {
            // capitalize symbol (works)
            $_POST["symbol"] = strtoupper($_POST["symbol"]);
                         
            // add stock to their portfolio or update shares
            query("INSERT INTO shares (id, symbol, shares) VALUES(?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
            
            // subtract total price from cash
            query("UPDATE users SET cash = cash - ? WHERE id = ?", $value, $_SESSION["id"]);
            
            // update history
            query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, $_POST["symbol"], $_POST["shares"], $stock["price"]);

            //redirect to portfolio
            redirect("/");    
        }
    }
?>    
        
        
