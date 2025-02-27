<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <!-- Vinculamos el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ZvpUoO/+PpPHZg2BzmA4i8d3ni43mjV8w1cAn5cr1FxzYs5Wbsz5f4dZNEES3A2T" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h1>Customer edit: <?= htmlspecialchars($data->name) ?></h1>

    <!-- Formulario de edición del cliente -->
    <form action="<?= base_url() ?>customer/edit/<?= $data->customer_id ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Cliente</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data->name) ?>" required>
        </div>

        <h3 class="mt-4">Dirección</h3>
        <div class="mb-3">
            <label for="street" class="form-label">Calle</label>
            <input type="text" class="form-control" id="street" name="street" value="<?= htmlspecialchars($data->addresses()->first()->street ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="zip_code" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?= htmlspecialchars($data->addresses()->first()->zip_code ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($data->addresses()->first()->city ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" value="<?= htmlspecialchars($data->addresses()->first()->country ?? '') ?>" required>
        </div>

        <h3 class="mt-4">Teléfono</h3>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Número de Teléfono</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= htmlspecialchars($data->phones()->first()->number ?? '') ?>" required>
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        <a href="<?= base_url() ?>customer" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<!-- Vinculamos el JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kaB4miVsoxgOswq3XsDCp2t5Q2t5rwFdGl8q3hLlJWZqHE+Vks9a0P/j8gGQLF1V" crossorigin="anonymous"></script>

</body>
</html>