<?php
include_once "../Classes/database.php"; 

$pdo = getDatabaseConnection(); // Function to get DB connection from your db connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $what = htmlspecialchars($_GET['what']);

    $deleteQuery = "";
    switch ($what) {
        case 'tour':
            $deleteQuery = "DELETE FROM tours WHERE id = ?";
            break;
        case 'hotel':
            $deleteQuery = "DELETE FROM hotels WHERE id = ?";
            break;
        // Add more cases as needed
        default:
            header('Location: ../admin.php');
            exit();
    }

    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteSuccess = $deleteStmt->execute([$id]);

    if ($deleteSuccess) {
        header('Location: ../admin.php?what=' . $what . '&data=' . urlencode($_GET['data']));
        exit();
    } else {
        header('Location: error.html');
        exit();
    }
} else {
    header('Location: ../admin.php');
    exit();
}
?>
