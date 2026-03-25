<?php
require_once __DIR__ . '/includes/admin_bootstrap.php';
require_once __DIR__ . '/includes/admin_layout.php';

$context = admin_get_base_context($pdo);
$message = admin_take_flash_message();

if ((isset($_FILES['logofile']) && isset($_FILES['logofile']['name']) && $_FILES['logofile']['name'] !== '') || isset($_POST['logoname'])) {
    $message = admin_update_logo($pdo, $context['hasSettings'], $_FILES, $_POST);
    admin_redirect_with_message('logo_settings.php', $message);
}

$settings = admin_load_settings($pdo);
$logo = $settings['logo'];

admin_render_page_start('Pengaturan Logo', 'logo', $logo, $message);
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pengaturan Logo</h3>
    </div>
    <div class="card-body">
        <?php if ($logo): ?>
            <p>Logo saat ini: <strong><?php echo htmlspecialchars($logo); ?></strong></p>
            <div class="mb-3" style="max-width:200px;">
                <img src="../assets/<?php echo htmlspecialchars($logo); ?>" class="img-fluid" alt="Logo">
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logofile">Upload Logo Baru (PNG):</label>
                <input type="file" id="logofile" name="logofile" accept=".png" class="form-control-file">
            </div>
            <p class="text-muted">atau ketik nama file PNG di folder assets:</p>
            <div class="form-group">
                <input type="text" name="logoname" class="form-control" value="<?php echo htmlspecialchars($logo); ?>" placeholder="logo.png">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Logo</button>
        </form>
    </div>
</div>
<?php
admin_render_page_end();
