<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料輸入</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .error { color: red; font-size: 0.9em; display: none; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>

    <h2>使用者資料輸入</h2>

    <form id="userForm">
        <div class="form-group">
            <label for="name">姓名：</label>
            <input type="text" id="name" name="name" placeholder="請輸入 2-5 字中文姓名">
            <div id="nameError" class="error">姓名格式不正確（請輸入 2~5 字中文）</div>
        </div>

        <div class="form-group">
            <label for="phone">電話：</label>
            <input type="text" id="phone" name="phone" placeholder="例如：0912345678">
            <div id="phoneError" class="error">電話格式不正確（請輸入 10 碼台灣手機號碼）</div>
        </div>

        <div class="form-group">
            <label for="email">電子信箱：</label>
            <input type="email" id="email" name="email" placeholder="例如：example@mail.com">
            <div id="emailError" class="error">電子信箱格式不正確</div>
        </div>

        <button type="submit">送出資料</button>
    </form>

    <script>
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault(); // 阻止表單預設跳頁送出行為

            // 隱藏所有錯誤訊息
            document.querySelectorAll('.error').forEach(el => el.style.display = 'none');

            // 取得輸入值
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();

            // 正則表達式定義
            const nameRegex = /^[\u4e00-\u9fa5]{2,5}$/; // 2 到 5 個中文字
            const phoneRegex = /^09\d{8}$/; // 台灣手機號碼格式（09開頭共10碼）
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            let isFormValid = true;

            // 驗證姓名
            if (!nameRegex.test(name)) {
                document.getElementById('nameError').style.display = 'block';
                isFormValid = false;
            }

            // 驗證電話
            if (!phoneRegex.test(phone)) {
                document.getElementById('phoneError').style.display = 'block';
                isFormValid = false;
            }

            // 驗證信箱
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').style.display = 'block';
                isFormValid = false;
            }

            // 全部驗證通過，整理成 data 導到後端
            if (isFormValid) {
                const payload = { name, phone, email };

                // 使用 Fetch API 非同步傳送到 Laravel 後端
                fetch('/submit-user-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('後端驗證成功並成功接收資料！');
                        console.log(data.user);
                    } else {
                        // 處理後端驗證失敗返回的錯誤
                        alert('後端驗證失敗：' + JSON.stringify(data.errors));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/user_form.blade.php ENDPATH**/ ?>