<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>食べたもの登録</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/reset.css" rel="stylesheet" type="text/css">
  </head>

  <body>
  <a href="/sugar/{{ Auth::user()->id }}">list</a>
      <div class="main">
        <div class="title">
          <h2>更新</h2>
        </div>
        <div class="result">
          <h3 class="subtitle">登録糖質</h3>
          <span id="result">0 g</span>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/sugar/edit/{id}" method="post" id="product">
          @csrf
          <div class="input">
            <span>食べた商品</span> : 
            <select name="product_id" id="product_id" onchange='changeSelectBox()'>
              @foreach($products as $product)
                <option value="{{$product->product_id}}" {{ $product->product_id == $userProduct->product_id ? 'selected' : '' }} required>{{$product->name}}</option>
              @endforeach
            </select><br/>
          </div>
          <div class="input">
            <span>数量</span> : <input type="number" name="amount" id="amount" step="0.1" min="0" placeholder="食べた数（個）を入力してください" value="{{$userProduct->amount}}" required onchange='changeSelectBox()'><br/>
          </div>
          <div class="input">
            <span>日付</span> : <input type="date" name="date" value="{{$userProduct->date}}" required>
          </div>

          <button type="submit" >更新</button>
        </form>

        <!-- <script type="text/javascript">
          function changeSelectBox() {
            var selectedProductId = document.getElementById("product_id").value;
            var amount = document.getElementById("amount").value;
            var url = `/sugar/calc?selectedProductId=${selectedProductId}&amount=${amount}`;

            fetch(url)
            .then(response => {
            return response.json();
            }).then(result => {
              document.getElementById("result").innerText = Math.round(result*10)/10 + " g";
              }
            );
          };
        </script> -->
      </div>
  </body>
</html>