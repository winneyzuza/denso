<html>
<head>
	<title>Gun test Join table</title>
</head>
<body>

    <table border=1 width='75%' align='center'>
        <caption>THIS IS TEST</caption>
        <tr align="center">
            <th>1</th> 
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
        </tr>
        <tr aligh="center">
            <td colspan="3"><?php echo $hi; ?></td>
            <td colspan="2"><?php echo $hay; ?></td>
        </tr>
       <?php
            foreach ($getdata as $key => $row) {
                echo "<tr>";
                echo "<td>". $row['id']."</td>";
                echo "<td>". $row['problems_th']."</td>";
                echo "<td>". $row['problems_en']."</td>";
                foreach ($partname as $key => $part) {
                    if ($part['part_id'] === $row['part_id']) {
                        echo "<td>". $part['name_eng']."</td>";
                        echo "<td>". $part['name_th']."</td>";
                        break;
                    }
                }
                
                echo "</tr>";

            }
        ?> 
    </table>
</body>
</html>