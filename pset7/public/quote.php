<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quotes"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide valid stock symbol.");
        }

        // get quote
        $stock = lookup($_POST["symbol"]);
        
        // 2-4 decimals
        if ($stock["price"] < 1.00)
        $stock["price"] = number_format($stock["price"], 4, '.', '');
        
        else
        $stock["price"] = number_format($stock["price"], 2);
        
        // check if stock exists
        if(($stock = lookup($_POST["symbol"])) == FALSE)
            {
                apologize("Invalid stock name");
            }
            else
            {
                // redirect to portfolio
                render("quote_display.php", ["stock" => $stock, "title" => "Quote"]);
            }
    }
?>    
        
        
