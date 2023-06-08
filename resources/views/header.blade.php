<nav class="navbar navbar-expand-lg navbar-light bg-light dashboard">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <script>
    function confirmAction() {
      // 使用 confirm 函數顯示確認對話框
      var result = confirm("確定要同步線上資料庫嗎?這將覆蓋掉目前本機資料！");
      
      // 如果用戶點擊了確定按鈕
      if (result) {
        // 在這裡執行您想要的動作
        window.location.href = "/downloaddb";
      } else {
        // 用戶取消操作，不執行任何動作
      }
    }
  </script>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        @guest
        <li class="nav-item">
          <a class="nav-link" href="/punch/create">打卡</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/punch">打卡紀錄</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/users">工讀生資料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="confirmAction(); return false;" >同步連線版資料</a>
        </li>
        @if (Route::has('login'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
          </li>
        @endif
        @else
        <li class="nav-item">
          <a class="nav-link" href="/users">工讀生資料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/punch">打卡紀錄</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/basesalary/1/edit">修改基本薪資</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="confirmAction(); return false;" >同步連線版資料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
              {{ __('登出') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
        @endguest
  </div>