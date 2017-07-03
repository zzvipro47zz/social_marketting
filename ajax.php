<?php

include_once('init.php');
header('Content-Type: text/json');

if (isset($_REQUEST['core'])) {
    if ($_REQUEST['core'] === 'token') {
        $tokenManager = new TokenManager();

        // Save token
        if ($_REQUEST['act'] === 'add') {
            $data = $tokenManager->add();
            if ($data == -1001) {
                echo json(false, 'Không lấy được thông tin tài khoản.');
            } elseif ($data == -1002) {
                echo json(true, 'Tài khoản đã tồn tại');
            } else {
                echo json(true, 'Lưu thành công!', $data);
            }
            die;
        }

        // Get List Token
        if ($_REQUEST['act'] === 'list') {
            $data = $tokenManager->list();
            echo json(true, 'Lấy thành công!', $data);
            die;
        }

        // Get Info Token
        if ($_REQUEST['act'] === 'get-info') {
            $data = $tokenManager->getWithId($_REQUEST['access_key']);
            if ($data) {
                echo json(true, 'Lấy thành công!', $data);
            } else {
                echo json(false, 'Lấy info không thành công!');
            }
            die;
        }

        // Delete Token With Id
        if ($_REQUEST['act'] === 'delete') {
            $data = $tokenManager->deleteWithId($_REQUEST['access_key']);
            if ($data) {
                echo json(true, 'Xóa thành công!', $data);
            } else {
                echo json(false, 'Xóa không thành công!');
            }
            die;
        }
    }
}
echo json('false', 'Không xác định rõ hành động!');