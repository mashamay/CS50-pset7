
<div>
    <a href="logout.php">Log Out</a>
</div>

<div>
    <?php print ("Your current balance is " . $balance); ?>
    <a href="sell.php">sell</a>
    <a href="buy.php">buy</a>
    <a href="/">portfolio</a>
</div>



<div>
    <table class="table table-hover">
    <thead>
        <tr>
            <th>Time</th>
            <th>Type</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price Bought</th>
            <th>Current Price</th>
        </tr>
    </thead>
    <?php foreach ($positions as $position): ?>
    <tr>
        <td><?= $position["time"] ?></td>
        <td><?= $position["transaction"] ?></td>
        <td><?= $position["name"] ?></td>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td><?= $position["price"] ?></td>
        <td><?= $position["price_cur"] ?></td>
    </tr>
    <?php endforeach ?>
    </table>
</div>
  
