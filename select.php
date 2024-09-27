<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();


//２．データ登録SQL作成
// form2_tableとtz_tableを結合
$pdo = db_conn();
$sql = "SELECT f.*, GROUP_CONCAT(t.timeZone SEPARATOR ', ') AS timeZones 
        FROM form2_table f
        LEFT JOIN tz_table t ON f.id = t.form2_id 
        GROUP BY f.id";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


// tz_table
$tz_sql = "SELECT * FROM tz_table";
$tz_stmt = $pdo->prepare($tz_sql);
$tz_status = $tz_stmt->execute();


//３．データ表示
// form2_table
$values = "";
if ($status == false) {
  sql_error($stmt);
}

// tz_table
$tz_values = "";
if ($tz_status == false) {
  sql_error($tz_stmt);
}


//全データ取得
// form2_table
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

// tz_table
$tz_values =  $tz_stmt->fetchAll(PDO::FETCH_ASSOC);
$tz_json = json_encode($tz_values, JSON_UNESCAPED_UNICODE);

?>
<?php include("head.php"); ?>
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/select.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>

  <main>
    <h2>漫画のアンケート結果</h2>
    <div class="results">
      <!-- 年収：散布図-->
      <div class="item">
        <h2>年収と漫画課金額の関係</h2>
        <canvas id="incomeChart" class="chart"></canvas>
      </div>
      <!-- 年齢・性別 -->
      <div class="item">
        <h2>年齢・性別と漫画課金額の関係</h2>
        <canvas id="ageGenderChart" class="chart"></canvas>
      </div>
      <!-- 時間・パイチャート -->
      <div class="item">
        <h2>漫画にかける時間/週</h2>
        <canvas id="timeChart" class="chart"></canvas>
      </div>
      <!-- 時間帯・ヒートマップ -->
      <div class="item">
        <h2>いつ漫画を読むか</h2>
        <canvas id="timeZoneChart" width="400" height="400"></canvas>
      </div>
    </div>
    <div class="data-results">

      <table>
        <thead>
          <tr>
            <th>id</th>
            <th>名前</th>
            <th>メール</th>
            <th>支出</th>
            <th>収入</th>
            <th>年齢</th>
            <th>性別</th>
            <th>時間</th>
            <th>タイムゾーン</th>
            <th>地域</th>
            <th>タイムスタンプ</th>
            <?php if ($_SESSION["kanri_flg"] == "1") { ?>
              <th>更新</th>
              <th>削除</th>
            <?php } ?>
          </tr>
        </thead>
        <?php foreach ($values as $v) { ?>
          <tr>
            <td><?= h($v["id"]) ?></td>
            <td><?= h($v["name"]) ?></td>
            <td><?= h($v["email"]) ?></td>
            <td><?= h($v["spending"]) ?>万円以下</td>
            <td><?= h($v["income"]) ?>万円以下</td>
            <td><?= h($v["age"]) ?>代</td>
            <td><?= h($v["gender"]) ?></td>
            <td><?= h($v["hour"]) ?>時間以下</td>
            <td><?= h($v["timeZones"]) ?></td>
            <td><?= h($v["region"]) ?></td>
            <td><?= h($v["indate"]) ?></td>
            <?php if ($_SESSION["kanri_flg"] == "1") { ?>
              <td><a href="detail.php?id=<?= $v["id"] ?>">更新</a></td>
              <td><a href="delete.php?id=<?= $v["id"] ?>">削除</a></td>
            <?php } ?>
          </tr>
        <?php } ?>
      </table>
    </div>
  </main>

  <script>
    const datas = <?= $json; ?>;
    console.dir(datas);
    const tz_datas = <?= $tz_json; ?>;
    console.dir(tz_datas);
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/data.js"></script>
  <script src="js/income.js"></script>
  <script src="js/ageGender.js"></script>
  <script src="js/hour.js"></script>
  <script src="js/timeZone.js"></script>
</body>

</html>