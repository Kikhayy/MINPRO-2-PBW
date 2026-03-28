<?php
include 'koneksi.php';

$profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile LIMIT 1"));
$skills = mysqli_query($conn, "SELECT * FROM skills");
$certificates = mysqli_query($conn, "SELECT * FROM certificates");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | <?php echo $profile['nama']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#certificates">Certificates</a></li>
        </ul>
    </nav>
</header>

<!-- HERO -->
<section id="home" class="hero">
    <div class="hero-content">
        <h1>Hi, I'm <span><?php echo $profile['nama']; ?></span></h1>
        <p>Sistem Informasi Student | Universitas Mulawarman</p>
        <p><?php echo $profile['tempat_lahir']; ?>, <?php echo $profile['tanggal_lahir']; ?></p>
        <p><?php echo $profile['alamat']; ?></p>
        <a href="#about" class="btn-primary">See My Profile</a>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="about">
    <div class="container">
        <div class="about-text">
            <h2>Profile Summary</h2>
            <p><?php echo $profile['deskripsi']; ?></p>

            <h3>Professional Skills</h3>
            <?php
            mysqli_data_seek($skills, 0);
            while($row = mysqli_fetch_assoc($skills)) {
                if($row['kategori'] == 'Professional') {
            ?>
                <div class="skill">
                    <label><?php echo $row['nama_skill']; ?></label>
                    <div class="bar">
                        <div class="fill" style="width:<?php echo $row['persen']; ?>%"></div>
                    </div>
                </div>
            <?php }} ?>

            <h3>Technical Skills</h3>
            <?php
            mysqli_data_seek($skills, 0);
            while($row = mysqli_fetch_assoc($skills)) {
                if($row['kategori'] == 'Technical') {
            ?>
                <div class="skill">
                    <label><?php echo $row['nama_skill']; ?></label>
                    <div class="bar">
                        <div class="fill" style="width:<?php echo $row['persen']; ?>%"></div>
                    </div>
                </div>
            <?php }} ?>

        </div>

        <div class="about-img">
            <img src="profile.jpg" alt="Profile">
        </div>
    </div>
</section>

<!-- CERTIFICATES -->
<section id="certificates" class="certificates">
    <h2>Experience & Certificates</h2>
    <div class="grid">

        <?php while($row = mysqli_fetch_assoc($certificates)) { ?>
            <div class="card certificate-card">
                <img src="<?php echo $row['gambar']; ?>" alt="Sertifikat">
                <h3><?php echo $row['nama_sertifikat']; ?></h3>
            </div>
        <?php } ?>

    </div>
</section>

<footer>
    <p>© 2026 <?php echo $profile['nama']; ?></p>
    <p>Email: <?php echo $profile['email']; ?></p>
</footer>

</body>
</html>