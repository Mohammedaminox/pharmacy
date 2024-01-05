<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body {
            background-color: #f0f0f0;
            color: #333;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        main {
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <header>
        <h1>Medical Information Form</h1>
    </header>

    <main>
        <?php foreach($products as $prdct) : ?>

            <form action="?route=Modifed_Product" method="post">

            <input type="hidden" value="<?= $prdct['id'] ?>">
            <label for="firstName">Product Name:</label>
            <input type="text" id="firstName" name="nom" value="<?= $prdct['nom'] ?>" required>

            <label for="lastName">Description:</label>
            <input type="text" id="lastName" name="description" value="<?= $prdct['description'] ?>" required>

            <label for="email">Quantity:</label>
            <input type="number" id="email" name="quantete" value="<?= $prdct['quantite_stock'] ?>" required>
            <label for="email">Prix:</label>
            <input type="number" id="email" name="prix" value="<?= $prdct['prix'] ?>" required>          


            <button type="submit">Submit</button>
            <a href="?route=store">Back</a>
        </form>
        <?php endforeach; ?>
    </main>

</body>
</html>
