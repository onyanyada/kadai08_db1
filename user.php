<?php
session_start();
include "funcs.php";
sschk();
?>



<?php include("head.php"); ?>
<title>USERデータ登録</title>
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>


  <main>
    <?php if ($_SESSION["kanri_flg"] == "1") { ?>
      <form method="post" action="user-confirm.php">
        <h2>ユーザー登録</h2>
        <label>名前：<input type="text" name="name"></label><br>
        <label>Login ID：<input type="text" name="lid"></label><br>
        <label>Login PW<input type="text" name="lpw"></label><br>
        <label>管理FLG：
          一般<input type="radio" name="kanri_flg" value="0">　
          管理者<input type="radio" name="kanri_flg" value="1">
        </label>
        <br>
        <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
        <input type="submit" value="送信">
      </form>
    <?php } ?>

    <?php if ($_SESSION["kanri_flg"] == "0") { ?>
      <p>管理者権限を持っていません</p>
    <?php } ?>
  </main>


</body>

</html>