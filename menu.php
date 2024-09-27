<?php
include_once("funcs.php");
?>
<header class="login-header">
    <div class="nav">
        <ul>
            <li>
                <a class="nav-item" href="select.php">アンケート一覧</a>
            </li>
            <?php if (isset($_SESSION["kanri_flg"]) && $_SESSION["kanri_flg"] == "1") { ?>

                <li>
                    <a class="nav-item" href="user-select.php">ユーザー一覧</a>
                </li>
                <li>
                    <a class="nav-item" href="user.php">ユーザー登録</a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="logout.php">ログアウト</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="current-user">
        <?php if (isset($_SESSION["name"])) {
            echo h($_SESSION["name"]) . "さん";
        } ?>
    </div>
</header>