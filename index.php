<?php
$htdocsPath = realpath(__DIR__ . '/../'); // Subir desde /dashboard a /htdocs
$excluded = ['dashboard', '.', '..', '.DS_Store', 'webalizer', 'img'];

$projects = array_filter(scandir($htdocsPath), function ($item) use ($htdocsPath, $excluded) {
    return is_dir($htdocsPath . '/' . $item) && !in_array($item, $excluded);
});
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Local</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --card-bg: #ffffff;
            --body-bg: #f0f2f5;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--body-bg);
            color: var(--dark);
            line-height: 1.6;
            padding: 20px;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            color: var(--gray);
            font-size: 1.1rem;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 25px;
            transition: var(--transition);
            border-left: 4px solid var(--primary);
            height: fit-content;
            max-height: 70vh;
            width: fit-content;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-tools {
            border-left-color: var(--secondary);
        }

        .card-projects {
            border-left-color: var(--success);
        }

        .card h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .card h2 i {
            font-size: 1.6rem;
        }

        .card-tools h2 i {
            color: var(--secondary);
        }

        .card-projects h2 i {
            color: var(--success);
        }

        .item-list {
            list-style: none;
            max-height: 59vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .item-list a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            background: rgba(67, 97, 238, 0.05);
            border-radius: 8px;
            text-decoration: none;
            color: var(--dark);
            transition: var(--transition);
            font-weight: 500;
            white-space: nowrap;
        }

        .item-list a:hover {
            background: rgba(67, 97, 238, 0.1);
            transform: translateX(5px);
        }

        .item-list a i {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
            color: var(--primary);
        }

        .item-list .tools a i {
            color: var(--secondary);
        }

        .item-list .projects a i {
            color: var(--success);
        }

        .item-list.projects {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            max-height: 59vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .item-list.projects li {
            margin-bottom: 0;
            /* Eliminamos el margin-bottom ya que usamos gap */
        }

        .item-list.projects a {
            min-height: 50px;
            /* Altura mínima consistente */
            height: 100%;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px 0;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-server"></i> Panel de Control Local</h1>
            <p class="subtitle">Gestiona tus proyectos y herramientas de desarrollo</p>
        </header>

        <div class="dashboard">
            <div class="card card-tools">
                <h2><i class="fas fa-tools"></i> Herramientas del Sistema</h2>
                <ul class="item-list tools">
                    <li><a href="/dashboard/phpinfo.php" target="_blank"><i class="fas fa-info-circle"></i> PHP Info</a>
                    </li>
                    <li><a href="http://localhost/phpmyadmin" target="_blank"><i class="fas fa-database"></i>
                            phpMyAdmin</a></li>
                </ul>
            </div>

            <div class="card card-projects">
                <h2><i class="fas fa-folder-open"></i> Proyectos en htdocs</h2>
                <ul class="item-list projects">
                    <?php foreach ($projects as $project): ?>
                        <li><a href="/<?= htmlspecialchars($project) ?>" target="_blank"><i class="fas fa-folder"></i>
                                <?= htmlspecialchars($project) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p>Servidor local | <?php echo date('Y'); ?></p>
        </div>
    </div>
</body>

</html>