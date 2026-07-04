<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')

<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/news"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
                <button type="button" class="btn btn-success" title="{{ $title }}">{{ $title }}</button>
            </h3>

            <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fas fa-minus"></i></button>
	          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fas fa-times"></i></button>
	        </div> 
        </div>
          <!-- /.card-header -->
        <div class="card-body">
            <form id="profileForm" action="{{url('present/adl')}}" method="post">
                {{-- CSRF 欄位 --}}
				{{ csrf_field() }}
                {{-- 隱藏方法欄位 --}}
                {{ method_field('PUT') }}
                <div class="container">

                    <h3 for="resume_name">【履歷名稱】</h3>
                    <div class="form-group col-md-3">
                        <input class="form-control" type="text" name="resume_name" id="resume_name" value="">
                    </div>
                    <h3 for="resume_information">【基本資料】</h3>
                    <div class="form-group col-md-3">
                        <label for="resume_nickname">姓名:</label>
                        <input class="form-control" type="text" name="resume_nickname" id="resume_nickname">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_sex">性別:</label>
                        <select name="resume_sex" id="resume_sex" class="form-control">
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_age">年齡:</label>
                        <input class="form-control" type="text" name="resume_age" id="resume_age">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="resume_marry">婚姻狀態:</label>
                        <select name="resume_marry" id="resume_marry" class="form-control">
                            <option value="1">已婚</option>
                            <option value="2">未婚</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_education">畢業學校:</label>
                        <input class="form-control" type="text" name="resume_education" id="resume_education">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_cellphone">手機:</label>
                        <input class="form-control" type="text" name="resume_cellphone" id="resume_cellphone">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_email">信箱:</label>
                        <input class="form-control" type="text" name="resume_email" id="resume_email">
                    </div>
                    
                    <hr>

                    <label for="resume_introduction"></label>
                    <div class="form-group col-md-3">
                        <label for="resume_introduction">簡介:</label>
                        <input class="form-control" type="text" name="resume_introduction" id="resume_introduction">
                    </div>

                    <hr>

                    
                    <h3>【工作經歷】</h3>
                    <div class="form-group col-md-3">
                        <!-- <label for="resume_experience">經歷:</label> -->
                        <!-- <input class="form-control" type="text" name="resume_experience"> -->
                        <div class="resume-section">
                        <!-- <label for="resume_experience">經歷:</label> -->
                        <div id="experience-list"></div>
                        
                        <button type="button" id="add-btn"  class="btn btn-success" style="margin-top: 10px;">+ 新增經歷</button>
                        </div>
                        <script>
                            const addBtn = document.getElementById('add-btn');
                            const experienceList = document.getElementById('experience-list');

                            // 更新序號的函式
                            function updateIndex() {
                            const items = experienceList.querySelectorAll('.experience-item');
                            items.forEach((item, index) => {
                                // 找到顯示數字的 span 並更新為 index + 1
                                item.querySelector('.item-number').innerText = `經歷 ${index + 1}`;
                            });
                            }

                            // 點擊新增按鈕
                            addBtn.addEventListener('click', () => {
                            const itemDiv = document.createElement('div');
                            itemDiv.className = 'experience-item';
                            itemDiv.style.marginBottom = '15px';
                            itemDiv.style.padding = '10px';
                            itemDiv.style.border = '1px solid #ddd';

                            itemDiv.innerHTML = `
                                <strong class="item-number"></strong> 
                                <div style="display: inline-block; margin-left: 10px;">
                                <input type="text" class="form-control" placeholder="在職時間" name="work_time[]">
                                <input type="text" class="form-control" placeholder="公司名稱" name="work_company[]">
                                <input type="text" class="form-control"  placeholder="職位" name="work_post[]">
                                <button type="button" class="btn btn-danger delete-btn">刪除</button>
                                </div>
                            `;

                            experienceList.appendChild(itemDiv);
                            
                            // 新增後重新編號
                            updateIndex();

                            // 綁定刪除事件
                            itemDiv.querySelector('.delete-btn').addEventListener('click', () => {
                                itemDiv.remove();
                                // 刪除後也要重新編號，確保數字連續
                                updateIndex();
                            });
                            });

                            // 頁面載入時先預設顯示第一筆
                            // window.onload = () => addBtn.click();
                        </script>
                    </div>

                    <hr>

                    
                    <hr>

                    <style>
                        /* resources/css/app.css */
                        .item-card { border: 1px solid #e2e8f0; padding: 1.5rem; margin-bottom: 1rem; border-radius: 8px; background: #fff; position: relative; transition: 0.3s; }
                        .badge { background: #3182ce; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 0.85em; }
                        .btn-delete { color: #e53e3e; cursor: pointer; float: right; font-weight: bold; border: 1px solid #e53e3e; padding: 2px 8px; border-radius: 4px; }
                        .btn-delete:hover { background: #e53e3e; color: #fff; }

                        /* 星星評分系統 */
                        .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 5px; }
                        .star-rating input { display: none; }
                        .star-rating label { font-size: 2.5rem; color: #cbd5e0; cursor: pointer; transition: 0.2s; }
                        .star-rating label::before { content: '★'; }

                        /* 滑過時：由右到左黃色閃爍 */
                        .star-rating label:hover,
                        .star-rating label:hover ~ label {
                            color: #f6e05e;
                            animation: yellow-blink 0.6s infinite alternate;
                        }

                        /* 選取後：保持深黃色並停止閃爍 */
                        .star-rating input:checked ~ label {
                            color: #ecc94b;
                            animation: none;
                        }

                        @keyframes yellow-blink {
                            from { opacity: 1; filter: drop-shadow(0 0 2px #ecc94b); }
                            to { opacity: 0.5; filter: drop-shadow(0 0 8px #f6e05e); }
                        }
                    </style>

                    
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="payload" id="json_payload">

                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
                    <style>
                        /* body { font-family: Arial, sans-serif; padding: 40px; background: #f4f6f9; } */
                        /* .container { max-width: 700px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); } */
                        .skill-row { display: flex; align-items: center; margin-bottom: 15px; background: #fafafa; padding: 10px; border-radius: 5px; border:1px solid #d6d6d6; margin-right:350px;}
                        .row-num { font-weight: bold; margin-right: 15px; width: 30px; color: #666; }
                        .skill-input { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-right: 15px; margin-left: 15px;}
                        
                        /* 星星評分樣式 */
                        .rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; margin-right: 15px; }
                        .rating input { display: none; }
                        .rating label { font-size: 24px; color: #ccc; cursor: pointer; transition: color 0.2s; padding: 0 2px; }
                        .rating label:hover,
                        .rating label:hover ~ label,
                        .rating input:checked ~ label { color: #f5b301; }

                        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
                        .btn-add { background: #28a745; color: #fff; margin-bottom: 20px; }
                        .btn-submit { background: #007bff; color: #fff; width: 100%; font-size: 16px; margin-top: 20px; }
                        /* .btn-delete { background: #dc3545; color: #fff; padding: 5px 10px; font-size: 12px; } */
                    </style>
                    <div class="container" style="/*max-width: 850px;*/ margin: auto; padding: 20px;">
                        <section>
                            <h3 style="display: flex; justify-content: space-between;">工作經歷</h3>
                            <div id="f1"></div>
                            <div id="exp-list"></div>
                            <button type="button" class="btn btn-success" onclick="addItem('exp')">+ 新增經歷</button>
                        </section>

                        <section style="margin-top: 40px;">
                            <h3 style="display: flex; justify-content: space-between;">專業技能</h3>
                            <div id="skill-list"></div>
                            <button type="button" class="btn btn-success" onclick="addItem('skill')">+ 新增技能</button>
                        </section>

                        <button type="button"  style="width: 100%; padding: 15px; background: #2f855a; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 30px; font-size: 1.1rem;">
                            儲存並提交更新 (PUT)
                        </button>
                    </div>

                    <script>
                        let counters = { exp: 0, skill: 0 };
                        
                        exp = document.getElementById('exp');
                        exp.innerHTML = `<div class="item-card exp-item">
                                    <span class="btn-delete" onclick="removeItem(this, 'exp')">移除</span>
                                    <div class="item-header"><span class="badge num-label">經歷 #1</span></div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 10px;">
                                        <input type="text" placeholder="在職時間 (如: 2020-2023)" name="resume_period[]" class="form-control in-period">
                                        <input type="text" placeholder="公司名稱" name="resume_company[]" class="form-control in-company">
                                        <input type="text" placeholder="職稱" name="resume_title[]" class="form-control in-title">
                                    </div>
                                </div>`;
                        function addItem(type) {
                            counters[type]++;
                            const container = document.getElementById(`${type}-list`);
                            const div = document.createElement('div');
                            div.className = `item-card ${type}-item`;
                            
                            if (type === 'exp') {
                                div.innerHTML = `
                                    <span class="btn-delete" onclick="removeItem(this, 'exp')">移除</span>
                                    <div class="item-header"><span class="badge num-label">經歷 #${counters[type]}</span></div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 10px;">
                                        <input type="text" placeholder="在職時間 (如: 2020-2023)" name="resume_period[]" class="form-control in-period">
                                        <input type="text" placeholder="公司名稱" name="resume_company[]" class="form-control in-company">
                                        <input type="text" placeholder="職稱" name="resume_title[]" class="form-control in-title">
                                    </div>
                                `;
                            } else {
                                let stars = `<div class="star-rating">`;
                                for (let i = 5; i >= 1; i--) {
                                    stars += `
                                        <input type="radio" id="s${counters[type]}-${i}" name="rate-${counters[type]}" value="${i}">
                                        <label for="s${counters[type]}-${i}"></label>`;
                                }
                                stars += `</div>`;
                                
                                div.innerHTML = `
                                    <span class="btn-delete" onclick="removeItem(this, 'skill')">移除</span>
                                    <div class="item-header"><span class="badge num-label">技能 #${counters[type]}</span></div>
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        <select name="resume_skill_type[]" class="form-control in-type">
                                            <option value="frontend">前端技能</option>
                                            <option value="backend">後端技能</option>
                                        </select>
                                        <input type="text" placeholder="技能名稱 (如: Vue, Laravel)" name="resume_skill[]" class="form-control in-name" style="flex-grow: 1;">
                                        ${stars}
                                    </div>
                                `;
                            }
                            container.appendChild(div);
                            reorder(type);
                        }

                        function removeItem(el, type) {
                            el.closest('.item-card').remove();
                            reorder(type);
                        }

                        function reorder(type) {
                            const items = document.querySelectorAll(`.${type}-item`);
                            items.forEach((item, index) => {
                                const text = type === 'exp' ? '經歷' : '技能';
                                item.querySelector('.num-label').innerText = `${text} #${index + 1}`;
                            });
                        }

                        function packAndSubmit() {
                            let resume_name = document.getElementById('resume_name').value;
                            let resume_nickname = document.getElementById('resume_nickname').value;
                            let resume_sex = document.getElementById('resume_sex').value;
                            let resume_age = document.getElementById('resume_age').value;
                            let resume_marry = document.getElementById('resume_marry').value;
                            let resume_education = document.getElementById('resume_education').value;
                            let resume_cellphone = document.getElementById('resume_cellphone').value;
                            let resume_email = document.getElementById('resume_email').value;

                            const data = { 
                                resume_name: resume_name,
                                resume_nickname: resume_nickname,
                                resume_sex: resume_sex,
                                resume_age: resume_age,
                                resume_marry: resume_marry,
                                resume_education: resume_education,
                                resume_cellphone: resume_cellphone,
                                resume_email: resume_email,
                                experiences: [],
                                skills: []
                             };

                            // 打包經歷
                            document.querySelectorAll('.exp-item').forEach(item => {
                                data.experiences.push({
                                    period: item.querySelector('.in-period').value,
                                    company: item.querySelector('.in-company').value,
                                    title: item.querySelector('.in-title').value
                                });
                            });

                            // 打包技能
                            document.querySelectorAll('.skill-item').forEach((item, index) => {
                                const checked = item.querySelector('input[type="radio"]:checked');
                                data.skills.push({
                                    type: item.querySelector('.in-type').value,
                                    name: item.querySelector('.in-name').value,
                                    level: checked ? checked.value : 0
                                });
                            });

                            document.getElementById('json_payload').value = JSON.stringify(data);
                            document.getElementById('profileForm').submit();
                        }
                    </script>

                    <div class="form-group col-md-3">
                        <label for="resume_picme">頭像:</label>
                        <input id="resume_picme" type="file" name="resume_picme" placeholder="resume_picme" value="">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="resume_summary">求職簡介:</label>
                        <textarea name="resume_summary" id="resume_summary" class="form-control"></textarea>
                    </div>

                    <hr>
                    <div>
                        <!-- rating.blade.php -->
                        
                            <div class="star-rating">
                                <!-- 倒序排列以使用 CSS 的 + 選擇器 -->
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5">★</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4">★</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3">★</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2">★</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1">★</label>
                            </div>
                            
                        <style>
                            .star-rating {
                                display: flex;
                                flex-direction: row-reverse; /* 反轉，讓 :checked ~ label 能選到之前的星星 */
                                justify-content: flex-end;
                            }

                            .star-rating input {
                                display: none; /* 隱藏 Radio 按鈕 */
                            }

                            .star-rating label {
                                font-size: 2rem;
                                color: #ddd; /* 預設為灰色 */
                                cursor: pointer;
                            }

                            /* 選取時的星星與之前的星星變為橘色 */
                            .star-rating input:checked ~ label {
                                color: #f5a623;
                            }

                            /* 滑鼠懸停時的顏色 */
                            .star-rating label:hover,
                            .star-rating label:hover ~ label {
                                color: #f5a623;
                            }
                        </style>
                        <script>
                            document.querySelectorAll('.star-rating input').forEach(radio => {
                                radio.addEventListener('change', (e) => {
                                    console.log(`您選擇了: ${e.target.value} 顆星`);
                                    // 可以在這裡用 Ajax 發送 rating.submit
                                }, index2);
                            });
                        </script>
                    </div>
                </div>
                <input id="resume_display" type="hidden" name="resume_display" value="0">
                <button type="submit" onclick="packAndSubmit()" class="btn btn-primary">新增</button>
            </form>
            
		</div>
    </div>

</div>
@endsection