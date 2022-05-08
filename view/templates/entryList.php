<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="static/css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="static/js/form.js"></script>
</head>
<body>
<div class="container">
    <div class="table-container">
        <h4><a href="/">Homepage</a></h4>
        <table>
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>last name</th>
                <th>email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($formEntryCollection as $item) : ?>
                <tr id="row-<?= $item->getId() ?>">
                    <td><?= $item->getId() ?></td>
                    <td><?= $item->getName() ?></td>
                    <td><?= $item->getSurname() ?></td>
                    <td><?= $item->getEmail() ?></td>
                    <td>
                        <button
                                class="delete_button"
                                onclick="new Form().handleDelete($(this))"
                                value="<?= $item->getId() ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
