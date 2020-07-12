<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>食べたもの詳細</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/reset.css" rel="stylesheet" type="text/css">
  </head>

  <body>
  <a href="/sugar/{{ Auth::user()->id }}">list</a>
    <div class="main">
      <div class="title">
        <h2></h2>
      </div>
      <div class="data">
        <div class="total_sugar">
          <h3 class="subtitle" >総糖質</h3>
          @foreach($total as $x)
          <h3 id="totalSugar"> {{ $x->total_sugar }}</h3>
          @endforeach
        </div>
        <div class="standard_value">
          <h3 class="subtitle">基準値</h3>
          <h3 id="standardValue">300</h3>
        </div>
        <div class="rate"  >
          <h3 class="subtitle">一日の摂取割合</h3>
          <h3 id="rate"></h3>
        </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
      <canvas id="chartArea" style="height: 80px; width:480px;"></canvas>
      <script>
        var chartArea = document.getElementById("chartArea");
        var totalSugar = document.getElementById("totalSugar").textContent;
        var standardValue = document.getElementById("standardValue").textContent;
        document.getElementById("rate").innerText = Math.round(totalSugar/standardValue*100*10)/10 + "%";

        var data = { 
          labels: ['総糖質'],
          datasets: [{
            label:"糖質の割合",
            data: [totalSugar],
            backgroundColor: [
              '#ff0059'
            ],
        
          }]
        }
        var options = {
          scales: {
            xAxes: [{
              ticks: {
                min:0,
                max:300
              }
            }]
          }
        }
        var myChart = new Chart(chartArea, {
            type: 'horizontalBar',
            data: data,
            options: options
        });
      </script>
      <table>
        <thead>
          <tr>
            <th>商品</th>
            <th>摂取糖質</th>
            <th>数量</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($userProducts as $userProduct)
          <tr>
            <td>{{$userProduct->name}}</td>
            <td>{{$userProduct->sugar}}</td>
            <td>{{$userProduct->amount}}</td>
            <td><a href="/sugar/edit/{{$userProduct->id}}">更新</a></td>
            <td><a href="/sugar/delete/{{$userProduct->id}}">削除</a></td>
          </tr>
          @endforeach
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>