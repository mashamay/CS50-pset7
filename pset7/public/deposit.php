<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {  
        // else render form
        render("deposit_form.php", ["title" => "Deposit"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["cash"]))
        {
            apologize("You must enter cash you want to deposit");
        }

        if (preg_match("/^\d+$/", $_POST["cash"]) == false)
        {
            apologize("You must enter a whole, positive integer.");
        }
        
        else
        {
            // add cash to the balance
            query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["cash"], $_SESSION["id"]);
       
            // redirect to home
            redirect("/");
        }
    }
?>    
        
        
