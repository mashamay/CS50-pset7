<div>
    <?php print ("Hello, " . $user . "! "); ?><a href="logout.php">Log Out</a>
    <br>
    <?php print ("Your current balance is " . $balance); ?>
    <a href="sell.php">Sell</a>
    <a href="buy.php">Buy</a>
    <a href="history.php">History</a>
    <a href="deposit.php">Deposit</a>
</div>

<div>
    <table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Current Price</th>
        </tr>
    </thead>
    <?php foreach ($positions as $position): ?>
    <tr>
        <td><?= $position["name"] ?></td>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td><?= $position["price"] ?></td>
    </tr>
    <?php endforeach ?>
    </table>
</div>
  
