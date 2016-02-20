<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol">
            <option value="">Choose stock</option>
            <?php foreach ($stock as $value): ?>
                <option value="<?= $value['symbol'] ?>"><?= $value['symbol'] ?></option>
            <?php endforeach ?>
            </select> 
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>

