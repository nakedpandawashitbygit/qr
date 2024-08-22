<?php
include_once 'config.php';

if (isset($_GET['url'])) {
    $shortened_url = $_GET['url'];

    $stmt = $conn->prepare("SELECT original_url FROM shortened_urls WHERE shortened_url = ?");
    $stmt->bind_param("s", $shortened_url);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_url = $row['original_url'];
        header("Location: $original_url");
        exit();
    } else {
        echo "Сокращенная ссылка не найдена";
    }

    $stmt->close();
} else {
    echo "Некорректный запрос";
}

$conn->close();
?>