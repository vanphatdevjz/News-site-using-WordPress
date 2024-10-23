<?php
// Add custom Theme Functions here
function get_google_sheet_count() {
    $url = 'https://docs.google.com/spreadsheets/d/19kjtLUIfCpos8dElenmQsiMO7n0d3Y4vBtbgAaTXXeI/gviz/tq?tqx=out:csv';
    $response = wp_remote_get($url);
    
    if (is_wp_error($response)) {
        return 'Error fetching data';
    }

    $body = wp_remote_retrieve_body($response);

    // Phân tích dữ liệu CSV
    $rows = explode("\n", $body);
    // Giả sử bạn muốn đếm số lượng dòng không trống
    $number_of_entries = count(array_filter($rows)) - 1; // Trừ 1 cho tiêu đề

    return $number_of_entries; // Trả về số lượng
}

// Đăng ký shortcode
add_shortcode('google_sheet_count', 'get_google_sheet_count');
