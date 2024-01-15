
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt API</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        
    
        h1{
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:35px;
        }

      

    </style>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="..." height="56">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">University</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Faculties</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              More
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Students</a></li>
              <li><a class="dropdown-item" href="#">Services</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <h1>Universities</h1>
  <ul>
  </ul>

  
<?php
         $api = "http://universities.hipolabs.com/search?country=" . str_replace(" ", "20%", $_GET['country']) ;
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $api);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $data = curl_exec($ch);
         curl_close($ch);
         $universities = json_decode($data, true);
         $json = file_get_contents($api);
         $unis = json_decode($json);
         $count = 0;
         $results_per_page = 10;
         $page = 0;
         $acc = 1;

        

         echo " </li>";
         echo "</ul>";
         echo "</nav>";
 
         echo '<button onclick="exportData()"> Show as JSON</button>';
         echo '<script>';
         echo 'function exportData() {';
         echo '  var data = ' . json_encode($universities) . ';';
         echo '  var blob = new Blob([JSON.stringify(data, null, 2)], {type: "application/json"});';
         echo '  var url = URL.createObjectURL(blob);';
         echo '  window.open(url, "_blank");';
         echo '}';
         echo '</script>';

         echo"<br>";
         echo"<br>";

         if (!isset($_GET['page'])) {
             $page = 1;
         } else {
             $page = $_GET['page'];
         }
         

         foreach ($unis as $uni) {
             if ($count > ($page * 10) - 10 && $count <= $page * 10) {
                 echo "<div class='accordion' id='accordionExample'>";
                 echo "<div class='accordion-item' id=" . $acc . ">";
                 echo "<h2 class='accordion-header' id='. $acc .'>";
                 echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#c" . $acc . "' aria-expanded='true' aria-controls='" . $acc . "'>" . $uni->name . "</button>";
                 echo "</h2>";
                 echo "<div id='c" . $acc . "' class='accordion-collapse collapse' aria-labelledby='. $acc .' data-bs-parent='#accordionExample'>";
                 echo "<div class='accordion-body'>";
                 echo '<strong>' . $uni->web_pages[0] . '</strong>';
                 echo "</div>";
                 echo "</div>";
                 echo "</div>";
                 $acc += 1;
             }
             $count+=1;
         }
         echo "<br>";
         ?>
         <div style="display: flex; justify-content:center; align-items:center;">
         <?php
         $results_per_page = 10;
         $count += 0;
         $number_of_pages = ceil($count / $results_per_page);
         $this_page_first_result = ($page - 1) * $results_per_page;
         echo "<nav aria-label='Page navigation example'>";
         echo "<ul class='pagination'>";
         echo "<li class='page-item'>";
         $this_site = htmlentities($_SERVER['PHP_SELF']);
         echo "</li>";
         echo "<li class='page-item'>";
         if ($page == 1 && $number_of_pages > 4 && $page < $number_of_pages) {
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 2) . "'>" . ($page + 2) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($number_of_pages) . "'>" . ($number_of_pages) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
         } else if ($page == 2 && $number_of_pages > 4) {
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($number_of_pages) . "'>" . ($number_of_pages) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
         } else if ($page >= 3 && $number_of_pages > 4 && $page <= $number_of_pages - 2) {
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($number_of_pages) . "'>" . ($number_of_pages) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
         } else if ($page > $number_of_pages - 2 && $number_of_pages > 4 && $page < $number_of_pages) {
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
             echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
         } else if ($page == $number_of_pages && $number_of_pages > 4) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 2) . "'>" . ($page - 2) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
        } else if ($page == 1 && $number_of_pages == 3 && $page < $number_of_pages) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($number_of_pages) . "'>" . ($number_of_pages) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
        } else if ($page == 2 && $number_of_pages == 3 && $page < $number_of_pages) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
        } else if ($page == $number_of_pages && $number_of_pages == 3) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
        } else if ($page == 1 && $number_of_pages == 2) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page + 1) . "'>Next </a></li>";
        } else if ($page == 2 && $number_of_pages == 2) {
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page - 1) . "'>Previous </a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . ($page / $page) . "'>" . ($page / $page) . "</a></li>";
            echo "<li class='page-item'><a class='page-link' href = 'uni.php?country=" . $_GET['country'] . "&page=" . $page . "'>" . $page . "</a></li>";
        }
       

?>

</div>
         
         
         
         
         
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>

