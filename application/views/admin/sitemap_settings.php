<!DOCTYPE html>
<html>

<head>
    <title>XML Sitemap</title>
    <style>
        body {
            background: #23272b;
            color: #fff;
            font-family: Arial;
        }

        .container {
            background: #3393ff;
            padding: 30px;
            border-radius: 7px;
            max-width: 900px;
            margin: 40px auto;
        }

        h1 {
            color: #fff;
        }

        table {
            width: 100%;
            background: #222;
            border-radius: 7px;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #307ddf;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #283142;
        }

        a {
            color: #3393ff;
        }

        .xml-btn {
            background: #222;
            color: #fff;
            padding: 8px 18px;
            border: 1px solid #3393ff;
            border-radius: 4px;
            margin-bottom: 20px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>XML Sitemap</h1>
        <p>
            <a class="xml-btn" href="<?php echo base_url('sitemap/xml'); ?>">Download Raw XML</a>
        </p>
        <table>
            <tr>
                <th>URL</th>
                <th>Last Mod.</th>
                <th>Changefreq</th>
                <th>Priority</th>
            </tr>
            <?php foreach ($urls as $url): ?>
                <tr>
                    <td><a
                            href="<?php echo htmlspecialchars($url['url']); ?>"><?php echo htmlspecialchars($url['url']); ?></a>
                    </td>
                    <td><?php echo $url['last_modified']; ?></td>
                    <td><?php echo $url['change_frequency']; ?></td>
                    <td><?php echo $url['priority']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>