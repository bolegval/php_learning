<select name="<?= $name ?>" id="<?= $name ?>">
    <?php foreach ($array as $item) : ?>
        <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
    <?php endforeach ?>     
</select>