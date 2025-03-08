<?php require_once("config.php");
      include("./layout/hlava.php");
      include("./layout/navbar.php"); ?>
      <?php
$servername = "localhost";
$dbname = "bible"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_books = "SELECT id, nazev FROM knihy";
$result_books = $conn->query($sql_books);

$chapters = [];
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $sql_chapters = "SELECT id, cislo_kapitoly FROM kapitoly WHERE id_knihy = $book_id";
    $result_chapters = $conn->query($sql_chapters);
    while ($row = $result_chapters->fetch_assoc()) {
        $chapters[] = $row;
    }
}

$verses = [];
if (isset($_GET['chapter_id'])) {
    $chapter_id = $_GET['chapter_id'];
    $sql_verses = "SELECT cislo_verse, text_verse FROM verse WHERE id_kapitoly = $chapter_id ORDER BY cislo_verse";
    $result_verses = $conn->query($sql_verses);
    while ($row = $result_verses->fetch_assoc()) {
        $verses[] = $row;
    }
}

$conn->close();
?>
    
    <body id="cerna">
    <h1>Procházejte Bibli</h1>

    <form action="" method="GET">
        <h2>Vyberte knihu:</h2>
        <select name="book_id" onchange="this.form.submit()">
            <option value="">-- Vyberte knihu --</option>
            <?php
            if ($result_books->num_rows > 0) {
                while ($row = $result_books->fetch_assoc()) {
                    $selected = (isset($_GET['book_id']) && $_GET['book_id'] == $row['id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['nazev'] . "</option>";
                }
            }
            ?>
        </select>

        <?php if (isset($_GET['book_id'])): ?>
            <h2>Vyberte kapitolu:</h2>
            <select name="chapter_id" onchange="this.form.submit()">
                <option value="">-- Vyberte kapitolu --</option>
                <?php
                foreach ($chapters as $chapter) {
                    $selected = (isset($_GET['chapter_id']) && $_GET['chapter_id'] == $chapter['id']) ? 'selected' : '';
                    echo "<option value='" . $chapter['id'] . "' $selected>" . $chapter['cislo_kapitoly'] . "</option>";
                }
                ?>
            </select>
        <?php endif; ?>

        <?php if (isset($_GET['chapter_id'])): ?>
            <h2>Verše:</h2>
            <ul>
                <?php
                foreach ($verses as $verse) {
                    echo "<li><strong>" . $verse['cislo_verse'] . ":</strong> " . $verse['text_verse'] . "</li>";
                }
                ?>
            </ul>
        <?php endif; ?>
    </form>
</body>
